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
                    <h2 class="h2-recuperar-login">Revise su correo</h2>
                    <p class="p-recuperar-login">Enviamos las instrucciones para recuperar su cuenta</p>
                </div>
                <form action="" class="login-formulario">
                    <label for="">Email</label>
                    <div class="input">
                        <input type="email" required>
                    </div>
                    <button>
                        <p>Recuperar contraseña</p>
                        <img src="/public/img/btn-login.svg" alt="">
                    </button>
                </form>
            </div>

            <div class="flex-fondo-login">
                <div id="fondo-login"></div>
            </div>
        </div>
    </div>
</body>
</html>