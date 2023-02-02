@extends('layout.sistema')

@section('title', 'Home')

@section('content')

    <div class="contenido">
        <nav class="sub-menu-nav">
            <a>
                <p>Usted está en</p>
            </a>
            <img src="{{ asset('web/imagenes/i-flecha-derecha.svg') }}" alt="">
            <a href="{{ route('cliente.index') }}">
                <p>Mantenedor de clientes</p>
            </a>
            <img src="{{ asset('web/imagenes/i-flecha-derecha.svg') }}" alt="">
            <a href="{{ route('cliente.store') }}">
                <p class="menu-seleccionado">Editar cliente</p>
            </a>
        </nav>

        <form method="POST" action="{{ route('cliente.update', ['id' => $cliente->cli_id]) }} " class="formulario-crear-cliente">
            @csrf
            <div class="div-contenido">
                <h3>Editar cliente</h3>
                <div class="grid-mantenedor-n mantenedor-row-3">
                    <div class="label-input-n">
                        <label for="">Razón social</label>
                        <input type="text" name="editar_nombre_cliente" placeholder="Campo obligatorio" maxlength="255" value="{{ old('editar_nombre_cliente', $cliente->cli_nombre) }}">
                        @error('editar_nombre_cliente')
                            <span class="invalid-feedback badge alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="label-input-n">
                        <label for="">Identificación (RUT, DNI, etc)</label>
                        <input type="text" name="identificador_cliente" placeholder="Campo opcional" maxlength="255" value="{{ old('identificador_cliente', $cliente->cli_identificacion) }}">
                        @error('identificador_cliente')
                            <span class="invalid-feedback badge alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="label-input-n">
                        <label for="">País</label>
                        <select name="slc_crear_pais_cliente" id="id_pais_cliente">
                            <option value="{{$cliente->pais->pai_id }}">{{ old('slc_crear_pais_cliente', $cliente->pais->pai_nombre) }}</option>
                            @foreach ($paises as $paises)
                                @continue($paises->pai_id == $cliente->pais->pai_id)
                                <option value="{{ $paises['pai_id'] }}">{{ $paises['pai_nombre'] }}</option>
                            @endforeach
                        </select>
                        @error('slc_crear_pais_cliente')
                            <span class="invalid-feedback badge alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="label-input-n">
                        <label for="">Estado</label>
                        <select name="slc_estado_cliente" id="id_estado_cliente">
                            <option value="0" {{ old('slc_estado_cliente', $cliente->cli_estado) == 0 ? 'selected' : '' }}>Inactivo</option>
                            <option value="1" {{ old('slc_estado_cliente', $cliente->cli_estado) == 1 ? 'selected' : '' }}>Activo</option>
                        </select>
                        @error('slc_estado_cliente')
                            <span class="invalid-feedback badge alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="div-contenido-inicio-2 mostrar-nueva-carga" style="margin-top: 10px;">
                    <h2></h2>
                    <div class="botones-contenido-inicio">
                        <button type="button" class="btn-contenido-inicio2" onclick="location.href = '{{ route('cliente.index') }}'">
                            <p>Cancelar</p>
                            <img src="{{ asset('web/imagenes/i-x.svg') }}" alt="">
                        </button>
                        <button type="submit" class="btn-contenido-inicio">
                            <p class="mostrar-escritorio">Editar cliente</p>
                            <p class="mostrar-movil">Guardar</p>
                            <img src="{{ asset('web/imagenes/i-guardar.svg') }}" alt="">
                        </button>

                    </div>
                </div>
            </div>
        </form>
    </div>



@endsection
