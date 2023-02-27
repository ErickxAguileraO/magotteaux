@extends('layout.sistema')

@section('title', 'Crear chofer')

@section('content')
   <div class="contenido">
      <nav class="sub-menu-nav">
         <a>
            <p>Usted está en</p>
         </a>
         <img src="{{ asset('web/imagenes/i-flecha-derecha.svg') }}" alt="">
         <a href="{{ route('chofer.index') }}">
            <p>Mantenedor de chofers</p>
         </a>
         <img src="{{ asset('web/imagenes/i-flecha-derecha.svg') }}" alt="">
         <a href="{{ route('chofer.create') }}">
            <p class="menu-seleccionado">Nuevo chofer</p>
         </a>
      </nav>
      <form method="POST" action="{{ route('chofer.store') }}" onsubmit="myFunction()" class="formulario-crear-cliente">
         @csrf
         <div class="div-contenido">
            <h3>Nuevo chofer</h3>
            <div class="grid-mantenedor-n mantenedor-row-3">
               <div class="label-input-n">
                  <label for="nombre">Nombres</label>
                  <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}">
                  @error('nombre')
                     <span class="invalid-feedback badge alert-danger" role="alert">
                        <strong>{{ $message }}</strong>
                     </span>
                  @enderror
               </div>
               <div class="label-input-n">
                  <label for="apellido">Apellidos</label>
                  <input type="text" id="apellido" name="apellido" value="{{ old('apellido') }}">
                  @error('apellido')
                     <span class="invalid-feedback badge alert-danger" role="alert">
                        <strong>{{ $message }}</strong>
                     </span>
                  @enderror
               </div>
               <div class="label-input-n">
                  <label for="empresa">Empresa de transporte</label>
                  <select name="empresa" id="empresa">
                     <option value="">Seleccione</option>
                     @foreach ($empresas as $empresa)
                        @php
                           $selected = old('empresa') == $empresa->emt_id ? 'selected' : '';
                        @endphp
                        <option value="{{ $empresa->emt_id }}" {{ $selected }}>{{ $empresa->emt_nombre }}</option>
                     @endforeach
                  </select>
                  @error('empresa')
                     <span class="invalid-feedback badge alert-danger" role="alert">
                        <strong>{{ $message }}</strong>
                     </span>
                  @enderror
               </div>
               <div class="label-input-n">
                  <label for="identificacion">Identificación (RUT, DNI, etc)</label>
                  <input type="text" id="identificacion" name="identificacion" value="{{ old('identificacion') }}">
                  @error('identificacion')
                     <span class="invalid-feedback badge alert-danger" role="alert">
                        <strong>{{ $message }}</strong>
                     </span>
                  @enderror
               </div>
               <div class="label-input-n">
                  <label for="estado">Estado</label>
                  <select name="estado" id="estado">
                     <option value="">Seleccione</option>
                     <option value="1" {{ old('estado') == '1' ? 'selected' : '' }}>Activo</option>
                     <option value="0" {{ old('estado') == '0' ? 'selected' : '' }}>Inactivo</option>
                  </select>
                  @error('estado')
                     <span class="invalid-feedback badge alert-danger" role="alert">
                        <strong>{{ $message }}</strong>
                     </span>
                  @enderror
               </div>
            </div>
            <div class="div-contenido-inicio-2 mostrar-nueva-carga" style="margin-top: 10px;">
               <h2></h2>
               <div class="botones-contenido-inicio">
                  <button type="button" class="btn-contenido-inicio2" onclick="location.href='{{ route('chofer.index') }}'">
                     <p>Cancelar</p>
                     <img src="{{ asset('web/imagenes/i-x.svg') }}" alt="">
                  </button>
                  <button class="btn-contenido-inicio" id="btn">
                     <p class="mostrar-escritorio">Guardar nuevo chofer</p>
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
