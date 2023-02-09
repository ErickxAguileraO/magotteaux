@extends('layout.sistema')

@section('title', 'Editar paises')

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
            <a href="">
                <p class="menu-seleccionado">Editar país</p>
            </a>
        </nav>

        <form method="POST" action="{{ route('pais.update', ['id' => $paises->pai_id]) }} " class="formulario-editar-pais">
            @csrf
            <div class="div-contenido">
                <h3>Editar país</h3>
                <div class="grid-mantenedor-n mantenedor-row-2">
                    <div class="label-input-n">
                        <label for="">Nombre del país</label>
                        <input type="text" name="pais_nombre" maxlength="255" value="{{ old('pais_nombre', $paises->pai_nombre) }}">
                        @error('pais_nombre')
                            <span class="invalid-feedback badge alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="label-input-n">
                        <label for="">Estado</label>
                        <select name="slc_estado_pais" id="id_estado_pais">
                            <option value="0" {{ old('slc_estado_pais', $paises->pai_estado) == 0 ? 'selected' : '' }}>Inactivo</option>
                            <option value="1" {{ old('slc_estado_pais', $paises->pai_estado) == 1 ? 'selected' : '' }}>Activo</option>
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
                            <p class="mostrar-escritorio">Editar nuevo país</p>
                            <p class="mostrar-movil">Guardar</p>
                            <img src="{{ asset('web/imagenes/i-guardar.svg') }}" alt="">
                        </button>

                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection
