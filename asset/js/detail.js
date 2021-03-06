function pourcentage(val1,val2) {return Math.round(val1/(val1+val2)*100)}
function getLogDate(logDate){
    logDate *= 1000
    let date = new Date(logDate)
    let day      = date.getDate().toString()
    day = (day.toString().length === 1) ? '0'+day : day  
    let month    = date.getMonth()
    month = (month.toString().length === 1) ? '0'+month : month  
    let year     = date.getFullYear()
    let hours    = date.getHours()
    hours = (hours.toString().length === 1) ? '0'+hours : hours  
    let minutes  = date.getMinutes()
    minutes = (minutes.toString().length === 1) ? '0'+minutes : minutes  
    let seconde  = date.getSeconds()
    seconde = (seconde.toString().length === 1) ? '0'+seconde : seconde  
    let dateClean= day+'/'+month+'/'+year+' '+hours+':'+minutes+':'+seconde
return dateClean
}
// créer un tableau count de 0 à 23 qui corespond au nombre d'heure
// Si il y a une valeur on l'ajoute au tableau count
// ce tableau sert à mettre les données ensuite dans les nombre de trames par heure
function getCount(array){
    let count = [];
    for (let i = 0; i< 24; i++){
        count[i] = 0
    }
    array.forEach(element => {
    for (let i = 0; i< 24; i++ ){
        if(element == i)count[i]++             
        }
    })

    return count
}


