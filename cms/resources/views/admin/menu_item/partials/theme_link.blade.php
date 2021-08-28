<div class="col-md-4 theme-link">
    <div class="font-bold col-green">Choose Link</div>
    <div class="form-group form-float">
        <div class="form-line">
            <select name="referencer_id" id="referencer_id" class="form-control">
                <option value="">---</option>
                @if(\Schema::hasColumn($type, 'code'))
                @foreach($data_link as $key => $value)
                    <option value="{{ $value->id }}" {{ !empty($menu_item) && $menu_item->referencer_id === $value->id ? 'selected' : '' }}>{{ $value->code }}</option>
                @endforeach
                @elseif(\Schema::hasColumn($type, 'title'))
                @foreach($data_link as $key => $value)
                    <option value="{{ $value->id }}" {{ !empty($menu_item) && $menu_item->referencer_id === $value->id ? 'selected' : '' }}>{{ $value->title }}</option>
                @endforeach
                @elseif(\Schema::hasColumn($type, 'name'))
                @foreach($data_link as $key => $value)
                    <option value="{{ $value->id }}" {{ !empty($menu_item) && $menu_item->referencer_id === $value->id ? 'selected' : '' }}>{{ $value->name }}</option>
                @endforeach
                @endif
            </select>
        </div>
    </div>
</div>