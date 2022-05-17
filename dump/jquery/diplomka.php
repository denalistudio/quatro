<?php 
require 'Nette/loader.php'; 
date_default_timezone_set('Europe/Prague');
?>
<?php
//funkce na převod řetězců
function friendly_url($old_url) {
    $url = $old_url;
    $url = preg_replace('~[^\\pL0-9_]+~u', '-', $url);
    $url = trim($url, "-");
    $url = iconv("utf-8", "us-ascii//TRANSLIT", $url);
    $url = strtolower($url);
    $url = preg_replace('~[^-a-z0-9_]+~', '', $url);
    return $url;
}

  
//use Nette\Forms\Form;  jen verze php 5.3
//use Nette\Mail\Message; jen verze php 5.3
/******************************VYTVOŘENÍ FORMULÁŘE********************************/
$form = new NForm;
$form->getElementPrototype()->id('frm-');
$form->addText('name', 'Jméno a Příjmení:')
      ->setHtmlId('frm-')
     ->setRequired('Nutno vyplnit');
$form->addText('email', 'E-mail:')
     ->setRequired('Nutno vyplnit')
     ->addRule(NForm::EMAIL, 'Toto není platný email');
$form->addText('phone', 'Telefon:')
     ->setRequired('Nutno vyplnit');

$i = 0;
while($i<=6){ //toto číslo nahraďte pro maximální počet kopií diplomek
$countcopies[$i]=$i;
$i++;
}

$form->addSelect('counthard', 'Počet zhotovení pevných desek:', $countcopies)
     ->setPrompt('Zvolte počet')
     ->setRequired('Nutno vyplnit');    
$form->addSelect('countring', 'Počet zhotovení kroužkových vazeb:', $countcopies)
     ->setPrompt('Zvolte počet')
     ->setRequired('Nutno vyplnit');

$form->addText('term', 'Požadovaný termín zhotovení:')
     ->setRequired('Nutno vyplnit');
    

$type = array(
    '5mm (AA) 20-40 listů' => '20-40 listů',
    '10mm (A) 41-90 listů' => '41-90 listů',
    '13mm (B) 91-120 listů' => '91-120 listů',
    '16mm (C) 121-145 listů' => '121-145 listů',
    '20mm (D) 146-185 listů' => '146-185 listů',
    '24mm (E) 186-230 listů' => '186-230 listů',
    '28mm (F) 231-265 listů' => '231-265 listů',
    '32mm (G) 266-300 listů' => '266-300 listů'
);

$form->addSelect('type', 'Moje práce má:', $type)
     ->setPrompt('Zvolte počet listů')
     ->setRequired('Nutno vyplnit');
     
$colors = array(
    'Černá' => 'Černá',
    'Modrá' => 'Modrá',
    'Bordó'  => 'Bordó'
);
$form->addSelect('color', 'Barva desek:', $colors)
     ->setPrompt('Zvolte barvu desek')
     ->setRequired('Nutno vyplnit');
     
$textcolors = array(
    'Zlatý tisk' => 'Zlatý tisk',
    'Stříbrný tisk' => 'Stříbrný tisk'
);
$form->addSelect('textcolor', 'Barva písma:', $textcolors)
    ->setPrompt('Zvolte barvu písma')
    ->setRequired('Nutno vyplnit');
                          
$form->addSelect('countcd', 'Chci do vazby i kapsy na CD/DVD: (zadej celkový počet kapes)', $countcopies)
     ->setPrompt('Zvolte počet')
     ->setRequired('Nutno vyplnit');
     
$form->addSelect('countannex', 'Chci do vazby i chlopně na přílohy: (zadej celkový počet chlopní)', $countcopies)
     ->setPrompt('Zvolte počet')
     ->setRequired('Nutno vyplnit');
     
$form->addCheckbox('otherlists', 'Budu do vazby vkládat ještě nějaké listy (např. originál zadání)');     

$form->addTextarea('message', 'Poznámka:');

$form->addUpload('fileinfo', 'Soubor s údaji na desky (.pdf, .doc, .docx):')
     ->addRule(NForm::MAX_FILE_SIZE, 'Maximální velikost souboru je 5 MB.', 5120 * 1024 /* v bytech */);
     //->addRule(Form::REGEXP, "bad", '/^.*\.(doc|docx|pdf)$/');
     //->addRule(Form::MIME_TYPE, 'Přílohou musí být PDF soubor','application/msword,application/pdf,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/x-pdf,application/acrobat,applications/vnd.pdf,text/pdf, text/x-pdf');
     //->addRule(Form::MIME_TYPE, 'Přílohou musí být PDF soubor', 'application/pdf,application/x-pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document');

