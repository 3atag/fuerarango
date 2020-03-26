// (function () {
//     'use strict';

//     document.addEventListener('DOMContentLoaded', function () {

//         const formEditarPractica = document.querySelector('#editarPractica');


//         /* Validacion de formulario GENERALES al hacer clic en AGREGAR */
//         formEditarPractica.addEventListener('submit', function (e) {

//             e.preventDefault();

//             let idPrac = document.querySelector('#iD').value,
//             codigo = document.querySelector('#codigo').value.toUpperCase(),
//             descripcion = document.querySelector('#descripcion').value.toUpperCase(),
//             cantMaxDiaria = document.querySelector('#cantMaxDiaria').value,
//             cantMaxMen = document.querySelector('#cantMaxMen').value,
//             cantMaxAnu = document.querySelector('#cantMaxAnu').value;
           

//             /* Leer los datos de los inputs */

//             if (descripcion.trim() === '') {


//                 Swal.fire({
//                     icon: 'error',
//                     title: 'Oops...',
//                     text: 'Something went wrong!',
//                     footer: '<a href>Why do I have this issue?</a>'
//                 });


//             } else {
              
//                 // Paso la validacion, crear llamado a AJAX
//                 const datosEditarPractica = new FormData();
                
//                 datosEditarPractica.append('idPractica', idPrac);
//                 datosEditarPractica.append('codigo', codigo.trim());
//                 datosEditarPractica.append('descripcion', descripcion.trim());
//                 datosEditarPractica.append('cantMaxDiaria', cantMaxDiaria);
//                 datosEditarPractica.append('cantMaxMen', cantMaxMen);
//                 datosEditarPractica.append('cantMaxAnu', cantMaxAnu);

//                 // llamado a AJAX
//                 // Crear el objeto
//                 const xhr = new XMLHttpRequest();
//                 // abrir la conexion
//                 xhr.open('POST', 'save', true);

//                 // pasar los datos
//                 xhr.onload = function () {
//                     if (this.status === 200) {
//                         // Asignar respuesta del servidor php

//                         let respuesta = JSON.parse(xhr.responseText);



//                         console.log(respuesta.resultado);

//                         //     resultado = respuesta.resultado,
//                         //     mensaje = respuesta.mensaje;

                       
//                         // //Mostrar notificacion de OK
//                         // mostrarNotificacion(formContactoGenerales, '#contactoGenerales > div', mensaje, resultado);

                      
//                     }
//                 };
//                 // enviar los datos
//                 xhr.send(datosEditarPractica);
//             }

//         });

//     }); /* FIN DE ADDEVENTLISTENER DOM */


// })();