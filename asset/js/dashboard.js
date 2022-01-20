//FONCTION CONVERTIR HEXA EN IP
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
    }).then(function (data) {
        //Recupération des données présent en base
        console.log(data)

        //VARIABLES DATA
        //Calcul ttl pour camembert
        let ttl = data.map(function (e) {
            return e.ttl;
        });
        let ttlMax = ttl.length * 128;
        let ttlOk = getTtl(ttl);
        let ttlKo = ttlMax - ttlOk;
        let pourcentageTtlOk = Math.round(ttlOk / ttlMax * 100);
        let pourcentageTtlKo = Math.round(ttlKo / ttlMax * 100);

        let identification = data.map(function (e) {
            return e.identification;
        })


        //Variables de status
        let countStatusGood = 0
        let countStatusDisabled = 0
        let countStatusAnother = 0
        data.forEach(element => {
            if (element.protocol_checksum__status === "good") {
                countStatusGood++
            } else if (element.protocol_checksum__status === "disabled") {
                countStatusDisabled++
            } else {
                countStatusAnother++
            }
        })
        let pourcentageStatusGood = Math.round(countStatusGood / data.length * 100);
        let pourcentageStatusDisabled = Math.round(countStatusDisabled / data.length * 100);
        let pourcentageStatusAnother = Math.round(countStatusAnother / data.length * 100);

        //Variables nom de protocol

        let countUDP = 0;
        let countTLS = 0;
        let countICMP = 0;
        let countTCP = 0;
        let countAnotherName = 0;

        data.forEach(element => {
            if (element.protocol_name === "UDP") {
                countUDP++
            } else if (element.protocol_name === "TLSv1.2") {
                countTLS++
            } else if (element.protocol_name === "ICMP") {
                countICMP++
            } else if (element.protocol_name === "TCP") {
                countTCP++
            }

        })


        //Variables ICMP Error


        //GRAPHIQUES
        //Nom de protocole

        protocolNameCanvas = document.getElementById('canvas1');
        let protocolName = protocolNameCanvas.getContext('2d');
        protocolName.canvas.width = 400;

        let protocolNameConfig = {
            type: 'polarArea',
            data: {
                labels: ['UDP : ' + countUDP, 'TLSv1.2 : ' + countTLS, 'ICMP : ' + countICMP, 'TCP : ' + countTCP],
                datasets: [{
                    data: [countUDP, countTLS, countICMP, countTCP],
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
                title: {
                    display: true,
                    fontSize: 30,
                    position: 'top',
                    text: 'Répartition des protocoles',
                },
                legend: {
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
                labels: ['TTL Ok: ' + pourcentageTtlOk + '%', 'TTL Perte: ' + pourcentageTtlKo + '%'],
                datasets: [{
                    data: [ttlOk, ttlKo],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.4)',
                        'rgba(255, 99, 132, 0.4)',
                    ],
                }]
            },
            options: {
                responsive: false,
                title: {
                    display: true,
                    fontSize: 30,
                    position: 'top',
                    text: 'Taux de TTL',
                },
                legend: {
                    position: 'right',
                }
            }
        };

        //Initialisation du graph
        let ttlChart = new Chart(ttlGraph, ttlConfig);


        //Recupération des ip dest en bdd

        let ajaxIpData = fetch('http://localhost/J3M/ajax/getIpJson.php')
            .then(function (response) {
                return response.json()
            }).then(function (data) {
                console.log(data)

                let ip_dest = data.map(function (e) {
                    return getIpNumber(e.ip_dest);
                });
                let nb_request = data.map(function (e) {
                    return e.nbIp;
                });

                //GAPH IP

                threeCanvas = document.getElementById('canvas3');
                let three = threeCanvas.getContext('2d');
                three.canvas.width = 1000;
                let threeConfig = {
                    type: 'bar',
                    data: {
                        labels: ip_dest,
                        datasets: [{
                            label: 'Occurrence de requête par IP',
                            data: nb_request,
                            backgroundColor: "#B0F2B6",
                            borderColor: "green",
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                            }
                        },
                        responsive: true,
                        maintainAspectRatio: false,
                        title: {
                            display: true,
                            fontSize: 30,
                            position: 'top',
                            text: 'Requêtes ip',
                        },
                        legend: {
                            position: 'top',
                        },
                    }
                };

                let threeChart = new Chart(three, threeConfig);
            })

        //Graph Status

        statusCanvas = document.getElementById('canvas4');
        let status = statusCanvas.getContext('2d');
        status.canvas.width = 450;

        let statusConfig = {
            type: 'pie',
            data: {
                labels: ['Status "good": ' + pourcentageStatusGood + '%', 'Status "disabled": ' + pourcentageStatusDisabled + '%', 'Status "another": ' + pourcentageStatusAnother + '%'],
                datasets: [{
                    data: [countStatusGood, countStatusDisabled, countStatusAnother],
                    backgroundColor: [
                        'rgb(253,100,46)',
                        'rgb(143,166,229)',
                        'rgb(246,130,86)'
                    ],
                }]
            },
            options: {
                responsive: false,
                title: {
                    display: true,
                    fontSize: 30,
                    position: 'top',
                    text: 'Somme de contrôle',
                },
                legend: {
                    position: 'right',
                }
            }
        };

        //Initialisation du graph
        let statusChart = new Chart(status, statusConfig);


        //Graph Error ICMP
        let ajaxDataICMP = fetch('http://localhost/J3M/ajax/getICMPJson.php')
            .then(function (response) {
                return response.json()
            }).then(function (data) {
                console.log(data)

                let countNbIcmp = 0;
                data.forEach(element => {
                    if (element.nbICMP) {
                        countNbIcmp++
                    }
                })

                let countTimeout = 0;
                data.forEach(element => {
                    if (element.status === "timeout") {
                        countTimeout++
                    }
                })
                let countIcmpOk = countNbIcmp - countTimeout;

                console.log(countTimeout)
                console.log(countIcmpOk)

                //GRAPH ERROR ICMP

                IcmpErrorCanvas = document.getElementById('canvas5');
                let IcmpError = IcmpErrorCanvas.getContext('2d');
                IcmpError.canvas.width = 450;
                let IcmpErrorConfig = {
                    type: 'doughnut',
                    data: {
                        labels: ['Status timeout : ' + countTimeout, 'Status ok : ' + countIcmpOk],
                        datasets: [{
                            data: [countTimeout ,countIcmpOk],
                            backgroundColor: [
                                'rgb(255, 205, 86)',
                                'rgb(75, 192, 192)',
                            ],
                        }]
                    },
                    options: {
                        responsive: false,
                        title: {
                            display: true,
                            fontSize: 30,
                            position: 'top',
                            text: 'Status trames ICMP',
                        },
                        legend: {
                            position: 'right',
                        },
                    }
                };

                let IcmpErrorChart = new Chart(IcmpError, IcmpErrorConfig);
            })
    })










