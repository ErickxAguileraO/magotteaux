$('select').niceSelect();

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


// Imput file img
const input = document.getElementById("input-file-preview");
    const image = document.getElementById("image-selected");
    //CAPTURAMOS LA IMAGEN SELECCIONADA
    input && input.addEventListener("change", (e) => {
    console.log(e.target.files[0]);
    let imageBinary = null;
    //LEEMOS EL BINARIO DE LA IMAGEN
    const reader = new FileReader();
        reader.readAsDataURL(e.target.files[0]);
        reader.onload = (e) => {
            e.preventDefault();
            image.setAttribute('src', e.target.result)
        };
});

const input2 = document.getElementById("input-file-preview2");
    const image2 = document.getElementById("image-selected2");
    //CAPTURAMOS LA IMAGEN SELECCIONADA
    input2 && input2.addEventListener("change", (e) => {
    console.log(e.target.files[0]);
    let imageBinary = null;
    //LEEMOS EL BINARIO DE LA IMAGEN
    const reader = new FileReader();
        reader.readAsDataURL(e.target.files[0]);
        reader.onload = (e) => {
            e.preventDefault();
            image2.setAttribute('src', e.target.result)
        };
});

// Mostrar pass

function mostrarContrasena(){
    var tipo = document.getElementById("password");
    if(tipo.type == "password"){
        tipo.type = "text";
    }else{
        tipo.type = "password";
    }
}