<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact email</title>
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
                                                Hello,
                                            </p>

                                            <p style="text-align: left">
                                                You just received new contact from {{ $input['name'] }}
                                            </p>
                                            <div style="text-align: left">- Name: {{ $input['name'] }}</div>
                                            <div style="text-align: left">- Phone: {{ $input['phone'] }}</div>
                                            <div style="text-align: left">- E-mail: {{ $input['email'] }}</div>
                                            <div style="text-align: left">- Hear from: {{ $input['hear'] }}</div>
                                            <div style="text-align: left">- Interested: {{ $input['interested'] }}</div>
                                            <div style="text-align: left">Content:
                                                <blockquote style="text-align: left">{{ $input['content'] }}</blockquote>
                                            </div>
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