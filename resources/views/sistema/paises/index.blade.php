@extends('layout.web')

@section('title', 'Home')

@section('content')
    @push('extra-css')
    @endpush

    <div class="contenido">
        <nav class="sub-menu-nav">
            <a><p>Usted está en</p></a>
            <img src="{{ asset('web/imagenes/i-flecha-derecha.svg') }}" alt="">
            <a href="/paises"><p class="menu-seleccionado">Mantenedor de países</p></a>
        </nav>
        <section class="grid-row-menu-lateral">
            @include("imports.sidebar")
            <div>
                <div class="div-contenido">
                    <div class="div-contenido-inicio">
                        <h2>Mantenedor de países</h2>
                        <a href="{{ route('pais.create') }}" class="btn-contenido-inicio">
                            <p>Crear nuevo país</p>
                            <img src="{{ asset('web/imagenes/i-mas-white.svg') }}" alt="">
                        </a>
                    </div>

                    <form action="" class="sub-contenido">
                        <div class="div-contenido-inicio-2">
                            <h2>Filtros de búsqueda</h2>
                            <div class="botones-contenido-inicio">
                                <button class="btn-contenido-inicio">
                                    <p>Buscar</p>
                                    <img src="{{ asset('web/imagenes/i-buscar.svg') }}" alt="">
                                </button>
                                <button class="btn-contenido-inicio2" type="reset">
                                    <p>Limpiar filtro</p>
                                    <img src="{{ asset('web/imagenes/i-eliminar-filtros.svg') }}" alt="">
                                </button>
                            </div>
                        </div>
                        <div class="fomulario-row-2">
                            <div class="label-input-n">
                                <label for="">Nombre de país</label>
                                <input type="text">
                            </div>
                            <div class="label-input-n">
                                <label for="">Estado</label>
                                <select name="" id="">
                                    <option value="">Estado</option>
                                </select>
                            </div>

                        </div>
                        <div class="div-contenido-inicio-2-movil">
                            <div class="botones-contenido-inicio">
                                <button class="btn-contenido-inicio">
                                    <p>Buscar</p>
                                    <img src="{{ asset('web/imagenes/i-buscar.svg') }}" alt="">
                                </button>
                                <button class="btn-contenido-inicio2" type="reset">
                                    <p>Limpiar filtro</p>
                                    <img src="{{ asset('web/imagenes/i-eliminar-filtros.svg') }}" alt="">
                                </button>
                            </div>
                        </div>
                    </form>
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
                                    <th>Nombre de país</th>
                                    <th>Estado</th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <td>Aeurus</td>
                                    <td>Activo</td>
                                    <td>
                                        <a href="" class="tooltip">
                                            <img src="{{ asset('web/imagenes/i-editar-green.svg') }}" alt="">
                                            <!-- ToolTip -->
                                            <span class="tooltiptext">Editar</span>
                                        </a>
                                        <a href="" class="tooltip">
                                            <img src="{{ asset('web/imagenes/i-borrar-red.svg') }}" alt="">
                                            <!-- ToolTip -->
                                            <span class="tooltiptext">Eliminar</span>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Aeurus</td>
                                    <td>Activo</td>
                                    <td>
                                        <a href="" class="tooltip">
                                            <img src="{{ asset('web/imagenes/i-editar-green.svg') }}" alt="">
                                            <!-- ToolTip -->
                                            <span class="tooltiptext">Editar</span>
                                        </a>
                                        <a href="" class="tooltip">
                                            <img src="{{ asset('web/imagenes/i-borrar-red.svg') }}" alt="">
                                            <!-- ToolTip -->
                                            <span class="tooltiptext">Eliminar</span>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Aeurus</td>
                                    <td>Activo</td>
                                    <td>
                                        <a href="" class="tooltip">
                                            <img src="{{ asset('web/imagenes/i-editar-green.svg') }}" alt="">
                                            <!-- ToolTip -->
                                            <span class="tooltiptext">Editar</span>
                                        </a>
                                        <a href="" class="tooltip">
                                            <img src="{{ asset('web/imagenes/i-borrar-red.svg') }}" alt="">
                                            <!-- ToolTip -->
                                            <span class="tooltiptext">Eliminar</span>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Aeurus</td>
                                    <td>Activo</td>
                                    <td>
                                        <a href="" class="tooltip">
                                            <img src="{{ asset('web/imagenes/i-editar-green.svg') }}" alt="">
                                            <!-- ToolTip -->
                                            <span class="tooltiptext">Editar</span>
                                        </a>
                                        <a href="" class="tooltip">
                                            <img src="{{ asset('web/imagenes/i-borrar-red.svg') }}" alt="">
                                            <!-- ToolTip -->
                                            <span class="tooltiptext">Eliminar</span>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Aeurus</td>
                                    <td>Activo</td>
                                    <td>
                                        <a href="" class="tooltip">
                                            <img src="{{ asset('web/imagenes/i-editar-green.svg') }}" alt="">
                                            <!-- ToolTip -->
                                            <span class="tooltiptext">Editar</span>
                                        </a>
                                        <a href="" class="tooltip">
                                            <img src="{{ asset('web/imagenes/i-borrar-red.svg') }}" alt="">
                                            <!-- ToolTip -->
                                            <span class="tooltiptext">Eliminar</span>
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="div-contenido-movil">
                        <h2 style="margin-bottom: 15px;">Detalles</h2>
                        {{-- 1 --}}
                        <div class="detalles-n">
                            <div>
                                <span>Nombre</span>
                                <p>Aeurus</p>
                            </div>
                            <img src="{{ asset('web/imagenes/i-flecha-down.svg') }}" alt="">
                        </div>
                        <div class="ocultar-detalles">

                            <div class="ocultar-detalles-n">
                                <div>
                                    <span>Nombre</span>
                                    <p>Aeurus</p>
                                </div>
                            </div>

                            <div class="ocultar-detalles-n">
                                <div>
                                    <span>Estado</span>
                                    <p>Inactivo</p>
                                </div>
                            </div>
                            <div class="eliminar-editar">
                                <a href="" class="eliminar">Eliminar <img src="{{ asset('web/imagenes/i-borrar-red.svg') }}" alt=""></a>
                                <a href="" class="editar">Editar <img src="{{ asset('web/imagenes/i-editar.svg') }}" alt=""></a>
                            </div>
                        </div>
                        {{-- 2 --}}
                        <div class="detalles-n">
                            <div>
                                <span>Nombre</span>
                                <p>Aeurus</p>
                            </div>
                            <img src="{{ asset('web/imagenes/i-flecha-down.svg') }}" alt="">
                        </div>
                        <div class="ocultar-detalles">
                            <div class="ocultar-detalles-n">
                                <div>
                                    <span>Nombre</span>
                                    <p>Aeurus</p>
                                </div>
                            </div>

                            <div class="ocultar-detalles-n">
                                <div>
                                    <span>Estado</span>
                                    <p>Inactivo</p>
                                </div>
                            </div>
                            <div class="eliminar-editar">
                                <a href="" class="eliminar">Eliminar <img src="{{ asset('web/imagenes/i-borrar-red.svg') }}" alt=""></a>
                                <a href="" class="editar">Editar <img src="{{ asset('web/imagenes/i-editar.svg') }}" alt=""></a>
                            </div>
                        </div>
                    </div>
                    <div class="numeros-pag">
                        <a href="" class="numero-antes-despues"  style="margin-right: 35px">Anterior</a>
                        <a href="" class="numero-antes-despues-movil"  style="margin-right: 35px"><img src="{{ asset('web/imagenes/i-antes.svg') }}" alt=""></a>
                        <a href="" class="numero numero-seleccionado">1</a>
                        <a href="" class="numero">2</a>
                        <a href="" class="numero-antes-despues" style="margin-left: 35px">Siguiente</a>
                        <a href="" class="numero-antes-despues-movil"  style="margin-left: 35px"><img src="{{ asset('web/imagenes/i-despues.svg') }}" alt=""></a>
                    </div>
                </div>

            </div>
        </section>


    </div>

    @push('extra-js')

    @endpush

@endsection
