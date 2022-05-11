function  makeprice()
    {
/*Výpočet celkové ceny*/

//*****************************nastaveni casovych udaju***********************
//tyto údaje neměnit!

var date = new Date(); // vytvoří proměnnou obsahující aktuální datum
var thistime = date.getTime(); //zjištění počtu milisekund od 1970
var thishour = date.getHours(); //zjisteni aktualni hodiny
var oneday = 1*24*60*60*1000;  //délka jednoho dne v milisekundach
var thisday = date.getDay();   //pořadové číslo aktuálního dne v týdnu

var date2 = new Date();  //druha promena s datumem
var retezec = $('#frm-term').val();   //rozebere obsah pole s terminem na casti...
var pole = retezec.split(".");
date2.setFullYear(pole[2]);  //... a dosadi je do pole s datumem (změna data)
date2.setMonth(pole[1] - 1);
date2.setDate(pole[0]);
var term = date2.getTime();  //zjisteni poctu miliseknud z noveho datumu

// (term - thistime)  rozdil mezi daty v milisekundach
var lenght = term  - thistime;
//*********************prevod zadaneho data na casti*******************


//*********************cenove tarify, limity********************************
//tyto údaje lze měnit:

var p1 = 400;  //cenovy tarif 1
var p2 = 320;  //cenovy tarif 2
var p3 = 199;  //cenovy tarif 3

var limithour = 16;  //hodina, ktera rozhoduje o preklopeni ceniku o den (od teto hodiny uz preklopuje)

var afterholiday = new Date();
afterholiday.setFullYear(pole[2]);  //... a dosadi je do pole s datumem (změna data)
afterholiday.setMonth(04);
afterholiday.setDate(09);

var afterafterholiday = new Date();
afterafterholiday.setFullYear(pole[2]);  //... a dosadi je do pole s datumem (změna data)
afterafterholiday.setMonth(04);
afterafterholiday.setDate(10);
//*****************************************************************



if(thisday==3){  //středa
  if(thishour < limithour){
    if(lenght <= oneday){
      var priceone = p1;
    } 
    else if(lenght <= (oneday*2)){
      var priceone = p2;
    }
    else{
      var priceone = p3;
    }
    
  }
  else{
    if(lenght <= (oneday*4)){
      var priceone = p1;
    }
    else if(lenght <= (oneday*5)){
      var priceone = p2;
    }
    else{
      var priceone = p3;
    }
  }

}

else if(thisday==4){    //čtvrtek
  if(thishour < limithour){
  
    if(lenght <= oneday){
      var priceone = p1;
    } 
    else if(lenght <= (oneday*4)){
      var priceone = p2;
    }
    else{
      var priceone = p3;
    }
  }
  else{
    if(lenght <= (oneday*4)){
      var priceone = p1;
    } 
    else if((term - thistime) <= (oneday*5)){
      var priceone = p2;
    }
    else{
      var priceone = p3;
    }  
  }

}
else if(thisday==5){ //pátek
  if(thishour < limithour){ 
    if(lenght <= (oneday*3)){
      var priceone = p1;
    }
    else if(lenght <= (oneday*4)){
      var priceone = p2;
    }
    else{
      var priceone = p3;
    }
  }
  else{
    if(lenght <= (oneday*4)){
      var priceone = p1;
    }
    else if(lenght <= (oneday*5)){
      var priceone = p2;
    }
    else{
      var priceone = p3;
    }
  }

}
else if(thisday==6){ //sobota
  if(lenght <= (oneday*3)){
    var priceone = p1;
  }
  else if(lenght <= (oneday*4)){
    var priceone = p2;
  }
  else{
    var priceone = p3;
  }

}
else if(thisday==0){  //neděle
  if(lenght <= (oneday*2)){
    var priceone = p1;
  }
  else if(lenght <= (oneday*3)){
    var priceone = p2;
  }
  else{
    var priceone = p3;
  }

}
else{  //pondělí + úterý
  if(thishour < limithour){ 
    if(lenght <= oneday){
      var priceone = p1;
    }
    else if(lenght <= (oneday*2)){
      var priceone = p2;
    }
    else{
      var priceone = p3;
    }
  }
  else{
    if(lenght <= (oneday*2)){
      var priceone = p1;
    }
    else if(lenght <= (oneday*3)){
      var priceone = p2;
    }
    else{
      var priceone = p3;
    }
  }
}


/*
if((term - thistime) <= oneday){
  var priceone = 400;
} 
else if((term - thistime) <= (oneday*2)){
  var priceone = 3200;
  if(((thisday >= 5) || (thisday == 0)) || (thishour >= 16)){
  var priceone = 400;
  }
}
else if((term - thistime) <= (oneday*3)){
  var priceone = 199;
  if(((thisday >= 5) || (thisday == 0)) || (thishour >= 16)){
  var priceone = 320;
  }
} 
else if((term - thistime) <= (oneday*4)){
  var priceone = 199;
  if(((thisday >= 4) || (thisday == 0)) || (thishour >= 16)){
  var priceone = 320;
  }
}
else{
  var priceone = 199;  

} 
*/
if(afterholiday.getTime() == term){
  if(priceone == p2){
  priceone = p1;
  }
  if(priceone == p3){
  priceone = p2;
  }
//$('#frm-message').val('ano');
}
if(afterafterholiday.getTime() == term){
  if(priceone == p2){
  priceone = p1;
  }
  if(priceone == p3){
  priceone = p2;
  }
//$('#frm-message').val('ano');
}
var dayafter = afterholiday.getTime() + oneday;
if(dayafter == term){
  if(priceone == p3){
  priceone = p2;
  }
}
var price = (priceone * $('#frm-counthard').val()) + ($('#frm-countring').val() * 70) + ($('#frm-countcd').val() * 20) + ($('#frm-countannex').val() * 90);
$('#showprice-mobile').html(price); 
$('#showprice-desktop').html(price);
$('#frm-price').val(price);
$('#frm-priceone').val(priceone);

/*konec výpočtu*/    
    } 
