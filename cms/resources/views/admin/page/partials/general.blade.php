<div class="row">
    <div class="col-md-4">
        <div class="font-bold col-green">{!! trans("admin_page.form.theme") !!}</div>
        <div class="form-group">
            <div class="form-line">
                <select id="theme" name="theme" class="form-control" required>
                    <option value="">---</option>
                    @foreach($themes as $key => $value)
                        <option value="{{ $key }}" @if(!empty($page) && $page->theme === $key) selected @endif>{{ $value }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="font-bold col-green">{!! trans("admin_page.form.page_parent") !!}</div>
        <div class="form-group">
            <div class="form-line">
                <select id="parent_id" name="parent_id" class="form-control" required>
                    <option value="0">---</option>
                    @foreach($parents as  $p)
                        @continue(!empty($page) && $page->id === $p->id)
                        <option value="{{ $p->id }}" @if(!empty($page) && $page->parent_id === $p->id) selected @endif>{{ $p->code }} - {{ $p->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="font-bold col-green">{!! trans("admin_page.form.code") !!}</div>
        <div class="form-group form-float">
            <div class="form-line">
                <input type="text" class="form-control" name="code" {{!empty($page) ? 'disabled' : ''}} value="{{ !empty($page) ? $page->code : old('code') }}" required>
            </div>
        </div>
    </div>


</div>

<div class="row">
    <div class="col-md-4">
        <div class="font-bold col-green">{!! trans("admin_page.form.group_code") !!}</div>
        <div class="form-group form-float">
            <div class="form-line">
                <input type="text" class="form-control" name="group_code" {{!empty($page) ? 'disabled' : ''}}  value="{{ !empty($page) ? $page->group_code : old('group_code') }}">
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="font-bold col-green">{!! trans("admin_page.form.position") !!}</div>
        <div class="form-group form-float">
            <div class="form-line">
                <input type="number" class="form-control" name="position" value="{{ !empty($page) ? $page->position : '0' }}" required min="0">
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="font-bold col-green">{!! trans("admin_page.form.status") !!}</div>
        <div class="form-group">
            <input type="checkbox" name="active" value="1" id="active"
                   @if(!empty($page) && $page->active) checked @endif>
            <label for="active">{!! trans("admin_page.form.active") !!}</label>
        </div>
    </div>
</div>