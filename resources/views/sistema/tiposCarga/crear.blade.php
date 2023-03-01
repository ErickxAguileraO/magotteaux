@extends('layout.sistema')

@section('title', 'Crear tipo de carga')

@section('content')

    <div class="contenido">
        <nav class="sub-menu-nav">
            <a>
                <p>Usted está en</p>
            </a>
            <img src="{{ asset('web/imagenes/i-flecha-derecha.svg') }}" alt="">
            <a href="{{ route('tipo.carga.index') }}">
                <p>Mantenedor de tipos de carga</p>
            </a>
            <img src="{{ asset('web/imagenes/i-flecha-derecha.svg') }}" alt="">
            <a href="{{ route('tipo.carga.create') }}">
                <p class="menu-seleccionado">Nuevo tipo de carga</p>
            </a>
        </nav>

        <form method="POST" action="{{ route('tipo.carga.store') }}" onsubmit="myFunction()" class="formulario-crear-pais">
            @csrf
            @method('post')
            <div class="div-contenido">
                <h3>Nuevo tipo de carga</h3>
                <div class="grid-mantenedor-n mantenedor-row-2">
                    <div class="label-input-n">
                        <label for="">Nombre de la carga</label>
                        <input type="text" name="nombre_tipo_carga" value="{{ old('nombre_tipo_carga') }}">
                        @error('nombre_tipo_carga')
                            <span class="invalid-feedback badge alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="label-input-n">
                        <label for="">Estado</label>
                        <select name="slc_estado_tipo_carga" id="">
                            <option value="1" {{ old('slc_estado_tipo_carga') == '1' ? 'selected' : '' }}>Activo</option>
                            <option value="0" {{ old('slc_estado_tipo_carga') == '0' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                    </div>
                </div>
                <div class="div-contenido-inicio-2 mostrar-nueva-carga" style="margin-top: 10px;">
                    <h2></h2>
                    <div class="botones-contenido-inicio">
                        <button type="button" class="btn-contenido-inicio2" onclick="location.href = '{{ route('tipo.carga.index') }}'">
                            <p>Cancelar</p>
                            <img src="{{ asset('web/imagenes/i-x.svg') }}" alt="">
                        </button>
                        <button type="submit" id="btn" class="btn-contenido-inicio">
                            <p class="mostrar-escritorio">Guardar tipo de carga</p>
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
