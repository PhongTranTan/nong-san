<div id="custom-banner">
	<div class="col-md-12">
        <button class="btn btn-primary pull-right add-banner" type="button">Add Banner</button>
    </div>

    @php 
        $banners = [];
    @endphp

    @if(isset($linkreport->banner_images) && $linkreport->banner_images != null)
	    @php 
	        $banners = json_decode($linkreport->banner_images);
	        $banner_title = json_decode($linkreport->banner_title);
	        $banner_description = json_decode($linkreport->banner_description);
	    @endphp
    @endif

    <div class="row" id="load-banner">
	    
	    @if(count($banners) > 0)
    		@for($i = 0; $i < count($banners); $i++)
			<div class="col-md-4">
				<button class="btn btn-danger pull-right button-remove-banner" type="button">Remove</button><br/>
		        <div class="font-bold col-green">Banner</div>
		        <div class="form-group">
		            @component('admin.layouts.components.upload_photo', [
		                'image' => $banners[$i] ?? null,
		                'name' => 'banner_images[]',
		            ])
		            @endcomponent
		        </div>

		        <div class="tab-content">

		            <div class="font-bold col-green">{!! trans("admin_banner.form.title") !!}</div>
		            <div class="form-group form-float">
		                <div class="form-line">
		                    <input type="text" class="form-control" name="banner_title[]" value="{{ isset($banner_title[$i]) ? $banner_title[$i] : null }}">
		                </div>
		            </div>

		            <div class="font-bold col-green">{!! trans("admin_banner.form.description") !!}</div>
		            <div class="form-group form-float">
		                <div class="form-line">
		                    <textarea class="form-control" name="banner_description[]" rows="4">{{ isset($banner_description[$i]) ? $banner_description[$i] : null }}</textarea>
		                </div>
		            </div>

		        </div>
		    </div>
		    @endfor
		@endif

	</div>
</div>
