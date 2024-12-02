<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="word-spacing:normal;">
    <div>
        @if ($mailModel[0]->headerBackgroundUrl)
        <div style="background:#F1F1F1 url('{{ $mailModel[0]->headerBackgroundUrl }}') center top / auto no-repeat;background-position:center top;background-repeat:no-repeat;background-size:auto;margin:0px auto;max-width:600px;">
        @else
        <div style="margin:0px auto;max-width:600px;">
        @endif
            <div style="line-height:0;font-size:0;">
                @if ($mailModel[0]->headerBackgroundUrl)-
                <table align="center" background="{{ $mailModel[0]->headerBackgroundUrl }}" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#F1F1F1 url('{{ $mailModel[0]->headerBackgroundUrl }}') center top / auto no-repeat;background-position:center top;background-repeat:no-repeat;background-size:auto;width:100%;">
                @else
                <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">
                @endif
                    <tbody>
                        <tr>
                            <td style="direction:ltr;font-size:0px;padding:0 0 0 0;padding-bottom:0px;padding-top:0px;text-align:center;">
                                <div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                                        <tbody>
                                            @if ($mailModel[0]->logoUrl)
                                                <tr>
                                                    <td align="center" style="font-size:0px;padding:5px 25px 5px 25px;padding-top:20px;padding-bottom:10px;word-break:break-word;">
                                                        <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;border-spacing:0px;">
                                                            <tbody>
                                                                <tr>
                                                                    <td style="width:{{ $mailModel[0]->logoSize }}px;">
                                                                        <img alt="{{ $mailModel[0]->logoUrl }}" src="{{ $mailModel[0]->logoUrl }}" style="border:none;border-radius:px;display:block;outline:none;text-decoration:none;height:auto;width:100%;font-size:13px;" width="75" height="auto">
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            @endif
                                            @if ($mailModel[0]->titleText)
                                                <tr>
                                                    <td align="left" style="font-size:0px;padding:0px 25px 0px 25px;padding-top:0px;padding-bottom:0px;word-break:break-word;">
                                                        <div style="font-family:Verdana, Helvetica, Arial, sans-serif;font-size:13px;line-height:1;text-align:left;color:#000000;">
                                                            <p class="text-build-content" style="line-height: 24px; text-align: center; margin: 10px 0; margin-top: 5px;">
                                                                <span style="color:{{ $mailModel[0]->titleColor }};font-family:Arial;font-size: {{ $mailModel[0]->titleSize }}pt;">
                                                                    <b>{{ $mailModel[0]->titleText }}</b>
                                                                </span>
                                                            </p>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
                                            @if ($mailModel[0]->buttonUrl)
                                                <tr>
                                                    <td align="center" vertical-align="middle" style="font-size:0px;padding:5px 25px 5px 25px;padding-bottom:5px;word-break:break-word;">
                                                        <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:separate;line-height:100%;">
                                                            <tbody>
                                                                <tr>
                                                                    <td align="center" bgcolor="#ffffff" role="presentation" style="border:none;border-radius:20px;cursor:auto;mso-padding-alt:10px 25px;background:#ffffff;" valign="middle">
                                                                        <a href="{{ $mailModel[0]->buttonUrl }}" style="display:inline-block;background:#ffffff;color:#ffffff;font-family:Verdana, Helvetica, Arial, sans-serif;font-size:13px;font-weight:normal;line-height:120%;margin:0;text-decoration:none;text-transform:none;padding:10px 25px;mso-padding-alt:0px;border-radius:20px;" target="_blank">
                                                                            <span style="background-color:{{ $mailModel[0]->buttonBackgroundColor }};color:{{ $mailModel[0]->buttonTextColor }};font-family:Arial;font-size:14px;">
                                                                                <b>{{ $mailModel[0]->buttonText }}</b>
                                                                            </span>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            @endif
                                            @if ($mailModel[0]->descriptionText)
                                                <tr>
                                                    <td align="left" style="font-size:0px;padding:10px 25px;padding-top:0px;padding-bottom:10px;word-break:break-word;">
                                                        <div style="font-family:Arial, sans-serif;letter-spacing:normal;line-height:1;text-align:left;color:#000000;">
                                                            <p class="text-build-content" style="text-align: center; margin: 10px 0; margin-top: 10px;">
                                                                <span style="color:{{ $mailModel[0]->descriptionColor }}; font-size:{{ $mailModel[0]->descriptionSize }}pt;">{{ $mailModel[0]->descriptionText }}</span>
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
        @if ($mailModel[0]->subtitleText)
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
                                                            <span style="color:{{ $mailModel[0]->subtitleColor }};font-family:Arial;font-size:{{ $mailModel[0]->subtitleSize }}pt;">
                                                                <b>{{ $mailModel[0]->subtitleText }}</b>
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
        @if ($mailModel[0]->iconUrl)
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
                                                                <td style="width:{{ $mailModel[0]->iconSize }}px;">
                                                                    <img alt="{{ $mailModel[0]->iconUrl }}" src="{{ $mailModel[0]->iconUrl }}" style="border:none;border-radius:px;display:block;outline:none;text-decoration:none;height:auto;width:100%;font-size:13px;" height="auto">
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
                                                        @if ($mailModel[0]->importantInfoText)
                                                            <span
                                                                style="font-family:Arial;font-size:{{ $mailModel[0]->importantInfoSize }}pt;line-height:22px;">
                                                                <b style="color:{{ $mailModel[0]->importantInfoColor }};">{{ $mailModel[0]->importantInfoText }}</b>
                                                            </span>
                                                        @endif
                                                        @if ($mailModel[0]->name === 'Réinitialisation mot de passe fournisseur')
                                                            <a href="{{ $resetLink }}" style="background-color: {{ $mailModel[0]->passwordResetButtonBackgroundColor }}; color: {{ $mailModel[0]->passwordResetButtonColor }}; padding: 10px 20px; text-decoration: none;">{{ $mailModel[0]->passwordResetButtonText }}</a>
                                                        @endif
                                                    </p>
                                                    @if ($mailModel[0]->messageText)
                                                        <p class="text-build-content" style="text-align: center; margin: 0px 0; margin-bottom: 0px; padding-top: 10px;">
                                                            <span style="color:{{ $mailModel[0]->messageColor }};font-family:Arial;font-size:{{ $mailModel[0]->messageSize }}pt;line-height:22px;">{!! $mailModel[0]->messageText !!}</span>
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
        @if ($mailModel[0]->footerBackgroundUrl)
        <div style="background:#F1F1F1 url('{{ $mailModel[0]->footerBackgroundUrl }}') center top / auto no-repeat;background-position:center top;background-repeat:no-repeat;background-size:auto;margin:0px auto;max-width:600px;">
        @else
        <div style="margin:0px auto;max-width:600px;">
        @endif
            <div style="line-height:0;font-size:0;">
                @if ($mailModel[0]->footerBackgroundUrl)
                <table align="center" background="{{ $mailModel[0]->footerBackgroundUrl }}" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#F1F1F1 url('{{ $mailModel[0]->footerBackgroundUrl }}') center top / auto no-repeat;background-position:center top;background-repeat:no-repeat;background-size:auto;width:100%;">
                @else
                <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">
                @endif
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
                                                            <span style="color:{{ $mailModel[0]->footerColor }}; line-height:1.5; font-size:{{ $mailModel[0]->footerSize }}pt;">{!! $mailModel[0]->footerText !!}</span>
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