
@extends('globals.wrapper')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div id="task-wrapper">
					<script>var tasks = {!! json_encode($tasks) !!}</script>
					<script id="nestable-list-template" type="text/x-handlebars-template">
						<li class="dd-item @{{#if isDone}}complete@{{/if}}" data-id="@{{id}}">
							<div class="dd-titlebar">
								<div class="dd-handle"><i class="fa fa-sort"></i></div>
								<div class="dd-id">@{{id}}</div>
								<div class="dd-title">@{{title}}</div>
							</div>
							<div class="dd-toolbar">
								<i class="fa fa-flag"></i>
								<i class="fa fa-clock-o"></i>
								<i class="fa fa-user"></i>
								<i class="fa fa-tag"></i>
								<i class="fa fa-pencil"></i>
							</div>
							<div class="dd-editbox" style="display:none;">
								<div class="row">
									<input type="text" placeholder="Title" value="@{{title}}">
									<textarea>@{{content}}</textarea>
								<</div>
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
