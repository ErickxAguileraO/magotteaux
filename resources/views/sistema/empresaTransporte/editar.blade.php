@extends('layout.sistema')

@section('title', 'Home')

@section('content')

    <div class="contenido">
        <nav class="sub-menu-nav">
            <a>
                <p>Usted está en</p>
            </a>
            <img src="{{ asset('web/imagenes/i-flecha-derecha.svg') }}" alt="">
            <a href="{{ route('empresa.transporte.index') }}">
                <p>Mantenedor de empresas de transporte</p>
            </a>
            <img src="{{ asset('web/imagenes/i-flecha-derecha.svg') }}" alt="">
            <a href="{{ route('empresa.transporte.create') }}">
                <p class="menu-seleccionado">Nueva empresa de transporte</p>
            </a>
        </nav>

        <form method="POST" action="{{ route('empresa.transporte.update', ['id' => $empresaTransporte->emt_id]) }} " class="formulario-editar-pais">
            @csrf
            <div class="div-contenido">
                <h3>Nueva empresa de transporte</h3>
                <div class="grid-mantenedor-n mantenedor-row-3">
                    <div class="label-input-n">
                        <label for="">Nombre de la empresa</label>
                        <input type="text" name="nombre_empresa" maxlength="255" value="{{ old('nombre_empresa', $empresaTransporte->emt_nombre) }}">
                        @error('nombre_empresa')
                        <span class="invalid-feedback badge alert-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>

                    <div class="label-input-n">
                        <label for="">RUT de la empresa</label>
                        <input type="text" name="rut_empresa" maxlength="255" value="{{ old('rut_empresa', $empresaTransporte->emt_identificador) }}">
                        @error('rut_empresa')
                        <span class="invalid-feedback badge alert-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>

                    <div class="label-input-n">
                        <label for="">Estado</label>
                        <select name="slc_estado_empresa" id="" value="{{ old('slc_estado_empresa') }}">
                            <option value="0" {{ old('slc_estado_empresa', $empresaTransporte->emt_estado) == 0 ? 'selected' : '' }}>Inactivo</option>
                            <option value="1" {{ old('slc_estado_empresa', $empresaTransporte->emt_estado) == 1 ? 'selected' : '' }}>Activo</option>
                        </select>
                        @error('slc_estado_empresa')
                        <span class="invalid-feedback badge alert-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                </div>
                <div class="div-contenido-inicio-2 mostrar-nueva-carga" style="margin-top: 10px;">
                    <h2></h2>
                    <div class="botones-contenido-inicio">
                        <button type="button" class="btn-contenido-inicio2" onclick="location.href = '{{ route('empresa.transporte.index') }}'">
                            <p>Cancelar</p>
                            <img src="{{ asset('web/imagenes/i-x.svg') }}" alt="">
                        </button>
                        <button type="submit" class="btn-contenido-inicio">
                            <p class="mostrar-escritorio">Guardar empresa de transporte</p>
                            <p class="mostrar-movil">Guardar</p>
                            <img src="{{ asset('web/imagenes/i-guardar.svg') }}" alt="">
                        </button>

                    </div>
                </div>
            </div>
        </form>
    </div>


@endsection