/*------------------------------------------------------------*/  
$form->addCheckbox('printall', 'Chci vytisknout i samotnou práci');   
$form->addSelect('countprint', 'Počet výtisků:', $countcopies)
     ->setPrompt('Zvolte počet');  

$printtype = array(
    'Černobíle vše' => 'Černobíle vše',
    'Černobíle a barevné stránky barevně' => 'Černobíle a barevné stránky barevně'
);
$form->addSelect('printtype', 'Typ tisku:', $printtype)
    ->setPrompt('Zvolte typ tisku');
                                       
$form->addUpload('file', 'Soubor k tisku (.pdf):')
     ->addCondition(NForm::FILLED)
               // ->addRule(Form::MIME_TYPE, 'Súbor musí byť obrázok', 'image/*')
     ->addRule(NForm::MAX_FILE_SIZE, 'Maximální velikost souboru je 5 MB.', 5120 * 1024 /* v bytech */);
     //->addRule(Form::REGEXP, "bad", '/^.*\.pdf$/');
     //->addRule(Form::MIME_TYPE, 'Přílohou musí být PDF soubor', 'application/pdf, application/x-pdf, application/acrobat, applications/vnd.pdf, text/pdf, text/x-pdf');

/*--------------------------------------------------------------------*/
$form->addCheckbox('licence', 'Souhlasím s obchodními podmínkami')
     ->addRule(NForm::EQUAL, 'Je potřeba souhlasit s podmínkami', TRUE); 
$form->addText('price', 'Cena:');     
$form->addSubmit('send', 'Odeslat závaznou objednávku');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
  <?php
  //meta
  echo "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'/>";
  echo "<meta name='description' content=''/>";                 
  echo "<meta name='keywords' content=''/>";
  echo "<meta name='robots' content='all'/>";
  echo "<meta name='googlebot' content='snippet,archive'/>";
  echo "<meta http-equiv='Content-language' content=''/>";
  echo "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'/>";
  echo "<meta name='author' content='BEfirst'/>";
  echo "<title></title>";
  
  echo "<link rel='stylesheet' href='style.css' type='text/css' media='screen' />";
  echo "<script type='text/javascript' src='Nette/live-form-validation.js'></script>"; 
  ?>
  <script src="http://code.jquery.com/jquery-latest.js"></script> 
  <link rel="stylesheet" href="jscripts/ui/themes/base/jquery.ui.all.css" />
	
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
<script src="jscripts/ui/i18n/jquery.ui.datepicker-cs.js"></script>
	<script>
function  formFieldCleaner(formObject)
    {
        $(":input", formObject)
                         .not(":button, :submit, :reset, :hidden")
                         .val("")
                         .removeAttr("checked")
                         .removeAttr("selected");     
    }

formFieldCleaner("#form"); 

</script>
	<script>
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
  var priceone = 320;
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
var price = (priceone * $('#frm-counthard').val()) + ($('#frm-countring').val() * 50) + ($('#frm-countcd').val() * 15) + ($('#frm-countannex').val() * 50); 
$('#showprice').html(price);
$('#frm-price').val(price);
/*konec výpočtu*/    
    } 

</script>

  </head>
<body>
<div id = "web">
<h1>Objednávka online</h1>

<?php $form->render('begin') ?>

<?php $form->render('errors') ?>
<?php /******************************VYKRESLENÍ FORMULÁŘE********************************/ ?>
<div id = 'form'>
<div class = 'form'>
<table>
<th><h2>Zákazník</h2></th><td></td>
<tr class="required">
    <th><?php echo $form['name']->label ?></th><td><?php echo $form['name']->control ?></td>
</tr>
<tr class="required">
    <th><?php echo $form['phone']->label ?></th><td><?php echo $form['phone']->control ?></td>
</tr>
<tr class="required">
    <th><?php echo $form['email']->label ?></th><td><?php echo $form['email']->control ?></td>
</tr>
<th><h2>Vazba práce</h2></th><td></td>
<tr class="required">
    <th><?php echo $form['counthard']->label ?></th><td><?php echo $form['counthard']->control ?></td>
