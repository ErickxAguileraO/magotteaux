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
            <a href="{{ route('planta.index') }}">
                <p class="menu-seleccionado">Mantenedor de plantas</p>
            </a>
            <img src="{{ asset('web/imagenes/i-flecha-derecha.svg') }}" alt="">
            <a href="{{ route('planta.create') }}">
                <p class="menu-seleccionado">Nueva planta</p>
            </a>
        </nav>

        <form method="POST" action="{{ route('planta.store') }}" class="formulario-crear-pais">
            @csrf
            @method('post')
            <div class="div-contenido">
                <h3>Nueva planta</h3>
                <div class="grid-mantenedor-n mantenedor-row-3">
                    <div class="label-input-n">
                        <label for="">Nombre de planta</label>
                        <input type="text" name="nombre_planta" value="{{ old('nombre_planta') }}">
                        @error('nombre_planta')
                            <span class="invalid-feedback badge alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="label-input-n">
                        <label for="">País</label>
                        <select name="slc_planta_pais" id="">
                            <option value="">Selecciones un país</option>
                            @foreach ($paises as $paises)
                                @continue($paises->pai_estado == 0)
                                @php
                                    $selected = old('slc_planta_pais') == $paises->pai_id ? 'selected' : '';
                                @endphp
                                <option value="{{ $paises->pai_id }}" {{ $selected }}>{{ $paises->pai_nombre }}</option>
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
                        <select name="estado_planta" id="" value="{{ old('slc_estado_pais') }}">
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
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

    @push('extra-js')
    @endpush

@endsection
