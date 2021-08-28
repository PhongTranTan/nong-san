<div id="block-modules" class="module-items">
    @isset($page)
        @foreach($parent_blocks as $rs)
            @php $name  = "old_blocks[{$rs->id}]"; @endphp

            @component('admin.page.partials.component.block', [
                'name' => $name,
                'default_block' => $rs,
                'types' => $rs->decode_types,
                'parent_blocks' => $parent_blocks
            ])
            @endcomponent
        @endforeach
    @endisset
</div>

<div class="m-t-20 p-t-15" style="background-color: #eeeeee;">
    <div class="row form-horizontal">
        <label class="col-sm-3 control-label col-green">
            {{ trans('admin_page.select_type') }}
        </label>

        <div class="col-sm-4">
            <div class="form-group">
                <div class="form-line">
                    <select id="block_type" class="form-control" multiple style="height: 180px; overflow: hidden;">
                        @foreach($block_types as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <button type="button" class="btn btn-lg btn-success waves-effect" id="btn_add_block"
                    data-error="{{ trans('admin_page.select_type_required') }}">
                {{ trans('button.add_block') }}
            </button>
        </div>
    </div>
</div>