<div class="row">
    <div class="col-md-6">
        <div class="font-bold col-green">{!! trans("admin_news.form.image") !!}</div>
        <div class="form-group">
            @component('admin.layouts.components.upload_photo', [
                'image' => $news->images ?? null,
                'name' => 'images',
            ])
            @endcomponent
        </div>
    </div>
    <div class="col-md-6">
        <div class="font-bold col-green">{!! trans("admin_news.form.news_category_id") !!}</div>
        <div class="form-group form-float">
            <div class="form-line">
                <select required name="news_category_id" id="news_category_id" required class="form-control">
                    <option value="">---</option>
                    @if(isset($newsCategories) && $newsCategories != null)
                        @foreach($newsCategories as $newsCategory)
                            <option value="{{ $newsCategory->id }}" 
                                {{ !empty($news) && $news->news_category_id ==  $newsCategory->id ? 'selected' : '' }}>
                                {{  $newsCategory->name }}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="font-bold col-green">{!! trans("admin_news.form.publish_at") !!}</div>
        <div class="form-group form-float">
            <div class="form-line">
                <input required type="text" class="form-control datepicker" name="publish_date" id="publish_date" autocomplete="off"
                       value="{!! !empty($news->publish_date)  ? cvDbTime($news->publish_date) : old('publish_date') !!}">
                <div id="publish_date-container" style="position: relative"></div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="font-bold col-green">{!! trans("admin_news.form.active") !!}</div>
        <div class="form-group">
            <input type="checkbox" id="active" name="active"
                   value="1" {!! !empty($news) && $news->active ? "checked" : null !!}>
            <label style="margin-top: 10px" for="active">{!! trans("admin_news.form.active") !!}</label>
        </div>
    </div>
    <div class="col-md-3">
        <div class="font-bold col-green">{!! trans("admin_news.form.highlight") !!}</div>
        <div class="form-group">
            <input type="checkbox" id="highlight" name="highlight"
                   value="1" {!! !empty($news) && $news->highlight ? "checked" : null !!}>
            <label style="margin-top: 10px" for="highlight">{!! trans("admin_news.form.highlight") !!}</label>
        </div>
    </div>
</div>
