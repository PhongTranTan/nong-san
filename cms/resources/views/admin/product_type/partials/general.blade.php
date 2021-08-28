<div class="row">
	<div class="col-md-3">
        <div class="font-bold col-green">{!! trans("admin_project.form.logo") !!}</div>
        <div class="form-group">
            @component('admin.layouts.components.upload_photo', [
                'image' => $data->images ?? null,
                'name' => 'images',
            ])
            @endcomponent
        </div>
    </div>
    <div class="col-md-3">
        <div class="font-bold col-green">{!! trans("admin_project.form.active") !!}</div>
        <div class="form-group">
            <input type="checkbox" id="active" name="active"
                   value="1" {!! !empty($data) && $data->active ? "checked" : null !!}>
            <label style="margin-top: 10px" for="active">{!! trans("admin_project.form.active") !!}</label>
        </div>
    </div>

    <div class="col-md-4">
        <div class="font-bold col-green">Display Order</div>
        <div class="form-group form-float">
            <div class="form-line">
                <input type="number" class="form-control" name="display_order" id="display_order" min="0"
                       value="{!! !empty($data) ? $data->display_order : 0 !!}">
            </div>
        </div>
    </div>
</div>
