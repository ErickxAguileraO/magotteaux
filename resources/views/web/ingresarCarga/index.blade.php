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
            <a href="/nueva-carga"><p class="menu-seleccionado">Ingresar nueva carga</p></a>
        </nav>
        <div class="div-contenido">
           <section class="head-nueva-carga">
                <a href=""><img src="{{ asset('web/imagenes/i-atras.svg') }}" alt=""></a>
                <h3>Ingresar nueva carga</h3>
           </section>
           <form action="" class="grid-nueva-carga">
                <div class="grid-carga-n">
                    <h3 class="subtitulo">Datos del camión</h3>
                    <div class="label-input-n">
                        <label for="">Empresa de transporte</label>
                        <select name="" id="">
                            <option value="">Empresa 1</option>
                        </select>
                    </div>

                    <div class="label-input-n">
                        <label for="">Nombre del chofer</label>
                        <input type="text">
                    </div>

                    <div class="label-input-n">
                        <label for="">Patente</label>
                        <input type="text">
                    </div>

                    <div class="label-input-n">
                        <label for="">Tipo de carga</label>
                        <select name="" id="">
                            <option value="">Aeurus</option>
                        </select>
                    </div>

                    <div class="label-input-n">
                        <label for="">Tamaño de la bola</label>
                        <select name="" id="">
                            <option value="">Aeurus</option>
                        </select>
                    </div>
                </div>
                <div class="grid-carga-n"></div>
                <div class="grid-carga-n"></div>

           </form>
        </div>
        
    </div>

    @push('extra-js')
   
    @endpush

@endsection
