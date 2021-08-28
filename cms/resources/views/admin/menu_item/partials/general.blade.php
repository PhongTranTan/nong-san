<div class="row">
    <div class="col-md-4">
        <div class="font-bold col-green">{!! trans("admin_menu_item.form.menu") !!}</div>
        <div class="form-group form-float">
            <div class="form-line">
                <select name="menu_id[]" id="menu_id" class="js-example-basic form-control" multiple="multiple">
                    @foreach($menu as $key => $value)
                        <option value="{{ $value->id }}" {{ !empty($array_menu) && in_array($value->id ,$array_menu) ? 'selected' : '' }}>{{ $value->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="font-bold col-green">{!! trans("admin_menu_item.form.parent") !!}</div>
        <div class="form-group form-float">
            <div class="form-line">
                <select name="parent_id" id="parent_id" class="form-control">
                    {!! $menu_parent !!}
                </select>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="font-bold col-green">{!! trans("admin_menu_item.form.position") !!}</div>
        <div class="form-group form-float">
            <div class="form-line">
                <input type="number" class="form-control" name="position"
                       value="{!! !empty($menu_item)  ? $menu_item->position : old("position") !!}">
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="font-bold col-green">{!! trans("admin_menu_item.form.type") !!}</div>
        <div class="form-group form-float">
            <div class="form-line">
                <select name="type" id="type" class="form-control">
                    @foreach($types as $key => $value)
                        <option value="{{ $key }}" {{ !empty($menu_item) && $menu_item->type == $key ? 'selected' : '' }}>{{ $value }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="col-md-4 theme-link-ajax"></div>

    {{-- @if(!empty($data_link))
        @include("admin.menu_item.partials.theme_link")
    @endif --}}
    
</div>

<div class="row">
    <div class="col-md-4">
        <div class="font-bold col-green">{!! trans("admin_menu_item.form.class") !!}</div>
        <div class="form-group form-float">
            <div class="form-line">
                <input type="text" class="form-control" name="class"
                       value="{!! !empty($menu_item)  ? $menu_item->class : old("class") !!}">
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="font-bold col-green">{!! trans("admin_menu_item.form.target") !!}</div>
        <div class="form-group form-float">
            <div class="form-line">
                <select name="target" id="target" class="form-control">
                    @if(!empty($target))
                    @foreach($target as $key => $value)
                        <option value="{{ $key }}" {{ !empty($menu_item) && $menu_item->target == $key ? 'selected' : '' }}>{{ $value }}</option>
                    @endforeach
                    @endif
                </select>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="font-bold col-green">{!! trans("admin_menu_item.form.active") !!}</div>
        <div class="form-group">
            <input type="checkbox" id="active" name="active"
                   value="1" {!! !empty($menu_item) && $menu_item->active ? "checked" : null !!}>
            <label for="active">{!! trans("admin_menu_item.form.active") !!}</label>
        </div>
    </div>
</div>

