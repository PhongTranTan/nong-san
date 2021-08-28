<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Application</title>
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
                                                Xin Chào,
                                            </p>

                                            <p style="text-align: left">
                                                {{ trans('f_career.apply_online') }}
                                            </p>

                                            <div style="text-align: left">{{ trans('f_career.name') }}: {{ $input['name'] }}</div>
                                            <div style="text-align: left">{{ trans('f_career.email') }}: {{ $input['email'] }}</div>
                                            <div style="text-align: left">{{ trans('f_career.position') }}: {{ $input['position'] }}</div>
                                            <div style="text-align: left">{{ trans('f_career.content') }}: {{ $input['content'] }}</div>
                                            <div style="text-align: left">{{ trans('f_career.phone') }}: {{ $input['phone'] }}</div>
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