<div class="row">
    <div class="col-md-3">
        <div class="font-bold col-green">{!! trans("admin_mortgage.form.images") !!}</div>
        <div class="form-group">
            @component('admin.layouts.components.upload_photo', [
                'image' => $mortgage->images ?? null,
                'name' => 'images',
            ])
            @endcomponent
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="col-md-4">
        <div class="font-bold col-green">{!! trans("admin_mortgage.form.premium") !!}</div>
        <div class="form-group form-float">
            <div class="form-line">
                <input type="number" class="form-control" name="premium" id="premium" autocomplete="off" value="{!! !empty($mortgage) && $mortgage->premium ? $mortgage->premium : null !!}">
                <div id="publish_date-container" style="position: relative"></div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="font-bold col-green">{!! trans("admin_mortgage.form.position") !!}</div>
        <div class="form-group form-float">
            <div class="form-line">
                <input type="number" class="form-control" name="position" value="{{ $mortgage->position ?? 0 }}" min="0" autocomplete="off">
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="font-bold col-green">{!! trans("admin_mortgage.form.active") !!}</div>
        <div class="form-group">
            <input type="checkbox" id="active" name="active"
                   value="1" {!! !empty($mortgage) && $mortgage->active ? "checked" : null !!}>
            <label style="margin-top: 10px" for="active">{!! trans("admin_mortgage.form.active") !!}</label>
        </div>
    </div>

</div>
