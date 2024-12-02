const btnUpload = document.querySelector('#btnUpload');
const btnNuevaCarpeta = document.querySelector("#btnNuevaCarpeta");
const modalFile = document.querySelector("#modalFile");
const myModal = new bootstrap.Modal(modalFile);

const modalCarpeta = document.querySelector("#modalCarpeta");
const myModal1 = new bootstrap.Modal(modalCarpeta);
const frmCarpeta = document.querySelector('#frmCarpeta');

const btnSubirArchivo = document.querySelector('#btnSubirArchivo');
const file = document.querySelector('#file');

const modalCompartir = document.querySelector("#modalCompartir");
const myModal2 = new bootstrap.Modal(modalCompartir);
const id_carpeta = document.querySelector('#id_carpeta');

const carpetas = document.querySelectorAll('.carpetas');
const btnSubir = document.querySelector('#btnSubir');

// VER ARCHIVOS
const btnVer = document.querySelector("#btnVer");

//COMPARTIR ARCHIVOS ENTRE USUARIOS
const compartir = document.querySelectorAll(".compartir");
const modalUsuarios = document.querySelector("#modalUsuarios");
const myModalUser = new bootstrap.Modal(modalUsuarios);
const id_archivo = document.querySelector('#id_archivo');
const frmCompartir = document.querySelector('#frmCompartir');
const usuarios = document.querySelector('#usuarios');

const btnCompartir = document.querySelector('#btnCompartir');
const container_archivos = document.querySelector('#container-archivos');


document.addEventListener('DOMContentLoaded', function() {
    btnUpload.addEventListener('click', function() {
        myModal.show();
    })

    btnNuevaCarpeta.addEventListener('click', function(){
        myModal.hide();
        myModal1.show();
    })

    frmCarpeta.addEventListener('submit', function(e){
        e.preventDefault();
        if (frmCarpeta.nombre.value == '') {
            alertaPerzonalizada('warning', 'EL NOMBRE ES REQUERIDO');
        } else {
            const data = new FormData(frmCarpeta);
            const url = base_url + 'admin/crearcarpeta';
            const http = new XMLHttpRequest();

            http.open("POST", url, true);
            http.send(data);
            http.onreadystatechange = function (){
                if (http.status === 200) {
                    const res = JSON.parse(http.responseText);
                    alertaPerzonalizada(res.tipo, res.mensaje);
                   if (res.tipo === 'success') {
                         setTimeout(() => {
                            window.location.reload();
                         }, 1500);
                    }
                } 
            };
        }
        
    })

    // SUBIR ARCHIVOS
    btnSubirArchivo.addEventListener('click', function(){
        myModal.hide();
        file.click();
    })

    file.addEventListener('change', function (e){
            const data = new FormData();
            data.append('id_carpeta', id_carpeta.value);
            data.append('file', e.target.files[0]);
            const http = new XMLHttpRequest();
            const url = base_url + 'admin/subirarchivo';  // Conexion a la base de datos
            

            http.open("POST", url, true);
            http.send(data);
            http.onreadystatechange = function (){
                if (http.status === 200) {
                    const res = JSON.parse(http.responseText);
                    alertaPerzonalizada(res.tipo, res.mensaje);
                   if (res.tipo === 'success') {
                         setTimeout(() => {
                            window.location.reload();
                         }, 1500);
                    }
                } 
            };
    })

    carpetas.forEach(carpeta =>{
        carpeta.addEventListener('click', function(e){
            id_carpeta.value = e.target.id;
            myModal2.show();
        })
    });

    btnSubir.addEventListener('click', function(){
        myModal2.hide();
        file.click();
    })

    btnVer.addEventListener('click', function(){
        window.location = base_url + 'admin/ver/' + id_carpeta.value;
    })

    $(".js-states").select2({
        placeholder: 'Buscar y Agregar Usuarios',
        maximumSelectionLength: 5,
        minimumInputLength: 2,
        dropdownParent: $('#modalUsuarios'),
        ajax: {
            url: base_url + 'archivos/getUsuarios',
            dataType: 'json',
            delay: 250,
            data: function (params) {
              return {
                q: params.term
              };
            },
            processResults: function (data) {       
              return {
                results: data
              };
            },
            cache: true
          },
    });

    //AGREGAR CLICK AL ENLACE COMPARTIR
    compartir.forEach(enlace => {
        enlace.addEventListener('click', function(e){
            compartirArchivo(e.target.id);
        })
    });

    frmCompartir.addEventListener('submit', function(e){
        e.preventDefault();
        if (usuarios.value == '') {
            alertaPerzonalizada('warning', 'NO A SELECCIONADO NINGUN USUARIO');
        } else {
            const data = new FormData(frmCompartir);
            const http = new XMLHttpRequest();
            const url = base_url + 'archivos/compartir';
            
            http.open("POST", url, true);
            http.send(data);
            http.onreadystatechange = function (){
                if (http.status === 200) {
                    const res = JSON.parse(http.responseText);
                    alertaPerzonalizada(res.tipo, res.mensaje);
                   if (res.tipo == 'success') {
                    id_archivo.value = '';
                    $('.js-states').val(null).trigger('change');
                    myModalUser.hide();
                   }
                } 
            };
        }
    })

    //COMPARTIR ARCHIVOS POR CARPETAS
    btnCompartir.addEventListener('click', function(){
        verArchivos();
    })

})

eliminar.forEach(enlace => {
    enlace.addEventListener('click', function (e) {
        let id = e.target.getAttribute('data-id');
        const url = base_url + 'archivos/eliminar/' + id;
        eliminarRegistro(
            'ESTA SEGURO DE ELIMINAR',
            'EL ARCHIVO SE ELIMINARÁ DE FORMA PERMANENTE EN 30 DÍAS',
            'SI ELIMINAR',
            url, null)
    });
})

function compartirArchivo(id) {
    id_archivo.value = id;
    myModalUser.show();
}

function verArchivos() {
            const http = new XMLHttpRequest();
            const url = base_url + 'archivos/verArchivos/' + id_carpeta.value;
            
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function (){
                if (http.status === 200) {
                    const res = JSON.parse(http.responseText);
                    let html = '';
                    if (res.length > 0) {
                                res.forEach(archivo => {
                                    html += `<div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="${archivo.id}" name="archivos[]" id="flexCheckDefault_${archivo.id}">
                                        <label class="form-check-label" for="flexCheckDefault_${archivo.id}">
                                            ${archivo.nombre}
                                        </label>
                                    </div>`;
                                });
                    } else {
                        html = `<div class="alert alert-custom alert-indicator-right indicator-warning" role="alert">
                                                    <div class="alert-content">
                                                        <span class="alert-title">ALERTA!</span>
                                                        <span class="alert-text">LA CARPETA SE ENCUENTRA VACIA</span>
                                                    </div>
                                                </div>`;
                    }
                    container_archivos.innerHTML = html;
                    myModal2.hide();
                    myModalUser.show();
                } 
            };
}
