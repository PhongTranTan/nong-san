<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin NewlaunchPortal</title>
</head>
<body>
    <center>
        <div style="background: #fafafa; padding: 15px;" border="0" cellpadding="0" cellspacing="0">
            <table width="600" align="center">
                <tr>
                    <td align="center" valign="top">
                        <table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">
                            <tr>
                                <td align="center" valign="top" 
                                    style=" font-size: 18px;
                                            color: black;
                                            background: #fff;
                                            padding: 10px;
                                            border-radius: 10px;
                                            border: 1px solid #f1f1f1;">
                                    <table border="0" cellpadding="0" cellspacing="0" width="600">
                                        <tr>
                                            <td align="center" valign="top">
                                                {{-- <p style="text-align: left">
                                                    <img src="{{ public_path("/assets/images/icons/favicon.ico") }}">
                                                </p> --}}
                                                <p style="text-align: center;
                                                            border-bottom: 1px solid #dadce0;
                                                            padding-bottom: 15px;
                                                            font-size: 20px;
                                                            font-weight: bold;">
                                                    {{ $subject }}
                                                </p>
                                                <p style="text-align: left">
                                                    Hello Admin,
                                                </p>
                                                <p style="text-align: left">
                                                    You just received new contact from <b>{{ ucwords($info['name']) }}</b>
                                                </p>
                                                @foreach($info as $key => $item)
                                                    @if($item)
                                                        <div style="text-align: left"><b>- {{ ucfirst($key) }}:</b> {{ $item }}</div>
                                                    @endif
                                                @endforeach
                                                <br>
                                                <div style="text-align: center">
                                                    <a href="{{ $urlAccess }}" target="blank_">
                                                        <button style="padding: 15px; 
                                                                        background-color: #a0ce4e; 
                                                                        border: 1px solid #fff;
                                                                        border-radius: 3px;
                                                                        cursor: pointer;
                                                                        color: #ffffff">
                                                            Access
                                                        </button>
                                                    </a>
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