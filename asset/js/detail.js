function pourcentage(val1,val2) {return Math.round(val1/(val1+val2)*100)}
// ICMP
fetch('http://localhost/J3M/ajax/ICMP/getDataIcmp.php')
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
        let pourcentageIpv6 = pourcentage(nbIpv6,nbIpv4)
        let pourcentageIpv4 = pourcentage(nbIpv4,nbIpv6)
        console.log(pourcentageIpv6)
        console.log(pourcentageIpv4)
        // taux de Ping OK
        let pingOK =0
        let pingKO =0
        
        data.forEach(element => {
            if(element.protocol_type == 8){
                if(element.protocol_checksum__status == 'good'){
                    pingOK++;
                }else{
                    pingKO++;
                }
            }
            
        });
        let pourcentagePingOK = pourcentage(pingOK,pingKO)
        console.log(pourcentagePingOK)
        // Graphique IPv4 IPV6
        protocolNameCanvas = document.getElementById('canvasIcmp1');
        let protocolName   = protocolNameCanvas.getContext('2d');
        protocolName.canvas.width = 400;
        
        let protocolNameConfig = {
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
        let protocolNameChart = new Chart(protocolName, protocolNameConfig);
        // taux de ping à l'état good


}) // fin du fectch

