<div class="row">
    <div class="col-md-4">
        <div class="font-bold col-green">{!! trans("admin_menus.form.type") !!}</div>
        <div class="form-group form-float">
            <div class="form-line">
                <input type="text" class="form-control" name="type"
                       value="{!! !empty($menu)  ? $menu->type : old("type") !!}">
                <div id="type" style="position: relative"></div>
            </div>
        </div>
    </div>
</div>