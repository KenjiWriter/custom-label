<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nowa wiadomość z formularza kontaktowego</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: linear-gradient(135deg, #f97316, #ea580c);
            color: white;
            padding: 20px;
            border-radius: 8px 8px 0 0;
            text-align: center;
        }
        .content {
            background: #f9f9f9;
            padding: 20px;
            border: 1px solid #ddd;
        }
        .footer {
            background: #333;
            color: white;
            padding: 15px;
            border-radius: 0 0 8px 8px;
            text-align: center;
            font-size: 12px;
        }
        .field {
            margin-bottom: 15px;
        }
        .field strong {
            color: #f97316;
            display: inline-block;
            width: 120px;
        }
        .message-box {
            background: white;
            padding: 15px;
            border-left: 4px solid #f97316;
            margin: 15px 0;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>🏷️ Custom Labels</h1>
        <p>Nowa wiadomość z formularza kontaktowego</p>
    </div>

    <div class="content">
        <h2>Szczegóły wiadomości:</h2>
        
        <div class="field">
            <strong>Imię i nazwisko:</strong> {{ $firstName }} {{ $lastName }}
        </div>
        
        <div class="field">
            <strong>Email:</strong> <a href="mailto:{{ $email }}">{{ $email }}</a>
        </div>
        
        @if($phone)
        <div class="field">
            <strong>Telefon:</strong> <a href="tel:{{ $phone }}">{{ $phone }}</a>
        </div>
        @endif
        
        <div class="field">
            <strong>Temat:</strong> {{ $subject }}
        </div>
        
        <div class="field">
            <strong>Data wysłania:</strong> {{ $submitted_at }}
        </div>

        <div class="message-box">
            <strong>Wiadomość:</strong>
            <p>{!! nl2br(e($messageContent)) !!}</p>
        </div>
    </div>

    <div class="footer">
        <p>Ta wiadomość została wysłana z formularza kontaktowego na stronie Custom Labels</p>
        <p>Odpowiedz bezpośrednio na ten email, aby skontaktować się z klientem</p>
    </div>
</body>
</html>
