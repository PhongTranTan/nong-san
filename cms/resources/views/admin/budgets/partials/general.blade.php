<div class="row">

    <div class="col-md-4">
        <div class="font-bold col-green">{!! trans("admin_budgets.form.budgets") !!}</div>
        <div class="form-group">
            <input type="text" class="form-control" id="budgets" name="budgets"
                   value="{!! !empty($budgets) && $budgets->budgets != null ? $budgets->budgets : null !!}">
        </div>
    </div>

</div>