</tr>
<tr class="required">
    <th><?php echo $form['countring']->label ?></th><td><?php echo $form['countring']->control ?></td>
</tr>
<tr class="required">
    <th><?php echo $form['term']->label ?></th><td><?php echo $form['term']->control ?></td>
</tr>
<tr class="required">
    <th><?php echo $form['type']->label; ?></th><td><?php echo $form['type']->control;?></td>
</tr>
<tr class="required">
    <th><?php echo $form['color']->label ?></th><td><?php echo $form['color']->control ?></td>
</tr>
<tr class="required">
    <th><?php echo $form['textcolor']->label ?></th><td><?php echo $form['textcolor']->control ?></td>
</tr>
<tr class="required">
    <th><?php echo $form['countcd']->label; ?></th><td><?php echo $form['countcd']->control;?></td>
</tr>
<tr class="required">
    <th><?php echo $form['countannex']->label; ?></th><td><?php echo $form['countannex']->control;?></td>
</tr>
<tr class="required">
    <th></th><td><?php echo $form['otherlists']->control; echo $form['otherlists']->label;?></td>
</tr>
<tr class="required">
    <th><?php echo $form['message']->label; ?></th><td><?php echo $form['message']->control;?></td>
</tr>
<tr class="required">
    <th><?php echo $form['fileinfo']->label; ?></th><td><?php echo $form['fileinfo']->control;?></td>
</tr>
<tr class="required">
    <th></th><td><?php echo $form['printall']->control; echo $form['printall']->label;?></td>
</tr>
</table>
</div>
 
<div class = 'form hide'>
<table>   
<tr>
<th><h2>Tisk práce</h2></th><td></td>
</tr> 
<tr class="required">
    <th><?php echo $form['printtype']->label; ?></th><td><?php echo $form['printtype']->control;?></td>
</tr>
<tr class="required">
    <th><?php echo $form['countprint']->label; ?></th><td><?php echo $form['countprint']->control;?></td>
</tr>
<tr class="required">
    <th><?php echo $form['file']->label ?></th><td><?php echo $form['file']->control ?></td>
</tr>
</table>
</div> 
<hr  />
<div class = 'form'>
<table> 
<tr>
    <th></th><td><?php echo $form['licence']->control;?><?php echo $form['licence']->label;?><br /><a href = "http://www.nastartuj.cz/obchodni_podminky.html" target = "_blank">Obchodní podmínky</a></td>
</tr>
<tr class="required">
    <th></th><td><?php echo $form['send']->control ?></td>
</tr>
</table>
</div>

</div>

<div id = "pricetab">
<h2>Výpočet ceny</h2>
<h3><p><span id = "showprice">0</span> Kč</p></h2>
<p class="required">Uvedená cena je pouze orientační a nezahrnuje cenu za samotný tisk listů práce a cenu kalkuluje s max. 4 řádky tisku na desky.</p>
</div>
<div class = "hideevery">
<?php echo $form['price']->control ?>
</div>
<?php $form->render('end') ?>


<?php


//echo $form; 
    
