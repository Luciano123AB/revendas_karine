<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Confirmação de Email</title>
</head>
<body style="
    margin: 0;
    padding: 0;
    background-color: #dc3545;
    font-family: Times, Helvetica, sans-serif;
">
    <table width="100%" cellpadding="0" cellspacing="0" style="height: 100vh; box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15);">
        <tr>
            <td align="center" valign="middle">
                <table width="100%" cellpadding="0" cellspacing="0"
                    style="
                        max-width: 600px;
                        background: #fd7e14;
                        border-radius: 8px;
                        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.25);
                    ">

                    <tr>
                        <td style="
                            padding: 20px;
                            text-align: center;
                            border-bottom: 1px solid;
                            border-color: #b66f19 rgba(0, 0, 0, 0.175);
                        ">
                            <h3 style="margin: 0;">CONFIRMAÇÃO EMAIL</h3>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 30px; text-align: center;">
                            <h2 style="margin-top: 0;">Olá Sr(a) {{ $user->name }} 👋</h2>

                            <p style="font-size: 16px;">
                                Obrigado por se cadastrar!
                                <br>
                                Clique no botão abaixo para confirmar seu email:
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="
                            padding: 25px;
                            text-align: center;
                            border-top: 1px solid;
                            border-color: #b66f19 rgba(0, 0, 0, 0.175);
                        ">
                            <a href="{{ $url }}"
                               style="
                                   background: #dc3545;
                                   color: #ffffff;
                                   text-decoration: none;
                                   padding: 12px 30px;
                                   border-radius: 6px;
                                   font-weight: bold;
                                   display: inline-block;
                                   border: 1px solid #000;
                               ">
                                Confirmar
                            </a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>