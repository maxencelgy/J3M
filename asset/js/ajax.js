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
        let protocolName = data.map(function(e) {
            return e.protocol_name;
        });

        //Calcul ttl pour camembert
        let ttl = data.map(function(e) {
            return e.ttl;
        });
        let ttlMax = ttl.length * 128;
        let ttlOk = getTtl(ttl);
        let ttlKo = ttlMax - ttlOk;


        let identification = data.map(function (e){
            return e.identification;
        })


        //GRAPHIQUES
        //first graph ttl

        firstCanvas = document.getElementById('canvas1');
        let first = firstCanvas.getContext('2d');
        let firstConfig = {
            type: 'line',
            data: {
                labels: identification,
                datasets: [{
                    label: 'Graph Line',
                    data: ttl,
                    backgroundColor: [
                        'blue'
                    ],
                }]
            },
            options: {
                responsive: false
            }
        };

        let firstChart = new Chart(first, firstConfig);

        //second graph ttl

        secondCanvas = document.getElementById('canvas2');
        let second = secondCanvas.getContext('2d');
        let secondConfig = {
            type: 'pie',
            data: {
                labels: ['TTL Ok', 'TTL Perte'],
                datasets: [{
                    label: 'Graph Line',
                    data: [ttlKo,ttlOk],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.4)',
                        'rgba(75, 192, 192, 0.4)'
                    ],
                }]
            },
            options: {
                responsive: false
            }
        };

        let secondChart = new Chart(second, secondConfig);
})

