@extends('layout.sistema')

@section('title', 'Crear patente')

@section('content')

    <div class="contenido">
        <nav class="sub-menu-nav">
            <a>
                <p>Usted está en</p>
            </a>
            <img src="{{ asset('web/imagenes/i-flecha-derecha.svg') }}" alt="">
            <a href="{{ route('patente.index') }}">
                <p>Mantenedor de patentes</p>
            </a>
            <img src="{{ asset('web/imagenes/i-flecha-derecha.svg') }}" alt="">
            <a href="">
                <p class="menu-seleccionado">Nueva patente</p>
            </a>
        </nav>

        <form method="POST" action="{{ route('patente.store') }}" onsubmit="myFunction()" class="formulario-crear-patente">
            @csrf
            @method('post')
            <div class="div-contenido">
                <h3>Nueva patente</h3>
                <div class="grid-mantenedor-n mantenedor-row-3">
                    <div class="label-input-n">
                        <label for="">Número de Patente</label>
                        <input type="text" name="numero_patente" value="{{ old('numero_patente') }}">
                        @error('numero_patente')
                            <span class="invalid-feedback badge alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="label-input-n">
                        <label for="">Empresa de transportes</label>
                        <select name="empresa_transporte_patente" id="">
                            <option value="">Selecciones una empresa de transporte</option>
                            @foreach ($empresaTransporte as $empresaTransporte)
                                @continue($empresaTransporte->emt_estado == 0)
                                @php
                                    $selected = old('empresa_transporte_patente') == $empresaTransporte->emt_id ? 'selected' : '';
                                @endphp
                                <option value="{{ $empresaTransporte->emt_id }}" {{ $selected }}>{{ $empresaTransporte->emt_nombre }}</option>
                            @endforeach
                        </select>
                        @error('empresa_transporte_patente')
                            <span class="invalid-feedback badge alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="label-input-n">
                        <label for="">Estado</label>
                        <select name="estado_patente" id="">
                            <option value="1" {{ old('estado_patente') == '1' ? 'selected' : '' }}>Activo</option>
                            <option value="0" {{ old('estado_patente') == '0' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                        @error('estado_patente')
                            <span class="invalid-feedback badge alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="div-contenido-inicio-2 mostrar-nueva-carga" style="margin-top: 10px;">
                    <h2></h2>
                    <div class="botones-contenido-inicio">
                        <button type="button" class="btn-contenido-inicio2" onclick="location.href = '{{ route('patente.index') }}'">
                            <p>Cancelar</p>
                            <img src="{{ asset('web/imagenes/i-x.svg') }}" alt="">
                        </button>
                        <button type="submit" id="btn" class="btn-contenido-inicio">
                            <p class="mostrar-escritorio">Guardar nueva patente</p>
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
