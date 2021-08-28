<div class="row">
    <div class="col-sm-6">
        <div class="font-bold col-green">{{ trans('admin_theme.form.name') }}</div>
        <div class="form-group">
            <div class="form-line">
                <input id="name" class="form-control" name="name" type="text" value="{{ !empty($theme) ? $theme->name : old('name') }}" {{ !empty($theme) ? 'readonly' : null }}>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <div class="font-bold col-green">{{ trans('admin_theme.form.content') }}</div>
            <div style="position: relative; height: 500px;">
                <pre class="ace-editor" id="ace_content">{{ !empty($theme) ? $theme->content : old('content') }}</pre>
                <textarea id="content" name="content" class="hidden">{{ !empty($theme) ? $theme->content : old('content') }}</textarea>
            </div>
            <label id="content-error" class="error" for="content"></label>
        </div>
    </div>
</div>


@section("script")
    @parent
    <script src="/assets/plugins/ace-builds/src-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
@endsection