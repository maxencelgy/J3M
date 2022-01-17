export function getIpNumber(hexaIp){
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

export function getLogDate(logDate){
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