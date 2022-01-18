function pourcentage(val1,val2) {return Math.round(val1/(val1+val2)*100)}
// ICMP
fetch('http://localhost/J3M/ajax/ICMP/getDataIcmp.php')
    .then (function(response){
        
        return response.json()
    }).then(function (data){
        console.log(data)
        // GRAPH IP
        // calcul DATA
        let ipVersion = data.map(function (e) {
            return e.version;
        });     
        let nbIpv4 = 0
        let nbIpv6 = 0
        ipVersion.forEach(element => {
            if(element== 4){
                nbIpv4++;
            }else{
                nbIpv6++;
            }
        });
        let pourcentageIpv6 = pourcentage(nbIpv6,nbIpv4)
        let pourcentageIpv4 = pourcentage(nbIpv4,nbIpv6)        
   
        // Graphique 
        protocolNameCanvas = document.getElementById('canvasIcmp1');
        let protocolNameIp   = protocolNameCanvas.getContext('2d');
        protocolNameIp.canvas.width = 400;        
        let protocolNameConfigIp = {
            type: 'pie',
            data: {
                labels: ['ipV4 : '+pourcentageIpv4+'%','ipv6 : '+pourcentageIpv6+'%'],
                datasets: [{
                    data: [nbIpv4,nbIpv6],
                    backgroundColor: [
                        '#050B4F',
                        '#FB9D2C',                        
                    ],
                }]
            },
            options: {
                responsive: false,
                title: {
                    display: true,
                    fontSize: 30,
                    position: 'top',
                    text: 'Proportion Ipv4 et Ipv6',
                },
                legend: {
                    position: 'right',
                }
            }
        };
        // appel du graphique
        let protocolNameChartGraphIp = new Chart(protocolNameIp, protocolNameConfigIp);
        // graph PING
        // calcul DATA
        let pingOK = 0
        let pingKO = 0
        // taux de ping à l'état good        
        data.forEach(element => {
            if(element.protocol_type == 8){
                if(element.protocol_checksum__status == 'good'){
                    pingOK++;
                }else{
                    pingKO++;
                }
            }
            
        });        
        pourcentagePingOK = pourcentage(pingOK,pingKO)
        pourcentagePingKO = pourcentage(pingKO,pingOK)

        protocolNameCanvas = document.getElementById('canvasIcmp2');
        let protocolName   = protocolNameCanvas.getContext('2d');
        protocolName.canvas.width = 600;
        
        let protocolNameConfig = {
            type: 'bar',
            data: {
                labels: ['Ping OK : '+pourcentagePingOK+'%','Ping KO : '+pourcentagePingKO+'%'],
                datasets: [{
                    data: [pingOK,pingKO],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',                                              
                        'rgba(255, 99, 132, 0.2)',                                              
                    ],
                }]
            },
            options: {
                responsive: false,
                title: {
                    display: true,
                    fontSize: 30,
                    position: 'top',
                    text: 'Taux de ping valide',
                },
                legend: {
                    display: 'none',
                }
            }
        };
        let protocolNameChart = new Chart(protocolName, protocolNameConfig);
        


}) // fin du fectch





















































































































































fetch('http://localhost/J3M/ajax/UDP/getDataUdp.php')
    .then (function(response){
        return response.json()
    }).then(function (data){
        console.log(data)
        // jeu avec les données
        let ipVersion = data.map(function (e) {
            return e.version;
        });
        let nbIpv4 = 0
        let nbIpv6 = 0
        ipVersion.forEach(element => {
            if(element== 4){
                nbIpv4++;
            }else{
                nbIpv6++;
            }
        });
        console.log(nbIpv4)
        console.log(nbIpv6)

        protocolNameCanvas = document.getElementById('canvasUdp1');
        let protocolName = protocolNameCanvas.getContext('2d');
        protocolName.canvas.width = 400;
        
        let protocolNameConfig = {
            type: 'pie',
            data: {
                labels: ["ipV4","ipv6"],
                datasets: [{
                    data: [nbIpv4,nbIpv6],
                    backgroundColor: [
                        '#050B4F',
                        '#FB9D2C',
                        
                    ],
                }]
            },
            options: {
                responsive: false,
                title: {
                    display: true,
                    fontSize: 30,
                    position: 'top',
                    text: 'Proportion Ipv4 et Ipv6',
                },
                legend: {
                    position: 'right',
                }
            }
        };
        let protocolNameChart = new Chart(protocolName, protocolNameConfig);

}) // fin du fectch































































































































































































const selectListThree = document.querySelector('#select-list-detail'); 
        const graphiqueUDP = document.querySelector('#graphiqueUDP'); 
        const graphiqueTCP = document.querySelector('#graphiqueTCP'); 
        const graphiqueTLS = document.querySelector('#graphiqueTLS'); 
        const graphiqueICMP = document.querySelector('#graphiqueICMP'); 

        
        selectListThree.addEventListener("change",() => {
            if(selectListThree.value == 'TCP'){
                graphiqueTCP.classList.add("secNone");
                graphiqueUDP.classList.add("secNone");
                graphiqueTLS.classList.add("secNone");
                graphiqueICMP.classList.add("secNone");
                graphiqueTCP.classList.remove("secNone");
            }
            else if(selectListThree.value == 'UDP'){
                graphiqueTCP.classList.add("secNone");
                graphiqueUDP.classList.add("secNone");
                graphiqueTLS.classList.add("secNone");
                graphiqueICMP.classList.add("secNone");
                graphiqueUDP.classList.remove("secNone");
            }else if(selectListThree.value == 'TLSv1.2'){
                graphiqueTCP.classList.add("secNone");
                graphiqueUDP.classList.add("secNone");
                graphiqueTLS.classList.add("secNone");
                graphiqueICMP.classList.add("secNone");
                graphiqueTLS.classList.remove("secNone");
            }else{
                graphiqueTCP.classList.add("secNone");
                graphiqueUDP.classList.add("secNone");
                graphiqueTLS.classList.add("secNone");
                graphiqueICMP.classList.add("secNone");
                graphiqueICMP.classList.remove("secNone");
            }
        })
