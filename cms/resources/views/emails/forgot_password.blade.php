<!DOCTYPE html>
<html lang="en">
<head>
    @include('emails.layouts.header')
</head>
<body>
    <p>Reset Password</p>
    <p>Hi {{ $customer->name }},</p>
    <p>Click <a href="{{ route('frontend.reset.show', ['token' => $token]) }}">here</a> to reset your password</p>
    
    @include('emails.layouts.footer')
</body>
</html>