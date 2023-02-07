@extends('layout.sistema')

@section('title', 'Home')

@section('content')

    <div class="contenido">
        <nav class="sub-menu-nav">
            <a>
                <p>Usted está en</p>
            </a>
            <img src="{{ asset('web/imagenes/i-flecha-derecha.svg') }}" alt="">
            <a href="{{ route('pais.index') }}">
                <p>Mantenedor de países</p>
            </a>
            <img src="{{ asset('web/imagenes/i-flecha-derecha.svg') }}" alt="">
            <a href="{{ route('pais.create') }}">
                <p class="menu-seleccionado">Nuevo país</p>
            </a>
        </nav>

        <form method="POST" action="{{ route('pais.store') }}" class="formulario-crear-pais">
            @csrf
            @method('post')
            <div class="div-contenido">
                <h3>Nuevo país</h3>
                <div class="grid-mantenedor-n mantenedor-row-2">
                    <div class="label-input-n">
                        <label for="">Nombre del país</label>
                        <input type="text" name="pais_nombre" value="{{ old('pais_nombre') }}">
                        @error('pais_nombre')
                        <span class="invalid-feedback badge alert-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                    <div class="label-input-n">
                        <label for="">Estado</label>
                        <select name="slc_estado_pais" id="id_estado_pais" value="{{ old('slc_estado_pais') }}">
                            <option value="1" {{ old('slc_estado_pais') == '1' ? 'selected' : '' }}>Activo</option>
                            <option value="0" {{ old('slc_estado_pais') == '0' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                        @error('slc_estado_pais')
                        <span class="invalid-feedback badge alert-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                </div>
                <div class="div-contenido-inicio-2 mostrar-nueva-carga" style="margin-top: 10px;">
                    <h2></h2>
                    <div class="botones-contenido-inicio">
                        <button type="button" class="btn-contenido-inicio2" onclick="location.href = '{{ route('pais.index') }}'">
                            <p>Cancelar</p>
                            <img src="{{ asset('web/imagenes/i-x.svg') }}" alt="">
                        </button>
                        <button type="submit" class="btn-contenido-inicio">
                            <p class="mostrar-escritorio">Guardar nuevo país</p>
                            <p class="mostrar-movil">Guardar</p>
                            <img src="{{ asset('web/imagenes/i-guardar.svg') }}" alt="">
                        </button>

                    </div>
                </div>
            </div>
        </form>
    </div>

    @push('extra-js')
    @endpush

@endsection
