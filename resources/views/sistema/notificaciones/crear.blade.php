@extends('layout.sistema')

@section('title', 'Crear notificación')

@section('content')

    <div class="contenido">
        <nav class="sub-menu-nav">
            <a>
                <p>Usted está en</p>
            </a>
            <img src="{{ asset('web/imagenes/i-flecha-derecha.svg') }}" alt="">
            <a href="/notificaciones">
                <p>Mantenedor de notificaciones</p>
            </a>
            <img src="{{ asset('web/imagenes/i-flecha-derecha.svg') }}" alt="">
            <a href="/crear-notificacion">
                <p class="menu-seleccionado">Nueva notificación</p>
            </a>
        </nav>

        <form method="POST" action="{{ route('cliente.store') }}" onsubmit="myFunction()" class="formulario-crear-cliente">
            @csrf
            @method('post')
            <div class="div-contenido">
                <h3>Nueva notificación</h3>
                <div class="grid-mantenedor-n mantenedor-row-2">
                    <div class="label-input-n">
                        <label for="">Empresa</label>
                        <select name="slc_estado_cliente" id="id_estado_cliente">
                            <option value="">Empresa 1</option>
                        </select>
                    </div>

                    <div class="label-input-n">
                        <label for="">Frecuencia de envío</label>
                        <select name="slc_estado_cliente" id="id_estado_cliente">
                            <option value="">Mensual</option>
                            <option value="">Semanal</option>
                            <option value="">Diario</option>
                        </select>
                    </div>
                </div>
                <div class="div-contenido-inicio-2 mostrar-nueva-carga" style="margin-top: 10px;">
                    <h2></h2>
                    <div class="botones-contenido-inicio">
                        <button type="button" class="btn-contenido-inicio2">
                            <p>Cancelar</p>
                            <img src="{{ asset('web/imagenes/i-x.svg') }}" alt="">
                        </button>
                        <button type="submit" id="btn" class="btn-contenido-inicio">
                            <p class="mostrar-escritorio">Guardar nueva notificacion</p>
                            <p class="mostrar-movil">Guardar</p>
                            <img src="{{ asset('web/imagenes/i-guardar.svg') }}" alt="">
                        </button>

                    </div>
                </div>
            </div>
        </form>
    </div>


@endsection
@push('extra-js')

<script>
    function myFunction() {
        document.getElementById("btn").disabled = true;
    }
</script>
@endpush
