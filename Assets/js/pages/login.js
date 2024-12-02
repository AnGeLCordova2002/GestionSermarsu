alertaPerzonalizada('success', 'BIENVENIDO A SERMARSU');

const frm = document.querySelector('#formulario');
const correo = document.querySelector('#correo');
const clave = document.querySelector('#clave');

document.addEventListener('DOMContentLoaded', function (){
    frm.addEventListener('submit', function(e){
        e.preventDefault();
        if (Correo.value === '' || Clave.value === '') {
            alertaPerzonalizada('warning', 'Todos los campos con * son requeridos');
        } else {
            console.log('Campos completos, enviando datos');
            const data = new FormData(frm);
            const http = new XMLHttpRequest();
            const url = base_url + 'principal/validar'; // Conexion

            console.log('URL de solicitud:', url);

            http.open("POST", url, true);
            http.send(data);

            http.onreadystatechange = function () {
                if (this.readyState === 4) {
                    console.log('Respuesta recibida');
                    if (this.status === 200) {

                        try {
                            console.log('Respuesta JSON:', this.responseText);
                            const res = JSON.parse(this.responseText);
                            alertaPerzonalizada(res.tipo, res.mensaje);

                            if (res.tipo === 'success') {
                                let timerInterval;
                                Swal.fire({
                                    title: res.mensaje,
                                    html: "Será redireccionado en <b></b> milliseconds.",
                                    timer: 2000,
                                    timerProgressBar: true,
                                    didOpen: () => {
                                        Swal.showLoading();
                                        const timer = Swal.getPopup().querySelector("b");
                                        timerInterval = setInterval(() => {
                                            timer.textContent = `${Swal.getTimerLeft()}`;
                                        }, 100);
                                    },
                                    willClose: () => {
                                        clearInterval(timerInterval);
                                    }
                                }).then((result) => {
                                    if (result.dismiss === Swal.DismissReason.timer) {
                                        window.location = base_url + 'admin';
                                    }
                                });
                            }
                        } catch (error) {
                            console.error("Error al analizar la respuesta JSON:", error);
                            alertaPerzonalizada('error', 'Error al procesar la respuesta del servidor.');
                        }
                    } else {
                        console.error("Error en la solicitud:", this.status, this.statusText);
                        alertaPerzonalizada('error', 'Error en la solicitud al servidor.');
                    }
                }
            };
        }
    });
});