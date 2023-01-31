@extends('layout.sistema')

@section('title', 'Home')

@section('content')
    @push('extra-css')
    @endpush
    
    <div class="contenido">
        <nav class="sub-menu-nav">
            <a><p>Usted está en</p></a>
            <img src="{{ asset('web/imagenes/i-flecha-derecha.svg') }}" alt="">
            <a href="/patentes"><p>Mantenedor de patentes</p></a>
            <img src="{{ asset('web/imagenes/i-flecha-derecha.svg') }}" alt="">
            <a href="/nueva-patente"><p class="menu-seleccionado">Nueva patente</p></a>
        </nav>
        <div class="div-contenido">
            <h3>Nueva patente</h3>
            <div class="grid-mantenedor-n mantenedor-row-3">
                <div class="label-input-n">
                    <label for="">Número de Patente</label>
                    <input type="text">
                </div>

                <div class="label-input-n">
                    <label for="">Empresa de transportes</label>
                    <select name="" id="">
                        <option value="">Empresa</option>
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
                        <p class="mostrar-escritorio">Guardar nueva patente</p>
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
