@extends('layout.web')

@section('title', 'Home')

@section('content')
    @push('extra-css')
    @endpush
    
    <div class="contenido">
        <nav class="sub-menu-nav">
            <a><p>Usted está en</p></a>
            <img src="{{ asset('web/imagenes/i-flecha-derecha.svg') }}" alt="">
            <a href="/"><p class="menu-seleccionado">Control de carga</p></a>
        </nav>
        <div class="div-contenido">
            <div class="div-contenido-inicio">
                <h2>Últimos viajes</h2>
                <a href="/nueva-carga" class="btn-contenido-inicio">
                    <p>Ingresar nueva carga</p>
                    <img src="{{ asset('web/imagenes/i-mas-white.svg') }}" alt="">
                </a>
            </div>
            <div class="sub-contenido">
                <div class="div-contenido-inicio-2">
                    <h2>Filtros de búsqueda</h2>
                    <div class="botones-contenido-inicio">
                        <button class="btn-contenido-inicio">
                            <p>Buscar</p>
                            <img src="{{ asset('web/imagenes/i-buscar.svg') }}" alt="">
                        </button>
                        <button class="btn-contenido-inicio2">
                            <p>Limpiar filtro</p>
                            <img src="{{ asset('web/imagenes/i-eliminar-filtros.svg') }}" alt="">
                        </button>
                    </div>
                </div>  
                <form action="" class="fomulario-row-3">
                    <div class="label-input-n">
                        <label for="">Cliente destino</label>
                        <select name="" id="">
                            <option value="">Aeurus</option>
                        </select>
                    </div>

                    <div class="label-input-n">
                        <label for="">Planta</label>
                        <select name="" id="">
                            <option value="">Aeurus</option>
                        </select>
                    </div>

                    <div class="label-input-n">
                        <label for="">Tipo de bola</label>
                        <select name="" id="">
                            <option value="">Aeurus</option>
                        </select>
                    </div>

                    <div class="label-input-n">
                        <label for="">Fecha fin despacho</label>
                        <input type="date" class="input-fecha">
                    </div>

                    <div class="label-input-n">
                        <label for="">Fecha inicio despacho</label>
                        <input type="date" class="input-fecha">
                    </div>
                    <div class="label-input-n">
                        <label for="">Tipo de carga</label>
                        <select name="" id="">
                            <option value="">Aeurus</option>
                        </select>
                    </div>

                    <div class="label-input-n">
                        <label for="">Cliente destino</label>
                        <input type="date" class="input-fecha">
                    </div>
                </form>
                <div class="div-contenido-inicio-2-movil">
                    <div class="botones-contenido-inicio">
                        <button class="btn-contenido-inicio">
                            <p>Buscar</p>
                            <img src="{{ asset('web/imagenes/i-buscar.svg') }}" alt="">
                        </button>
                        <button class="btn-contenido-inicio2">
                            <p>Limpiar filtro</p>
                            <img src="{{ asset('web/imagenes/i-eliminar-filtros.svg') }}" alt="">
                        </button>
                    </div>
                </div> 
            </div>
        </div>
        <div class="div-contenido">
            <div class="div-contenido-escritorio">
                <div class="div-contenido-inicio">
                    <h2>Detalle</h2>
                    <a href="" class="btn-contenido-inicio">
                        <p>Descargar Excel</p>
                        <img src="{{ asset('web/imagenes/i-exel.svg') }}" alt="">
                    </a>
                </div>
                <div class="sub-contenido2">
                    <table>
                        <tr>
                            <th><input type="checkbox" id="selectAll"> Patente</th>
                            <th>Tipo de carga</th>
                            <th>Cliente destino</th>
                            <th>Planta</th>
                            <th>Tipo de bola</th>
                            <th>Tipo de carga</th>
                            <th>Empresa de transporte</th>
                            <th>Fecha de despacho</th>
                            <th>Usuario MGTX</th>
                            <th></th>
                        </tr>
                        <tr>
                            <td><input type="checkbox"> DDFF34</td>
                            <td>Madera</td>
                            <td>Minera Escondida</td>
                            <td>Aeurus</td>
                            <td>Bola 1</td>
                            <td>Carga 1</td>
                            <td>Empresa 1</td>
                            <td>22-02-2023</td>
                            <td>Darío Gijón</td>
                            <td><img src="{{ asset('web/imagenes/i-ojo.svg') }}" alt=""></td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"> DDFF34</td>
                            <td>Madera</td>
                            <td>Minera Escondida</td>
                            <td>Aeurus</td>
                            <td>Bola 1</td>
                            <td>Carga 1</td>
                            <td>Empresa 1</td>
                            <td>22-02-2023</td>
                            <td>Darío Gijón</td>
                            <td><img src="{{ asset('web/imagenes/i-ojo.svg') }}" alt=""></td>
                        </tr>
                    </table>
                    <div class="numeros-pag">
                        <a href="" class="numero-antes-despues"  style="margin-right: 35px">Anterior</a>
                        <a href="" class="numero numero-seleccionado">1</a>
                        <a href="" class="numero">2</a>
                        <a href="" class="numero-antes-despues" style="margin-left: 35px">Siguiente</a>
                    </div>
                </div>
            </div>
            <div class="div-contenido-movil">
                <h2 style="margin-bottom: 15px;">Detalles</h2>
                {{-- 1 --}}
                <div class="detalles-n">
                    <div>
                        <span>Patente</span>
                        <p>DDFF34</p>
                    </div>
                    <img src="{{ asset('web/imagenes/i-flecha-down.svg') }}" alt="">
                </div>
                <div class="ocultar-detalles">
                    <div class="ocultar-detalles-n">
                        <div>
                            <span>Tipo de carga</span>
                            <p>Madera</p>
                        </div>
                        <a href=""><img src="{{ asset('web/imagenes/i-ojo.svg') }}" alt=""></a>
                    </div>

                    <div class="ocultar-detalles-n">
                        <div>
                            <span>Cliente destino</span>
                            <p>Minera Escondida</p>
                        </div>
                        <a href=""><img src="{{ asset('web/imagenes/i-ojo.svg') }}" alt=""></a>
                    </div>

                    <div class="ocultar-detalles-n">
                        <div>
                            <span>Chofer</span>
                            <p>Carlos Sanfuentes</p>
                        </div>
                        <a href=""><img src="{{ asset('web/imagenes/i-ojo.svg') }}" alt=""></a>
                    </div>

                    <div class="ocultar-detalles-n">
                        <div>
                            <span>Fecha de despacho</span>
                            <p>22-02-2023</p>
                        </div>
                        <a href=""><img src="{{ asset('web/imagenes/i-ojo.svg') }}" alt=""></a>
                    </div>

                    <div class="ocultar-detalles-n">
                        <div>
                            <span>Usuario MGTX</span>
                            <p>Darío Gijón</p>
                        </div>
                        <a href=""><img src="{{ asset('web/imagenes/i-ojo.svg') }}" alt=""></a>
                    </div>
                </div>
                {{-- 2 --}}
                <div class="detalles-n">
                    <div>
                        <span>Patente</span>
                        <p>DDFF34</p>
                    </div>
                    <img src="{{ asset('web/imagenes/i-flecha-down.svg') }}" alt="">
                </div>
                <div class="ocultar-detalles">
                    <div class="ocultar-detalles-n">
                        <div>
                            <span>Tipo de carga</span>
                            <p>Madera</p>
                        </div>
                        <a href=""><img src="{{ asset('web/imagenes/i-ojo.svg') }}" alt=""></a>
                    </div>

                    <div class="ocultar-detalles-n">
                        <div>
                            <span>Cliente destino</span>
                            <p>Minera Escondida</p>
                        </div>
                        <a href=""><img src="{{ asset('web/imagenes/i-ojo.svg') }}" alt=""></a>
                    </div>

                    <div class="ocultar-detalles-n">
                        <div>
                            <span>Chofer</span>
                            <p>Carlos Sanfuentes</p>
                        </div>
                        <a href=""><img src="{{ asset('web/imagenes/i-ojo.svg') }}" alt=""></a>
                    </div>

                    <div class="ocultar-detalles-n">
                        <div>
                            <span>Fecha de despacho</span>
                            <p>22-02-2023</p>
                        </div>
                        <a href=""><img src="{{ asset('web/imagenes/i-ojo.svg') }}" alt=""></a>
                    </div>

                    <div class="ocultar-detalles-n">
                        <div>
                            <span>Usuario MGTX</span>
                            <p>Darío Gijón</p>
                        </div>
                        <a href=""><img src="{{ asset('web/imagenes/i-ojo.svg') }}" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
        
    </div>

    @push('extra-js')
   
    @endpush

@endsection
