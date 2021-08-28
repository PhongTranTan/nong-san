<div class="row">
    <div class="col-md-6">
        <div class="font-bold col-green">{!! trans("admin_guides.form.image") !!}</div>
        <div class="form-group">
            @component('admin.layouts.components.upload_photo', [
                'image' => $guides->images ?? null,
                'name' => 'images',
            ])
            @endcomponent
        </div>
    </div>
    <div class="col-md-6">
        <div class="font-bold col-green">{!! trans("admin_guides.form.guides_category_id") !!}</div>
        <div class="form-group form-float">
            <div class="form-line">
                <select required name="guides_category_id" id="guides_category_id" required class="form-control">
                    <option value="">---</option>
                    @if(isset($guideCategories) && $guideCategories != null)
                        @foreach($guideCategories as $guideCategory)
                            <option value="{{ $guideCategory->id }}" 
                                {{ !empty($guides) && $guides->guides_category_id ==  $guideCategory->id ? 'selected' : '' }}>
                                {{  $guideCategory->name }}
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
        <div class="font-bold col-green">{!! trans("admin_guides.form.publish_at") !!}</div>
        <div class="form-group form-float">
            <div class="form-line">
                <input required type="text" class="form-control datepicker" name="publish_date" id="publish_date" autocomplete="off"
                       value="{!! !empty($guides->publish_date)  ? cvDbTime($guides->publish_date) : old('publish_date') !!}">
                <div id="publish_date-container" style="position: relative"></div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="font-bold col-green">{!! trans("admin_guides.form.active") !!}</div>
        <div class="form-group">
            <input type="checkbox" id="active" name="active"
                   value="1" {!! !empty($guides) && $guides->active ? "checked" : null !!}>
            <label style="margin-top: 10px" for="active">{!! trans("admin_guides.form.active") !!}</label>
        </div>
    </div>
    <div class="col-md-3">
        <div class="font-bold col-green">{!! trans("admin_guides.form.highlight") !!}</div>
        <div class="form-group">
            <input type="checkbox" id="highlight" name="highlight"
                   value="1" {!! !empty($guides) && $guides->highlight ? "checked" : null !!}>
            <label style="margin-top: 10px" for="highlight">{!! trans("admin_guides.form.highlight") !!}</label>
        </div>
    </div>
</div>
