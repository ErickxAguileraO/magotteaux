@extends('layout.sistema')

@section('title', 'carga')

@section('content')
   <div class="contenido">
      <nav class="sub-menu-nav">
         <a>
            <p>Usted está en</p>
         </a>
         <img src="{{ asset('web/imagenes/i-flecha-derecha.svg') }}" alt="">
         <a href="{{ route('carga.index') }}">
            <p class="menu-seleccionado">Mantenedor de cargas</p>
         </a>
      </nav>
      <section class="grid-row-menu-lateral">
         <div>
            <div class="div-contenido">
               <div class="div-contenido-inicio">
                  <h2>Mantenedor de cargas</h2>
                  @if (auth()->user()->hasRole('Logistica'))
                     <a href="{{ route('carga.create') }}" class="btn-contenido-inicio">
                        <p>Crear nueva carga</p>
                        <img src="{{ asset('web/imagenes/i-mas-white.svg') }}" alt="">
                     </a>
                  @endif
               </div>
            </div>
            <div class="div-contenido">
               <div class="div-contenido-escritorio">
                  <div class="div-contenido-inicio">
                     <h2>Detalle</h2>
                     <a href="{{ route('carga.download.excel') }}" class="btn-contenido-inicio">
                        <p>Descargar Excel</p>
                        <img src="{{ asset('web/imagenes/i-exel.svg') }}" alt="">
                     </a>
                  </div>
                  <input type="hidden" id="rolUser" value="{{ auth()->user()->getRoleId() }}">
                  <div id="container-datagrid" data-link-show="{{ route('carga.show', ':id') }}" data-link="{{ route('carga.list') }}" data-link-edit="{{ route('carga.edit', ':id') }}" data-link-delete="{{ route('carga.delete', ':id') }}"></div>
               </div>
            </div>
         </div>
      </section>
   </div>
@endsection

@push('extra-js')
   <script>
      const grid = document.getElementById('container-datagrid');
      const rol = document.querySelector('#rolUser').value;

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
                  dataField: 'patente',
                  caption: 'Patente',
                  filterOperations: ["contains"],
                  hidingPriority: 8, // prioridad para ocultar columna, 0 se oculta primero
               },
               {
                  dataField: 'tipo',
                  caption: 'Tipo carga',
                  filterOperations: ["contains"],
                  hidingPriority: 7, // prioridad para ocultar columna, 0 se oculta primero
               },
               {
                  dataField: 'cliente',
                  caption: 'Cliente destino',
                  filterOperations: ["contains"],
                  hidingPriority: 6, // prioridad para ocultar columna, 0 se oculta primero
               },
               {
                  dataField: 'planta',
                  caption: 'Planta',
                  visible: rol == 1,
                  filterOperations: ["contains"],
                  hidingPriority: 5, // prioridad para ocultar columna, 0 se oculta primero
               },
               {
                  dataField: 'tamano_bola',
                  caption: 'Tipo de bola',
                  filterOperations: ["contains"],
                  hidingPriority: 5, // prioridad para ocultar columna, 0 se oculta primero
               },
               {
                  dataField: 'fecha_carga',
                  caption: 'Fecha de carga',
                  dataType: 'datetime',
                  format: "dd/MM/yyyy - HH:mm",
                  filterOperations: ["between"],
                  selectedFilterOperation: "between",
                  filterOperations: ["between"],
                  hidingPriority: 4, // prioridad para ocultar columna, 0 se oculta primero
               },
               {
                  dataField: 'fecha_salida',
                  caption: 'Fecha de salida',
                  dataType: 'datetime',
                  format: "dd/MM/yyyy - HH:mm",
                  filterOperations: ["between"],
                  selectedFilterOperation: "between",
                  filterOperations: ["between"],
                  hidingPriority: 4, // prioridad para ocultar columna, 0 se oculta primero
               },
               {
                  dataField: 'empresa',
                  caption: 'Empresa',
                  filterOperations: ["contains"],
                  hidingPriority: 4, // prioridad para ocultar columna, 0 se oculta primero
               },
               {
                  caption: 'Opciones',
                  filterOperations: ["contains"],
                  hidingPriority: 0, // prioridad para ocultar columna, 0 se oculta primero
                  cellTemplate(container, options) {

                     const url_show = $(grid).data('link-show').replace(':id', options.data.id);
                     const url_edit = $(grid).data('link-edit').replace(':id', options.data.id);
                     const url_delete = $(grid).data('link-delete').replace(':id', options.data.id);

                     const icon_correo = options.data.email_enviado == 0 ? '<a href="#" class="disable-click"><img src="/web/imagenes/i-correo-pendiente.svg" alt=""></a>' : '<a href="#" class="disable-click"><img src="/web/imagenes/i-correo-enviado.svg" alt=""></a>';
                     const link_show = '<a href="' + url_show + '" class="tooltip" title="Ver"><img src="/web/imagenes/i-ojo.svg" alt=""></a>';
                     // const link_edit = '<a href="' + url_edit + '" class="tooltip" title="Editar"><img src="/web/imagenes/i-editar-green.svg" alt=""></a>';
                     const link_edit = '<a href="' + url_edit + '" class="tooltip" title="Editar"><img src="/web/imagenes/i-editar-green.svg" alt=""></a>';
                     const link_delete = '<a href="' + url_delete + '" class="tooltip delete-confirmation" title="Eliminar" data-message="esta carga"><img class="pointer-event-none" src="/web/imagenes/i-borrar-red.svg" alt=""></a>';
                     let links = icon_correo + link_show;

                     if (rol == 1) links += link_edit + link_delete;

                     return $(links);
                  },
               },
            ],
         }).dxDataGrid('instance');
      });
   </script>
@endpush
