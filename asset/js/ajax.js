// Partie Ajax
const getDataJson = async function(){
    let response = await fetch('http://localhost/J3M/ajax/getDataJson.php')
    if (response.ok){
        let data = await response.json()
        return data
    }else{
      console.log('Erreur serveur : ', response.status)  
    }
    
}
console.log(getDataJson())


