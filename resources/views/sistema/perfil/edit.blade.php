@extends('layout.web')

@section('title', 'Home')

@section('content')
   <div class="contenido">
      <nav class="sub-menu-nav">
         <a>
            <p>Usted está en</p>
         </a>
         <img src="{{ asset('web/imagenes/i-flecha-derecha.svg') }}" alt="">
         <a href="/editar-perfil">
            <p class="menu-seleccionado">Editar mi perfil</p>
         </a>
      </nav>

      <form method="POST" action="{{route('cuenta.edit')}}" class="formulario-cambios-contraseña">
        @csrf
        <div class="div-contenido">
            <h3>Editar mi perfil</h3>
            <div class="grid-mantenedor-n mantenedor-row-3">
                <div class="label-input-n">
                <label for="">Contraseña actual</label>
                <input type="password" name="password_actual" id="id_password_actual">
                @error('password')
                    <span class="invalid-feedback badge alert-danger" role="alert">
                        <strong>El campo glosa es obligatorio.</strong>
                    </span>
                @enderror
                </div>

                <div class="label-input-n">
                <label for="">Contraseña nueva</label>
                <input type="password" name="password_nueva" id="id_password_nueva">
                </div>

                <div class="label-input-n">
                <label for="">Confirmar contraseña</label>
                <input type="password" name="password_nueva_confirmar" id="id_password_nueva_confirmar">
                </div>
            </div>
            <div class="div-contenido-inicio-2 mostrar-nueva-carga" style="margin-top: 10px;">
                <h2></h2>
                <div class="botones-contenido-inicio">
                    <button type="button" class="btn-contenido-inicio2" onclick="location.href = '{{ route('cliente.index') }}'">
                        <p>Cancelar</p>
                        <img src="{{ asset('web/imagenes/i-x.svg') }}" alt="">
                    </button>
                    <button type="submit" class="btn-contenido-inicio" id="btn_guardarClave" >
                        <p class="mostrar-escritorio">Guardar contraseña</p>
                        <p class="mostrar-movil">Guardar</p>
                        <img src="{{ asset('web/imagenes/i-guardar.svg') }}" alt="">
                    </button>

                </div>
            </div>
        </div>
      </form>
   </div>

@endsection
