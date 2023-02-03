@extends('layout.sistema')

@section('title', 'Home')

@section('content')

    <div class="contenido">
        <nav class="sub-menu-nav">
            <a>
                <p>Usted está en</p>
            </a>
            <img src="{{ asset('web/imagenes/i-flecha-derecha.svg') }}" alt="">
            <a href="{{ route('destino.index') }}">
                <p class="menu-seleccionado">Mantenedor de destinos</p>
            </a>
            <img src="{{ asset('web/imagenes/i-flecha-derecha.svg') }}" alt="">
            <a href="">
                <p class="menu-seleccionado">Editar destino</p>
            </a>
        </nav>

        <form method="POST" action="{{ route('destino.update', ['id' => $destino->des_id]) }}" class="formulario-editar-destino">
            @csrf
            @method('post')
            <div class="div-contenido">
                <h3>Editar destino</h3>
                <div class="grid-mantenedor-n mantenedor-row-3">
                    <div class="label-input-n">
                        <label for="">Nombre del destino</label>
                        <input type="text" name="nombre_destino" maxlength="255" value="{{ old('nombre_destino', $destino->des_nombre) }}">
                        @error('nombre_destino')
                            <span class="invalid-feedback badge alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="label-input-n">
                        <label for="">Cliente</label>
                        <select name="cliente_destino" id="">
                            <option value="{{$destino->cliente->cli_id }}">{{ old($destino->cliente->cli_nombre,$destino->cliente->cli_nombre) }}</option>
                            @foreach ($clientes as $clientes)
                                @continue($clientes->cli_id == $destino->cliente->cli_id || $clientes->cli_estado == 0)
                                <option value="{{ $clientes['cli_id'] }}">{{ $clientes['cli_nombre'] }}</option>
                            @endforeach
                        </select>
                        @error('cliente_destino')
                            <span class="invalid-feedback badge alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="label-input-n">
                        <label for="">Estado</label>
                        <select name="estado_destino" id="">
                            <option value="0" {{ old('estado_destino', $destino->des_estado) == 0 ? 'selected' : '' }}>Inactivo</option>
                            <option value="1" {{ old('estado_destino', $destino->des_estado) == 1 ? 'selected' : '' }}>Activo</option>
                        </select>
                        @error('estado_destino')
                            <span class="invalid-feedback badge alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="div-contenido-inicio-2 mostrar-nueva-carga" style="margin-top: 10px;">
                    <h2></h2>
                    <div class="botones-contenido-inicio">
                        <button type="button" class="btn-contenido-inicio2" onclick="location.href = '{{ route('destino.index') }}'">
                            <p>Cancelar</p>
                            <img src="{{ asset('web/imagenes/i-x.svg') }}" alt="">
                        </button>
                        <button type="submit" class="btn-contenido-inicio">
                            <p class="mostrar-escritorio">Editar destino</p>
                            <p class="mostrar-movil">Guardar</p>
                            <img src="{{ asset('web/imagenes/i-guardar.svg') }}" alt="">
                        </button>

                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection
