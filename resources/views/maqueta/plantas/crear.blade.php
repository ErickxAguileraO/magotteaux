@extends('layout.sistema')

@section('title', 'Home')

@section('content')
    @push('extra-css')
    @endpush
    
    <div class="contenido">
        <nav class="sub-menu-nav">
            <a><p>Usted está en</p></a>
            <img src="{{ asset('web/imagenes/i-flecha-derecha.svg') }}" alt="">
            <a href="/plantas"><p class="menu-seleccionado">Mantenedor de plantas</p></a>
            <img src="{{ asset('web/imagenes/i-flecha-derecha.svg') }}" alt="">
            <a href="/nueva-planta"><p class="menu-seleccionado">Nueva planta</p></a>
        </nav>
        <div class="div-contenido">
            <h3>Nueva planta</h3>
            <div class="grid-mantenedor-n mantenedor-row-3">
                <div class="label-input-n">
                    <label for="">Nombre de planta</label>
                    <input type="text">
                </div>
                <div class="label-input-n">
                    <label for="">País</label>
                    <select name="" id="">
                        <option value="">País</option>
                    </select>
                </div>
                <div class="label-input-n">
                    <label for="">Estado</label>
                    <select name="" id="">
                        <option value="">Activo</option>
                    </select>
                </div>
            </div>
            <div class="div-contenido-inicio-2 mostrar-nueva-carga" style="margin-top: 10px;">
                <h2></h2>
                <div class="botones-contenido-inicio">
                    <button class="btn-contenido-inicio2">
                        <p>Cancelar</p>
                        <img src="{{ asset('web/imagenes/i-x.svg') }}" alt="">
                    </button>
                    <button class="btn-contenido-inicio">
                        <p class="mostrar-escritorio">Guardar nueva planta</p>
                        <p class="mostrar-movil">Guardar</p>
                        <img src="{{ asset('web/imagenes/i-guardar.svg') }}" alt="">
                    </button>
                    
                </div>
            </div> 
        </div>

    </div>

    @push('extra-js')
   
    @endpush

@endsection
