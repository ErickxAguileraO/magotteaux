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
<body class="body-login">
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
                        <input type="password" id="password" required>
                        <p id="mostrar-pass" onclick="mostrarContrasena()">Mostrar</p>
                    </div>

                    <label for="">Confirmar contraseña</label>
                    <div class="input">
                        <input type="password" id="password2" required>
                        <p id="mostrar-pass2" onclick="mostrarContrasena2()">Mostrar</p>
                    </div>

                    <button>
                        <p>Cambiar contraseña</p>
                        <img src="/public/img/btn-login.svg" alt="">
                    </button>
                </form>
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
        function mostrarContrasena2(){
            var tipo = document.getElementById("password2");
            if(tipo.type == "password"){
                tipo.type = "text";
                document.getElementById("mostrar-pass2").innerHTML = 'Ocultar'
            }else{
                tipo.type = "password";
                document.getElementById("mostrar-pass2").innerHTML = 'Mostrar'
            }
        }
    </script>
</body>
</html>