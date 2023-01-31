@extends('layout.web')

@section('title', 'Home')

@section('content')

    <div class="contenido">
        <nav class="sub-menu-nav">
            <a>
                <p>Usted está en</p>
            </a>
            <img src="{{ asset('web/imagenes/i-flecha-derecha.svg') }}" alt="">
            <a href="{{ route('planta.index') }}">
                <p class="menu-seleccionado">Mantenedor de plantas</p>
            </a>
            <img src="{{ asset('web/imagenes/i-flecha-derecha.svg') }}" alt="">
            <a href="{{ route('planta.edit', ['id' => $planta->pla_id]) }}">
                <p class="menu-seleccionado">Nueva planta</p>
            </a>
        </nav>
        <form method="POST" action="{{ route('planta.update', ['id' => $planta->pla_id]) }} " class="formulario-editar_planta">
            @csrf
            <div class="div-contenido">
                <h3>Nueva planta</h3>
                <div class="grid-mantenedor-n mantenedor-row-3">
                    <div class="label-input-n">
                        <label for="">Nombre de planta</label>
                        <input type="text" name="nombre_planta" maxlength="255" value="{{ old('nombre_planta', $planta->pla_nombre) }}">
                        @error('nombre_planta')
                            <span class="invalid-feedback badge alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="label-input-n">
                        <label for="">País</label>
                        <select name="slc_planta_pais" id="">
                            <option value="{{ $planta->pais->pai_id }}">{{ old('slc_planta_pais', $planta->pais->pai_nombre) }}</option>
                            @foreach ($paises as $paises)
                                <option value="{{ $paises['pai_id'] }}">{{ old('slc_planta_pais', $paises->pai_nombre) }}</option>
                            @endforeach
                        </select>
                        @error('slc_planta_pais')
                        <span class="invalid-feedback badge alert-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                    <div class="label-input-n">
                        <label for="">Estado</label>
                        <select name="estado_planta" id="" value="{{ old('estado_planta') }}">
                            <option value="0" {{ old('estado_planta', $planta->pla_estado) == 0 ? 'selected' : '' }}>Inactivo</option>
                            <option value="1" {{ old('estado_planta', $planta->pla_estado) == 1 ? 'selected' : '' }}>Activo</option>
                        </select>
                        @error('estado_planta')
                        <span class="invalid-feedback badge alert-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                </div>
                <div class="div-contenido-inicio-2 mostrar-nueva-carga" style="margin-top: 10px;">
                    <h2></h2>
                    <div class="botones-contenido-inicio">
                        <button type="button" class="btn-contenido-inicio2" onclick="location.href = '{{ route('planta.index') }}'">
                            <p>Cancelar</p>
                            <img src="{{ asset('web/imagenes/i-x.svg') }}" alt="">
                        </button>
                        <button type="submit" class="btn-contenido-inicio">
                            <p class="mostrar-escritorio">Guardar nueva planta</p>
                            <p class="mostrar-movil">Guardar</p>
                            <img src="{{ asset('web/imagenes/i-guardar.svg') }}" alt="">
                        </button>

                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection
