//FONCTION CALCUL

// TTL manquante = TTL max - TTL presente

function getTtl(array){
    //Somme des ttl
    let ttlOk = 0
    array.forEach(element => ttlOk += parseInt(element))
    return ttlOk
}

// Partie Ajax
let ajaxData = fetch('http://localhost/J3M/ajax/getDataJson.php')
    .then (function(response){
        return response.json()
    }).then(function (data){
        //Recupération des données présent en base
        console.log(data)

        //VARIABLES DATA

        let id = data.map(function(e) {
            return e.id_jsondata;
        });

        //Calcul ttl pour camembert
        let ttl = data.map(function(e) {
            return e.ttl;
        });
        let ttlMax           = ttl.length * 128;
        let ttlOk            = getTtl(ttl);
        let ttlKo            = ttlMax - ttlOk;
        let pourcentageTtlOk = Math.round(ttlOk/ttlMax * 100);
        let pourcentageTtlKo = Math.round(ttlKo/ttlMax * 100);

        let identification = data.map(function (e){
            return e.identification;
        })

        //Variables de status
        let countStatusGood = 0
        let countStatusDisabled =0
        let countStatusAnother =0
        data.forEach(element => {
            if(element.protocol_checksum__status === "good"){
                countStatusGood++
            }else if(element.protocol_checksum__status === "disabled"){
                countStatusDisabled++
            }
            else{
                countStatusAnother++
            }
        })
        let pourcentageStatusGood = Math.round(countStatusGood/data.length * 100);
        let pourcentageStatusDisabled = Math.round(countStatusDisabled/data.length * 100);
        let pourcentageStatusAnother = Math.round(countStatusAnother/data.length * 100);

        //Variables nom de protocol

        let countUDP = 0;
        let countTLS = 0;
        let countICMP = 0;
        let countTCP = 0;
        let countAnotherName = 0;

        data.forEach(element => {
            if(element.protocol_name === "UDP"){
                countUDP++
            }else if(element.protocol_name === "TLSv1.2"){
                countTLS++
            }
            else if(element.protocol_name === "ICMP"){
                countICMP++
            }
            else if(element.protocol_name === "TCP"){
                countTCP++
            }else{
                countAnotherName++
            }

        })



        //GRAPHIQUES
        //Nom de protocole

        protocolNameCanvas = document.getElementById('canvas1');
        let protocolName = protocolNameCanvas.getContext('2d');
        protocolName.canvas.width = 400;

        let protocolNameConfig = {
            type: 'polarArea',
            data: {
                labels: ['UDP: '+countUDP, 'TLSv1.2 :'+countTLS, 'ICMP :'+countICMP, 'TCP :'+countTCP, 'Another: '+countAnotherName],
                datasets: [{
                    data: [countUDP, countTLS, countICMP, countTCP, countAnotherName],
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(75, 192, 192)',
                        'rgb(255, 205, 86)',
                        'rgb(54, 162, 235)',
                        'rgb(201, 203, 207)'
                    ],
                }]
            },
            options: {
                responsive: false,
                title:{
                    display: true,
                    fontSize: 30,
                    position: 'top',
                    text: 'Répartition des protocoles',
                },
                legend:{
                    position: 'right',
                }
            }
        };

        //Initialisation du graph
        let protocolNameChart = new Chart(protocolName, protocolNameConfig);


        //graph ttl

        ttlCanvas = document.getElementById('canvas2');
        let ttlGraph = ttlCanvas.getContext('2d');
        ttlGraph.canvas.width = 400;

        //Config graph avec options et données

        let ttlConfig = {
            type: 'pie',
            data: {
                labels: ['TTL Ok: '+pourcentageTtlOk+'%', 'TTL Perte: '+pourcentageTtlKo+'%'],
                datasets: [{
                    data: [ttlOk,ttlKo],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.4)',
                        'rgba(255, 99, 132, 0.4)',
                    ],
                }]
            },
            options: {
                responsive: false,
                title:{
                    display: true,
                    fontSize: 30,
                    position: 'top',
                    text: 'Taux de TTL',
                },
                legend:{
                    position: 'right',
                }
            }
        };

        //Initialisation du graph
        let ttlChart = new Chart(ttlGraph, ttlConfig);

        //Troisieme

        threeCanvas = document.getElementById('canvas3');
        let three = threeCanvas.getContext('2d');
        three.canvas.width = 1000;
        let threeConfig = {
            type: 'bar',
            data: {
                labels: identification,
                datasets: [{
                    label: 'TTL',
                    data: ttl,
                    backgroundColor: [
                        'green'
                    ],
                }]
            },
            options: {
                responsive: false,
                title:{
                    display: true,
                    fontSize: 30,
                    position: 'top',
                    text: 'Requêtes ip',
                },
                legend:{
                    position: 'right',
                }
            }
        };

        let threeChart = new Chart(three, threeConfig);

        //Graph Status

        statusCanvas = document.getElementById('canvas4');
        let status = statusCanvas.getContext('2d');
        status.canvas.width = 400;

        let statusConfig = {
            type: 'pie',
            data: {
                labels: ['Status "good": '+pourcentageStatusGood+'%', 'Status "disabled": '+pourcentageStatusDisabled+'%', 'Status "another": '+pourcentageStatusAnother+'%'],
                datasets: [{
                    data: [countStatusGood,countStatusDisabled, countStatusAnother],
                    backgroundColor: [
                        'rgba(2,194,100,0.65)',
                        'rgba(253,1,47,0.65)',
                        'rgba(100, 50, 125, 0.4)',
                    ],
                }]
            },
            options: {
                responsive: false,
                title:{
                    display: true,
                    fontSize: 30,
                    position: 'top',
                    text: 'Checksum status',
                },
                legend:{
                    position: 'right',
                }
            }
        };

        //Initialisation du graph
        let statusChart = new Chart(status, statusConfig);


        //
})


