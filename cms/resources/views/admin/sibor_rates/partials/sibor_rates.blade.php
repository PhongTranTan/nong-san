<div class="row" id="content-sibor">

    <div class="col-md-12">
        <button class="btn btn-primary pull-right add-sibor" type="button">Add</button>
    </div>

    <div class="clearfix"></div>
    @if(!isset($sibor_rates))
    <div class="col-md-12">
        <button class="btn btn-danger pull-right button-remove" type="button">Remove</button><br/>
        <div class="col-md-4">
            <div class="font-bold col-green">{!! trans("admin_sibor_rates.form.month_sibor") !!}</div>
            <div class="form-group form-float">
                <div class="form-line">
                    <div class="form-line">
                        <input type="text" class="form-control" name="month_sibor[]">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="font-bold col-green">{!! trans("admin_sibor_rates.form.percent_sibor") !!}</div>
            <div class="form-group form-float">
                <div class="form-line">
                    <div class="form-line">
                        <input type="text" class="form-control" name="percent_sibor[]">
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>
        <hr>
    </div>
    @else
    @php
        $month_sibors = json_decode($sibor_rates->month_sibor);
        $percent_sibors = json_decode($sibor_rates->percent_sibor);
    @endphp
        @if($month_sibors != null && $percent_sibors != null)
            @foreach($month_sibors as $key => $month_sibor)
            <div class="col-md-12">
                <button class="btn btn-danger pull-right button-remove" type="button">Remove</button><br/>
                <div class="col-md-4">
                    <div class="font-bold col-green">{!! trans("admin_sibor_rates.form.month_sibor") !!}</div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <div class="form-line">
                                <input type="text" class="form-control" name="month_sibor[]" value="{{ $month_sibor }}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="font-bold col-green">{!! trans("admin_sibor_rates.form.percent_sibor") !!}</div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <div class="form-line">
                                <input type="text" class="form-control" name="percent_sibor[]" value="{{ (isset($percent_sibors[$key])) ? $percent_sibors[$key] : null }}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="clearfix"></div>
                <hr>
            </div>
            @endforeach
        @endif
    @endif
</div>

