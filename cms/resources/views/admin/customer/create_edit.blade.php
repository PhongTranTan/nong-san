@extends("admin.layouts.master")

@section("meta")
@endsection

@section("style")
    <link href="/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet"/>
@endsection

@section("content")
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        {!! trans("admin_customer.edit") !!}
                    </h2>
                    <div class="clearfix"></div>
                </div>
                <div class="body">
                    <div class="row">
                    	<div class="col-md-4">
                            <label for="">Avatar</label>
                            <div>
                                <img src="{{ $customer->avatar }}" style="max-width: 100%" alt="">
                            </div>
                    	</div>
                        <div class="col-md-8">
                            <table class="table table-hover">
                                <tbody>
                                <tr>
                                    <th>Name:</th>
                                    <td>{{ $customer->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td>{{ $customer->email }}</td>
                                </tr>
                                <tr>
                                    <th>Birthday:</th>
                                    <td>{{ Date2String($customer->birthday, 'd/m/Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Phone:</th>
                                    <td>{{ $customer->address }}</td>
                                </tr>
                                <tr>
                                    <th>Bio:</th>
                                    <td>{{ $customer->bio }}</td>
                                </tr>
                                <tr>
                                    <th>Company name:</th>
                                    <td>{{ $customer->company_name }}</td>
                                </tr>
                                <tr>
                                    <th>Company address:</th>
                                    <td>{{ $customer->company_address }}</td>
                                </tr>
                                <tr>
                                    <th>Company phone:</th>
                                    <td>{{ $customer->company_phone }}</td>
                                </tr>
                                <tr>
                                    <th>Company email:</th>
                                    <td>{{ $customer->company_email }}</td>
                                </tr>
                                <tr>
                                    <th>Company bio:</th>
                                    <td>{{ $customer->company_bio }}</td>
                                </tr>
                                <tr>
                                    <th>Active/ Inactive:</th>
                                    <td>
                                        <div class="form-group">
                                            <input type="checkbox" id="active" name="active"
                                                   value="1" {!! !empty($customer) && $customer->active ? "checked" : null !!}>
                                            <label for="active">{!! trans("admin_customer.form.active") !!}</label>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("script")
    <script type="text/javascript" src="/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

    <script type="application/javascript" src="assets/plugins/notify/notify.min.js"></script>
    <script src="/assets/plugins/jquery-validation/jquery.validate.js"></script>
    <script>
        $('#active').click(function () {
            let active = $(this).is(":checked") ? 1 : 0;
            $.ajax({
                url: '{{ route('admin.customer.update', $customer->id) }}',
                type: 'PUT',
                data: { active: active },
                success: function (res) {
                    $.notify(res.message, res.notify_class);
                }
            });
        })
    </script>
@endsection