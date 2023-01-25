$(".user-menu").click(function(){
    $(".user-menu-drop").fadeToggle(300);
    event.preventDefault();
});
  
$('#selectAll').change(function() {
    $('input[type=checkbox]').prop('checked', $(this).is(':checked'));
});

$('.detalles-n').click(function(event) {
    event.preventDefault();
    $('.ocultar-detalles').slideUp();
    $(this).next('.ocultar-detalles').slideDown();
});

$('.menu-sidebar-movil').click(function() {
    $(".op-sidebar").css("display", "grid");
    $(".cerrar-menu-sidebar-movil").css("margin-bottom", "40px");
    $(".menu-sidebar-movil").css("display", "none");
    $(".cerrar-menu-sidebar-movil").css("display", "grid");
});

$('.cerrar-menu-sidebar-movil').click(function() {
    $(".op-sidebar").css("display", "none");
    $(".menu-sidebar-movil").css("display", "grid");
    $(".cerrar-menu-sidebar-movil").css("display", "none");
});