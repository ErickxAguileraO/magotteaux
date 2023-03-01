<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <!-- Metas -->
   <meta name="author" content="Magotteaux">
   <meta name="title" content="">
   <meta name="keywords" content="">
   <meta name="description" content="">
   <!-- Title -->
   <title>Magotteaux | Detalle de carga</title>
   <!-- Estilos -->
   <link rel="stylesheet" type="text/css" href="{{ asset('web/css/font-awesome.min.css') }}">
   <link rel="stylesheet" type="text/css" href="{{ asset('web/css/style.css') }}">
   <style>
      header {
         display: flex;
         align-items: center;
         justify-content: center;
         background: #002060;
         widows: 100%;
         height: 77px;
      }
   </style>
</head>

<body>
   <header>
      <img src="{{ asset('web/imagenes/logo-blanco.svg') }}" alt="">
   </header>
   <div class="contenido">
      <div class="div-contenido">
         <section class="head-nueva-carga grid-row-cargas">
            <div>
               <h3>Resumen de carga</h3>
            </div>
         </section>
         <div class="grid-carga-n">
            <div>
               <h3>Datos del camión</h3>
               <div class="datos-row">
                  <div>
                     <p>Empresa de transporte</p>
                     <p class="bold">{{ $carga->empresaTransporte->emt_nombre }}</p>
                  </div>

                  <div>
                     <p>Nombre del chofer</p>
                     <p class="bold">{{ $carga->chofer->cho_nombre }}</p>
                  </div>

                  <div>
                     <p>Patente</p>
                     <p class="bold">{{ $carga->patente->pat_patente }}</p>
                  </div>

                  <div>
                     <p>Tipo de carga</p>
                     <p class="bold">{{ $carga->tipoCarga->tic_nombre }}</p>
                  </div>

                  <div>
                     <p>Tamaño de bola</p>
                     <p class="bold">{{ $carga->tamanoBola->tab_tamano }}</p>
                  </div>
               </div>
            </div>
         </div>
         <br>
         <div class="grid-carga-n">
            <div>
               <h3>Ruta</h3>
               <div class="datos-row">
                  <div>
                     <p>Fecha y hora de despacho</p>
                     <p class="bold">{{ $carga->car_fecha_salida->format('d-m-Y / H:i') }}</p>
                  </div>

                  <div>
                     <p>Guía de despacho</p>
                     <p class="bold">{{ $carga->car_numero_guia_despacho }}</p>
                  </div>

                  <div>
                     <p>Planta de origen</p>
                     <p class="bold">{{ $carga->planta->pla_nombre }}</p>
                  </div>

                  <div>
                     <p>Punto de carga</p>
                     <p class="bold">{{ $carga->puntoCarga->puc_nombre }}</p>
                  </div>

                  <div>
                     <p>Cliente</p>
                     <p class="bold">{{ $carga->cliente->cli_nombre }}</p>
                  </div>

                  <div>
                     <p>Destino</p>
                     <p class="bold">{{ $carga->destino->des_nombre }}</p>
                  </div>
               </div>
            </div>
         </div>

         <br>
         <div class="grid-carga-n">
            <div>
               <h3>Documentación</h3>
               <div class="datos-row">
                  <div>
                     <p>Certificado de calidad</p>
                     @if ($carga->car_certificado_calidad)
                        <a href="{{ route('download.file', ['url' => base64_encode($carga->car_certificado_calidad)]) }}" class="link-verde">DESCARGAR ARCHIVO</a>
                     @else
                        <span>SIN DOCUMENTO</span>
                     @endif
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="div-contenido">
         <h3>Imágenes</h3>
         <div class="grid-img-cargas">
            <div>
               <p>Fotografía de la patente</p>
               <img src="{{ route('download.file', ['url' => base64_encode($carga->car_imagen_patente)]) }}" alt="">
            </div>

            <div>
               <p>Fotografía de la carga (horizontal)</p>
               <img src="{{ route('download.file', ['url' => base64_encode($carga->car_imagen_carga)]) }}" alt="">
            </div>
         </div>
      </div>
   </div>

   <!-- Scripts -->
   <script src="{{ asset('web/js/jquery-3.6.0.min.js') }}"></script>
   <script src="{{ asset('web/js/jquery-ui.js') }}"></script>
   <script src="{{ asset('web/js/script.js') }}"></script>
</body>

</html>
