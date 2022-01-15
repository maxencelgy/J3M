
import { getIpNumber } from './fonction.js';



fetch('http://localhost/J3M/ajax/getDataJson.php')
    .then (function(response){
        return response.json()
    }).then(function (data){     
        console.log(data)
        function hexaToNumber(hexaValue){
            if(isNaN(hexaValue)){
              if(hexaValue        == 'a'){
                hexaValue = 10;
              }else if (hexaValue == 'b') {
                hexaValue = 11;
              }else if (hexaValue == 'c') {
                hexaValue = 12;
              }else if (hexaValue == 'd') {
                hexaValue = 13;
              }else if (hexaValue == 'e') {
                hexaValue = 14;
              }else if (hexaValue == 'f') {
                hexaValue = 15;
              }
            }else{
              hexaValue = parseInt(hexaValue)
            }
            return hexaValue;
          }
          
        function getIpNumber(hexaIp){
            let ip ='' // Ip retourné
            let arrayNumber=[]
            let arrayHexa = hexaIp.split('') // on mets chaine dans un tableau pour faire les calculs
          // fonction qui transforme l'hexa en nombre
          // on parcours le tableau qui est desormais avec des nombre en base 10
            for (let i=0 ; i<arrayHexa.length ; i++){
              if(i%2 === 0){
                arrayHexa[i] = hexaToNumber(arrayHexa[i])
                arrayHexa[i] = arrayHexa[i]*16
              }else{
                arrayHexa[i] = hexaToNumber(arrayHexa[i])
                arrayNumber.push(arrayHexa[i] + arrayHexa[i-1]);
              }
            }
            arrayNumber.forEach(element => ip += element+'.');
            ip = ip.substring(0,ip.length-1);
            return ip;
          }

       
        const form = document.querySelector('.rwd-table')
        data.forEach(element => {
            // Si protocolChecksumStatusClass = au text good afficher en vert sinon disable
            let protocolChecksumStatusClass = (element.protocol_checksum__status === 'good') ? 'true' : 'disable'

            let ttlClass                    = (element.ttl === '128') ? 'true' : 'move'
            let ipFrom                      = getIpNumber(element.ip_from)
            let ipDest                      = getIpNumber(element.ip_dest)
            form.innerHTML += `
            <tr class="trame">
            <tr class="tra proto">
                <td data-th="id">${element.identification}</td>
                <td data-th="date">${element.date}</td>  
                <td data-th="status">${element.status}</td>
                <td data-th="name">${element.protocol_name}</td>
                <td data-th="checksum" class="${protocolChecksumStatusClass}">${element.protocol_checksum__status}</td>
                <td data-th="ttl" class="${ttlClass}">${element.ttl}</td>            

                <td data-th="ipFrom">${ipFrom}</td>                 
                <td data-th="ipDest">${ipDest}</td>                           
            </tr>`;  
        });
})
 
function change(list)
{
    let val=list.options[list.selectedIndex].value;
    // document.body.style.background=val;
    console.log(val);

    if (val === 'ICMP'){
    console.log('BIEN JOUER');
    }else if (val === 'TLSv1.2'){
    console.log('BIEN JOUER2');
    }else if (val === 'UDP'){
    console.log('bien jouer 3');
    }else{
    console.log('nice');
    }
}























       // const tra = document.querySelectorAll('.tra')
        // console.log(tra);

        //     tra.onmouseclick = function() {mouseClick()};
        //     tra.onmouseout = function() {mouseOut()};
            
        //     function mouseClick() {
        //       tra.classList.add("trb");
        //       console.log('cc');
        //     }
            
        //     function mouseOut() {
        //         tra.classList.remove("trb");
        //     }


