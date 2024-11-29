<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $mailModel->title }}</title>
</head>
<body style="word-spacing:normal;">
    <div>
        <div style="background:#F1F1F1 url('https://i.ibb.co/tCcbctZ/image.png') center top / auto no-repeat;background-position:center top;background-repeat:no-repeat;background-size:auto;margin:0px auto;max-width:600px;">
            <div style="line-height:0;font-size:0;">
                <table align="center" background="https://i.ibb.co/tCcbctZ/image.png" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#F1F1F1 url('https://i.ibb.co/tCcbctZ/image.png') center top / auto no-repeat;background-position:center top;background-repeat:no-repeat;background-size:auto;width:100%;">
                    <tbody>
                        <tr>
                            <td style="direction:ltr;font-size:0px;padding:0 0 0 0;padding-bottom:0px;padding-top:0px;text-align:center;">
                                <div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                                        <tbody>
                                            <tr>
                                                <td align="center" style="font-size:0px;padding:5px 25px 5px 25px;padding-top:20px;padding-bottom:10px;word-break:break-word;">
                                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;border-spacing:0px;">
                                                        <tbody>
                                                            <tr>
                                                                <td style="width:50px;">
                                                                    <img alt="vtr_noir.png" src="https://www.v3r.net/wp-content/uploads/2022/06/vtr_noir.png" style="border:none;border-radius:px;display:block;outline:none;text-decoration:none;height:auto;width:100%;font-size:13px;" width="75" height="auto">
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="left" style="font-size:0px;padding:0px 25px 0px 25px;padding-top:0px;padding-bottom:0px;word-break:break-word;">
                                                    <div style="font-family:Verdana, Helvetica, Arial, sans-serif;font-size:13px;line-height:1;text-align:left;color:#000000;">
                                                        <p class="text-build-content" style="line-height: 24px; text-align: center; margin: 10px 0; margin-top: 5px;">
                                                            <span style="color:#ffffff;font-family:Arial;font-size: 24pt;">
                                                                <b>{{ $mailModel->title }}</b>
                                                            </span>
                                                        </p>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="center" vertical-align="middle" style="font-size:0px;padding:5px 25px 5px 25px;padding-bottom:5px;word-break:break-word;">
                                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:separate;line-height:100%;">
                                                        <tbody>
                                                            <tr>
                                                                <td align="center" bgcolor="#ffffff" role="presentation" style="border:none;border-radius:20px;cursor:auto;mso-padding-alt:10px 25px;background:#ffffff;" valign="middle">
                                                                    @if ($destinator === 'Supplier')
                                                                        <a href="http://127.0.0.1:8000/" style="display:inline-block;background:#ffffff;color:#ffffff;font-family:Verdana, Helvetica, Arial, sans-serif;font-size:13px;font-weight:normal;line-height:120%;margin:0;text-decoration:none;text-transform:none;padding:10px 25px;mso-padding-alt:0px;border-radius:20px;" target="_blank">
                                                                            <span style="background-color:#ffffff;color:#0075d5;font-family:Arial;font-size:14px;">
                                                                                <b>{{__('mail.portalButton')}}</b>
                                                                            </span>
                                                                        </a>
                                                                    @else
                                                                        <a href="http://127.0.0.1:8080/" style="display:inline-block;background:#ffffff;color:#ffffff;font-family:Verdana, Helvetica, Arial, sans-serif;font-size:13px;font-weight:normal;line-height:120%;margin:0;text-decoration:none;text-transform:none;padding:10px 25px;mso-padding-alt:0px;border-radius:20px;" target="_blank">
                                                                            <span style="background-color:#ffffff;color:#0075d5;font-family:Arial;font-size:14px;">
                                                                                <b>{{__('mail.portalButton')}}</b>
                                                                            </span>
                                                                        </a>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            @if ($mailModel->description)
                                                <tr>
                                                    <td align="left" style="font-size:0px;padding:10px 25px;padding-top:0px;padding-bottom:10px;word-break:break-word;">
                                                        <div style="font-family:Arial, sans-serif;font-size:13px;letter-spacing:normal;line-height:1;text-align:left;color:#000000;">
                                                            <p class="text-build-content" style="text-align: center; margin: 10px 0; margin-top: 10px;">
                                                                <span style="color:#ffffff;">{{ $mailModel->description }}</span>
                                                            </p>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        @if ($mailModel->subtitle)
            <div style="background:#F1F1F1;background-color:#F1F1F1;margin:0px auto;max-width:600px;">
                <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#F1F1F1;background-color:#F1F1F1;width:100%;">
                    <tbody>
                        <tr>
                            <td style="direction:ltr;font-size:0px;padding:0 0 0 0;padding-bottom:0px;padding-top:0px;text-align:center;">
                                <div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                                        <tbody>
                                            <tr>
                                                <td align="left" style="background:#FFFFFF;font-size:0px;padding:20px 25px 10px 25px;padding-top:10px;padding-bottom:10px;word-break:break-word;">
                                                    <div style="font-family:Verdana, Helvetica, Arial, sans-serif;font-size:13px;line-height:1;text-align:left;color:#000000;">
                                                        <p class="text-build-content" style="line-height: 32px; text-align: center; margin: 10px 0; margin-top: 10px; margin-bottom: 10px;">
                                                            <span style="color:#5e6977;font-family:Arial;font-size:26px;">
                                                                <b>{{ $mailModel->subtitle }}</b>
                                                            </span>
                                                        </p>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @endif
        @if ($mailModel->icon)
            <div style="background:#ffffff;background-color:#ffffff;margin:0px auto;max-width:600px;">
                <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#ffffff;background-color:#ffffff;width:100%;">
                    <tbody>
                        <tr>
                            <td style="direction:ltr;font-size:0px;padding:0px 0px 0px 0px;text-align:center;">
                                <div class="mj-column-per-33-333333333333336 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                                        <tbody>
                                            <tr>
                                                <td align="center" style="font-size:0px;padding:0px 25px 0px 25px;word-break:break-word;">
                                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;border-spacing:0px;">
                                                        <tbody>
                                                            <tr>
                                                                <td style="width:40px;">
                                                                    <img alt="{{ $mailModel->icon }}" src="{{ $mailModel->icon }}" style="border:none;border-radius:px;display:block;outline:none;text-decoration:none;height:auto;width:100%;font-size:13px;" height="auto">
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @endif
        <div style="background:#ffffff;background-color:#ffffff;margin:0px auto;max-width:600px;">
            <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#ffffff;background-color:#ffffff;width:100%;">
                <tbody>
                    <tr>
                        <td style="direction:ltr;font-size:0px;padding:0px 0px 20px 0px;text-align:center;">
                            <div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
                                <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                                    <tbody>
                                        <tr>
                                            <td align="left" style="font-size:0px;padding:10px 25px 20px 25px;padding-top:10px;padding-bottom:10px;word-break:break-word;">
                                                <div style="font-family:Verdana, Helvetica, Arial, sans-serif;font-size:13px;line-height:1;text-align:left;color:#000000;">
                                                    <p class="text-build-content" style="text-align: center; margin: 10px 0; margin-top: 10px;">
                                                        <span
                                                            style="font-family:Arial;font-size:24px;line-height:22px;">
                                                            @if ($mailModel->name === 'ResponsableToCheck')
                                                                <b style="color:#0076D5;">{{ $user->neq }}
                                                                <br><br>
                                                                {{ $user->name }}</b>
                                                            @elseif ($mailModel->state === 'waiting')
                                                                <b style="color:#ff8800;">{{__('mail.waiting')}}</b>
                                                            @elseif ($mailModel->state === 'accepted')
                                                                <b style="color:#00ca00;">{{__('mail.accepted')}}</b>
                                                            @elseif ($mailModel->state === 'denied')
                                                                <b style="color:#c50000;">{{__('mail.denied')}}</b>
                                                            @endif
                                                        </span>
                                                    </p>
                                                    @if ($mailModel->message)
                                                        <p class="text-build-content" style="text-align: center; margin: 0px 0; margin-bottom: 0px; padding-top: 10px;">
                                                            <span style="color:#5e6977;font-family:Arial;font-size:14px;line-height:22px;">{!! $mailModel->message !!}</span>
                                                        </p>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div style="background:#F1F1F1 url('https://i.ibb.co/tCcbctZ/image.png') center top / auto no-repeat;background-position:center top;background-repeat:no-repeat;background-size:auto;margin:0px auto;max-width:600px;">
            <div style="line-height:0;font-size:0;">
                <table align="center" background="https://i.ibb.co/tCcbctZ/image.png" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#F1F1F1 url('https://i.ibb.co/tCcbctZ/image.png') center top / auto no-repeat;background-position:center top;background-repeat:no-repeat;background-size:auto;width:100%;">
                    <tbody>
                        <tr>
                            <td style="direction:ltr;font-size:0px;padding:0 0 0 0;padding-bottom:0px;padding-top:0px;text-align:center;">
                                <div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                                        <tbody>
                                            <tr>
                                                <td align="left" style="font-size:0px;padding:20px 25px 20px 25px;padding-top:20px;padding-bottom:20px;word-break:break-word;">
                                                    <div style="font-family:Arial, sans-serif;font-size:13px;letter-spacing:normal;line-height:1;text-align:left;color:#000000;">
                                                        <p class="text-build-content" style="text-align: center; margin: 10px 0; margin-top: 10px;">
                                                            <span style="color:#ffffff; line-height:1.5;">{!! $mailModel->footer !!}</span>
                                                        </p>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div style="margin:0px auto;max-width:600px;">
            <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">
                <tbody>
                    <tr>
                        <td style="direction:ltr;font-size:0px;padding:10px 0px 10px 0px;text-align:center;">
                            <div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
                                <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                                    <tbody>
                                        <tr>
                                            <td align="left" style="font-size:0px;padding:0px 20px 0px 20px;padding-top:0px;padding-bottom:0px;word-break:break-word;">
                                                <div style="font-family:Verdana, Helvetica, Arial, sans-serif;font-size:13px;line-height:1;text-align:left;color:#000000;">
                                                    <p class="text-build-content" style="text-align: center; margin: 10px 0; margin-top: 5px; margin-bottom: 5px;">
                                                        <span style="color:#949aa2;font-family:Arial;font-size:16px;line-height:22px;">{{__('mail.noReply')}}</span>
                                                    </p>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>