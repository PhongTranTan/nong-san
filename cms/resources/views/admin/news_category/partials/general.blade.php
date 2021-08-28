<div class="row">
    <div class="col-md-4">
        <div class="font-bold col-green">{!! trans("admin_news_category.form.image") !!}</div>
        <div class="form-group">
            @component('admin.layouts.components.upload_photo', [
                'image' => $newsCategory->icon ?? null,
                'name' => 'icon',
            ])
            @endcomponent
        </div>
    </div>
    <div class="col-md-4">
        <div class="font-bold col-green">{!! trans("admin_news_category.form.active") !!}</div>
        <div class="form-group">
            <input type="checkbox" id="active" name="active"
                   value="1" {!! !empty($newsCategory) && $newsCategory->active ? "checked" : null !!}>
            <label style="margin-top: 10px" for="active">{!! trans("admin_news_category.form.active") !!}</label>
        </div>
    </div>
</div>
