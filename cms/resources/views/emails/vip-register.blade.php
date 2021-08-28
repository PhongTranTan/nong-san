<!DOCTYPE html>
<html lang="vi">
<head></head>
<body style="text-align: center; position: relative;background-color: #f5f8fa;">
<div style="margin: 50px auto;width: 80%; position: absolute;margin: auto; left: 0;right: 0;font-family: sans-serif;border-radius: 4px;background: #fff;border: 1px solid #e1e8ed;padding: 10px;">
    <div style="text-align: center; margin-bottom: 20px">
        <a href="#" style="text-decoration:none"
           target="_blank"><img src="{{asset('images/logo.png')}}"
                                style="max-width: 145px;">
        </a>
    </div>
    <div style="text-align: justify;margin-bottom: 22px;border: 1px solid beige;padding: 5px;border-radius: 5px;">
        <p> A customer has just signed up to receive news from the website: <span style="color: #87c460">{{ $info['m_email2'] }}</span></p>
    </div>
    {{-- <div style="text-align: center">
        <a href="{{ route('unsubscribe.get') }}?email={{ $info['m_email2'] }}&code={{ $info['id'] }}-{{ $info['updated_at'] }}"><button style="padding: 15px; background-color: #a0ce4e; color: #ffffff">Unsubscribe</button></a>
    </div> --}}
    <span> <a href="#" style="text-decoration:none;font-family: 'Helvetica Neue Light',Helvetica,Arial,sans-serif;color:#8899a6;font-size:12px;font-weight:normal;">Copyright © New Launch Portal • All rights reserved.</a> </span>
</div>

</body>
</html>