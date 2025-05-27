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
    <div style="
        width:100%;
        background:#fff;
        border-radius:8px;
        overflow:hidden;
        border:1px solid #e2e8f0;
    ">
        <!-- BANNER full-width -->
        <div style="width:100%;background:#e2e8f0;padding:20px 0;text-align:center;">
            <div style="
                width:125px;height:125px;
                border-radius:100%;
                background:#fff;
                display:inline-flex;
                align-items:center;
                justify-content:center;
            ">
                <img
                    src="{{ asset('images/logo_web.png') }}"
                    alt="Logo"
                    width="100" height="100"
                    style="display:block;"
                >
            </div>
        </div>

        <!-- CONTEÚDO centralizado em max-width -->
        <div style="max-width:600px;margin:0 auto;">
            <div style="padding:20px;">
                <h2 style="margin:0 0 10px;color:#333;">Olá {{ $user->usr_name }}!</h2>
                <p style="margin:0 0 20px;color:#555;line-height:1.5;">
                    Você solicitou acesso ao WebNews através do Login Mágico. Para acessar sua conta, clique no botão abaixo:
                </p>

                <!-- CARD DO TOKEN -->
                <div style="
                    background:#fff;
                    height:100px;
                    border-radius:8px;
                    border:1px solid rgba(0,0,0,0.1);
                    padding:20px;
                    position:relative;
                    margin:20px 0;
                    display:flex;
                    align-items:center;
                    justify-content:center;
                ">
                    <div style="
                        font-size:24px;
                        font-weight:bold;
                        color:#a7c1eb;
                        text-align:center;
                    ">
                        <a href="{{ $magicUrl }}" class="button">Acessar WebNews</a>
                        
                    </div>
                    <img
                        src="{{ asset('images/spider_going_down.png') }}"
                        alt="Segurança"
                        width="60" height="60"
                        style="
                            position:absolute;
                            top:0px;
                            right:10px;
                            display:block;
                        "
                    >
                </div>

                <p class="text-muted" style="margin-top: 15px; font-size: 14px;">
                    Este link é válido por 2 dias.
                </p>
                
                <p class="text-muted" style="margin-top: 15px; font-size: 14px;">
                    Se você não solicitou este acesso, por favor ignore este email.
                </p>
            </div>
        </div>

        <!-- FOOTER único, centralizado e com quebra -->
        <div style="
            background:#edf2f7;
            padding:20px;
            text-align:justify;
            align-items:center;
            justify-content:center;
            display:flex;
            font-size:12px;
            color:#999;
            width:100%;
        ">
            <div class="footer">
                <p>Este é um email automático, por favor não responda.</p>
                <p>© 2025 WebNews. Todos os direitos reservados.</p>
            </div>
        </div>
    </div>
</body>
</html>