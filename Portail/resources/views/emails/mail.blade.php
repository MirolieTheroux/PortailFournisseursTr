<!--//? REMARQUES::432::Attention à mettre tout le texte dans les fichiers de langue (Réutiliser ceux qui existe déjà si possible) (Ligne : ~92, ~206 à ~212 et ~288)-->
<!--//? REMARQUES::432::Est-ce que ce serait possible d'organiser les styles dans un fichier css en utilisant des id et des classes? Je pense que ce serait plus facile à lire-->

<!--//? REMARQUES::431::Est-ce que tu as valider que tous les envois requis à la page 22 (Du document d'analyse) sont fait?
    //?     - 1.a Fonctionne
    //?     - 1.b Ne semble pas fait
    //?     - 2.a Fonctionne
    //?     - 3.a Fonctionne
    //?     - 4.a S'envoit au fournisseur alors qu'il devrait s'envoyer à l'approvisionnement
    //?     - 5.a À faire lorsque les modifs seront configurer
-->

<!--//? REMARQUES::581::(Nice_to_have?) Selon la page 37 du document d'analyse, nous ne sommes pas conforme.
    //?     - Ajouter la possibilité au responsable de joindre la raison du refus au courriel.
-->

<!--//? REMARQUES::431/432::Je sais pas si c'est voulu mais je mentionne au cas que non mais j'ai un cadrier blanc dans les fonds bleus que je recois dans les courriels.-->

<!--//? REMARQUES::431/432::Dans le SupplierController de l'app de gestion, les 3 lignes ci-dessous se répètent souvent et je pense que tu pourrais en extraire un méthode
    $mailModel = EmailModel::where('name', 'denied')->firstOrFail();
    $mailsController = new MailsController();
    $mailsController->sendMail($supplier, $mailModel);
-->

