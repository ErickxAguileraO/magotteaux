@extends('layout.sistema')

@section('title', 'Crear destino')

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
            <a href="{{ route('destino.create') }}">
                <p class="menu-seleccionado">Nuevo destino</p>
            </a>
        </nav>

        <form method="POST" action="{{ route('destino.store') }}" onsubmit="myFunction()" class="formulario-crear-destino">
            @csrf
            @method('post')
            <div class="div-contenido">
                <h3>Nuevo destino</h3>
                <div class="grid-mantenedor-n mantenedor-row-3">
                    <div class="label-input-n">
                        <label for="">Nombre del destino</label>
                        <input type="text" name="nombre_destino" value="{{ old('nombre_destino') }}">
                        @error('nombre_destino')
                            <span class="invalid-feedback badge alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="label-input-n">
                        <label for="">Cliente</label>
                        <select name="cliente_destino" id="">
                            <option value="">Selecciones un cliente</option>
                            @foreach ($clientes as $clientes)
                                @continue($clientes->cli_estado == 0)
                                @php
                                    $selected = old('cliente_destino') == $clientes->cli_id ? 'selected' : '';
                                @endphp
                                <option value="{{ $clientes->cli_id }}" {{ $selected }}>{{ $clientes->cli_nombre }}</option>
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
                            <option value="1" {{ old('estado_destino') == '1' ? 'selected' : '' }}>Activo</option>
                            <option value="0" {{ old('estado_destino') == '0' ? 'selected' : '' }}>Inactivo</option>
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
                        <button type="submit" id="btn" class="btn-contenido-inicio">
                            <p class="mostrar-escritorio">Guardar nuevo destino</p>
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
