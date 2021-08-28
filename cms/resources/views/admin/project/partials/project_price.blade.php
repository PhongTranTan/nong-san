<div class="row" id="project-price-more">

	@php 
        $price_images = [];
        $price_prices = [];
    @endphp

    @if(isset($project->project_price_images) && $project->project_price_images != null)
	@php 
        $price_images = json_decode($project->project_price_images);
        $price_prices = json_decode($project->project_price_table);
    @endphp
    @endif

    <div class="col-md-12">
        <button class="btn btn-primary pull-right add-project-price" type="button">Add</button>
    </div>

    @if(count($price_images) > 0)

    @for($i = 0; $i < count($price_images); $i++)

	<div class="col-md-12">
		<button class="btn btn-danger pull-right button-remove" type="button">Remove</button><br/>
		<div class="col-md-4">
	        <div class="font-bold col-green">{!! trans("admin_project.form.project_price_images") !!}</div>
	        <div class="form-group">
	            @component('admin.layouts.components.upload_photo', [
	                'image' => $price_images[$i] ?? null,
	                'name' => 'project_price_images[]',
	            ])
	            @endcomponent
	        </div>
	    </div>

		<div class="col-md-4">
	        <div class="font-bold col-green">{!! trans("admin_project.form.project_price_table") !!}</div>
	        <div class="form-group form-float">
	            <div class="form-line">
	                <input type="text" class="form-control" name="project_price_table[]" autocomplete="off"
	                       value="{!! isset($price_prices[$i]) ? $price_prices[$i] : 0 !!}">
	            </div>
	        </div>
	    </div>
		<div class="col-md-12">
		    <ul class="nav nav-tabs tab-nav-right" role="tabpricename">
	            @php $j = 0 @endphp
	            @foreach($composer_locales as $key => $locale)
	            	@if(isset($project->project_price_name_detail) && $project->project_price_name_detail != null)
	                @php 
	                    $project_price_name_detail[$key] = json_decode($project->{"project_price_name_detail:{$key}"});
	                @endphp
	                @endif
	                <li role="presentation" class="{{ ($j == 0) ? 'active' : '' }} tab-{{ $key }} tablocale">
	                    <a href="#tabpricename{{ $key }}" data-toggle="tab" aria-expanded="false" class="tabclick" data-lang="{{ $key }}">
	                        <span class="font-17">{!! trans("admin_translation.tab.{$key}") !!}</span>
	                    </a>
	                </li>
	            @php $j++; @endphp
	            @endforeach     
	        </ul>
				
	        <div class="tab-content">
			@php $j = 0; @endphp
            @foreach($composer_locales as $key => $locale)
                <div class="data-price-name-{{ $key }} tab-pane fade {{ ($j == 0) ? 'in active' : '' }} lang-content" id="tabpricename{{ $key }}">
					<div class="font-bold col-green">{!! trans("admin_project.form.price_name") !!}</div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="{{ $key }}[price_name_detail][]" value="{{ isset($project_price_name_detail[$key][$i]) ? $project_price_name_detail[$key][$i] : null }}">
                        </div>
                    </div>
                </div>
            @php $j++; @endphp
	        @endforeach
	        </div>
	    </div>
	</div>
	@endfor

	@else

	<div class="col-md-12">
		<button class="btn btn-danger pull-right button-remove" type="button">Remove</button><br/>
		<div class="col-md-4">
	        <div class="font-bold col-green">{!! trans("admin_project.form.project_price_images") !!}</div>
	        <div class="form-group">
	            @component('admin.layouts.components.upload_photo', [
	                'image' =>  null,
	                'name' => 'project_price_images[]',
	            ])
	            @endcomponent
	        </div>
	    </div>

		<div class="col-md-4">
	        <div class="font-bold col-green">{!! trans("admin_project.form.project_price_table") !!}</div>
	        <div class="form-group form-float">
	            <div class="form-line">
	                <input type="text" class="form-control" name="project_price_table[]" autocomplete="off"
	                       value="">
	            </div>
	        </div>
	    </div>
		<div class="col-md-12">
		    <ul class="nav nav-tabs tab-nav-right" role="tabpricename">
	            @php $j = 0 @endphp
	            @foreach($composer_locales as $key => $locale)
	                <li role="presentation" class="{{ ($j == 0) ? 'active' : '' }} tab-{{ $key }} tablocale">
	                    <a href="#tabpricename{{ $key }}" data-toggle="tab" aria-expanded="false" class="tabclick" data-lang="{{ $key }}">
	                        <span class="font-17">{!! trans("admin_translation.tab.{$key}") !!}</span>
	                    </a>
	                </li>
	            @php $j++; @endphp
	            @endforeach     
	        </ul>
				
	        <div class="tab-content">
			@php $j = 0; @endphp
            @foreach($composer_locales as $key => $locale)
                <div class="data-price-name-{{ $key }} tab-pane fade {{ ($j == 0) ? 'in active' : '' }} lang-content" id="tabpricename{{ $key }}">
					<div class="font-bold col-green">{!! trans("admin_project.form.price_name") !!}</div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="{{ $key }}[price_name_detail][]" value="">
                        </div>
                    </div>
                </div>
            @php $j++; @endphp
	        @endforeach
	        </div>
	    </div>
	</div>

	@endif
	
	<div class="clearfix"></div>
	<hr>
</div>

