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