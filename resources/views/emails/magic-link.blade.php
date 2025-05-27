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
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo img {
            max-width: 150px;
        }
        .button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #1f2937;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
        }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="{{ asset('images/spider_logo_transparent.png') }}" alt="WebNews Logo">
        </div>
        
        <h2>Olá!</h2>
        
        <p>Você solicitou acesso ao WebNews através do Login Mágico. Clique no botão abaixo para acessar sua conta:</p>
        
        <div style="text-align: center;">
            <a href="{{ $magicUrl }}" class="button">Acessar WebNews</a>
        </div>
        
        <p>Se você não solicitou este acesso, por favor ignore este email.</p>
        
        <p>Este link é válido por 24 horas e pode ser usado apenas uma vez.</p>
        
        <div class="footer">
            <p>Este é um email automático, por favor não responda.</p>
            <p>© 2025 WebNews. Todos os direitos reservados.</p>
        </div>
    </div>
</body>
</html> 