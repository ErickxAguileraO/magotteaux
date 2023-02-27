@extends('layout.sistema')

@section('title', 'Home')

@section('content')

    <div class="contenido">
        <nav class="sub-menu-nav">
            <a>
                <p>Usted está en</p>
            </a>
            <img src="{{ asset('web/imagenes/i-flecha-derecha.svg') }}" alt="">
            <a href="{{ route('cliente.index') }}">
                <p>Mantenedor de clientes</p>
            </a>
            <img src="{{ asset('web/imagenes/i-flecha-derecha.svg') }}" alt="">
            <a href="{{ route('cliente.create') }}">
                <p class="menu-seleccionado">Nuevo cliente</p>
            </a>
        </nav>

        <form method="POST" action="{{ route('cliente.store') }}" onsubmit="myFunction()" class="formulario-crear-cliente">
            @csrf
            @method('post')
            <div class="div-contenido">
                <h3>Nuevo cliente</h3>
                <div class="grid-mantenedor-n mantenedor-row-3">
                    <div class="label-input-n">
                        <label for="">Razón social</label>
                        <input type="text" name="crear_nombre_cliente" placeholder="Campo obligatorio" maxlength="255" value="{{ old('crear_nombre_cliente') }}">
                        @error('crear_nombre_cliente')
                            <span class="invalid-feedback badge alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="label-input-n">
                        <label for="">Identificación (RUT, DNI, etc)</label>
                        <input type="text" name="identificador_cliente" placeholder="Campo opcional" maxlength="255" value="{{ old('identificador_cliente') }}">
                        @error('identificador_cliente')
                            <span class="invalid-feedback badge alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="label-input-n">
                        <label for="">País</label>
                        <select name="slc_crear_pais_cliente" id="id_pais_cliente">
                            <option value="">Seleccione un país</option>
                            @foreach ($paises as $paises)
                                @continue($paises->pai_estado == 0)
                                @php
                                    $selected = old('slc_crear_pais_cliente') == $paises->pai_id ? 'selected' : '';
                                @endphp
                                <option value="{{ $paises->pai_id }}" {{ $selected }}>{{ $paises->pai_nombre }}</option>
                            @endforeach
                        </select>
                        @error('slc_crear_pais_cliente')
                            <span class="invalid-feedback badge alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="label-input-n">
                        <label for="">Estado</label>
                        <select name="slc_estado_cliente" id="id_estado_cliente">
                            <option value="1" {{ old('slc_estado_cliente') == '1' ? 'selected' : '' }}>Activo</option>
                            <option value="0" {{ old('slc_estado_cliente') == '0' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                        @error('slc_estado_cliente')
                            <span class="invalid-feedback badge alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="div-contenido-inicio-2 mostrar-nueva-carga" style="margin-top: 10px;">
                    <h2></h2>
                    <div class="botones-contenido-inicio">
                        <button type="button" class="btn-contenido-inicio2" onclick="location.href = '{{ route('cliente.index') }}'">
                            <p>Cancelar</p>
                            <img src="{{ asset('web/imagenes/i-x.svg') }}" alt="">
                        </button>
                        <button type="submit" id="btn" class="btn-contenido-inicio">
                            <p class="mostrar-escritorio">Guardar nuevo cliente</p>
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
