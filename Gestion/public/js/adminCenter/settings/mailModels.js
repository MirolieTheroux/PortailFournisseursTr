function replaceByPlaceholders(text) {
    if (!text) return '';
    const placeholders = {
        '{{ $supplier->neq }}': '{neq}',
        '{{ $supplier->name }}': '{nom}',
        '{{ $supplier->email }}': '{email}',
        '{{ $supplier->site }}': '{site}',
    };

    let replacedText = text.replace(/{{\s*\$supplier->\w+\s*}}/g, (match) => placeholders[match] || match);

    replacedText = replacedText.replace(/{{\s*\$reason\s*}}/g, '{raison}');
    replacedText = replacedText.replace(/<br\s*\/?>/gi, '{ligne}');

    return replacedText;
}

function replacePlaceholders(text) {
    if (!text) return '';
    const selectedEmail = document.getElementById('selectedMail').value;
    const placeholders = {
        '{neq}': '1111111111',
        '{nom}': 'Demo',
        '{email}': 'Demo@example.com',
        '{site}': 'Demo.com',
        '{ligne}': '<br>',
    };

    if (selectedEmail === "Fournisseur refusé avec raison") {
        placeholders['{raison}'] = 'demo de raison';
    }

    let replacedText = text.replace(/{[^}]+}/g, (match) => placeholders[match] || match);

    return replacedText;
}

function populateFields(selectedMail) {
    if (!selectedMail) return;

    fetch(`/email-model/${encodeURIComponent(selectedMail)}`)
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                console.error(data.error);
                return;
            }

            document.getElementById('object').value = replaceByPlaceholders(data.object);
            document.getElementById('headerBackgroundUrl').value = replaceByPlaceholders(data.headerBackgroundUrl);
            document.getElementById('logoUrl').value = replaceByPlaceholders(data.logoUrl);
            document.getElementById('logoSize').value = data.logoSize || '';
            document.getElementById('titleText').value = replaceByPlaceholders(data.titleText);
            document.getElementById('titleSize').value = data.titleSize || '';
            document.getElementById('titleColor').value = data.titleColor || '#ffffff';
            document.getElementById('buttonUrl').value = replaceByPlaceholders(data.buttonUrl);
            document.getElementById('buttonText').value = replaceByPlaceholders(data.buttonText);
            document.getElementById('buttonTextColor').value = data.buttonTextColor || '#ffffff';
            document.getElementById('buttonBackgroundColor').value = data.buttonBackgroundColor || '#ffffff';
            document.getElementById('descriptionText').value = replaceByPlaceholders(data.descriptionText);
            document.getElementById('descriptionSize').value = data.descriptionSize || '';
            document.getElementById('descriptionColor').value = data.descriptionColor || '#ffffff';
            document.getElementById('subtitleText').value = replaceByPlaceholders(data.subtitleText);
            document.getElementById('subtitleSize').value = data.subtitleSize || '';
            document.getElementById('subtitleColor').value = data.subtitleColor || '#ffffff';
            document.getElementById('iconUrl').value = replaceByPlaceholders(data.iconUrl);
            document.getElementById('iconSize').value = data.iconSize || '';
            document.getElementById('importantInfoText').value = replaceByPlaceholders(data.importantInfoText);
            document.getElementById('importantInfoSize').value = data.importantInfoSize || '';
            document.getElementById('importantInfoColor').value = data.importantInfoColor || '#ffffff';
            document.getElementById('passwordResetButtonText').value = replaceByPlaceholders(data.passwordResetButtonText);
            document.getElementById('passwordResetButtonColor').value = data.passwordResetButtonColor || '#ffffff';
            document.getElementById('passwordResetButtonBackgroundColor').value = data.passwordResetButtonBackgroundColor || '#ffffff';
            document.getElementById('messageText').value = replaceByPlaceholders(data.messageText);
            document.getElementById('messageSize').value = data.messageSize || '';
            document.getElementById('messageColor').value = data.messageColor || '#ffffff';
            document.getElementById('footerText').value = replaceByPlaceholders(data.footerText);
            document.getElementById('footerSize').value = data.footerSize || '';
            document.getElementById('footerColor').value = data.footerColor || '#ffffff';
            document.getElementById('footerBackgroundUrl').value = replaceByPlaceholders(data.footerBackgroundUrl);
            insertValues();
        })
        .catch(error => console.error('Error fetching mail data:', error));
}

document.addEventListener('DOMContentLoaded', function () {
    const selectedMail = document.getElementById('selectedMail').value;
    populateFields(selectedMail);
});

document.getElementById('selectedMail').addEventListener('change', function () {
    const selectedMail = this.value;
    populateFields(selectedMail);
});

document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('mails-section');
    
    // Attach the 'change' event to all form elements
    Array.from(form.elements).forEach(element => {
        element.addEventListener('input', insertValues);
    });
});

