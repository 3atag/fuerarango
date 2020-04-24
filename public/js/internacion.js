(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {

        let  buscador = document.querySelector('#buscador'),
             documento = document.querySelector('#documento'),
             btnSeleccionar = document.querySelector('#btnSeleccionar'),
             registros = document.querySelectorAll('#allPacientes tbody tr');

            btnSeleccionar.addEventListener('click', function () {

            buscador.value = '';

            registros.forEach(registro =>{

                registro.style.display = 'none';
     
            });
            
        });

        
       

       buscador.addEventListener('input', function (e) {

       const expresion = RegExp (e.target.value, "i");
    

       registros.forEach(registro =>{
    
           registro.style.display = 'none';

           if(registro.childNodes[3].textContent.replace(/\s/g, " ").search(expresion) != -1) {

                        
            registro.style.display = 'table-row';

           }
       });

    });


    documento.addEventListener('input', function (e) {

        const expresion = RegExp (e.target.value, "i");
     
 
        registros.forEach(registro =>{
     
            registro.style.display = 'none';
 
            if(registro.childNodes[5].textContent.replace(/\s/g, " ").search(expresion) != -1) {
 
                         
             registro.style.display = 'table-row';
 
            }
        });
        
     });




        let idPaciente = document.querySelector('#id_paciente'),

            nombrePaciente = document.querySelector('#nom_paciente'),

            btnPaciente = document.querySelectorAll('.btn-paciente');           


        for (let i = 0; i < btnPaciente.length; i++) {

            btnPaciente[i].addEventListener('click', function () {

                idPaciente.value = btnPaciente[i].value;
                nombrePaciente.value = btnPaciente[i].name;
                $('#modalAddPaciente').modal('hide');
            })
        }

        // btnPaciente[1].addEventListener('click', function () {




    }); /* FIN DE ADDEVENTLISTENER DOM */


})();