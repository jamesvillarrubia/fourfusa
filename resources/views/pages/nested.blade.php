
@extends('globals.wrapper')

@include ('globals.header')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div id="task-wrapper">

					<script>
						var tasks = {!! json_encode($tasks) !!}
					</script>
					<script id="nestable-list-template" type="text/x-handlebars-template">
						<li class="dd-item @{{#if isDone}}complete@{{/if}}" data-id="@{{id}}">
							<div class="dd-titlebar">
								<div class="dd-handle"><i class="fa fa-sort"></i></div>
								<div class="dd-id">@{{order}}</div>
								<div class="dd-title">@{{title}}</div>
							</div>
							<div class="dd-toolbar">
								<div class="dropdown priority-wrapper">
									<i data-toggle="dropdown" class="fa fa-flag priority-@{{priority}}"></i>
									<ul class="dropdown-menu priority-list" aria-labelledby="dLabel">
										<li class="@{{#ifCond priority '==' '4'}} active @{{/ifCond}}" data-priority="4"><i class="fa fa-flag priority-4">Critical</i></li>
										<li class="@{{#ifCond priority '==' '3'}} active @{{/ifCond}}" data-priority="3"><i class="fa fa-flag priority-3">High</i></li>
										<li class="@{{#ifCond priority '==' '2'}} active @{{/ifCond}}" data-priority="2"><i class="fa fa-flag priority-2">Medium</i></li>
										<li class="@{{#ifCond priority '==' '1'}} active @{{/ifCond}}" data-priority="1"><i class="fa fa-flag priority-1">Low</i></li>
										<li class="@{{#ifCond priority '==' '0'}} active @{{/ifCond}}" data-priority="0"><i class="fa fa-flag priority-0">None</i></li>
									</ul>
								</div>
								<div class="dropdown clock-wrapper">
									<i data-toggle="dropdown" class="fa fa-clock-o @{{#if due_date_utc}} active @{{/if}}"></i>
									<ul class="dropdown-menu" aria-labelledby="dLabel">
										<li class="">
											<div>START:</div><input data-date="start" class="datepicker" type="text" placeholder="Start Date" value="@{{fromUTC start_date_utc}}">
										</li>
										<li class="">
											<div>DUE:</div><input data-date="due" class="datepicker" type="text" placeholder="Due Date"  value="@{{fromUTC due_date_utc}}">
										</li>
									</ul>
								</div>
								<div>
									<i class="fa fa-user"></i>
								</div>
								<div>
									<i class="fa fa-tag"></i>
								</div>
								<div>
									<i class="fa fa-pencil"></i>
								</div>
							</div>
							<div class="dd-editbox" style="display:none;">
								<div class="row">
									<div class="col-md-12 form-group">
										<input class="form-control" type="text" placeholder="Title" value="@{{title}}">
									</div>
									<div class="col-md-12 form-group">
										<input class="form-control" type="text" placeholder="Title" value="@{{title}}">
									</div>
									<div class="col-md-6 form-group">
										<input class="form-control" type="text" placeholder="Title" value="@{{title}}">
									</div>
									<div class="col-md-6 form-group">
										<input class="form-control" type="text" placeholder="Title" value="@{{title}}">
									</div>
									<div class="col-md-4 form-group">
										<input class="form-control" type="text" placeholder="Title" value="@{{title}}">
									</div>
									<label>Make this a Project</label>
									<input type="checkbox">
								</div>
							</div>
						</li>
					</script>
					<script id="nestable-item-template" type="text/x-handlebars-template">

					</script>
					<div class="dd" data-id="0">
						<ol class="dd-list"></ol>
					</div>
				</div>
			</div>

			<div id="results" class="col-md-6">
				<pre>
					{!! print_r($tasks) !!}
				</pre>
			</div>
		</div>
	</div>



@endsection

	@include('globals.footer')
