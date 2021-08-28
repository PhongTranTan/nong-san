@extends('frontend.auth.master')

@section('style')
    <style>
        label.error {
            color: red !important;
        }
    </style>
@endsection

@section('content')
<h6 class="my-4 text-center text-uppercase">Cập nhật mật khẩu mới</h6>
<p class="small text-center"></p>
@include('frontend.layouts.partials.message')
<form id="resetForm" action="{{ route('frontend.reset') }}" method="POST">
    {{ csrf_field() }}
    <input type="hidden" id="email" name="email" value="{{ $customer->email }}">
    <div class="form-group">
    <label for="exampleInputPassword1">Mật khẩu mới</label>
    <input name="password" class="form-control" id="exampleInputPassword1" type="password" placeholder="Mật khẩu mới">
    </div>
    <div class="form-group">
    <label for="exampleInputPassword2">Xác nhận mật khẩu mới</label>
    <input name="password_confirm" class="form-control" id="exampleInputPassword2" type="password" placeholder="Xác nhận mật khẩu mới">
    </div>
    <button type="submit" class="btn btn-default btn-block">Đặt lại mật khẩu</button>
</form>
<div class="text-center mt-3">
    <a class="d-block small" href="{{ route('frontend.login.show') }}"><i class="icon-arrow-left-circle icons"></i> Quay lại đăng nhập</a>
</div>
@endsection

@section('script')
    <script src="/assets/plugins/jquery-validation/jquery.validate.js"></script>
    <script>
        jQuery(function ($) {
            $('#resetForm').validate({
                ignore: "",
                rules: {
                    "email": {
                        required: true,
                        email: true
                    },
                    "password": {
                        required: true,
                        minlength: 7,
                        equalTo: "#exampleInputPassword2"
                    },
                },
                highlight: function (input) {

                    
                },
                unhighlight: function (input) {
                },
                errorPlacement: function (error, input) {
                    error.insertAfter($(input));
                }
            });
        });
    </script>
@endsection