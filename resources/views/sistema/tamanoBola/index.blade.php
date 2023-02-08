@extends('layout.sistema')

@section('title', 'Tamaño de bola')

@section('content')
   <div class="contenido">
      <nav class="sub-menu-nav">
         <a>
            <p>Usted está en</p>
         </a>
         <img src="{{ asset('web/imagenes/i-flecha-derecha.svg') }}" alt="">
         <a href="/tamaños-de-bola">
            <p class="menu-seleccionado">Mantenedor de tamaños de bola</p>
         </a>
      </nav>
      <section class="grid-row-menu-lateral">
         @include('imports.sidebar')
         <div>
            <div class="div-contenido">
               <div class="div-contenido-inicio">
                  <h2>Mantenedor de tamaños de bola</h2>
                  <a href="{{ route('tamano.bola.create') }}" class="btn-contenido-inicio">
                     <p>Crear nuevo tamaño de bola</p>
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
                        <label for="">Tipo de bola</label>
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
                     <a href="{{ route('tamano.bola.download.excel') }}" class="btn-contenido-inicio">
                        <p>Descargar Excel</p>
                        <img src="{{ asset('web/imagenes/i-exel.svg') }}" alt="">
                     </a>
                  </div>
                  <div id="container-datagrid" data-link="{{ route('tamano.bola.list') }}" data-link-edit="{{ route('tamano.bola.edit', ':id') }}" data-link-delete="{{ route('tamano.bola.delete', ':id') }}"></div>
               </div>
            </div>
         </div>
      </section>
   </div>
@endsection

@push('extra-js')
   <script>
      const grid = document.getElementById('container-datagrid');

      $(document).ready(async function(e) {

         const items = new DevExpress.data.CustomStore({ // función para el origen de datos
            load: function() {
               return sendRequest($(grid).data('link'));
            }
         });

         DevExpress.localization.locale(navigator.language);

         const dataGrid = $(grid).dxDataGrid({
            dataSource: items,
            columnAutoWidth: true,
            showBorders: true, // mostrar bordes de la tabla
            hoverStateEnabled: true, // color en la fila al pasar el mouse por encima
            columnHidingEnabled: true, // ocultar columnas si no alcanzan a desplegarse en la resolucion
            allowColumnReordering: true, // permite mover las columnas (cambiar de orden) al actualizar vuelve a la normalidad
            // rowAlternationEnabled: true, // fila de color intercalada
            wordWrapEnabled: true, // permite visualizar todo el texto en una columna (pasa la siguiente, como si hiciera enter)
            searchPanel: { // 1 panel para buscar palabras
               visible: true,
               width: 240,
               placeholder: 'Buscar...',
            },
            headerFilter: { // filtro para filtrar al seleccionar valores de la columna en la cabecera
               visible: true,
            },
            filterRow: { //lupita para buscar en columna
               visible: true,
               applyFilter: 'auto', // puede ser auto u onClick
               betweenStartText: 'Inicio',
               betweenEndText: 'Fin',
            },
            pager: { // paginador, cuantas filas se muestran
               allowedPageSizes: [10, 25, 50, 100],
               showInfo: true,
               showNavigationButtons: true,
               showPageSizeSelector: true,
               visible: 'auto',
            },
            paging: { // numero de filas a mostrar
               pageSize: 10,
            },
            columnChooser: { // escoger que columnas se muestran u ocultar al presionar un botón y seleccionar
               enabled: false,
               mode: 'select',
            },
            columns: [
               // filtro en cabecera para NUMERIC filterOperations:[ "=", "<>", "<", ">", "<=", ">=", "between" ],
               // filtro en cabecera para STRING filterOperations:[ "contains", "notcontains", "startswith", "endswith", "=", "<>" ],
               // filtro en cabecera para DATE filterOperations:[ "=", "<>", "<", ">", "<=", ">=", "between" ],
               // en caso de tener 2 o más filtros, para dejar uno por defecto se usa selectedFilterOperation: "between",
               {
                  dataField: 'id',
                  caption: 'Id',
                  dataType: 'number',
                  visible: false,
                  sortIndex: 1, // al cargar, ordena por esta columna
                  sortOrder: "desc", // orden descendente
               },
               {
                  dataField: 'tamano',
                  caption: 'Tamaño de bola',
                  filterOperations: ["contains"],
                  hidingPriority: 2, // prioridad para ocultar columna, 0 se oculta primero
               },
               {
                  dataField: 'estado',
                  caption: 'Estado',
                  filterOperations: ["contains"],
                  lookup: {
                     dataSource: {
                        store: {
                           type: 'array',
                           data: [{
                                 id: 0,
                                 name: 'Inactivo'
                              },
                              {
                                 id: 1,
                                 name: 'Activo'
                              }
                           ],
                           key: "id"
                        },
                        pageSize: 10,
                        paginate: true
                     },
                     valueExpr: 'id',
                     displayExpr: 'name'
                  },
               },
               {
                  caption: 'Opciones',
                  filterOperations: ["contains"],
                  hidingPriority: 0, // prioridad para ocultar columna, 0 se oculta primero
                  cellTemplate(container, options) {

                     const url_edit = $(grid).data('link-edit').replace(':id', options.data.id);
                     const url_delete = $(grid).data('link-delete').replace(':id', options.data.id);

                     const link_edit = '<a href="' + url_edit + '" class="tooltip" title="Editar"><img src="/web/imagenes/i-editar-green.svg" alt=""></a>';
                     const link_delete = '<a href="' + url_delete + '" class="tooltip delete-confirmation" title="Eliminar" data-message="este tamaño de bola"><img class="pointer-event-none" src="/web/imagenes/i-borrar-red.svg" alt=""></a>';

                     return $(link_edit + link_delete);
                  },
               },
            ],
         }).dxDataGrid('instance');
      });
   </script>
@endpush

