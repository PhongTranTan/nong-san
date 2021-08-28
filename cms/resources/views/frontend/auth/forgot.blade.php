@extends('frontend.auth.master')

@section('style')
    <style>
        label.error {
            color: red !important;
        }
    </style>
@endsection

@section('content')
<h6 class="my-4 text-center text-uppercase">Thay đổi mật khẩu</h6>
<p class="small text-center">Nhập địa chỉ email của bạn và chúng tôi sẽ gửi cho bạn hướng dẫn về cách đặt lại mật khẩu.</p>
@include('frontend.layouts.partials.message')
<form id="forgotForm" action="{{ route('frontend.forgot') }}" method="POST">
    {{ csrf_field() }}
    <div class="form-group">
    <input name="email" class="form-control" id="exampleInputEmail1" type="email" aria-describedby="emailHelp" placeholder="Nhập địa chỉ E-mail">
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
            $('#forgotForm').validate({
                ignore: "",
                rules: {
                    "email": {
                        required: true,
                        email: true
                    }
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