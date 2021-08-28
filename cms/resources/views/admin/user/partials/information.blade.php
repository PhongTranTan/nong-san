<div class="row">
    <div class="col-md-6">
        <div class="font-bold col-green">{!! trans("admin_user.form.role") !!}</div>
        <div class="form-group form-float">
            <div class="form-line">
                <select class="form-control show-tick" name="role[]" id="role" multiple>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" {!! !empty($user_role) && in_array($role->id , $user_role) ? "selected" : null !!} >{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="font-bold col-green">{!! trans("admin_user.form.name") !!}</div>
        <div class="form-group form-float">
            <div class="form-line">
                <input type="text" class="form-control" name="name"
                       value="{!! !empty($user) ? $user->name : old("name") !!}">
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="font-bold col-green">{!! trans("admin_user.form.email") !!}</div>
        <div class="form-group form-float">
            <div class="form-line">
                <input type="text" class="form-control" name="email"
                       value="{!! !empty($user) ? $user->email : old("email") !!}">
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group form-float">
            <div class="font-bold col-green">{!! trans("admin_user.form.password") !!}</div>
            <div class="form-line">
                <input type="text" class="form-control" name="password"
                       value="{!! old("password")  !!}">
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="font-bold col-green">{!! trans("admin_user.form.status") !!}</div>
        <div class="form-group">
            <input type="checkbox" id="active" name="active"
                   value="1" {!! !empty($user) && $user->active ? "checked" : null !!}>
            <label for="active">{!! trans("admin_user.form.active") !!}</label>
        </div>
    </div>
</div>