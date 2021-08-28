<div class="row">

	<div class="col-md-4">
        <div class="font-bold col-green">{!! trans("admin_type.form.parent_type") !!}</div>
        <div class="form-group">
            <select name="parent_id" id="parent_id" class="form-control">
                <option value="0">---</option>
                @if(isset($floor_parents) && $floor_parents != null)
                @foreach($floor_parents as $floor_parent)
                    <option value="{{ $floor_parent->id }}" @if(isset($type->parent_id) && $type->parent_id != 0 && $type->parent_id == $floor_parent->id) {{ 'selected' }} @endif>{{ $floor_parent->name }}</option>
                @endforeach
                @endif
            </select>
        </div>
    </div>

    <div class="col-md-4">
        <div class="font-bold col-green">{!! trans("admin_type.form.active") !!}</div>
        <div class="form-group">
            <input type="checkbox" id="active" name="active"
                   value="1" {!! !empty($type) && $type->active ? "checked" : null !!}>
            <label style="margin-top: 10px" for="active">{!! trans("admin_type.form.active") !!}</label>
        </div>
    </div>

</div>
