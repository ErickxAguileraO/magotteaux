<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('web/css/style.css') }}">
</head>
<body>
    <div id="container">
        <div id="login">
            <div id="ingresar-login">
                <div class="sub-txt-login">
                    <h2 class="h2-recuperar-login">Nueva contraseña</h2>
                    <p class="p-recuperar-login">Cree una nueva contraseña.</p>
                    <p class="p-recuperar-login">Esta debe ser diferente a contraseñas usadas anteriormente.</p>
                </div>
                <form action="" class="login-formulario">
                    <label for="">Nueva contraseña</label>
                    <div class="input">
                        <input type="password" required>
                        <p>Mostrar</p>
                    </div>

                    <label for="">Confirmar contraseña</label>
                    <div class="input">
                        <input type="password" required>
                        <p>Mostrar</p>
                    </div>

                    <button>
                        <p>Iniciar contraseña</p>
                        <img src="/public/img/btn-login.svg" alt="">
                    </button>
                </form>
                <a href="/resource/login/recuperar.html"><span>Olvidé mi contraseña</span></a>
            </div>

            <div class="flex-fondo-login">
                <div id="fondo-login"></div>
            </div>
        </div>
    </div>
</body>
</html>