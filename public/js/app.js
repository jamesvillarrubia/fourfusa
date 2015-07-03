var current_list = [
    {
        "id": 6,
        "parent": 0,
        "order": 0
    },
    {
        "id": 3,
        "parent": 6,
        "order": 0
    },
    {
        "id": 4,
        "parent": 3,
        "order": 0
    },
    {
        "id": 5,
        "parent": 6,
        "order": 1
    },
    {
        "id": 2,
        "parent": 5,
        "order": 0
    },
    {
        "id": 1,
        "parent": 2,
        "order": 0
    }
];




$(document).ready(function(){


	Handlebars.registerHelper('ifCond', function (v1, operator, v2, options) {

	    switch (operator) {
	        case '==':
	            return (v1 == v2) ? options.fn(this) : options.inverse(this);
	        case '===':
	            return (v1 === v2) ? options.fn(this) : options.inverse(this);
	        case '<':
	            return (v1 < v2) ? options.fn(this) : options.inverse(this);
	        case '<=':
	            return (v1 <= v2) ? options.fn(this) : options.inverse(this);
	        case '>':
	            return (v1 > v2) ? options.fn(this) : options.inverse(this);
	        case '>=':
	            return (v1 >= v2) ? options.fn(this) : options.inverse(this);
	        case '&&':
	            return (v1 && v2) ? options.fn(this) : options.inverse(this);
	        case '||':
	            return (v1 || v2) ? options.fn(this) : options.inverse(this);
	        default:
	            return options.inverse(this);
	    }
	});

	Handlebars.registerHelper('fromUTC', function (v1){
		var date = new Date(v1.toString());
		return moment(date).format('YYYY/MM/DD HH:mm')
	});


	$.fn.createNestableEntry = function(item){
		var source   = $("#nestable-list-template").html();
		var template = Handlebars.compile(source);
		var html     = template(item);
		$(this).append(html);
		$(this).children('li[data-id="'+item.id+'"]').data('local',item);
	}

	$.fn.nestableToArray = function(pid, star)
	{
		
		if(!pid){
			pid = 0; //root ordered list - no siblings
		}
		if(!star){
			var star = [];
		}
		
		var new_tasks = tasks;
		var order = 0;

		$(this).children('li').each(function(){
			var li = $(this),
				listItem = $(this).children('ol'),
				lid = li.attr('data-id');
			if(!lid)
			{
				console.log(lid);
				throw 'Previous item in console.log has no id';
			}


			//Does the item have data attached?
			//YES
			if(li.data('local')){
				var li_data = li.data('local');
				//Update the element
				li_data.parent = (parseInt(pid));
				li_data.order = (parseInt(order));
			//NO
			}else{
				//TODO: SHOULD BE USING A TEMPLATE HERE
				var li_data = {
					id: parseInt(lid),
				parent: parseInt(pid),
				 order: parseInt(order)
				}
			}

			//add the element to the new storage array
			star.push(li_data);
			//attach the object to the li
			li.data('local',li_data);
			//iterate through children and keep going;
			listItem.nestableToArray(lid, star);
			order++;

		});
		if(!pid){
			$(this).data('tasks',star)
		}
	};

	$.fn.arrayToNestable = function()
	{

		//Get the storage array from 
		var star = this.data('tasks');
		
		//build each element
		var ol = $(this);
		for (var i = 0, len = star.length; i < len; i++) {
			item = star[i];
			var li = $('[data-id="'+item.id+'"]');
			if(li.length == 0){
				ol.createNestableEntry(item);
			}
		}

		//iterate through each element in the array and attach where necessary;
		for (var i = 0, len = star.length; i < len; i++) {

			var item = star[i];
			var li = $('[data-id="'+item.id+'"]');
			var par = $('[data-id="'+item.parent+'"]');
			var order = item.order;
			

			li.data('local',item);

			if (!(par.children('ol').length > 0)){
				par.prepend('<button class="dd-collapse" data-action="collapse" type="button">Collapse</button><button class="dd-expand" data-action="expand" type="button">Expand</button>');
				par.append('<ol class="dd-list"></ol>');
				var ol = par.children('ol');
				ol.css('display','block');
				if(item.collapsed){
					par.addClass('dd-collapsed');
					ol.css('display','none');
				}
				li.detach().appendTo(par.children('ol'));
			}else{
				var ol = par.children('ol');
				var list = ol.children('li');
				var set = false;
				for(var z=0; z<list.length; z++){
					if($(list[z]).data('local').order){
						var pointer = $(list[z]).data('local').order;
						if(pointer > order){
							set = true;
							$(list[z]).before(li.detach());
							break;
						}
					}
				}
				if(!set){
					li.detach().appendTo(par.children('ol'));
				}
			}

			
		};
	};

	$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});

	$.fn.submitNestable = function() {
		$('.dd > ol').nestableToArray();


        var data = $('.dd > ol').data('tasks');

		var loc = window.location;
		var currentURL = loc.protocol + '//' + loc.host;

        $.ajax({
        	method  : 'POST',
            url   : '/api/v1/tasks',
            dataType: "json",
            data  : {tasks: data},
            success: function(a,b,c){
            	console.log(a);
            },
            complete: function(a,b,c){
            	console.log(a);
            },
            error: function(a,b,c){
            	console.log(a);
            }
        });

    };


	$.fn.nestableRunCompletion = function(){

	}



	//ON LOAD

	$('.dd').nestable({maxDepth:10});
	$('.dd > ol').data('tasks',tasks);
	$('.dd > ol').arrayToNestable();


	$('.dd').on('change', function(){
		$('.dd > ol').nestableToArray();
		$('#results').html('<pre>'+JSON.stringify($('.dd > ol').data('tasks'), null, 4)+'</pre>');
	});

	$('.dd-title').on('click', function(){
		var item = $(this).closest('.dd-item');
		item.toggleClass('complete');
		item.data('local').isDone = item.hasClass('complete');
		$('#results').html('<pre>'+JSON.stringify($('.dd > ol').data('tasks'), null, 4)+'</pre>');

	});

	$('#results').html('<pre>'+JSON.stringify($('.dd > ol').data('tasks'), null, 4)+'</pre>');

	$('.dd-toolbar .fa-pencil').on('click', function(){
		$(this).closest('li').children('.dd-editbox').slideToggle(300);
	});

	$('.dd-toolbar .priority-list li').on('click',function(){
		var priority = $(this).attr('data-priority');
		var data = $(this).closest('.dd-item').data('local');
		var old_pr = parseInt(data.priority);
		data.priority = parseInt(priority);
		$(this).closest('.priority-wrapper').children('i.fa-flag').removeClass('priority-'+old_pr);
		$(this).closest('.priority-wrapper').children('i.fa-flag').addClass('priority-'+priority);
	});


	$('.datepicker').datetimepicker({mask:false, allowBlank:true});

	$('.datepicker').on('change', function(){
		if($(this).val() != ""){
			var date = new Date($(this).val());
			var isStart = ($(this).attr('data-date') == 'start');

			if(isStart){
				$(this).closest('.dd-item').data('local').start_date_utc = date.toISOString();
			}else{
				$(this).closest('.dd-item').data('local').due_date_utc = date.toISOString();
			}
		}
	});


	






	//ANIMATIONS
	var config = {anim:true}

	if(config.anim){
		$('.dd-collapse').on('click',function(){
			$(this).siblings('ol').slideUp(300)
			//$(this).parent('li')
		});
		$('.dd-expand').on('click',function(){
			$(this).siblings('ol').slideDown(300)
			//$(this).parent('li')
		});
	}

});


