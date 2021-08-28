<div class="row">

    <div class="col-md-4">
        <div class="font-bold">{!! trans("admin_review.form.position") !!}</div>
        <div class="form-group form-float">
            <div class="form-line">
                <input type="number" class="form-control" name="position" value="{{ $review->position ?? 1 }}" min="0" autocomplete="off">
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="font-bold">{!! trans("admin_review.form.active") !!}</div>
        <div class="form-group">
            <input type="checkbox" id="active" name="active"
                   value="1" {!! !empty($review) && $review->active ? "checked" : null !!}>
            <label style="margin-top: 10px" for="active">{!! trans("admin_review.form.active") !!}</label>
        </div>
    </div>
</div>