if ($form->isSubmitted() && $form->isValid()) {
$values = $form->getValues();        
//dump($values);
//$file = $form->values['fileinfo'];    
//$fileContent = file_get_contents($file);
$type = strtolower(substr($_FILES["fileinfo"]['name'],strrpos($_FILES["fileinfo"]['name'],".")));
$type2 = strtolower(substr($_FILES["file"]['name'],strrpos($_FILES["file"]['name'],".")));
//if((($type == ".doc") || ($type == ".docx") || ($type == ".pdf")) && (($type2 == ".pdf") || ($type2 == ""))){
$time = date("H:i");
$day = date("d.m.Y");
if($values["otherlists"] == 1) $values["otherlists"] = "Ano";
else $values["otherlists"] = "Ne";

$message = "$day, $time\n";
$message .= "Jméno: $values[name]\n";
$message .= "E-mail: $values[email]\n";
$message .= "Telefon: $values[phone]\n";
$message .= "Počet zhotovení pevných desek: $values[counthard]\n";
if($values["countring"] <> 0) $message .= "Počet zhotovení kroužkových vazeb: $values[countring]\n";
$message .= "Termín zhotovení: $values[term]\n";
$message .= "Typ desek: $values[type]\n";
$message .= "Barva desek: $values[color]\n";
$message .= "Barva písma: $values[textcolor]\n";
if($values["countcd"] <> 0) $message .= "Počet kapes na CD: $values[countcd]\n";
if($values["countannex"] <> 0) $message .= "Počet chlopní na přílohy: $values[countannex]\n";
$message .= "Budu do vazby vkládat ještě nějaké listy: $values[otherlists]\n";
if($values["message"] <> "") $message .= "Poznámka: $values[message]\n";
if($values["countprint"] <> "") $message .= "Počet výtisků: $values[countprint]\n";
if($values["printtype"] <> "") $message .= "Typ tisku: $values[printtype]\n";    
$message .= "Vypočítaná orientační cena: $values[price]"; $message .= ",- Kč\n";

  
$mail = new NMail;
$file = $form->values['fileinfo'];
$type = strtolower(substr($_FILES["fileinfo"]['name'],strrpos($_FILES["fileinfo"]['name'],".")));
//$type = strtolower(substr($file->name,$file->name,".")));
$mailname = friendly_url($values["name"]);
if ($file->isOK())
    {
    $mail->addAttachment("desky-$mailname$type", $file->getContents());
    }
$file2 = $form->values['file'];
if ($file2->isOK())
    $mail->addAttachment("prace-$mailname.pdf", $file2->getContents());
    
$mail->setFrom("$values[name] <$values[email]>")
    //->addTo('lukas.fabik@gmail.com')
    //->addTo('reklamka@nastartuj.cz')
    ->addTo('hned@nastartuj.cz')    
    ->setSubject("Objednávka 'diplomky' $values[name]")
//    ->setHtmlBody($message)   //    nastavení html verze        
    ->setBody($message)         //    verze prostý text
    ->send();    
        
    
$mail = new NMail; 
$mail->setFrom('Quatro reklamka <hned@nastartuj.cz>')
    ->addTo("$values[email]")
    
    ->setSubject('Potvrzení objednávky - Quatro reklamka')
    ->setBody($message)
    ->send(); 
?>
<script>
alert("Děkujeme vám za vaší objednávku. Potvrzení přijetí objednávky přijde na vámi uvedený mail. Pokud ne, kontaktujte nás. Hezký den!");
formFieldCleaner("#frm-");
</script>
<?php
//}
//else{
?>
<script>
//alert("Přílohy nejsou v požadovaných formátech (.PDF/.doc/.docx)");
//checkboxCleaner("#frm-");
</script>
<?php
//}
}

?>


<script>
$(document).ready(function(){
  if(!$('#frm-printall').is(':checked')){
  $('.hide').fadeOut();
   
  }
  $('.hideevery').fadeOut();
});
</script>
<script>

$(function() {

  var holidays= [[1.5]];

  var workingDayOffset = 10, selectedDate = new Date();

  function nonWorkingDays(date) {
    for (var j = 0; j < holidays.length; j++) {
      if (date.getMonth() == holidays[j][1] - 1 && date.getDate() == holidays[j][0]) {
        return [false, ''];
      }
    }
  return [true, ''];
  }

  function nonAvailableDays(date) {
    var noWeekend = $.datepicker.noWeekends(date), holiday = nonWorkingDays(date);        
    return [noWeekend[0] && holiday[0], ''];
  }

  for(var i = 0; i < workingDayOffset; i++) {
    selectedDate.setDate(selectedDate.getDate() + 1);
    if(!nonAvailableDays(selectedDate)[0])
    { 
      i--;
    }    
  }

var date = new Date(); // vytvoří proměnnou obsahující aktuální datum
var thishour = date.getHours();
var thisday = date.getDay();
var days = 0; 


if(thisday == 5){
  if(thishour > 15){
    days = 4;
  }
  else{
    days = 3;
  }
}
else if(thisday == 6){
  days = 3;
}
else if(thisday == 0){
  days = 2;
}
else{
  if(thishour > 15){
    days = 2;
  }
  else{
    days = 1;
  }
}
$("#frm-term").datepicker({  minDate: +days, beforeShowDay: nonAvailableDays })
});
</script>

<script>
$('#frm-printall').change(function(){
  $('.hide').fadeToggle();
});
</script>

<script>
$('#frm-term').change(function(){
makeprice();
});  

$('#frm-counthard').change(function(){
makeprice();
});

$('#frm-countring').change(function(){
makeprice();
});

$('#frm-countcd').change(function(){
makeprice();
});

$('#frm-countannex').change(function(){
makeprice();
});
</script>
</div>   
</body>
</html>