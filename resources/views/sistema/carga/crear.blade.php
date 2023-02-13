@extends('layout.sistema')

@section('title', 'cargas')

@section('content')
   <div class="contenido">
      <nav class="sub-menu-nav">
         <a>
            <p>Usted está en</p>
         </a>
         <img src="{{ asset('web/imagenes/i-flecha-derecha.svg') }}" alt="">
         <a href="{{ route('carga.index') }}">
            <p>Mantenedor de carga</p>
         </a>
         <img src="{{ asset('web/imagenes/i-flecha-derecha.svg') }}" alt="">
         <a href="{{ route('carga.create') }}">
            <p class="menu-seleccionado">Ingresar nueva carga</p>
         </a>
      </nav>
      <form action="{{ route('carga.store') }}" method="post" class="div-contenido" enctype='multipart/form-data'>
         @csrf
         <section class="head-nueva-carga">
            <a href="/"><img src="{{ asset('web/imagenes/i-atras.svg') }}" alt=""></a>
            <h3>Ingresar nueva carga</h3>
         </section>
         <div class="grid-nueva-carga">
            <div class="grid-carga-n g-1">
               <h3 class="subtitulo">Datos del camión</h3>
               <div class="label-input-n">
                  <label for="empresa">Empresa de transporte</label>
                  <select name="empresa" id="empresa" class="load-relation">
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
                  <label for="chofer">Nombre del chofer</label>
                  <select name="chofer" id="chofer">
                     <option value="">Seleccione</option>
                     @foreach ($choferes as $chofer)
                        @php
                           $selected = old('chofer') == $chofer->cho_id ? 'selected' : '';
                        @endphp
                        <option value="{{ $chofer->cho_id }}" {{ $selected }}>{{ $chofer->cho_nombre }}</option>
                     @endforeach
                  </select>
                  @error('chofer')
                     <span class="invalid-feedback badge alert-danger" role="alert">
                        <strong>{{ $message }}</strong>
                     </span>
                  @enderror
               </div>

               <div class="label-input-n">
                  <label for="patente">Patente</label>
                  <select name="patente" id="patente">
                     <option value="">Seleccione</option>
                     @foreach ($patentes as $patente)
                        @php
                           $selected = old('patente') == $patente->pat_id ? 'selected' : '';
                        @endphp
                        <option value="{{ $patente->pat_id }}" {{ $selected }}>{{ $patente->pat_patente }}</option>
                     @endforeach
                  </select>
                  @error('patente')
                     <span class="invalid-feedback badge alert-danger" role="alert">
                        <strong>{{ $message }}</strong>
                     </span>
                  @enderror
               </div>

               <h3 class="subtitulo">Datos de la carga</h3>

               <div class="label-input-n">
                  <label for="tipo_carga">Tipo de carga</label>
                  <select name="tipo_carga" id="tipo_carga">
                     <option value="">Seleccione</option>
                     @foreach ($tipo_cargas as $tipo_carga)
                        @php
                           $selected = old('tipo_carga') == $tipo_carga->tic_id ? 'selected' : '';
                        @endphp
                        <option value="{{ $tipo_carga->tic_id }}" {{ $selected }}>{{ $tipo_carga->tic_nombre }}</option>
                     @endforeach
                  </select>
                  @error('tipo_carga')
                     <span class="invalid-feedback badge alert-danger" role="alert">
                        <strong>{{ $message }}</strong>
                     </span>
                  @enderror
               </div>

               <div class="label-input-n">
                  <label for="tamano_bola">Tamaño de la bola</label>
                  <select name="tamano_bola" id="tamano_bola">
                     <option value="">Seleccione</option>
                     @foreach ($tamano_bolas as $tamano_bola)
                        @php
                           $selected = old('tamano_bola') == $tamano_bola->tab_id ? 'selected' : '';
                        @endphp
                        <option value="{{ $tamano_bola->tab_id }}" {{ $selected }}>{{ $tamano_bola->tab_tamano }}</option>
                     @endforeach
                  </select>
                  @error('tamano_bola')
                     <span class="invalid-feedback badge alert-danger" role="alert">
                        <strong>{{ $message }}</strong>
                     </span>
                  @enderror
               </div>
            </div>
            <div class="grid-carga-n g-2">
               <h3 class="subtitulo">Ruta</h3>
               <div class="label-input-n">
                  <label for="fecha_carga">Fecha y hora de carga</label>
                  <input type="datetime-local" class="input-fecha" id="fecha_carga" name="fecha_carga" min="{{ now()->subDay(1)->format('Y-m-d 00:00') }}" max="{{ now()->format('Y-m-d 23:59') }}" value="{{ old('fecha_carga') }}">
                  @error('fecha_carga')
                     <span class="invalid-feedback badge alert-danger" role="alert">
                        <strong>{{ $message }}</strong>
                     </span>
                  @enderror
               </div>
               <div class="label-input-n">
                  <label for="fecha_salida">Fecha y hora de salida a destino</label>
                  <input type="datetime-local" class="input-fecha" id="fecha_salida" name="fecha_salida" value="{{ old('fecha_salida') }}">
                  @error('fecha_salida')
                     <span class="invalid-feedback badge alert-danger" role="alert">
                        <strong>{{ $message }}</strong>
                     </span>
                  @enderror
               </div>
               <div class="label-input-n">
                  <label for="planta">Planta de origen</label>
                  <select name="planta" id="planta" class="load-relation">
                     <option value="">Seleccione</option>
                     @foreach ($plantas as $planta)
                        @php
                           $selected = old('planta') == $planta->pla_id ? 'selected' : '';
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
                  <label for="punto_carga">Punto de carga</label>
                  <select name="punto_carga" id="punto_carga">
                     <option value="">Seleccione</option>
                     @foreach ($punto_cargas as $punto_carga)
                        @php
                           $selected = old('punto_carga') == $punto_carga->puc_id ? 'selected' : '';
                        @endphp
                        <option value="{{ $punto_carga->puc_id }}" {{ $selected }}>{{ $punto_carga->puc_nombre }}</option>
                     @endforeach
                  </select>
                  @error('punto_carga')
                     <span class="invalid-feedback badge alert-danger" role="alert">
                        <strong>{{ $message }}</strong>
                     </span>
                  @enderror
               </div>
               <div class="label-input-n">
                  <label for="cliente-carga">Cliente</label>
                  <select name="cliente" id="cliente-carga" class="load-relation">
                     <option value="">Seleccione</option>
                     @foreach ($clientes as $cliente)
                        @php
                           $selected = old('cliente') == $cliente->cli_id ? 'selected' : '';
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
               <div class="label-input-n">
                  <label for="destino">Destino</label>
                  <select name="destino" id="destino">
                     <option value="">Seleccione</option>
                     @foreach ($destinos as $destino)
                        @php
                           $selected = old('destino') == $destino->des_id ? 'selected' : '';
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
            </div>
            <div class="grid-carga-n g-3">
               <h3 class="subtitulo">Documentación</h3>
               <div class="label-input-n">
                  <label for="numero_guia_despacho">N° guia de despacho</label>
                  <input type="text" id="numero_guia_despacho" name="numero_guia_despacho" value="{{ old('numero_guia_despacho') }}">
                  @error('numero_guia_despacho')
                     <span class="invalid-feedback badge alert-danger" role="alert">
                        <strong>{{ $message }}</strong>
                     </span>
                  @enderror
               </div>
               <div class="label-input-n">
                  <label for="">Guía de despacho</label>
                  <input type="text">
                  <div class="input-file-simple">
                     <div>
                        <p>Subir guía de despacho</p>
                        <img src="{{ asset('web/imagenes/i-file.svg') }}" alt="">
                     </div>
                     <input type="file" name="guia_despacho" id="guia_despacho" class="file-simple" accept=".pdf">
                  </div>
                  @error('guia_despacho')
                     <span class="invalid-feedback badge alert-danger" role="alert">
                        <strong>{{ $message }}</strong>
                     </span>
                  @enderror
               </div>
               <div class="label-input-n">
                  <label for="">Certificado de calidad</label>
                  <input type="text">
                  <div class="input-file-simple">
                     <div>
                        <p>Subir certificado de calidad</p>
                        <img src="{{ asset('web/imagenes/i-file.svg') }}" alt="">
                     </div>
                     <input type="file" name="certificado_calidad" id="certificado_calidad" class="file-simple" accept=".pdf">
                  </div>
                  @error('certificado_calidad')
                     <span class="invalid-feedback badge alert-danger" role="alert">
                        <strong>{{ $message }}</strong>
                     </span>
                  @enderror
               </div>
            </div>
         </div>
         <div class="grid-carga-n-row-2 g-4">
            <div class="label-input-n">
               <h3 class="subtitulo">Imágenes</h3>
               <label for="">Fotografía de la patente</label>
               <div class="input-file-pro">
                  <img src="{{ asset('web/imagenes/i-file-img.svg') }}" alt="">
                  <input type="file" name="foto_patente" id="input-file-preview2" class="file-simple input-file-preview" accept=".jpg,.jpeg,.png">
                  <img src="" alt="" id="image-selected2" class="image-selected">
               </div>
               @error('foto_patente')
                  <span class="invalid-feedback badge alert-danger" role="alert">
                     <strong>{{ $message }}</strong>
                  </span>
               @enderror
            </div>

            <div class="label-input-n">
               <h3 class="subtitulo" style="visibility: hidden;">Imágenes</h3>
               <label for="">Fotografía de la carga (horizontal)</label>
               <div class="input-file-pro">
                  <img src="{{ asset('web/imagenes/i-file-img.svg') }}" alt="">
                  <input type="file" name="foto_carga" id="input-file-preview" class="file-simple input-file-preview" accept=".jpg,.jpeg,.png">
                  <img src="" alt="" id="image-selected" class="image-selected">
               </div>
               @error('foto_carga')
                  <span class="invalid-feedback badge alert-danger" role="alert">
                     <strong>{{ $message }}</strong>
                  </span>
               @enderror
            </div>
         </div>
         <div class="div-contenido-inicio-2 mostrar-nueva-carga" style="margin-top: 10px;">
            <h2></h2>
            <div class="botones-contenido-inicio">
               <button type="button" class="btn-contenido-inicio2" onclick="location.href='{{ route('carga.index') }}'">
                  <p>Cancelar</p>
                  <img src="{{ asset('web/imagenes/i-x.svg') }}" alt="">
               </button>
               <button type="submit" class="btn-contenido-inicio">
                  <p class="mostrar-escritorio">Guardar nueva carga</p>
                  <p class="mostrar-movil">Guardar</p>
                  <img src="{{ asset('web/imagenes/i-guardar.svg') }}" alt="">
               </button>
            </div>
         </div>
      </form>
   </div>
@endsection
