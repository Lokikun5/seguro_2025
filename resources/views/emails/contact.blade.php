<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Nouveau message de contact</title>
</head>
<body style="font-family: Arial, sans-serif; background: #f9f9f9; padding: 20px;">
    <table style="width: 100%; max-width: 600px; margin: auto; background: #ffffff; padding: 20px; border-radius: 8px;">
        <tr>
            <td>
                <h2 style="color: #000;">Nouveau message du formulaire de contact</h2>

                <p><strong>Prénom :</strong> {{ $data['first_name'] }}</p>
                <p><strong>Nom :</strong> {{ $data['last_name'] }}</p>
                <p><strong>Téléphone :</strong> {{ $data['phone'] }}</p>
                <p><strong>Email :</strong> {{ $data['email'] }}</p>

                <hr style="margin: 20px 0;">

                <p><strong>Message :</strong></p>
                <p style="white-space: pre-line;">{{ $data['message'] }}</p>

                <br>
                <p style="font-size: 14px; color: #555;">Message envoyé depuis le site Villa Seguro</p>
            </td>
        </tr>
    </table>
</body>
</html>