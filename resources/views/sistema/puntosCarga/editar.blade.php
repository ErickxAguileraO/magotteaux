@extends('layout.sistema')

@section('title', 'Home')

@section('content')
    @push('extra-css')
    @endpush

    <div class="contenido">
        <nav class="sub-menu-nav">
            <a>
                <p>Usted está en</p>
            </a>
            <img src="{{ asset('web/imagenes/i-flecha-derecha.svg') }}" alt="">
            <a href="{{ route('punto.carga.index') }}">
                <p>Mantenedor de puntos de carga</p>
            </a>
            <img src="{{ asset('web/imagenes/i-flecha-derecha.svg') }}" alt="">
            <a href="{{ route('punto.carga.update', ['id' => $puntoCarga->puc_id]) }}">
                <p class="menu-seleccionado">Nuevo punto de carga</p>
            </a>
        </nav>

        <form method="POST" action="{{ route('punto.carga.update', ['id' => $puntoCarga->puc_id]) }} " class="formulario-editar-pais">
            @csrf
            <div class="div-contenido">
                <h3>Nuevo punto de carga</h3>
                <div class="grid-mantenedor-n mantenedor-row-3">
                    <div class="label-input-n">
                        <label for="">Nombre del punto de carga</label>
                        <input type="text" name="nombre_puntoCarga" maxlength="255" value="{{ old('nombre_puntoCarga', $puntoCarga->puc_nombre) }}">
                        @error('nombre_puntoCarga')
                            <span class="invalid-feedback badge alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="label-input-n">
                        <label for="">Planta</label>
                        <select name="slc_planta_puntoCarga" id="">
                            <option value="{{ $puntoCarga->planta->pla_id }}">{{ old('slc_planta_puntoCarga', $puntoCarga->planta->pla_nombre) }}</option>
                            @foreach ($planta as $planta)
                                <option value="{{ $planta['pla_id'] }}">{{ old('slc_planta_puntoCarga', $planta->pla_nombre) }}</option>
                            @endforeach
                        </select>
                        @error('slc_planta_puntoCarga')
                            <span class="invalid-feedback badge alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="label-input-n">
                        <label for="">Estado</label>
                        <select name="slc_estado_puntoCarga" id="">
                            <option value="0" {{ old('slc_estado_puntoCarga', $puntoCarga->puc_estado) == 0 ? 'selected' : '' }}>Inactivo</option>
                            <option value="1" {{ old('slc_estado_puntoCarga', $puntoCarga->puc_estado) == 1 ? 'selected' : '' }}>Activo</option>
                        </select>
                        @error('slc_estado_puntoCarga')
                            <span class="invalid-feedback badge alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="div-contenido-inicio-2 mostrar-nueva-carga" style="margin-top: 10px;">
                    <h2></h2>
                    <div class="botones-contenido-inicio">
                        <button type="button" class="btn-contenido-inicio2" onclick="location.href = '{{ route('punto.carga.index') }}'">
                            <p>Cancelar</p>
                            <img src="{{ asset('web/imagenes/i-x.svg') }}" alt="">
                        </button>
                        <button type="submit" class="btn-contenido-inicio">
                            <p class="mostrar-escritorio">Guardar nuevo punto</p>
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
