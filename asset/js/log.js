
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
            let statusClass                 = (element.status === 'timeout') ? 'disable' : 'true'
            let statusVide                  = (element.status === 'timeout') ? 'Refusée' : 'Acceptée'
            let ipFrom                      = getIpNumber(element.ip_from)
            let ipDest                      = getIpNumber(element.ip_dest)
            form.innerHTML += `
            <tr class="tra">
                <td data-th="id" class="selectTd">${element.identification}</td>
                <td data-th="date" class="selectTd">${date}</td>  
                <td data-th="status" class="${statusClass} selectTd">${statusVide}</td>
                <td data-th="name" class="elementName selectTd">${element.protocol_name}</td>
                <td data-th="checksum" class="${protocolChecksumStatusClass} selectTd">${element.protocol_checksum__status}</td>
                <td data-th="ttl" class="${ttlClass} selectTd">${element.ttl}</td>            
                <td data-th="ipFrom" class="selectTd">${ipFrom}</td>                 
                <td data-th="ipDest" class="selectTd">${ipDest}</td>   
                <td data-th="version" class="selectTd" style="display: none;">${element.version}</td>                                                           
                <td data-th="headerLength" class="selectTd" style="display: none;">${element.headerLength}</td>                                                           
                <td data-th="service" class="selectTd" style="display: none;">${element.service}</td>                                                                                                                   
                <td data-th="protocolheaderChecksum" class="selectTd" style="display: none;">${element.headerChecksum}</td>                                                           
                <td data-th="protocolPortsFrom" class="selectTd" style="display: none;">${element.protocol_ports__from}</td>                                                                                                                  
                <td data-th="protocol_ports__dest" class="selectTd" style="display: none;">${element.protocol_ports__dest}</td>                                                                                                                  
                <td data-th="flags_code" class="selectTd" style="display: none;">${element.flags_code}</td>                                                                                                                  
                <td data-th="protocol_checksum__code" class="selectTd" style="display: none;">${element.protocol_checksum__code}</td>                                                                                                                  
            </tr>`;  
        });

        // si variable Protocole name = UDP remove class trNone à seulement ceux qui ont udp
        // SI  la value d'option est égale à l'écriture qu'il y a dans protocole name ajouter class trBlock à tr
        const trame = document.querySelectorAll('.tra');
        const selectList = document.querySelector('#select-list'); 
        const selectListTwo = document.querySelector('#select-list2'); 
        const popup = document.querySelector('.popup');
        const popupRight = document.querySelector('.right');
        const cross = document.querySelector('#crossPop');
        const tableau = document.querySelector('#tableau');

    


        cross.addEventListener('click', function() {
            popup.style.visibility = 'hidden';
            cross.style.visibility = 'hidden';
            tableau.style.filter = 'inherit';
            document.body.style.overflowY      = 'inherit';
        });

        // Ouverture de trame avec plus de données
        trame.forEach(elements =>{
            elements.addEventListener('click', event => {

                popup.style.visibility             = 'inherit';
                cross.style.visibility             = 'inherit';
                tableau.style.filter               = 'brightness(0.3)';
                document.body.style.overflowY      = 'hidden';

                popupRight.innerHTML = 
                `
                 <h2 class="violet">${elements.cells[0].innerText}</h2>
                 <h2>${elements.cells[1].innerText}</h2>
                 <h2 class="red">${elements.cells[2].innerText}</h2>
                 <h2 class="vert">${elements.cells[3].innerText}</h2> 
                 <h2 class="vert">${elements.cells[4].innerText}</h2>
                 <h2 class="vert">${elements.cells[5].innerText}</h2> 
                 <h2 class="orange">${elements.cells[6].innerText}</h2> 
                 <h2 class="orange">${elements.cells[7].innerText}</h2>
                 <h2 class="orange">v${elements.cells[8].innerText}</h2>
                 <h2>${elements.cells[9].innerText}</h2>
                 <h2>${elements.cells[10].innerText}</h2>
                 <h2>${elements.cells[11].innerText}</h2>                        
                 <h2 class="orange">${elements.cells[12].innerText}</h2>                        
                 <h2 class="orange">${elements.cells[13].innerText}</h2>                        
                 <h2>${elements.cells[14].innerText}</h2>                        
                 <h2>${elements.cells[15].innerText}</h2>                                        
                `
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

    selectListTwo.addEventListener("change",() => {
        // protocolName = selectList.value
        trame.forEach(element => {
            // console.log(element.cells[2].innerText);

            if(selectListTwo.value == 'Tous'){
                element.classList.remove("secNone");
            }
            else if(element.cells[2].innerText == selectListTwo.value){
                element.classList.remove("trNone");
            }else{
                element.classList.add("trNone");
            }

        });

    })

});


