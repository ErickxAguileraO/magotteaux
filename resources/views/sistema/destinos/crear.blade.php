@extends('layout.web')

@section('title', 'Home')

@section('content')
    @push('extra-css')
    @endpush

    <div class="contenido">
        <nav class="sub-menu-nav">
            <a><p>Usted está en</p></a>
            <img src="{{ asset('web/imagenes/i-flecha-derecha.svg') }}" alt="">
            <a href="/destinos"><p class="menu-seleccionado">Mantenedor de destinos</p></a>
            <img src="{{ asset('web/imagenes/i-flecha-derecha.svg') }}" alt="">
            <a href="/nuevo-destino"><p class="menu-seleccionado">Nuevo destino</p></a>
        </nav>

        <div class="div-contenido">
            <h3>Nuevo destino</h3>
            <div class="grid-mantenedor-n mantenedor-row-3">
                <div class="label-input-n">
                    <label for="">Nombre del destino</label>
                    <input type="text">
                </div>

                <div class="label-input-n">
                    <label for="">Correo de notificación del destino</label>
                    <input type="email">
                </div>

                <div class="label-input-n">
                    <label for="">Cliente</label>
                    <select name="" id="">
                        <option value="">Cliente</option>
                    </select>
                </div>

                <div class="label-input-n">
                    <label for="">Estado</label>
                    <select name="" id="">
                        <option value="">Activo</option>
                    </select>
                </div>
            </div>
            <div class="div-contenido-inicio-2 mostrar-nueva-carga" style="margin-top: 10px;">
                <h2></h2>
                <div class="botones-contenido-inicio">
                    <button class="btn-contenido-inicio2">
                        <p>Cancelar</p>
                        <img src="{{ asset('web/imagenes/i-x.svg') }}" alt="">
                    </button>
                    <button class="btn-contenido-inicio">
                        <p class="mostrar-escritorio">Guardar nuevo destino</p>
                        <p class="mostrar-movil">Guardar</p>
                        <img src="{{ asset('web/imagenes/i-guardar.svg') }}" alt="">
                    </button>

                </div>
            </div>
        </div>

    </div>

    @push('extra-js')

    @endpush

@endsection
