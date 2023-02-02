<nav class="menu-lateral">
    <div class="menu-sidebar-movil">
        <div class="txt">
            <p>Menú</p>
        </div>
        <div class="img">
            <img src="{{ asset('web/imagenes/i-menu-movil.svg') }}" alt="">
        </div>
    </div>
    <div class="cerrar-menu-sidebar-movil">
        <div class="txt">
            <p>Cerrar</p>
        </div>
        <div class="img">
            <img src="{{ asset('web/imagenes/i-cerrar-menu.svg') }}" alt="">
        </div>
    </div>
    <a href="{{ route('cliente.index') }}" class="op-sidebar">
        <img src="{{ asset('web/imagenes/i-clientes-sb.svg') }}" alt="">
        <p>Clientes</p>
    </a>

    <a href="{{ route('destino.index') }}" class="op-sidebar">
        <img src="{{ asset('web/imagenes/i-destinos-sb.svg') }}" alt="">
        <p>Destinos</p>
    </a>

    <a href="{{ route('planta.index') }}" class="op-sidebar">
        <img src="{{ asset('web/imagenes/i-plantas-sb.svg') }}" alt="">
        <p>Plantas</p>
    </a>

    <a href="{{ route('punto.carga.index') }}" class="op-sidebar">
        <img src="{{ asset('web/imagenes/i-puntoscarga-sb.svg') }}" alt="">
        <p>Puntos de carga</p>
    </a>

    <a href="{{ route('empresa.transporte.index') }}" class="op-sidebar">
        <img src="{{ asset('web/imagenes/i-empresatransporte-sb.svg') }}" alt="">
        <p>Empresa de transporte</p>
    </a>

    <a href="{{ route('tipo.carga.index') }}" class="op-sidebar">
        <img src="{{ asset('web/imagenes/i-tiposcarga-sb.svg') }}" alt="">
        <p>Tipos de carga</p>
    </a>

    <a href="{{ route('tamano.bola.index') }}" class="op-sidebar">
        <img src="{{ asset('web/imagenes/i-tamañosbola-sb.svg') }}" alt="">
        <p>Tamaños de bola</p>
    </a>

    <a href="/" class="op-sidebar">
        <img src="{{ asset('web/imagenes/i-clientes-sb.svg') }}" alt="">
        <p>Cargas</p>
    </a>

    <a href="{{ route('usuario.index') }}" class="op-sidebar">
        <img src="{{ asset('web/imagenes/i-clientes-sb.svg') }}" alt="">
        <p>Usuarios</p>
    </a>

    <a href="/patentes" class="op-sidebar">
        <img src="{{ asset('web/imagenes/i-patentes-sb.svg') }}" alt="">
        <p>Patentes</p>
    </a>

    <a href="/choferes" class="op-sidebar">
        <img src="{{ asset('web/imagenes/i-choferes-sb.svg') }}" alt="">
        <p>Choferes</p>
    </a>

    <a href="{{ route('pais.index') }}" class="op-sidebar">
        <img src="{{ asset('web/imagenes/i-paises-sb.svg') }}" alt="">
        <p>Países</p>
    </a>
</nav>
