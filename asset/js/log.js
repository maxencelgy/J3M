import { getIpNumber } from './fonction.js';


console.log(getIpNumber('c0a8014a'))

fetch('http://localhost/J3M/ajax/getDataJson.php')
    .then (function(response){
        return response.json()
    }).then(function (data){
        var elt = document.querySelector('select');

        console.log(elt);
       
        const form = document.querySelector('.rwd-table')
       
        data.forEach(element => {
            // Si protocolChecksumStatusClass = au text good afficher en vert sinon disable
            let protocolChecksumStatusClass = (element.protocol_checksum__status === 'good') ? 'true' : 'disable'
            let ttlClass                    = (element.ttl === '128') ? 'true' : 'move'
            let ipFrom                      = getIpNumber(element.ip_from)
            let ipDest                      = getIpNumber(element.ip_dest)
            form.innerHTML += `
            <tr class="trame">
                <td data-th="id">${element.identification}</td>
                <td data-th="date">${element.date}</td>  
                <td data-th="status">${element.status}</td>
                <td data-th="name">${element.protocol_name}</td>
                <td data-th="checksum" class="${protocolChecksumStatusClass}">${element.protocol_checksum__status}</td>
                <td data-th="ttl" class="${ttlClass}">${element.ttl}</td>                 
                <td data-th="ipA">${ipFrom}</td>                 
                <td data-th="ipB">${ipDest}</td>                           
            </tr>`;  
        });
})