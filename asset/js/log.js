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
            let ttlClass = (element.ttl === '128') ? 'true' : 'move'
            form.innerHTML += `
            <tr class="tra">
                <td data-th="id">${element.identification}</td>
                <td data-th="date">${element.date}</td>  
                <td data-th="status">${element.status}</td>
                <td data-th="name">${element.protocol_name}</td>
                <td data-th="checksum" class="${protocolChecksumStatusClass}">${element.protocol_checksum__status}</td>
                <td data-th="ttl" class="${ttlClass}">${element.ttl}</td>                 
                <td data-th="ipA">${element.ip_from}</td>                 
                <td data-th="ipB">${element.ip_dest}</td>                           
            </tr>`;  
        });


})







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
