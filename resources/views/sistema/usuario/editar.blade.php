@extends('layout.sistema')

@section('title', 'Editar usuario')

@section('content')
   <div class="contenido">
      <nav class="sub-menu-nav">
         <a>
            <p>Usted está en</p>
         </a>
         <img src="{{ asset('web/imagenes/i-flecha-derecha.svg') }}" alt="">
         <a href="{{ route('usuario.index') }}">
            <p>Mantenedor de usuarios</p>
         </a>
         <img src="{{ asset('web/imagenes/i-flecha-derecha.svg') }}" alt="">
         <a href="{{ route('usuario.create') }}">
            <p class="menu-seleccionado">Editar usuario</p>
         </a>
      </nav>
      <form method="POST" action="{{ route('usuario.update', ['id' => $usuario->usu_id]) }}" class="formulario-crear-cliente">
         @csrf
         <div class="div-contenido">
            <h3>Editar usuario</h3>
            <div class="grid-mantenedor-n mantenedor-row-3">
               <div class="label-input-n">
                  <label for="nombre">Nombres</label>
                  <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $usuario->usu_nombre) }}">
                  @error('nombre')
                     <span class="invalid-feedback badge alert-danger" role="alert">
                        <strong>{{ $message }}</strong>
                     </span>
                  @enderror
               </div>
               <div class="label-input-n">
                  <label for="apellido">Apellidos</label>
                  <input type="text" id="apellido" name="apellido" value="{{ old('apellido', $usuario->usu_apellido) }}">
                  @error('apellido')
                     <span class="invalid-feedback badge alert-danger" role="alert">
                        <strong>{{ $message }}</strong>
                     </span>
                  @enderror
               </div>
               <div class="label-input-n">
                  <label for="celular">Celular</label>
                  <input type="text" id="celular" name="celular" value="{{ old('celular', $usuario->usu_celular) }}">
                  @error('celular')
                     <span class="invalid-feedback badge alert-danger" role="alert">
                        <strong>{{ $message }}</strong>
                     </span>
                  @enderror
               </div>
               <div class="label-input-n">
                  <label for="email">Email</label>
                  <input type="email" id="email" name="email" value="{{ old('email', $usuario->usu_email) }}">
                  @error('email')
                     <span class="invalid-feedback badge alert-danger" role="alert">
                        <strong>{{ $message }}</strong>
                     </span>
                  @enderror
               </div>
               <div class="label-input-n">
                  <label for="contrasena">Contraseña</label>
                  <input type="password" id="contrasena" name="contrasena" value="{{ old('contrasena') }}">
                  @error('contrasena')
                     <span class="invalid-feedback badge alert-danger" role="alert">
                        <strong>{{ $message }}</strong>
                     </span>
                  @enderror
               </div>
               <div class="label-input-n">
                  <label for="identificacion">Identificación (RUT, DNI, etc)</label>
                  <input type="text" id="identificacion" name="identificacion" value="{{ old('identificacion', $usuario->usu_identificacion) }}">
                  @error('identificacion')
                     <span class="invalid-feedback badge alert-danger" role="alert">
                        <strong>{{ $message }}</strong>
                     </span>
                  @enderror
               </div>
               <div class="label-input-n">
                  <label for="tipo_usuario">Tipo de usuario</label>
                  <select name="tipo_usuario" id="tipo_usuario">
                     <option value="">Seleccione</option>
                     <option value="1" {{ old('tipo_usuario', $usuario->getRoleId()) == '1' ? 'selected' : '' }}>Logística</option>
                     <option value="2" {{ old('tipo_usuario', $usuario->getRoleId()) == '2' ? 'selected' : '' }}>Cliente</option>
                     <option value="3" {{ old('tipo_usuario', $usuario->getRoleId()) == '3' ? 'selected' : '' }}>Administrador</option>
                  </select>
                  @error('tipo_usuario')
                     <span class="invalid-feedback badge alert-danger" role="alert">
                        <strong>{{ $message }}</strong>
                     </span>
                  @enderror
               </div>
               @php
                  $style = old('tipo_usuario', $usuario->getRoleId()) == 2 ? '' : 'display: none';
               @endphp
               <div class="label-input-n label-cliente" style="{{ $style }}">
                  <label for="cliente">Empresa</label>
                  <select name="cliente" id="cliente">
                     <option value="">Seleccione</option>
                     @foreach ($clientes as $cliente)
                        @php
                           $selected = old('cliente', $usuario->usu_cliente_id) == $cliente->cli_id ? 'selected' : '';
                        @endphp
                        <option value="{{ $cliente->cli_id }}" {{ $selected }}>{{ $cliente->cli_nombre }}</option>
                     @endforeach
                  </select>
                  @error('cliente')
                     <span class="invalid-feedback badge alert-danger" role="alert">
                        <strong>{{ $message }}</strong>
                     </span>
                  @enderror
               </div>
               @php
                  $style = old('tipo_usuario', $usuario->getRoleId()) == 2 ? '' : 'display: none';
               @endphp
               <div class="label-input-n label-cliente" style="{{ $style }}">
                  <label for="destino">Destinos</label>
                  <input type="hidden" class="value-destinos" value="{{ $clientes->pluck('destinos')->collapse() }}">
                  <select name="destino" id="destino">
                     <option value="">Seleccione</option>
                     @foreach ($destinos as $destino)
                        @php
                           $selected = old('destino', $usuario->usu_destino_id) == $destino->des_id ? 'selected' : '';
                        @endphp
                        <option value="{{ $destino->des_id }}" {{ $selected }}>{{ $destino->des_nombre }}</option>
                     @endforeach
                  </select>
                  @error('destino')
                     <span class="invalid-feedback badge alert-danger" role="alert">
                        <strong>{{ $message }}</strong>
                     </span>
                  @enderror
               </div>
               @php
                  $style = old('tipo_usuario', $usuario->getRoleId()) == 1 ? '' : 'display: none';
               @endphp
               <div class="label-input-n label-planta" style="{{ $style }}">
                  <label for="planta">Planta</label>
                  <select name="planta" id="planta">
                     <option value="">Seleccione</option>
                     @foreach ($plantas as $planta)
                        @php
                           $selected = old('planta', $usuario->usu_planta_id) == $planta->pla_id ? 'selected' : '';
                        @endphp
                        <option value="{{ $planta->pla_id }}" {{ $selected }}>{{ $planta->pla_nombre }}</option>
                     @endforeach
                  </select>
                  @error('planta')
                     <span class="invalid-feedback badge alert-danger" role="alert">
                        <strong>{{ $message }}</strong>
                     </span>
                  @enderror
               </div>
               <div class="label-input-n">
                  <label for="estado">Estado</label>
                  <select name="estado" id="estado">
                     <option value="1" {{ old('estado', $usuario->usu_estado) == '1' ? 'selected' : '' }}>Activo</option>
                     <option value="0" {{ old('estado', $usuario->usu_estado) == '0' ? 'selected' : '' }}>Inactivo</option>
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
                  <button type="button" class="btn-contenido-inicio2" onclick="location.href='{{ route('usuario.index') }}'">
                     <p>Cancelar</p>
                     <img src="{{ asset('web/imagenes/i-x.svg') }}" alt="">
                  </button>
                  <button class="btn-contenido-inicio">
                     <p class="mostrar-escritorio">Editar usuario</p>
                     <p class="mostrar-movil">Editar</p>
                     <img src="{{ asset('web/imagenes/i-guardar.svg') }}" alt="">
                  </button>
               </div>
            </div>
         </div>
      </form>
   </div>
@endsection
