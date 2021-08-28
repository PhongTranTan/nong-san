<div class="row">
    <div class="col-md-4">
        <div class="font-bold col-green">{!! trans("admin_banner.form.image") !!}</div>
        <div class="form-group">
            @component('admin.layouts.components.upload_photo', [
                'image' => $banner->image ?? null,
                'name' => 'image',
            ])
            @endcomponent
        </div>
    </div>

    <div class="col-md-4">
        <div class="font-bold col-green">{!! trans("admin_banner.form.page") !!}</div>
        <div class="form-group form-float">
            <div class="form-line">
                <select name="page_id" id="page_id" required class="form-control">
                    <option value="">Please choose page</option>
                    @if($pages != null)
                        @foreach($pages as $page)
                            <option value="{{ $page->id }}" {{ !empty($banner) && $banner->page_id == $page->id ? "selected" : null }}>{{ $page->title }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="font-bold col-green">{!! trans("admin_banner.form.position") !!}</div>
        <div class="form-group form-float">
            <div class="form-line">
                <input type="number" class="form-control" name="position" value="{{ $banner->position ?? 1 }}" min="0" autocomplete="off">
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="font-bold col-green">{!! trans("admin_banner.form.active") !!}</div>
        <div class="form-group">
            <input type="checkbox" id="active" name="active"
                   value="1" {!! !empty($banner) && $banner->active ? "checked" : null !!}>
            <label style="margin-top: 10px" for="active">{!! trans("admin_banner.form.active") !!}</label>
        </div>
    </div>

</div>
