@extends('layout.sistema')

@section('title', 'Editar notificación')

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
                <p class="menu-seleccionado">Editar notificación</p>
            </a>
        </nav>

        <form method="POST" action="{{ route('notificacion.update', ['id' => $frecuencias->fre_id]) }}" class="formulario-editar-notificacion">
            @csrf
            <div class="div-contenido">
                <h3>Editar notificación</h3>
                <div class="grid-mantenedor-n mantenedor-row-2">
                    <div class="label-input-n">
                        <label for="">Empresa</label>
                        <select name="empresa" id="empresa" >
                            <option value="{{ $frecuencias->cliente->cli_id }}">{{ old($frecuencias->cliente->cli_nombre, $frecuencias->cliente->cli_nombre) }}</option>
                            {{-- @foreach ($clientes as $cliente)
                                @continue($cliente->cli_id == $frecuencias->cliente->cli_id || $cliente->cli_estado == 0)
                                @php
                                    $selected = old('empresa') == $cliente->cli_id ? 'selected' : '';
                                @endphp
                                <option value="{{ $cliente->cli_id }}" {{ $selected }}>{{ $cliente->cli_nombre }}</option>
                            @endforeach --}}
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
                            <option value="Diaria" {{ old('frecuencia', $frecuencias->fre_frecuencia) == 'Diaria' ? 'selected' : '' }}>Diaria</option>
                            <option value="Semanal" {{ old('frecuencia', $frecuencias->fre_frecuencia) == 'Semanal' ? 'selected' : '' }}>Semanal</option>
                            <option value="Quincenal" {{ old('frecuencia', $frecuencias->fre_frecuencia) == 'Quincenal' ? 'selected' : '' }}>Quincenal</option>
                            <option value="Mensual" {{ old('frecuencia', $frecuencias->fre_frecuencia) == 'Mensual' ? 'selected' : '' }}>Mensual</option>
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
                            <p class="mostrar-escritorio">Editar notificacion</p>
                            <p class="mostrar-movil">Guardar</p>
                            <img src="{{ asset('web/imagenes/i-guardar.svg') }}" alt="">
                        </button>

                    </div>
                </div>
            </div>
        </form>
    </div>


@endsection
