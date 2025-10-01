<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resetowanie hasła - Custom Labels</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: linear-gradient(135deg, #ff6b35, #f7931e);
            padding: 30px 20px;
            text-align: center;
        }
        .header h1 {
            color: #ffffff;
            margin: 0;
            font-size: 28px;
            font-weight: 700;
        }
        .content {
            padding: 40px 30px;
        }
        .greeting {
            font-size: 24px;
            color: #ff6b35;
            margin-bottom: 20px;
            font-weight: 600;
        }
        .message {
            font-size: 16px;
            line-height: 1.6;
            color: #333333;
            margin-bottom: 20px;
        }
        .button-container {
            text-align: center;
            margin: 30px 0;
        }
        .button {
            display: inline-block;
            background: linear-gradient(135deg, #ff6b35, #f7931e);
            color: #ffffff;
            text-decoration: none;
            padding: 15px 30px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
            box-shadow: 0 4px 15px rgba(255, 107, 53, 0.3);
            transition: all 0.3s ease;
        }
        .button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 107, 53, 0.4);
        }
        .warning {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 8px;
            padding: 15px;
            margin: 20px 0;
            color: #856404;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 30px;
            text-align: center;
            border-top: 1px solid #e9ecef;
        }
        .footer p {
            margin: 5px 0;
            color: #666666;
            font-size: 14px;
        }
        .brand {
            color: #ff6b35;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>Custom Labels</h1>
        </div>
        
        <div class="content">
            <div class="greeting">Cześć! 👋</div>
            
            <div class="message">
                Otrzymujesz ten email, ponieważ otrzymaliśmy prośbę o resetowanie hasła dla Twojego konta w <span class="brand">Custom Labels</span>.
            </div>
            
            <div class="message">
                Jeśli to Ty złożyłeś tę prośbę, kliknij przycisk poniżej, aby zresetować hasło:
            </div>
            
            <div class="button-container">
                <a href="{{ $url }}" class="button">🔄 Zresetuj hasło</a>
            </div>
            
            <div class="warning">
                <strong>⚠️ Ważne:</strong> Ten link do resetowania hasła wygaśnie za {{ config('auth.passwords.'.config('auth.defaults.passwords').'.expire') }} minut.
            </div>
            
            <div class="message">
                Jeśli nie prosiłeś o resetowanie hasła, zignoruj ten email. Twoje konto pozostanie bezpieczne.
            </div>
            
            <div class="message">
                Dziękujemy za korzystanie z <span class="brand">Custom Labels</span>! 🎉
            </div>
        </div>
        
        <div class="footer">
            <p><strong>Custom Labels</strong></p>
            <p>Twój zaufany partner w tworzeniu etykiet</p>
            <p>📧 CustomLabelHelp@gmail.com | 🌐 customlabels.com</p>
            <p style="font-size: 12px; color: #999999;">
                Ta wiadomość została wysłana automatycznie. Prosimy nie odpowiadać na ten email.
            </p>
        </div>
    </div>
</body>
</html>
