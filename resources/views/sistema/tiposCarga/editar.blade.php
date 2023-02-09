@extends('layout.sistema')

@section('title', 'Editar tipo de carga')

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
            <a href="">
                <p class="menu-seleccionado">Editar tipo de carga</p>
            </a>
        </nav>

        <form method="POST" action="{{ route('tipo.carga.update', ['id' => $tipoCarga->tic_id]) }} " class="formulario-crear-pais">
            @csrf
            @method('post')
            <div class="div-contenido">
                <h3>Editar tipo de carga</h3>
                <div class="grid-mantenedor-n mantenedor-row-2">
                    <div class="label-input-n">
                        <label for="">Nombre de la carga</label>
                        <input type="text" name="nombre_tipo_carga" maxlength="255" value="{{ old('nombre_tipo_carga', $tipoCarga->tic_nombre) }}">
                        @error('nombre_tipo_carga')
                            <span class="invalid-feedback badge alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="label-input-n">
                        <label for="">Estado</label>
                        <select name="slc_estado_tipo_carga" id="">
                            <option value="0" {{ old('slc_estado_tipo_carga', $tipoCarga->tic_estado) == 0 ? 'selected' : '' }}>Inactivo</option>
                            <option value="1" {{ old('slc_estado_tipo_carga', $tipoCarga->tic_estado) == 1 ? 'selected' : '' }}>Activo</option>
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
                        <button type="submit" class="btn-contenido-inicio">
                            <p class="mostrar-escritorio">Editar tipo de carga</p>
                            <p class="mostrar-movil">Guardar</p>
                            <img src="{{ asset('web/imagenes/i-guardar.svg') }}" alt="">
                        </button>

                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection
