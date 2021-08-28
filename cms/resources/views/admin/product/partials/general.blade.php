<div class="row">
	<div class="col-md-4">
        <div class="font-bold col-green">{!! trans("admin_product.form.image") !!}</div>
        <div class="form-group">
            @component('admin.layouts.components.upload_photo', [
                'image' => $data->images ?? null,
                'name' => 'images',
            ])
            @endcomponent
        </div>
    </div>
    <div class="col-md-4">
        <div class="font-bold col-green">{!! trans("admin_product.form.banner") !!}</div>
        <div class="form-group">
            @component('admin.layouts.components.upload_photo', [
                'image' => $data->banner ?? null,
                'name' => 'banner',
            ])
            @endcomponent
        </div>
    </div>
    <div class="col-md-4">
        <div class="font-bold col-green">{!! trans("admin_product.form.image_ads") !!}</div>
        <div class="form-group">
            @component('admin.layouts.components.upload_photo', [
                'image' => $data->image_ads ?? null,
                'name' => 'image_ads',
            ])
            @endcomponent
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="font-bold col-green">{!! trans("admin_product.form.type") !!}</div>
        <div class="form-group form-float">
            <div class="form-line">
                <select required name="product_type_id" id="product_type_id" required class="form-control">
                    <option value="">---</option>
                    @if(isset($productTypes) && $productTypes != null)
                        @foreach($productTypes as $productType)
                            <option value="{{ $productType->id }}" 
                                {{ !empty($data) && $data->product_type_id ==  $productType->id ? 'selected' : '' }}>
                                {{  $productType->name }}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="font-bold col-green">Price</div>
        <div class="form-group form-float">
            <div class="form-line">
                <input type="number" class="form-control" name="price" id="price" min="0"
                       value="{!! !empty($data) ? $data->price : 0 !!}">
            </div>
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
<div class="row">
    <div class="col-md-3">
        <div class="font-bold col-green">{!! trans("admin_project.form.active") !!}</div>
        <div class="form-group">
            <input type="checkbox" id="active" name="active"
                   value="1" {!! !empty($data) && $data->active ? "checked" : null !!}>
            <label style="margin-top: 10px" for="active">{!! trans("admin_project.form.active") !!}</label>
        </div>
    </div>
</div>
