
import { getIpNumber , getLogDate } from './fonction.js';

fetch('http://localhost/J3M/ajax/getDataJson.php')
    .then (function(response){
        return response.json()
    }).then(function (data){     
        // console.log(data)

        const form = document.querySelector('.rwd-table')
        data.forEach(element => {
            // Si protocolChecksumStatusClass = au text good afficher en vert sinon disable
            let date = getLogDate(element.date)
            let protocolChecksumStatusClass = (element.protocol_checksum__status === 'good') ? 'true' : 'disable'
            let ttlClass                    = (element.ttl === '128') ? 'true' : 'move'
            let ipFrom                      = getIpNumber(element.ip_from)
            let ipDest                      = getIpNumber(element.ip_dest)
            form.innerHTML += `
            <tr class="trame">
            <tr class="tra">
                <td data-th="id" class="selectTd">${element.identification}</td>
                <td data-th="date" class="selectTd">${date}</td>  
                <td data-th="status" class="selectTd">${element.status}</td>
                <td data-th="name" class="elementName selectTd">${element.protocol_name}</td>
                <td data-th="checksum" class="${protocolChecksumStatusClass} selectTd">${element.protocol_checksum__status}</td>
                <td data-th="ttl" class="${ttlClass} selectTd">${element.ttl}</td>            
                <td data-th="ipFrom" class="selectTd">${ipFrom}</td>                 
                <td data-th="ipDest" class="selectTd">${ipDest}</td>                           
            </tr>`;  
         
        });


        // si variable Protocole name = UDP remove class trNone à seulement ceux qui ont udp
        // SI  la value d'option est égale à l'écriture qu'il y a dans protocole name ajouter class trBlock à tr
        const trame = document.querySelectorAll('.tra');
        const selectList = document.querySelector('#select-list'); 
        const selectTd = document.querySelectorAll('.selectTd');
        
        console.log(selectTd);
        console.log(selectTd.innerText);

        
        // console.log(trame);

        // Ouverture de trame avec plus de données
        trame.forEach(elements =>{
            elements.addEventListener('click', event => {
                console.log(selectTd.innerText);
              });
        })

        // SELECT LIST

        selectList.addEventListener("change",() => {
        // protocolName = selectList.value
        trame.forEach(element => {
            console.log(element.cells[3].innerText);

            if(selectList.value == 'ALL'){
                element.classList.remove("trNone");
            }
            else if(element.cells[3].innerText == selectList.value){
                element.classList.remove("trNone");
            }else{
                element.classList.add("trNone");
            }
        });


      



    })

});


