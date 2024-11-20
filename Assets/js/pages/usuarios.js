const frm = document.querySelector('#formulario');
const btnNuevo = document.querySelector('#btnNuevo');
const title = document.querySelector('#title');

const modalRegistro = document.querySelector("#modalRegistro");
const myModal = new bootstrap.Modal(modalRegistro);

document.addEventListener('DOMContentLoaded', function () {
    // Configurar DataTable
    $('#tblUsuarios').DataTable({
        ajax: {
            url: base_url + 'usuarios/listar',
            dataSrc: '',
            error: function (xhr, status, error) {
                console.error('Error al cargar datos:', error);
                console.log('Respuesta del servidor:', xhr.responseText);
            },
            success: function (data) {
                console.log('Datos recibidos del servidor:', data);
            }
        },
        columns: [
            { data: 'id' },
            { data: 'nombre' },
            { data: 'correo' },
            { data: 'telefono' },
            { data: 'direccion' },
            { data: 'perfil' },
            { data: 'fecha' },
        ],
    });
    

    // Mostrar modal para nuevo usuario
    btnNuevo.addEventListener('click', function () {
        title.textContent = 'NUEVO USUARIO';
        frm.reset();
        myModal.show();
    });

    // Registrar usuario
    frm.addEventListener('submit', function (e) {
        e.preventDefault();
        if (frm.nombre.value == '' || 
            frm.apellido.value == '' || 
            frm.correo.value == '' || 
            frm.telefono.value == '' || 
            frm.direccion.value == '' || 
            frm.clave.value == '' || 
            frm.rol.value == ''
        ) {
            alertaPerzonalizada('warning', 'TODOS LOS CAMPOS SON REQUERIDOS');
        } else {
            const data = new FormData(frm);
            const http = new XMLHttpRequest();
            const url = base_url + 'usuarios/guardar';
            
            http.open("POST", url, true);
            http.send(data);

            http.onload = function () {
                if (http.status === 200) {
                    const res = JSON.parse(http.responseText);
                    alertaPerzonalizada(res.tipo, res.mensaje);
                    if (res.tipo == 'success') {
                        $('#tblUsuarios').DataTable().ajax.reload();
                        frm.reset();
                        myModal.hide();
                    }
                } else {
                    alertaPerzonalizada('error', 'Error en la solicitud al servidor');
                }
            };            
        }  
    })
})
