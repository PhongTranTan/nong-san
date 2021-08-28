<div class="row">
    <div class="col-md-4">
        <div class="font-bold col-green">{!! trans("admin_testimonials.form.image") !!}</div>
        <div class="form-group">
            @component('admin.layouts.components.upload_photo', [
                'image' => $testimonials->images ?? null,
                'name' => 'images',
            ])
            @endcomponent
        </div>
    </div>

    <div class="col-md-4">
        <div class="font-bold">{!! trans("admin_testimonials.form.position") !!}</div>
        <div class="form-group form-float">
            <div class="form-line">
                <input type="number" class="form-control" name="position" value="{{ $testimonials->position ?? 0 }}" min="0" autocomplete="off">
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <input type="checkbox" id="active" name="active"
                   value="1" {!! !empty($testimonials) && $testimonials->active ? "checked" : null !!}>
            <label style="margin-top: 25px" for="active">{!! trans("admin_lecture.form.active") !!}</label>
        </div>
    </div>
</div>
