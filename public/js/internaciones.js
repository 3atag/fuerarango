(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {

        let  intFindBeneficio = document.querySelector('#intFindBeneficio'),
             intFindName = document.querySelector('#intFindName'),
             intFindDocumento = document.querySelector('#intFindDocumento'),
             registros = document.querySelectorAll('#allInternaciones tbody tr');

        // Buscar por numero de BENEFICIO
        intFindBeneficio.addEventListener('input', function (e) {

            const expresion = RegExp (e.target.value, "i");

            registros.forEach(registro =>{
    
                registro.style.display = 'none';

                if(registro.childNodes[1].textContent.replace(/\s/g, " ").search(expresion) != -1) {

                    registro.style.display = 'table-row';
                }
            });

        });

        // Buscar por NOMBRE
        intFindName.addEventListener('input', function (e) {

            const expresion = RegExp (e.target.value, "i");

            registros.forEach(registro =>{

                registro.style.display = 'none';

                if(registro.childNodes[3].textContent.replace(/\s/g, " ").search(expresion) != -1) {

                    registro.style.display = 'table-row';
                }
            });

        });

        // Buscar por DOCUMENTO
        intFindDocumento.addEventListener('input', function (e) {

            const expresion = RegExp (e.target.value, "i");

            registros.forEach(registro =>{

                registro.style.display = 'none';

                if(registro.childNodes[5].textContent.replace(/\s/g, " ").search(expresion) != -1) {

                    registro.style.display = 'table-row';
                }
            });

        });

    }); /* FIN DE ADDEVENTLISTENER DOM */


})();