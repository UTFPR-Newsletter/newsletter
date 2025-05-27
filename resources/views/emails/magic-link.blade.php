<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Link Mágico de Acesso - WebNews</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header img {
            max-width: 150px;
            margin-bottom: 20px;
        }
        .header h1 {
            color: #1f2937;
            margin: 0;
            font-size: 24px;
        }
        .content {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #1f2937;
            color: white !important;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
            font-weight: bold;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            font-size: 12px;
            color: #666;
        }
        .text-center {
            text-align: center;
        }
        .text-muted {
            color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ asset('images/spider_logo_transparent.png') }}" alt="WebNews Logo">
            <h1>WebNews</h1>
        </div>

        <p>Olá!</p>
        
        <p>Você solicitou acesso ao WebNews através do Login Mágico. Para acessar sua conta, clique no botão abaixo:</p>
        
        <div class="content text-center">
            <a href="{{ $magicUrl }}" class="button">Acessar WebNews</a>
            <p class="text-muted" style="margin-top: 15px; font-size: 14px;">
                Este link é válido por 2 dias e pode ser usado apenas uma vez.
            </p>
        </div>
        
        <p>Se você não solicitou este acesso, por favor ignore este email.</p>
        
        <div class="footer">
            <p>Este é um email automático, por favor não responda.</p>
            <p>© 2025 WebNews. Todos os direitos reservados.</p>
        </div>
    </div>
</body>
</html> 