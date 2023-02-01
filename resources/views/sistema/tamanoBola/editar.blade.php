@extends('layout.sistema')

@section('title', 'Actualizar tamaño de bola')

@section('content')
   <div class="contenido">
      <nav class="sub-menu-nav">
         <a>
            <p>Usted está en</p>
         </a>
         <img src="{{ asset('web/imagenes/i-flecha-derecha.svg') }}" alt="">
         <a href="{{ route('tamano.bola.index') }}">
            <p>Mantenedor de tamaños de bola</p>
         </a>
         <img src="{{ asset('web/imagenes/i-flecha-derecha.svg') }}" alt="">
         <a href="{{ route('tamano.bola.edit', ['id' => $tamano->tab_id]) }}">
            <p class="menu-seleccionado">Actualizar tamaño de bola</p>
         </a>
      </nav>
      <form method="POST" action="{{ route('tamano.bola.update', ['id' => $tamano->tab_id]) }}" class="formulario-crear-cliente">
         @csrf
         <div class="div-contenido">
            <h3>Actualizar tamaño de bola</h3>
            <div class="grid-mantenedor-n mantenedor-row-2">
               <div class="label-input-n">
                  <label for="tamano">Tipo de tamaño</label>
                  <input type="text" id="tamano" name="tamano" value="{{ old('tamano', $tamano->tab_tamano) }}">
                  @error('tamano')
                     <span class="invalid-feedback badge alert-danger" role="alert">
                        <strong>{{ $message }}</strong>
                     </span>
                  @enderror
               </div>
               <div class="label-input-n">
                  <label for="estado">Estado</label>
                  <select name="estado" id="estado">
                     <option>Seleccione estado (Campo obligatorio)</option>
                     <option value="1" {{ old('estado', $tamano->tab_estado) == '1' ? 'selected' : '' }}>Activo</option>
                     <option value="0" {{ old('estado', $tamano->tab_estado) == '0' ? 'selected' : '' }}>Inactivo</option>
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
                  <button type="button" class="btn-contenido-inicio2" onclick="location.href='{{ route('tamano.bola.index') }}'">
                     <p>Cancelar</p>
                     <img src="{{ asset('web/imagenes/i-x.svg') }}" alt="">
                  </button>
                  <button class="btn-contenido-inicio">
                     <p class="mostrar-escritorio">Guardar nuevo tipo de bola</p>
                     <p class="mostrar-movil">Guardar</p>
                     <img src="{{ asset('web/imagenes/i-guardar.svg') }}" alt="">
                  </button>
               </div>
            </div>
         </div>
      </form>
   </div>
@endsection
