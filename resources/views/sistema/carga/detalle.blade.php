@extends('layout.sistema')

@section('title', 'Detalle de la carga')

@section('content')
    @push('extra-css')
    @endpush

    <div class="contenido">
        <nav class="sub-menu-nav">
            <a>
                <p>Usted está en</p>
            </a>
            <img src="{{ asset('web/imagenes/i-flecha-derecha.svg') }}" alt="">
            <a href="/">
                <p>Control de carga</p>
            </a>
            <img src="{{ asset('web/imagenes/i-flecha-derecha.svg') }}" alt="">
            @if (auth()->user()->hasRole('Logistica'))
                <a href="{{ route('carga.edit', $carga->car_id) }}">
                    <p class="menu-seleccionado">Detalle carga</p>
                </a>
            @endif
        </nav>

        <form method="" action="{{ route('carga.show',$carga->car_id, $carga->car_token) }}" class="">
            @csrf
        <div class="div-contenido">
            <section class="head-nueva-carga grid-row-cargas">
                <div>
                    <a href="/"><img src="{{ asset('web/imagenes/i-atras.svg') }}" alt=""></a>
                    <h3>Resumen de carga</h3>
                </div>
                <a href="{{ route('carga.edit', ['id' => $carga->car_id]) }}" class="btn-contenido-inicio">
                    <p>Editar</p>
                    <img src="{{ asset('web/imagenes/i-editar.svg') }}" alt="">
                </a>
            </section>
            <div class="grid-carga-n">
                <div>
                    <h3>Datos del camión</h3>
                    <div class="datos-row">
                        <div>
                            <p>Empresa de transporte</p>
                            <p class="bold">{{$carga->empresaTransporte->emt_nombre}}</p>
                        </div>

                        <div>
                            <p>Nombre del chofer</p>
                            <p class="bold">{{$carga->usuario->usu_nombre}}</p>
                        </div>

                        <div>
                            <p>Patente</p>
                            <p class="bold">{{$carga->patente->pat_patente}}</p>
                        </div>

                        <div>
                            <p>Tipo de carga</p>
                            <p class="bold">{{$carga->tipoCarga->tic_nombre}}</p>
                        </div>

                        <div>
                            <p>Tamaño de bola</p>
                            <p class="bold">{{$carga->tamanoBola->tab_tamano}}</p>
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
                            <p class="bold">{{$carga->car_fecha_salida->format('d-m-Y / H:i')}}</p>
                        </div>

                        <div>
                            <p>Guía de despacho</p>
                            <p class="bold">{{$carga->car_numero_guia_despacho}}</p>
                        </div>

                        <div>
                            <p>Planta de origen</p>
                            <p class="bold">{{$carga->planta->pla_nombre}}</p>
                        </div>

                        <div>
                            <p>Punto de carga</p>
                            <p class="bold">{{$carga->puntoCarga->puc_nombre}}</p>
                        </div>

                        <div>
                            <p>Cliente</p>
                            <p class="bold">{{$carga->cliente->cli_nombre}}</p>
                        </div>

                        <div>
                            <p>Destino</p>
                            <p class="bold">{{$carga->destino->des_nombre}}</p>
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
                            <p>Guía de despacho</p>
                            <a href="{{ route('download.file', ['url' => base64_encode($carga->car_guia_despacho)]) }}" class="link-verde">DESCARGAR ARCHIVO</a>
                        </div>

                        <div>
                            <p>Certificado de calidad</p>
                            <a href="{{ route('download.file', ['url' => base64_encode($carga->car_certificado_calidad)]) }}" class="link-verde">DESCARGAR ARCHIVO</a>
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

    @push('extra-js')
    @endpush

@endsection
