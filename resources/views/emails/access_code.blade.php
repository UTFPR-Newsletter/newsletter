<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Código de Acesso</title>
</head>
<body style="margin:0;padding:0;background:#f5f5f5;font-family:Arial,sans-serif;">
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
                <h2 style="margin:0 0 10px;color:#333;">Bem vindo de volta!</h2>
                <p style="margin:0 0 20px;color:#555;line-height:1.5;">
                    Você solicitou acesso ao nosso sistema. A seguir está seu código temporário:
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
                        {{ $token }}
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

                <p style="margin:0 0 20px;color:#555;line-height:1.5;">
                    Insira este código no formulário de login para concluir sua autenticação e acessar o sistema.
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
            <div style="max-width:600px;margin:0 auto;">
                <p style="margin:0 0 5px;">Este é um e-mail automático, por favor não responda.</p>
                <p style="margin:0;">© 2025 WebNews. Todos os direitos reservados.</p>
            </div>
        </div>
    </div>
</body>
</html>
