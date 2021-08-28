<div class="row" id="project-last-update">
	<div class="col-md-12">
        <button class="btn btn-primary pull-right add-last-update" type="button">Add</button>
    </div>
    
	@if(isset($project_last_update) && $project_last_update->count() > 0)
    @foreach($project_last_update as $last_update)

	<div class="col-md-12">
		<button class="btn btn-danger pull-right button-remove-update" type="button">Remove</button><br/>

		<div class="col-md-12">
	        <div class="font-bold col-green">{!! trans("admin_project.form.project_date_update") !!}</div>
	        <div class="form-group form-float">
	            <div class="form-line">
	                <input type="text" class="form-control datepicker" name="last_update_date[]" autocomplete="off" value="{{ (isset($last_update->date) && $last_update->date != null) ? date("d/m/Y", strtotime($last_update->date)) : null }}">
	                <div class="publish_date-container" style="position: relative"></div>
	            </div>
	        </div>
	    </div>
		<div class="col-md-12">
		    <ul class="nav nav-tabs tab-nav-right" role="tablastupdate">
	            @php $j = 0 @endphp
	            @foreach($composer_locales as $key => $locale)
	                <li role="presentation" class="{{ ($j == 0) ? 'active' : '' }} tab-{{ $key }} tablocale">
	                    <a href="#tablastupdate{{ $key }}" data-toggle="tab" aria-expanded="false" class="tabclick" data-lang="{{ $key }}">
	                        <span class="font-17">{!! trans("admin_translation.tab.{$key}") !!}</span>
	                    </a>
	                </li>
	            @php $j++; @endphp
	            @endforeach     
	        </ul>
				
	        <div class="tab-content">
			@php $j = 0; @endphp
            @foreach($composer_locales as $key => $locale)
                <div class="data-last-update-{{ $key }} tab-pane fade {{ ($j == 0) ? 'in active' : '' }} lang-content" id="tablastupdate{{ $key }}">
					<div class="font-bold col-green">{!! trans("admin_project.form.content_update") !!}</div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="{{ $key }}[content_update][]" value="{{ $last_update->{"content:{$key}"} }}">
                        </div>
                    </div>
                </div>
            @php $j++; @endphp
	        @endforeach
	        </div>
	    </div>
	    <input type="hidden" name="project_last_update[]" value="{{ $last_update->id }}">
		<hr>
	</div>

	<div class="clearfix"></div>

	@endforeach
	@else

	<div class="col-md-12">
		<button class="btn btn-danger pull-right button-remove-update" type="button">Remove</button><br/>

		<div class="col-md-12">
	        <div class="font-bold col-green">{!! trans("admin_project.form.project_date_update") !!}</div>
	        <div class="form-group form-float">
	            <div class="form-line">
	                <input type="text" class="form-control datepicker" name="last_update_date[]" autocomplete="off">
	                <div class="publish_date-container" style="position: relative"></div>
	            </div>
	        </div>
	    </div>
		<div class="col-md-12">
		    <ul class="nav nav-tabs tab-nav-right" role="tablastupdate">
	            @php $j = 0 @endphp
	            @foreach($composer_locales as $key => $locale)
	                <li role="presentation" class="{{ ($j == 0) ? 'active' : '' }} tab-{{ $key }} tablocale">
	                    <a href="#tablastupdate{{ $key }}" data-toggle="tab" aria-expanded="false" class="tabclick" data-lang="{{ $key }}">
	                        <span class="font-17">{!! trans("admin_translation.tab.{$key}") !!}</span>
	                    </a>
	                </li>
	            @php $j++; @endphp
	            @endforeach     
	        </ul>
				
	        <div class="tab-content">
			@php $j = 0; @endphp
            @foreach($composer_locales as $key => $locale)
                <div class="data-last-update-{{ $key }} tab-pane fade {{ ($j == 0) ? 'in active' : '' }} lang-content" id="tablastupdate{{ $key }}">
					<div class="font-bold col-green">{!! trans("admin_project.form.content_update") !!}</div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="{{ $key }}[content_update][]" >
                        </div>
                    </div>
                </div>
            @php $j++; @endphp
	        @endforeach
	        </div>
	    </div>
	</div>

	<hr>

	<div class="clearfix"></div>
	@endif

</div>

