<div class="row">

    <div class="col-md-4">
        <div class="font-bold col-green">{!! trans("admin_partner.form.image") !!}</div>
        <div class="form-group">
            @component('admin.layouts.components.upload_photo', [
                'image' => $partner->image ?? null,
                'name' => 'image',
            ])
            @endcomponent
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="font-bold col-green">{!! trans("admin_partner.form.parent_type") !!}</div>
        <div class="form-group">
            <select name="type" id="type" class="form-control">
                <option value="1" @if(isset($partner->type) && $partner->type == 1) {{ 'selected' }} @endif>Home Loan</option>
                <option value="2" @if(isset($partner->type) && $partner->type == 2) {{ 'selected' }} @endif>Mortgage</option>
            </select>
        </div>
    </div>

    <div class="col-md-4">
        <div class="font-bold col-green">{!! trans("admin_partner.form.active") !!}</div>
        <div class="form-group">
            <input type="checkbox" id="active" name="active"
                   value="1" {!! !empty($partner) && $partner->active ? "checked" : null !!}>
            <label style="margin-top: 10px" for="active">{!! trans("admin_sibor_rates.form.active") !!}</label>
        </div>
    </div>

</div>
