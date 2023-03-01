<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recupera contraseña</title>
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('web/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('web/plugins/sweetalert2/css/sweetalert2.min.css') }}">

</head>
<body class="body-login">
    <div id="container">
        <div id="login">
            <div id="ingresar-login">
                <div class="sub-txt-login">
                    <h2 class="h2-recuperar-login">Ingrese su correo</h2>
                    <p class="p-recuperar-login">Enviamos su nueva contraseña para luego usted la cambie</p>
                </div>
                <form method="POST" action="{{ route('recupera.password.store') }}" class="login-formulario" id="form-recuperar">
                    @csrf
                    <label for="">Email</label>
                    <div class="input">
                        <input name="email_recuperar" type="email" required>
                    </div>
                    @error('email_recuperar')
                     <span class="invalid-feedback badge alert-danger" role="alert">
                        <strong>{{ $message }}</strong>
                     </span>
                  @enderror
                    <br>
                    <button type="submit">
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
    @include('imports.notifications')
    <script src="{{ asset('web/plugins/sweetalert2/js/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('web/js/web.js') }}"></script>
</body>
</html>