///////////////////////////////////////////////////////// ICMP //////////////////////////////////////
fetch('http://localhost/J3M/ajax/ICMP/getDataIcmp.php')
    .then (function(response){  
        return response.json()
    }).then(function (data){

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
                    data: [nbIpv4, nbIpv6],
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
        protocolName.canvas.width = 600        
        let protocolNameConfig = {
            type: 'bar',
            
            data: {
                labels: ['Ping OK : '+pourcentagePingOK+'%','Ping KO : '+pourcentagePingKO+'%'],
                datasets: [{
                    data: [pingOK,pingKO],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',                                              
                        'rgba(255, 99, 132, 0.2)',                                              
                    ], },{
                        type: 'line',
                        label: 'Ping KO',
                        data: [pingKO],
                        backgroundColor:'rgba(255, 99, 132, 0.2)', 
                    },{
                        type: 'line',
                        label: 'Ping OK',
                        data: [pingOK],
                        backgroundColor:'rgba(255, 99, 132, 0.2)', 
                    }           
                ]},                
            options: { 
                scales: {
                    yAxes: [{
                        display: true,
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },                
                responsive: false,
                title: {
                    display: true,
                    fontSize: 30,
                    position: 'top',
                    text: 'Taux de ping valide',
                },
                legend: {
                    display: false,                
                },
                
            }
        };
        let protocolNameChart = new Chart(protocolName, protocolNameConfig);
        let ipDate = data.map(function (e) {
                return getLogDate(e.date);
        }); 

        /////////////////////////// INIATILASATION ////////////////////////////////
        let tab = []
        ipDate.forEach(element => {
            const nbrDate = parseInt(element.substring(11, 14))
            tab.push(nbrDate)
        });

        // ///////////////////////////TABLEAU Count//////////////////////////
        let count = getCount(tab);

        // array.pop modifie l'objet data, on en créer une copie pour ne pas aletéré l'original
        let data2 = Array.from(data);        
        const infosICMP = document.querySelector('#infosICMP');
        infosICMP.innerHTML = `Il y a ${data.length} trames ${data[0].protocol_name} depuis le ${getLogDate(data2.pop().date).substring(0, 10)}`; 
       
        // //////////////////////////////////////// Nombre De ping Ip selon L'heure /////////////////////
        threeCanvas = document.getElementById('canvasIcmp3')
        let three = threeCanvas.getContext('2d')
        three.canvas.width = 1000;
        let threeConfig = {
            type: 'bar',
            data: {
                labels: ["0h", "1h", "2h", "3h", "4h", "5h", "6h","7h","8h","9h","10h","11h","12h","13h","14h","15h","16h","17h","18h","19h","20h","21h","22h","23h"],
                datasets: [{
                    label: 'Nombre de trame ICMP en fonction des heures',
                    data: count,
                    backgroundColor: "#FB9D2C",
                    borderColor: "#FB9D2C",
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        display: true,
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                responsive: false,
                title: {
                    display: true,
                    fontSize: 30,
                    position: 'top',
                    text: 'Moyenne des trames reçu chaques heures',
                },
                legend: {
                    position: 'bottom'
                },
            }
        };

        let threeChart = new Chart(three, threeConfig);

        


}) // fin du fectch







///////////////////////////////////////////////////////// TCP //////////////////////////////////////


fetch('http://localhost/J3M/ajax/TCP/getDataTcp.php')
    .then (function(response){
        return response.json()
    }).then(function (data){
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
        protocolNameCanvas = document.getElementById('canvasTcp1');
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

        // array.pop modifie l'objet data, on en créer une copie pour ne pas aletéré l'original
        let data2 = Array.from(data);
        
        const infosTCP = document.querySelector('#infosTCP');
        infosTCP.innerHTML = `Il y a ${data.length} trames ${data[0].protocol_name} depuis le ${getLogDate(data2.pop().date).substring(0, 10)}`; 
        
        


        /////////////////////////////////  CHART JS TABLEAU IP EN FONCTION DES HEURES ///////////

        let ipDate = data.map(function (e) {
            return getLogDate(e.date);
        }); 

        /////////////////////////// INIATILASATION ////////////////////////////////
        let tab = []
        ipDate.forEach(element => {
            const nbrDate = parseInt(element.substring(11, 14))
            tab.push(nbrDate)
        });   

        // ///////////////////////////TABLEAU count//////////////////////////
        let count = getCount(tab);
        // //////////////////////////////////////// Nombre De ping Ip selon L'heure /////////////////////
        threeCanvas = document.getElementById('canvasTcp3');
        let three = threeCanvas.getContext('2d');
        three.canvas.width = 1000;
        let threeConfig = {
            type: 'bar',
            data: {
                labels: ["0h", "1h", "2h", "3h", "4h", "5h", "6h","7h","8h","9h","10h","11h","12h","13h","14h","15h","16h","17h","18h","19h","20h","21h","22h","23h"],
                datasets: [{
                    label: 'Nombre de trame TCP en fonction des heures',
                    data: count,
                    backgroundColor: "#FB9D2C",
                    borderColor: "#FB9D2C",
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
                    text: 'Nombre de trame TCP en fonction des heures',
                },
                legend: {
                    position: 'bottom'
                },
            }
        };
        let threeChart = new Chart(three, threeConfig);
}) // fin du fectch

///////////////////////////////////////////////////////// TLS //////////////////////////////////////
fetch('http://localhost/J3M/ajax/TLS/getDataTls.php')
    .then (function(response){
        return response.json()
    }).then(function (data){
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
        protocolNameCanvas = document.getElementById('canvasTls1');
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

        // array.pop modifie l'objet data, on en créer une copie pour ne pas aletéré l'original
        let data2 = Array.from(data);
        
        const infosTLS = document.querySelector('#infosTLS');
        infosTLS.innerHTML = `Il y a ${data.length} trames ${data[0].protocol_name} depuis le ${getLogDate(data2.pop().date).substring(0, 10)}`; 

        
        /////////////////////////////////  CHART JS TABLEAU IP EN FONCTION DES HEURES ///////////

        /////////////////////FUNCTION POUR TRANSFORMER LA DATE EN DATE LISIBLE////////////////////
        let ipDate = data.map(function (e) {
            return getLogDate(e.date);
        }); 
        /////////////////////////// INIATILASATION ////////////////////////////////
        let tab = []
        ipDate.forEach(element => {

            const nbrDate = parseInt(element.substring(11, 14))
            tab.push(nbrDate)
        });   

    
        // ///////////////////////////TABLEAU ASSOCIATIF//////////////////////////
        let count = getCount(tab);
        // //////////////////////////////////////// Nombre De ping Ip selon L'heure /////////////////////
        threeCanvas = document.getElementById('canvasTls3');
        let three = threeCanvas.getContext('2d');
        three.canvas.width = 1000;
        let threeConfig = {
            type: 'bar',
            data: {
                labels: ["0h", "1h", "2h", "3h", "4h", "5h", "6h","7h","8h","9h","10h","11h","12h","13h","14h","15h","16h","17h","18h","19h","20h","21h","22h","23h"],
                datasets: [{
                    label: 'Nombre de trame TLS en fonction des heures',
                    data: count,
                    backgroundColor: "#FB9D2C",
                    borderColor: "#FB9D2C",
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        display: true,
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                responsive: true,
                maintainAspectRatio: false,
                title: {
                    display: true,
                    fontSize: 30,
                    position: 'top',
                    text: 'Nombre de trame TLS en fonction des heures',
                },
                legend: {
                    position: 'bottom',
                },
            }
        };
        let threeChart = new Chart(three, threeConfig);

}) // fin du fectch


///////////////////////////////////////////////////////// UDP //////////////////////////////////////

fetch('http://localhost/J3M/ajax/UDP/getDataUdp.php')
    .then (function(response){
        return response.json()
    }).then(function (data){
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
        protocolNameCanvas = document.getElementById('canvasUdp1');
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
        // array.pop modifie l'objet data, on en créer une copie pour ne pas aletéré l'original
        let data2 = Array.from(data);
        
        const infosUDP = document.querySelector('#infosUDP');
        infosUDP.innerHTML = `Il y a ${data.length} trames ${data[0].protocol_name} depuis le ${getLogDate(data2.pop().date).substring(0, 10)}`; 


    /////////////////////////////////  CHART JS TABLEAU IP EN FONCTION DES HEURES ///////////

    /////////////////////FUNCTION POUR TRANSFORMER LA DATE EN DATE LISIBLE////////////////////
        let ipDate = data.map(function (e) {
            return getLogDate(e.date);
        }); 
        /////////////////////////// INIATILASATION ////////////////////////////////
        let tab = []
        ipDate.forEach(element => {
            const nbrDate = parseInt(element.substring(11, 14))
            tab.push(nbrDate)
        });     
    // ///////////////////////////TABLEAU ASSOCIATIF//////////////////////////
        let count = getCount(tab);
        // //////////////////////////////////////// Nombre De ping Ip selon L'heure /////////////////////
        threeCanvas = document.getElementById('canvasUdp3');
        let three = threeCanvas.getContext('2d');
        three.canvas.width = 1000;
        let threeConfig = {
            type: 'bar',
            data: {
                labels: ["0h", "1h", "2h", "3h", "4h", "5h", "6h","7h","8h","9h","10h","11h","12h","13h","14h","15h","16h","17h","18h","19h","20h","21h","22h","23h"],
                datasets: [{
                    label: 'Nombre de trame UDP en fonction des heures',
                    data: count,
                    backgroundColor: "#FB9D2C",
                    borderColor: "#FB9D2C",
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        display: true,
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                responsive: true,
                maintainAspectRatio: false,
                title: {
                    display: true,
                    fontSize: 30,
                    position: 'top',
                    text: 'Nombre de trame UDP en fonction des heures',
                },
                legend: {
                    position: 'bottom',
                },
            }
        };
        let threeChart = new Chart(three, threeConfig);

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
