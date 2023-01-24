<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Metas -->
    <meta name="author" content="Magotteaux">
    <meta name="title" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <!-- Title -->
    <title>Magotteaux | @yield('title')</title>
    <!-- Jquery-->
    <script src="{{ asset('/web/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('/web/js/jquery-ui.js') }}"></script>

    <!-- Estilos -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/web/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/web/js/niceselect/nice-select.css') }}">
    
    @stack('extra-css')
</head>

<body>
    <!-- Header entorno publico definitivo -->
    <header>
        <div class="div-1-header">
            <img src="{{ asset('web/imagenes/Logo-white.svg') }}" alt="">
            <div >
                <p>Plataforma</p>
                <h4>Página actual</h4>
            </div>
        </div>
        <div class="user-menu">
            <img src="{{ asset('web/imagenes/user.svg ') }}" alt="">
            <p>dgijon@aeurus.cl</p>
            <img class="flecha-menu-user" src="{{ asset('web/imagenes/i-flecha-menu.svg') }}" alt="">
        </div>
        <div class="user-menu-drop">
            <a class="user-menu-n" href="">
                <img src="{{ asset('web/imagenes/i-menu-user.svg') }}" alt="">
                <p>Mi perfil</p>
            </a>
            <a class="user-menu-n" href="">
                <img src="{{ asset('web/imagenes/i-menu-admin.svg') }}" alt="">
                <p>Administración</p>
            </a>
            <a class="user-menu-n" href="">
                <img src="{{ asset('web/imagenes/cerrar-sesion.svg') }}" alt="">
                <p>Cerrar sesión</p>
            </a>
        </div>
    </header>
    @yield('content')


    <!-- Scripts -->
    <script src="{{ asset('/web/js/niceselect/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('/web/js/script.js') }}"></script>
    <script>
        $('select').niceSelect();
    </script>
    @stack('extra-js')

</body>
</html>
