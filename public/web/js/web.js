window.addEventListener('load', () => {

    const TIPO_LOGISTICA = 1;
    const TIPO_CLIENTE = 2;
    const TIPO_ADMINISTRADOR = 3;

    /***********************************
     *  Iniciar plugins
     **********************************/

    notificaciones();

    window.addEventListener('click', (e) => {

        /**** Encargado de mostrar un aviso de confirmacion para eliminar ****/
        if (e.target.classList.contains('delete-confirmation')) {
            e.preventDefault();
            const boton = e.target;

            Swal.fire({
                title: '¿Deseas eliminar ' + boton.getAttribute("data-message") + ' ?',
                icon: 'question',
                confirmButtonText: 'Si',
                cancelButtonText: 'No',
                showCancelButton: true,
                showCloseButton: true
            }).then((result) => {
                if (result.isConfirmed) window.location = boton.getAttribute("href");
            });

        }
    });

    $('#tipo_usuario').on('change', function (e) {
        const value = e.currentTarget.value;

        const label_planta = document.querySelector('.label-planta');
        const label_cliente = document.querySelector('.label-cliente');

        if (value == TIPO_LOGISTICA) {
            label_planta.style.display = '';
            label_cliente.style.display = 'none';

        } else if (value == TIPO_CLIENTE) {
            label_cliente.style.display = '';
            label_planta.style.display = 'none';

        } else {
            label_cliente.style.display = 'none';
            label_planta.style.display = 'none';

        }
    });
});

/**********************************
 * Funciones auxiliares
 *********************************/


const configSweetAlert = () => {
    return Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 8000,
        timerProgressBar: true,
        showCloseButton: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })
}

const themeSweetAlert = (type, message) => {
    return {
        background: type == 'success' ? '#a5dc86' : type == 'error' ? '#f27474' : '#f8bb86',
        icon: type,
        title: message,
        iconColor: '#fff',
        color: '#fff',
        customClass: {
            closeButton: 'text-white',
        },
    }
}

const showNotificacion = (type, message) => {
    const Toast = configSweetAlert();

    Toast.fire(themeSweetAlert(type, message));
}

const notificaciones = () => {

    const message = document.getElementById('msg-notify');
    const type = document.getElementById('type-notify');
    const route = document.getElementById('route-notify');

    if (!message || !type) return;

    const Toast = configSweetAlert();

    Toast.fire(themeSweetAlert(type.value, message.value));

    if (!route) return;
    if (route.value) setTimeout(() => window.location.href = route.value, 2000);

    message.remove();
    type.remove();
    route.remove();
}


/**********************************
 * Funciones devextreme
 *********************************/

function sendRequest(url, method, data) { // función para solicitudes de devxtreme

    const d = $.Deferred();
    method = method || "GET";

    $.ajax(url, {
        method: method || "GET",
        data: data,
        cache: false,
        xhrFields: {
            withCredentials: true
        }
    }).done(function (result) {
        /* d.resolve(method === "GET" ? result.data : result); */
        d.resolve(result);
    }).fail(function (xhr) {
        showNotificacion('error', 'Error al obtener los datos');
        d.reject(xhr.responseJSON ? xhr.responseJSON.Message : xhr.statusText);
    });

    return d.promise();
}