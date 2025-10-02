<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Witamy w newsletterze - Custom Labels</title>
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
        .benefits {
            background-color: #f8f9fa;
            border-left: 4px solid #ff6b35;
            padding: 20px;
            margin: 25px 0;
            border-radius: 0 8px 8px 0;
        }
        .benefits h3 {
            color: #ff6b35;
            margin: 0 0 15px 0;
            font-size: 18px;
        }
        .benefits ul {
            margin: 0;
            padding-left: 20px;
        }
        .benefits li {
            margin-bottom: 8px;
            color: #333333;
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
        .highlight {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 8px;
            padding: 15px;
            margin: 20px 0;
            color: #856404;
            text-align: center;
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
        .unsubscribe {
            font-size: 12px;
            color: #999999;
            margin-top: 15px;
        }
        .unsubscribe a {
            color: #ff6b35;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>Custom Labels</h1>
        </div>
        
        <div class="content">
            <div class="greeting">Witaj w naszej społeczności! 🎉</div>
            
            <div class="message">
                Dziękujemy za zapisanie się do newslettera <span class="brand">Custom Labels</span>! 
                Cieszymy się, że dołączyłeś do grona naszych użytkowników, którzy chcą być na bieżąco 
                z najnowszymi trendami w świecie etykiet.
            </div>
            
            <div class="benefits">
                <h3>📬 Co będziesz otrzymywać:</h3>
                <ul>
                    <li>🆕 <strong>Nowości</strong> - informacje o nowych funkcjach kreatora etykiet</li>
                    <li>💰 <strong>Promocje</strong> - ekskluzywne oferty i kody rabatowe</li>
                    <li>💡 <strong>Porady</strong> - wskazówki dotyczące projektowania etykiet</li>
                    <li>🎨 <strong>Inspiracje</strong> - najnowsze trendy i pomysły na etykiety</li>
                    <li>📊 <strong>Case studies</strong> - przykłady udanych projektów</li>
                </ul>
            </div>
            
            <div class="message">
                Gotowy na rozpoczęcie przygody z projektowaniem etykiet? Nasz kreator jest prosty w użyciu 
                i oferuje setki możliwości personalizacji!
            </div>
            
            <div class="button-container">
                <a href="{{ url('/') }}" class="button">🚀 Rozpocznij projektowanie</a>
            </div>
            
            <div class="highlight">
                <strong>💎 Bonus dla nowych subskrybentów:</strong><br>
                Pierwsza etykieta z 20% rabatem! Kod: <strong>WELCOME20</strong>
            </div>
            
            <div class="message">
                Masz pytania? Nasz zespół wsparcia jest zawsze gotowy do pomocy. 
                Skontaktuj się z nami przez email lub odwiedź naszą stronę pomocy.
            </div>
            
            <div class="message">
                Dziękujemy za zaufanie i witamy w <span class="brand">Custom Labels</span>! 🏷️
            </div>
        </div>
        
        <div class="footer">
            <p><strong>Custom Labels</strong></p>
            <p>Twój zaufany partner w tworzeniu etykiet</p>
            <p>📧 CustomLabelHelp@gmail.com | 🌐 customlabels.com</p>
            <p style="font-size: 12px; color: #999999;">
                Ta wiadomość została wysłana automatycznie. Prosimy nie odpowiadać na ten email.
            </p>
            <div class="unsubscribe">
                Nie chcesz otrzymywać naszych wiadomości? 
                <a href="{{ url('/newsletter/unsubscribe/' . $unsubscribeToken) }}">Wypisz się tutaj</a>
            </div>
        </div>
    </div>
</body>
</html>
