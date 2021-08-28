<div class="row">
    <div class="col-md-4">
        <div class="font-bold col-green">{!! trans("admin_role.form.name") !!}</div>
        <div class="form-group form-float">
            <div class="form-line">
                <input type="text" class="form-control" name="name"
                       value="{!! !empty($role) ? $role->name : old("name") !!}">
            </div>
        </div>
    </div>

    <div class="col-md-4 hidden">
        <div class="font-bold col-green">{!! trans("admin_role.form.level") !!}</div>
        <div class="form-group form-float">
            <div class="form-line">
                <input type="number" class="form-control" name="level"
                       value="{!! !empty($role) ? $role->level : 1 !!}">
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="font-bold col-green">{!! trans("admin_role.form.slug") !!}</div>
        <div class="form-group form-float">
            <div class="form-line">
                <input readonly type="text" class="form-control" name="slug"
                       value="{!! !empty($role) ? $role->slug : old("slug") !!}">
            </div>
        </div>
    </div>
</div>