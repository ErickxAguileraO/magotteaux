@extends('layout.sistema')

@section('title', 'Crear notificación')

@section('content')

    <div class="contenido">
        <nav class="sub-menu-nav">
            <a>
                <p>Usted está en</p>
            </a>
            <img src="{{ asset('web/imagenes/i-flecha-derecha.svg') }}" alt="">
            <a href="{{ route('notificacion.index') }}">
                <p>Mantenedor de notificaciones</p>
            </a>
            <img src="{{ asset('web/imagenes/i-flecha-derecha.svg') }}" alt="">
            <a href="#">
                <p class="menu-seleccionado">Nueva notificación</p>
            </a>
        </nav>

        <form method="POST" action="{{ route('notificacion.store') }}" onsubmit="myFunction()" class="formulario-crear-notificacion">
            @csrf
            @method('post')
            <div class="div-contenido">
                <h3>Nueva notificación</h3>
                <div class="grid-mantenedor-n mantenedor-row-2">
                    <div class="label-input-n">
                        <label for="">Empresa</label>
                        <select name="empresa" id="empresa">
                            <option value="">Seleccione una empresa</option>
                            @foreach ($clientes as $cliente)
                                @continue($cliente->cli_estado == 0)
                                @php
                                    $selected = old('empresa') == $cliente->cli_id ? 'selected' : '';
                                @endphp
                                <option value="{{ $cliente->cli_id }}" {{ $selected }}>{{ $cliente->cli_nombre }}</option>
                            @endforeach
                        </select>
                        @error('empresa')
                            <span class="invalid-feedback badge alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="label-input-n">
                        <label for="">Frecuencia de envío</label>
                        <select name="frecuencia" id="frecuencia" value="{{ old('frecuencia') }}">
                            <option value="">Seleccione una frecuencia</option>
                            <option value="Inmediato" {{ old('frecuencia') == 'Inmediato' ? 'selected' : '' }}>Inmediato</option>
                            <option value="Semanal" {{ old('frecuencia') == 'Semanal' ? 'selected' : '' }}>Semanal</option>
                            <option value="Quincenal" {{ old('frecuencia') == 'Quincenal' ? 'selected' : '' }}>Quincenal</option>
                            <option value="Mensual" {{ old('frecuencia') == 'Mensual' ? 'selected' : '' }}>Mensual</option>
                        </select>
                        @error('frecuencia')
                            <span class="invalid-feedback badge alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="div-contenido-inicio-2 mostrar-nueva-carga" style="margin-top: 10px;">
                    <h2></h2>
                    <div class="botones-contenido-inicio">
                        <button type="button" class="btn-contenido-inicio2" onclick="location.href = '{{ route('notificacion.index') }}'">
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
