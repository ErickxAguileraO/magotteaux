<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Magotteaux</title>
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('web/css/style.css') }}">
</head>
<body class="body-login">
    <div id="container">
        <div id="login">
            <div id="ingresar-login">

                <img src="{{ asset('/web/imagenes/Logo.svg') }}" alt="">
                <div class="sub-txt-login">
                    <p>¡Hola! Te damos la bienvenida a</p>
                    <h2>Plataforma de control de carga</h2>
                    <span>Un sistema pensado por MGTX</span>
                </div>
                <form action="" class="login-formulario">
                    <label for="">Email</label>
                    <div class="input">
                        <input type="email" required>
                    </div>

                    <label for="">Contraseña</label>
                    <div class="input">
                        <input class="password" id="password" type="password" required>
                        <p id="mostrar-pass" onclick="mostrarContrasena()">Mostrar</p>
                    </div>

                    <button>
                        <p>Iniciar sesión</p>
                        <img src="{{ asset('/web/imagenes/btn-login.svg') }}" alt="">
                    </button>
                </form>
                <a href="/recuperar-contraseña"><span>Olvidé mi contraseña</span></a>
            </div>

            <div class="flex-fondo-login">
                <div id="fondo-login"></div>
            </div>
        </div>
    </div>
    <script>
        function mostrarContrasena(){
            var tipo = document.getElementById("password");
            if(tipo.type == "password"){
                tipo.type = "text";
                document.getElementById("mostrar-pass").innerHTML = 'Ocultar'
            }else{
                tipo.type = "password";
                document.getElementById("mostrar-pass").innerHTML = 'Mostrar'
            }
        }
    </script>
</body>
</html>