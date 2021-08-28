<div class="row">

    <div class="col-md-4">
        <div class="font-bold col-green">{!! trans("admin_sibor_rates.form.date") !!}</div>
        <div class="form-group form-float">
            <div class="form-line">
                <div class="form-line">
                    <input type="text" class="form-control datepicker" name="date" id="date-sibor" autocomplete="off"
                           value="{!! !empty($sibor_rates->date)  ? cvDbTime($sibor_rates->date) : old('date') !!}">
                    <div id="date-sibor-container" style="position: relative"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="font-bold col-green">Type</div>
        <div class="form-group">
            <input type="radio" id="type" name="type"
                   value="0" checked>
            <label style="margin-top: 10px" for="type">Sibor</label>

            <input type="radio" id="type_sor" name="type"
                   value="1" {!! !empty($sibor_rates) && $sibor_rates->type ? "checked" : null !!}>
            <label style="margin-top: 10px" for="type_sor">Sor</label>
        </div>
    </div>

    <div class="col-md-4">
        <div class="font-bold col-green">{!! trans("admin_sibor_rates.form.active") !!}</div>
        <div class="form-group">
            <input type="checkbox" id="active" name="active"
                   value="1" {!! !empty($sibor_rates) && $sibor_rates->active ? "checked" : null !!}>
            <label style="margin-top: 10px" for="active">{!! trans("admin_sibor_rates.form.active") !!}</label>
        </div>
    </div>

</div>
