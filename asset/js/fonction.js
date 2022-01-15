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

function getLogDate(logDate){
  logDate *= 1000
  let date = new Date(logDate)
  day      = date.getDate()
  month    = date.getMonth()
  year     = date.getFullYear()
  hours    = date.getHours()
  minutes  = date.getMinutes()
  seconde  = date.getSeconds()
  dateClean= day+'/'+month+'/'+year+' '+hours+':'+minutes+':'+seconde
return dateClean
}