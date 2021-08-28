<div class="row">

	<div class="col-md-4">
        <div class="font-bold col-green">{!! trans("admin_project.form.title") !!}</div>
        <div class="form-group form-float">
            <div class="form-line">
                <input type="text" class="form-control" name="report_title" autocomplete="off"
					   value="{!! !empty($linkreport->report_title)  ? $linkreport->report_title : old('report_title') !!}"
						>
            </div>
        </div>
    </div>

	<div class="col-md-4">
        <div class="font-bold col-green">{!! trans("admin_project.form.url") !!}</div>
        <div class="form-group form-float">
            <div class="form-line">
                <input type="text" class="form-control" name="url" autocomplete="off"
                       value="{!! !empty($linkreport->url)  ? $linkreport->url : old('url') !!}">
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="font-bold col-green">{!! trans("admin_project.form.description") !!}</div>
        <div class="form-group form-float">
            <div class="form-line">
                <textarea name="description" class="form-control" rows="5">{{ !empty($linkreport->description)  ? $linkreport->description : old('description') }}</textarea>
            </div>
        </div>
    </div>

</div>

<div id="create-project">
    <button class="btn btn-primary pull-right" type="button" id="btn-create-project">Create Project Choose</button>
</div>

<div class="clearfix"></div>

<div class="row">

	<div id="show-project" style="margin-top: 20px">
		@if(isset($linkreport) && $linkreport->count() > 0)
			@php
                $check_projects = json_decode($linkreport->project_choose);
                $check_rental = json_decode($linkreport->estimate_rental);
                $check_capital = json_decode($linkreport->estimate_capital);
			@endphp
			
			@if($check_projects)
				@foreach($check_projects as $key => $project_choice)
					<div class="col-md-12 item-project">
						<div class="col-md-12 text-right">
							<button class="btn btn-danger pull-right button-remove" type="button">Remove</button><br/>
						</div>

						<div class="col-md-4">
							<div class="font-bold col-green">{!! trans("admin_project.form.project") !!}</div>
							<select name="project_choose[]" class="project_choose form-control">
								<option value="">Choose Project</option>
								@if(isset($projects) && $projects->count() > 0)
									@foreach($projects as $project)
										<option value="{{ $project->id }}" @if($project->id == $project_choice) selected @endif>{{ $project->name }}</option>
									@endforeach
								@endif
							</select>
						</div>

						<div class="col-md-4 rating-project-edit">
							<div class="font-bold col-green">{!! trans("admin_project.form.estimated_rental_yield") !!}</div>
							<div class="form-group">
								<input type="hidden" name="estimated_rental[]" class="rating" data-fractions="2" value="{{ isset($check_rental[$key]) ? $check_rental[$key] : 0 }}"/>
							</div>
						</div>

						<div class="col-md-4 rating-project-edit">
							<div class="font-bold col-green">{!! trans("admin_project.form.estimated_capital_appreciation") !!}</div>
							<div class="form-group">
								<input type="hidden" name="estimated_capital[]" class="rating" data-fractions="2" value="{{ isset($check_capital[$key]) ? $check_capital[$key] : 0 }}"/>
							</div>
						</div>
					</div>
				@endforeach
			@endif
		@endif
	</div>

</div>