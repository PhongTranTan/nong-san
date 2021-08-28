<!DOCTYPE html>
<html lang="en">
<head>
    @include('emails.layouts.header')
</head>
<body>
    <h4>{{ trans('emails.create_customer.your_info') }}</h4>
    <p>{{ trans('emails.create_customer.name') }}: {{ $customer->name }}</p>
    <p>{{ trans('emails.create_customer.email') }}: {{ $customer->email }}</p>
    <p>{{ trans('emails.create_customer.password') }}: {{ $password }}</p>
    <p>{!! trans('emails.create_customer.access', ['route' => route('page.home')]) !!}</p>
    
    @include('emails.layouts.footer')
</body>
</html>