function insertValues() {
    const name = document.getElementById('selectedMail').value;
    const headerBackgroundUrl = document.getElementById('headerBackgroundUrl').value;
    const logoUrl = document.getElementById('logoUrl').value;
    const logoSize = document.getElementById('logoSize').value;
    const titleText = replacePlaceholders(document.getElementById('titleText').value);
    const titleSize = document.getElementById('titleSize').value;
    const titleColor = document.getElementById('titleColor').value;
    const buttonUrl = document.getElementById('buttonUrl').value;
    const buttonText = replacePlaceholders(document.getElementById('buttonText').value);
    const buttonTextColor = document.getElementById('buttonTextColor').value;
    const buttonBackgroundColor = document.getElementById('buttonBackgroundColor').value;
    const descriptionText = replacePlaceholders(document.getElementById('descriptionText').value);
    const descriptionSize = document.getElementById('descriptionSize').value;
    const descriptionColor = document.getElementById('descriptionColor').value;
    const subtitleText = replacePlaceholders(document.getElementById('subtitleText').value);
    const subtitleSize = document.getElementById('subtitleSize').value;
    const subtitleColor = document.getElementById('subtitleColor').value;
    const iconUrl = document.getElementById('iconUrl').value;
    const iconSize = document.getElementById('iconSize').value;
    const importantInfoText = replacePlaceholders(document.getElementById('importantInfoText').value);
    const importantInfoSize = document.getElementById('importantInfoSize').value;
    const importantInfoColor = document.getElementById('importantInfoColor').value;
    const passwordResetButtonText = replacePlaceholders(document.getElementById('passwordResetButtonText').value);
    const passwordResetButtonColor = document.getElementById('passwordResetButtonColor').value;
    const passwordResetButtonBackgroundColor = document.getElementById('passwordResetButtonBackgroundColor').value;
    const messageText = replacePlaceholders(document.getElementById('messageText').value);
    const messageSize = document.getElementById('messageSize').value;
    const messageColor = document.getElementById('messageColor').value;
    const footerText = replacePlaceholders(document.getElementById('footerText').value);
    const footerSize = document.getElementById('footerSize').value;
    const footerColor = document.getElementById('footerColor').value;
    const footerBackgroundUrl = document.getElementById('footerBackgroundUrl').value;

    const outputDiv = document.getElementById('showMail');

    let outputHtml = `  <!DOCTYPE html>
                        <html lang="fr">
                        <head>
                            <meta charset="UTF-8">
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        </head>
                        <body style="word-spacing:normal;">
                        <div>`;

    if (headerBackgroundUrl) {
        outputHtml += `<div style="background:#F1F1F1 url('${headerBackgroundUrl}') center top / auto no-repeat;background-position:center top;background-repeat:no-repeat;background-size:auto;margin:0px auto;max-width:600px;">`;
    } else {
        outputHtml += `<div style="margin:0px auto;max-width:600px;">`;
    }

    outputHtml += `<div style="line-height:0;font-size:0;">`;

    if (headerBackgroundUrl) {
        outputHtml += `<table align="center" background="${headerBackgroundUrl}" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#F1F1F1 url('${headerBackgroundUrl}') center top / auto no-repeat;background-position:center top;background-repeat:no-repeat;background-size:auto;width:100%;">`;
    } else {
        outputHtml += `<table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">`;
    }

    outputHtml += `<tbody>
                        <tr>
                            <td style="direction:ltr;font-size:0px;padding:0 0 0 0;padding-bottom:0px;padding-top:0px;text-align:center;">
                                <div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                                        <tbody>`;
    
    if (logoUrl) {
        outputHtml += ` <tr>
                            <td align="center" style="font-size:0px;padding:5px 25px 5px 25px;padding-top:20px;padding-bottom:10px;word-break:break-word;">
                                <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;border-spacing:0px;">
                                    <tbody>
                                        <tr>
                                            <td style="width:${logoSize}px;">
                                                <img alt="${logoUrl}" src="${logoUrl}" style="border:none;border-radius:px;display:block;outline:none;text-decoration:none;height:auto;width:100%;font-size:13px;" width="75" height="auto">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>`;
    }

    if (titleText) {
        outputHtml += ` <tr>
                            <td align="left" style="font-size:0px;padding:0px 25px 0px 25px;padding-top:0px;padding-bottom:0px;word-break:break-word;">
                                <div style="font-family:Verdana, Helvetica, Arial, sans-serif;font-size:13px;line-height:1;text-align:left;color:#000000;">
                                    <p class="text-build-content" style="line-height: 24px; text-align: center; margin: 10px 0; margin-top: 5px;">
                                        <span style="color:${titleColor};font-family:Arial;font-size: ${titleSize}pt;">
                                            <b>${titleText}</b>
                                        </span>
                                    </p>
                                </div>
                            </td>
                        </tr>`;
    }

    if (buttonUrl) {
        outputHtml += ` <tr>
                            <td align="center" vertical-align="middle" style="font-size:0px;padding:5px 25px 5px 25px;padding-bottom:5px;word-break:break-word;">
                                <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:separate;line-height:100%;">
                                    <tbody>
                                        <tr>
                                            <td align="center" bgcolor="#ffffff" role="presentation" style="border:none;border-radius:20px;cursor:auto;mso-padding-alt:10px 25px;background:#ffffff;" valign="middle">
                                                <a href="${buttonUrl}" style="display:inline-block;background:${buttonBackgroundColor};color:#ffffff;font-family:Verdana, Helvetica, Arial, sans-serif;font-size:13px;font-weight:normal;line-height:120%;margin:0;text-decoration:none;text-transform:none;padding:10px 25px;mso-padding-alt:0px;border-radius:20px;" target="_blank">
                                                    <span style="color:${buttonTextColor};font-family:Arial;font-size:14px;">
                                                        <b>${buttonText}</b>
                                                    </span>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>`;
    }

    if (descriptionText) {
        outputHtml += ` <tr>
                            <td align="left" style="font-size:0px;padding:10px 25px;padding-top:0px;padding-bottom:10px;word-break:break-word;">
                                <div style="font-family:Arial, sans-serif;letter-spacing:normal;line-height:1;text-align:left;color:#000000;">
                                    <p class="text-build-content" style="text-align: center; margin: 10px 0; margin-top: 10px;">
                                        <span style="color:${descriptionColor}; font-size:${descriptionSize}pt;">${descriptionText}</span>
                                    </p>
                                </div>
                            </td>
                        </tr>`;
    }

    outputHtml += `</tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>`;

    if (subtitleText) {
        outputHtml += `<div style="background:#F1F1F1;background-color:#F1F1F1;margin:0px auto;max-width:600px;">
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
                                                            <span style="color:${subtitleColor};font-family:Arial;font-size:${subtitleSize}pt;">
                                                                <b>${subtitleText}</b>
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
            </div>`;
    }

    if (iconUrl) {
        outputHtml += `<div style="background:#ffffff;background-color:#ffffff;margin:0px auto;max-width:600px;">
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
                                                                <td style="width:${iconSize}px;">
                                                                    <img alt="${iconUrl}" src="${iconUrl}" style="border:none;border-radius:px;display:block;outline:none;text-decoration:none;height:auto;width:100%;font-size:13px;" height="auto">
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
            </div>`;
    }

    outputHtml += `<div style="background:#ffffff;background-color:#ffffff;margin:0px auto;max-width:600px;">
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
                                                    <p class="text-build-content" style="text-align: center; margin: 10px 0; margin-top: 10px;">`;


    if (importantInfoText) {
        outputHtml += ` <span
                            style="font-family:Arial;font-size:${importantInfoSize}pt;line-height:22px;">
                            <b style="color:${importantInfoColor};">${importantInfoText}</b>
                        </span>`;
    }

    if (name === 'Réinitialisation mot de passe fournisseur') {
        outputHtml += `<br><br><br><a style="background-color: ${passwordResetButtonBackgroundColor}; color: ${passwordResetButtonColor}; padding: 10px 20px; text-decoration: none;">${passwordResetButtonText}</a>`;
    }

    outputHtml += `</p>`;

    if (messageText) {
        outputHtml += ` <p class="text-build-content" style="text-align: center; margin: 0px 0; margin-bottom: 0px; padding-top: 10px;">
                            <span style="color:${messageColor};font-family:Arial;font-size:${messageSize}pt;line-height:22px;">${messageText}</span>
                        </p>`;
    }

    outputHtml += `</div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>`;

    if (footerBackgroundUrl) {
        outputHtml += `<table align="center" background="${footerBackgroundUrl}" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#F1F1F1 url('${footerBackgroundUrl}') center top / auto no-repeat;background-position:center top;background-repeat:no-repeat;background-size:auto;width:100%;">`;
    }
    else {
        outputHtml += `<table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">`;
    }

    outputHtml += `<tbody>
                        <tr>
                            <td style="direction:ltr;font-size:0px;padding:0 0 0 0;padding-bottom:0px;padding-top:0px;text-align:center;">
                                <div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                                        <tbody>
                                            <tr>
                                                <td align="left" style="font-size:0px;padding:20px 25px 20px 25px;padding-top:20px;padding-bottom:20px;word-break:break-word;">
                                                    <div style="font-family:Arial, sans-serif;font-size:13px;letter-spacing:normal;line-height:1;text-align:left;color:#000000;">
                                                        <p class="text-build-content" style="text-align: center; margin: 10px 0; margin-top: 10px;">
                                                            <span style="color:${footerColor}; line-height:1.5; font-size:${footerSize}pt;">${footerText}</span>
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
    </div>
</body>
</html>`;

    outputDiv.innerHTML = outputHtml;
}