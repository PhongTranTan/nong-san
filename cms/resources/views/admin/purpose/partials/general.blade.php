<div class="row">

    <div class="col-md-4">
        <div class="font-bold col-green">{!! trans("admin_purpose.form.active") !!}</div>
        <div class="form-group">
            <input type="checkbox" id="active" name="active"
                   value="1" {!! !empty($purpose) && $purpose->active ? "checked" : null !!}>
            <label style="margin-top: 10px" for="active">{!! trans("admin_purpose.form.active") !!}</label>
        </div>
    </div>

</div>