<!--//? REMARQUES::431::Dans le SupplierController de l'app de gestion, aux lignes 183 à 185 j'ai le même if que le tien au ligne 190 à 192, est-ce qu'on pourrait les rassembler?-->

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $mailModel->title }}</title>
</head>
<body style="word-spacing:normal;">
    <div>
        <div
            style="background:#F1F1F1 url('https://i.ibb.co/tCcbctZ/image.png') center top / auto no-repeat;background-position:center top;background-repeat:no-repeat;background-size:auto;margin:0px auto;max-width:600px;">
            <div style="line-height:0;font-size:0;">
                <table align="center" background="https://i.ibb.co/tCcbctZ/image.png" border="0" cellpadding="0"
                    cellspacing="0" role="presentation"
                    style="background:#F1F1F1 url('https://i.ibb.co/tCcbctZ/image.png') center top / auto no-repeat;background-position:center top;background-repeat:no-repeat;background-size:auto;width:100%;">
                    <tbody>
                        <tr>
                            <td
                                style="direction:ltr;font-size:0px;padding:0 0 0 0;padding-bottom:0px;padding-top:0px;text-align:center;">
                                <div class="mj-column-per-100 mj-outlook-group-fix"
                                    style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation"
                                        style="vertical-align:top;" width="100%">
                                        <tbody>
                                            <tr>
                                                <td align="center"
                                                    style="font-size:0px;padding:5px 25px 5px 25px;padding-top:20px;padding-bottom:10px;word-break:break-word;">
                                                    <table border="0" cellpadding="0" cellspacing="0"
                                                        role="presentation"
                                                        style="border-collapse:collapse;border-spacing:0px;">
                                                        <tbody>
                                                            <tr>
                                                                <td style="width:50px;">
                                                                    <img alt="vtr_noir.png"
                                                                        src="https://www.v3r.net/wp-content/uploads/2022/06/vtr_noir.png"
                                                                        style="border:none;border-radius:px;display:block;outline:none;text-decoration:none;height:auto;width:100%;font-size:13px;"
                                                                        width="75" height="auto">
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="left"
                                                    style="font-size:0px;padding:0px 25px 0px 25px;padding-top:0px;padding-bottom:0px;word-break:break-word;">
                                                    <div
                                                        style="font-family:Verdana, Helvetica, Arial, sans-serif;font-size:13px;line-height:1;text-align:left;color:#000000;">
                                                        <p class="text-build-content"
                                                            style="line-height: 24px; text-align: center; margin: 10px 0; margin-top: 5px;">
                                                            <span
                                                                style="color:#ffffff;font-family:Arial;font-size: min(6vw, 32px);">
                                                                <b>{{ $mailModel->title }}</b>
                                                            </span>
                                                        </p>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="center" vertical-align="middle"
                                                    style="font-size:0px;padding:5px 25px 5px 25px;padding-bottom:5px;word-break:break-word;">
                                                    <table border="0" cellpadding="0" cellspacing="0"
                                                        role="presentation"
                                                        style="border-collapse:separate;line-height:100%;">
                                                        <tbody>
                                                            <tr>
                                                                <td align="center" bgcolor="#ffffff" role="presentation"
                                                                    style="border:none;border-radius:20px;cursor:auto;mso-padding-alt:10px 25px;background:#ffffff;"
                                                                    valign="middle">
                                                                    <a href="http://127.0.0.1:8000/"
                                                                        style="display:inline-block;background:#ffffff;color:#ffffff;font-family:Verdana, Helvetica, Arial, sans-serif;font-size:13px;font-weight:normal;line-height:120%;margin:0;text-decoration:none;text-transform:none;padding:10px 25px;mso-padding-alt:0px;border-radius:20px;"
                                                                        target="_blank">
                                                                        <span
                                                                            style="background-color:#ffffff;color:#0075d5;font-family:Arial;font-size:14px;">
                                                                            <b>Accéder au portail</b>
                                                                        </span>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            @if ($mailModel->description)
                                                <tr>
                                                    <td align="left"
                                                        style="font-size:0px;padding:10px 25px;padding-top:0px;padding-bottom:10px;word-break:break-word;">
                                                        <div
                                                            style="font-family:Arial, sans-serif;font-size:13px;letter-spacing:normal;line-height:1;text-align:left;color:#000000;">
                                                            <p class="text-build-content"
                                                                style="text-align: center; margin: 10px 0; margin-top: 10px;">
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
                <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation"
                    style="background:#F1F1F1;background-color:#F1F1F1;width:100%;">
                    <tbody>
                        <tr>
                            <td
                                style="direction:ltr;font-size:0px;padding:0 0 0 0;padding-bottom:0px;padding-top:0px;text-align:center;">
                                <div class="mj-column-per-100 mj-outlook-group-fix"
                                    style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation"
                                        style="vertical-align:top;" width="100%">
                                        <tbody>
                                            <tr>
                                                <td align="left"
                                                    style="background:#FFFFFF;font-size:0px;padding:20px 25px 10px 25px;padding-top:10px;padding-bottom:10px;word-break:break-word;">
                                                    <div
                                                        style="font-family:Verdana, Helvetica, Arial, sans-serif;font-size:13px;line-height:1;text-align:left;color:#000000;">
                                                        <p class="text-build-content"
                                                            style="line-height: 32px; text-align: center; margin: 10px 0; margin-top: 10px; margin-bottom: 10px;">
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
                <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation"
                    style="background:#ffffff;background-color:#ffffff;width:100%;">
                    <tbody>
                        <tr>
                            <td style="direction:ltr;font-size:0px;padding:0px 0px 0px 0px;text-align:center;">
                                <div class="mj-column-per-33-333333333333336 mj-outlook-group-fix"
                                    style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation"
                                        style="vertical-align:top;" width="100%">
                                        <tbody>
                                            <tr>
                                                <td align="center"
                                                    style="font-size:0px;padding:0px 25px 0px 25px;word-break:break-word;">
                                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation"
                                                        style="border-collapse:collapse;border-spacing:0px;">
                                                        <tbody>
                                                            <tr>
                                                                <td style="width:40px;">
                                                                    <img alt="{{ $mailModel->icon }}" src="{{ $mailModel->icon }}"
                                                                        style="border:none;border-radius:px;display:block;outline:none;text-decoration:none;height:auto;width:100%;font-size:13px;"
                                                                        height="auto">
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
            <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation"
                style="background:#ffffff;background-color:#ffffff;width:100%;">
                <tbody>
                    <tr>
                        <td style="direction:ltr;font-size:0px;padding:0px 0px 20px 0px;text-align:center;">
                            <div class="mj-column-per-100 mj-outlook-group-fix"
                                style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
                                <table border="0" cellpadding="0" cellspacing="0" role="presentation"
                                    style="vertical-align:top;" width="100%">
                                    <tbody>
                                        <tr>
                                            <td align="left"
                                                style="font-size:0px;padding:10px 25px 20px 25px;padding-top:10px;padding-bottom:10px;word-break:break-word;">
                                                <div
                                                    style="font-family:Verdana, Helvetica, Arial, sans-serif;font-size:13px;line-height:1;text-align:left;color:#000000;">
                                                    @if ($mailModel->state)
                                                        <p class="text-build-content"
                                                            style="text-align: center; margin: 10px 0; margin-top: 10px;">
                                                            <span
                                                                style="font-family:Arial;font-size:24px;line-height:22px;">
                                                                @if ($mailModel->state === 'waiting')
                                                                    <b style="color:#ff8800;">En attente</b>
                                                                @elseif ($mailModel->state === 'accepted')
                                                                    <b style="color:#00ca00;">Acceptée</b>
                                                                @elseif ($mailModel->state === 'denied')
                                                                    <b style="color:#c50000;">Refusée</b>
                                                                @elseif ($mailModel->state === 'toCheck')
                                                                    <b style="color:#00aeff;">À vérifier</b>
                                                                @endif
                                                            </span>
                                                        </p>
                                                    @endif
                                                    @if ($mailModel->message)
                                                        <p class="text-build-content"
                                                            style="text-align: center; margin: 0px 0; margin-bottom: 0px; padding-top: 10px;">
                                                            <span
                                                                style="color:#5e6977;font-family:Arial;font-size:14px;line-height:22px;">{!! $mailModel->message !!}</span>
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
        <div
            style="background:#F1F1F1 url('https://i.ibb.co/tCcbctZ/image.png') center top / auto no-repeat;background-position:center top;background-repeat:no-repeat;background-size:auto;margin:0px auto;max-width:600px;">
            <div style="line-height:0;font-size:0;">
                <table align="center" background="https://i.ibb.co/tCcbctZ/image.png" border="0" cellpadding="0"
                    cellspacing="0" role="presentation"
                    style="background:#F1F1F1 url('https://i.ibb.co/tCcbctZ/image.png') center top / auto no-repeat;background-position:center top;background-repeat:no-repeat;background-size:auto;width:100%;">
                    <tbody>
                        <tr>
                            <td
                                style="direction:ltr;font-size:0px;padding:0 0 0 0;padding-bottom:0px;padding-top:0px;text-align:center;">
                                <div class="mj-column-per-100 mj-outlook-group-fix"
                                    style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation"
                                        style="vertical-align:top;" width="100%">
                                        <tbody>
                                            <tr>
                                                <td align="left"
                                                    style="font-size:0px;padding:20px 25px 20px 25px;padding-top:20px;padding-bottom:20px;word-break:break-word;">
                                                    <div
                                                        style="font-family:Arial, sans-serif;font-size:13px;letter-spacing:normal;line-height:1;text-align:left;color:#000000;">
                                                        <p class="text-build-content"
                                                            style="text-align: center; margin: 10px 0; margin-top: 10px;">
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
                            <div class="mj-column-per-100 mj-outlook-group-fix"
                                style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
                                <table border="0" cellpadding="0" cellspacing="0" role="presentation"
                                    style="vertical-align:top;" width="100%">
                                    <tbody>
                                        <tr>
                                            <td align="left"
                                                style="font-size:0px;padding:0px 20px 0px 20px;padding-top:0px;padding-bottom:0px;word-break:break-word;">
                                                <div
                                                    style="font-family:Verdana, Helvetica, Arial, sans-serif;font-size:13px;line-height:1;text-align:left;color:#000000;">
                                                    <p class="text-build-content"
                                                        style="text-align: center; margin: 10px 0; margin-top: 5px; margin-bottom: 5px;">
                                                        <span style="color:#949aa2;font-family:Arial;font-size:16px;line-height:22px;">Ce message est généré automatiquement. Merci de ne pas y répondre.</span>
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