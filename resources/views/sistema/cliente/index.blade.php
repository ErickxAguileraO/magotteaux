@extends('layout.web')

@section('title', 'Home')

@push('extra-css')
@endpush

@section('content')
   <div class="contenido">
      <nav class="sub-menu-nav">
         <a>
            <p>Usted está en</p>
         </a>
         <img src="{{ asset('web/imagenes/i-flecha-derecha.svg') }}" alt="">
         <a href="{{ route('cliente.index') }}">
            <p class="menu-seleccionado">Mantenedor de clientes</p>
         </a>
      </nav>
      <section class="grid-row-menu-lateral">
         @include('imports.sidebar')
         <div>
            <div class="div-contenido">
               <div class="div-contenido-inicio">
                  <h2>Mantenedor de clientes</h2>
                  <a href="{{ route('cliente.create') }}" class="btn-contenido-inicio">
                     <p>Crear nuevo cliente</p>
                     <img src="{{ asset('web/imagenes/i-mas-white.svg') }}" alt="">
                  </a>
               </div>
               <form action="" class="sub-contenido">
                  <div class="div-contenido-inicio-2">
                     <h2>Filtros de búsqueda</h2>
                     <div class="botones-contenido-inicio">
                        <button class="btn-contenido-inicio" id="btn-buscar">
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
                        <label for="">Nombre del cliente</label>
                        <input type="text" name="nombre" id="nombre-cliente" value="{{ request('nombre') }}">
                     </div>
                     <div class="label-input-n">
                        <label for="estado-cliente">Estado</label>
                        <select id="estado-cliente" name="estado">
                           <option value="">Seleccione</option>
                           <option value="0" {{ request('estado') === '0' ? 'selected' : '' }}>Inactivo</option>
                           <option value="1" {{ request('estado') === '1' ? 'selected' : '' }}>Activo</option>
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
                           <th>Nombre</th>
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
                        <p>BHP Mineral</p>
                     </div>
                     <img src="{{ asset('web/imagenes/i-flecha-down.svg') }}" alt="">
                  </div>
                  <div class="ocultar-detalles">
                     <div class="ocultar-detalles-n">
                        <div>
                           <span>Tipo de carga</span>
                           <p>Madera</p>
                        </div>
                     </div>

                     <div class="ocultar-detalles-n">
                        <div>
                           <span>Nombre</span>
                           <p>BHP Mineral</p>
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
                        <p>BHP Mineral</p>
                     </div>
                     <img src="{{ asset('web/imagenes/i-flecha-down.svg') }}" alt="">
                  </div>
                  <div class="ocultar-detalles">
                     <div class="ocultar-detalles-n">
                        <div>
                           <span>Tipo de carga</span>
                           <p>Madera</p>
                        </div>
                     </div>

                     <div class="ocultar-detalles-n">
                        <div>
                           <span>Nombre</span>
                           <p>BHP Mineral</p>
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
                  <a href="" class="numero-antes-despues" style="margin-right: 35px">Anterior</a>
                  <a href="" class="numero-antes-despues-movil" style="margin-right: 35px"><img src="{{ asset('web/imagenes/i-antes.svg') }}" alt=""></a>
                  <a href="" class="numero numero-seleccionado">1</a>
                  <a href="" class="numero">2</a>
                  <a href="" class="numero-antes-despues" style="margin-left: 35px">Siguiente</a>
                  <a href="" class="numero-antes-despues-movil" style="margin-left: 35px"><img src="{{ asset('web/imagenes/i-despues.svg') }}" alt=""></a>
               </div>
            </div>

         </div>
      </section>

   </div>
@endsection
