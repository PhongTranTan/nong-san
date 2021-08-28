<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Application email</title>
</head>
<body>
<center>
    <div style="background: #fafafa; padding: 15px;" border="0" cellpadding="0" cellspacing="0">
        <table width="600" align="center">
            <tr>
                <td align="center" valign="top">
                    <table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">
                        <tr>
                            <td align="center" valign="top">
                                <table border="0" cellpadding="0" cellspacing="0" width="600">
                                    <tr>
                                        <td align="center" valign="top">
                                            <p style="text-align: left">
                                                Xin Chào {{ $input['name'] }},
                                            </p>

                                            <p style="text-align: left">
                                                Cảm ơn {{ $input['name'] }} đã liên hệ với Longhau.com.vn. Chúng tôi xin xác nhận lại thông tin của bạn như sau:
                                            </p>
                                            <div style="padding-left:15px;text-align: left">{{ trans('f_career.name') }}: {{ $input['name'] }}</div>
                                            <div style="padding-left:15px;text-align: left">{{ trans('f_career.email') }}: {{ $input['email'] }}</div>
                                            <div style="padding-left:15px;text-align: left">{{ trans('f_career.position') }}: {{ $input['position'] }}</div>
                                            <div style="padding-left:15px;text-align: left">{{ trans('f_career.phone') }}: {{ $input['phone'] }}</div>

                                            <p style="text-align: left">
                                                Nhân viên chăm sóc khách hàng của chúng tôi sẽ liên hệ lại với {{ $input['name'] }} trong thời gian sớm nhất. Trong thời gian chờ đợi, nếu anh/ chị cần thêm yêu cầu hoặc cần hỗ trợ, vui lòng liên hệ trực tiếp với Longhau.com.vn qua số điện thoại: + 028.3781 8929 ext 264,  + 0979.24.24.75 hoặc Email: trinh.nth@longhau.com.vn
                                            </p>

                                            <p>&nbsp;&nbsp;</p>

                                            <p style="text-align: left">
                                                Cảm ơn {{ $input['name'] }},
                                                <br>
                                                Long Hau – Nhóm Chăm sóc khách hàng
                                            </p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</center>
</body>
</html>