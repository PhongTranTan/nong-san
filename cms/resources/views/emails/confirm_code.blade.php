<!DOCTYPE html>
<html lang="en">
<head>
    @include('emails.layouts.header')
</head>
<body>
    <p>Reset Password</p>
    <p>Hi {{ $customer->name }},</p>
    <p>Click your reset code is: <b>{{ $customer->confirm_code }}</b></p>

    @include('emails.layouts.footer')
</body>
</html>
