@extends('layout.web')

@section('title', 'Home')

@section('content')
    @push('extra-css')
    @endpush
    
    <div class="contenido">
        <nav class="sub-menu-nav">
            <a><p>Usted está en</p></a>
            <img src="{{ asset('web/imagenes/i-flecha-derecha.svg') }}" alt="">
            <a href="/"><p>Control de carga</p></a>
            <img src="{{ asset('web/imagenes/i-flecha-derecha.svg') }}" alt="">
            <a href="/detalle-carga"><p class="menu-seleccionado">Detalle carga</p></a>
        </nav>
        <div class="div-contenido">
            <section class="head-nueva-carga grid-row-cargas">
                <div>
                    <a href="/"><img src="{{ asset('web/imagenes/i-atras.svg') }}" alt=""></a>
                    <h3>Resumen de carga</h3>
                </div>
                <a href="" class="btn-contenido-inicio">
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
                            <p class="bold">Empresa 1</p>
                        </div>

                        <div>
                            <p>Nombre del chofer</p>
                            <p class="bold">Carlos Manríquez</p>
                        </div>

                        <div>
                            <p>Patente</p>
                            <p class="bold">DDFF34</p>
                        </div>

                        <div>
                            <p>Tipo de carga</p>
                            <p class="bold">Carga 1</p>
                        </div>

                        <div>
                            <p>Tamaño de bola</p>
                            <p class="bold">3</p>
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
                            <p class="bold">22-02-2023 / 14:33</p>
                        </div>

                        <div>
                            <p>Guía de despacho</p>
                            <p class="bold">N° 1234</p>
                        </div>

                        <div>
                            <p>Planta de origen</p>
                            <p class="bold">Antofagasta</p>
                        </div>

                        <div>
                            <p>Punto de carga</p>
                            <p class="bold">Planta 1</p>
                        </div>

                        <div>
                            <p>Cliente</p>
                            <p class="bold">BHP Minerals</p>
                        </div>

                        <div>
                            <p>Destino</p>
                            <p class="bold">Minera Escondida</p>
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
                    <img src="{{ asset('web/imagenes/img-1.svg') }}" alt="">
                </div>
                
                <div>
                    <p>Fotografía de la carga (horizontal)</p>
                    <img src="{{ asset('web/imagenes/img-2.svg') }}" alt="">
                </div>
            </div>
        </div>
    </div>

    @push('extra-js')
   
    @endpush

@endsection
