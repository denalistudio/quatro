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


use Nette\Forms\Form; // jen verze php 5.3
use Nette\Mail\Message; //jen verze php 5.3
use Nette\Utils\Html;
//use Tracy\Debugger;

//Debugger::enable(); // aktivujeme Laděnku

include "php/wsmForm.php";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml">
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
  echo "<title>Objednávka desek WSM</title>";

  echo "<link rel='stylesheet' href='wsmstyle.css' type='text/css' media='screen' />";
  echo "<link rel='stylesheet' href='print.css' type='text/css' media='print' />";
  echo "<script type='text/javascript' src='Nette/live-form-validation.js'></script>";
  ?>
  <script src="https://code.jquery.com/jquery-latest.js"></script>
  <link rel="stylesheet" href="jscripts/ui/themes/base/jquery.ui.all.css" />


    <script src="https://code.jquery.com/jquery-1.9.0.js"></script>
    <script src="https://code.jquery.com/jquery-migrate-1.2.1.js"></script>
    <script src="https://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
    <script src="jscripts/ui/i18n/jquery.ui.datepicker-cs.js"></script>

  </head>
<body>
<div id = "web">
<h1>Objednávka online Wyzsza szkola managerska w Warszawie</h1>

<?php $form->render('begin') ?>

<?php $form->render('errors') ?>
<?php /******************************VYKRESLENÍ FORMULÁŘE********************************/ ?>
<div id = 'form'>
<div class = 'form'>
<table>
<th><h2>Zákazník</h2></th><td></td>


<tr class="required">
    <th><?php echo $form['name']->label ?></th>
    <td><?php echo $form['name']->control ?>

        <span class = "help">
            <span class = "icon"></span>
            <span class = "text">Povinný údaj</span>
        </span>

    </td>
</tr>
<tr class="required">
    <th><?php echo $form['phone']->label ?></th><td><?php echo $form['phone']->control ?>
    <span class = "help">
            <span class = "icon"></span>
            <span class = "text">Povinný údaj, v případě nejasností Vás budeme kontaktovat na uvedeném telefonním čísle</span>
        </span>

    </td>
</tr>
<tr class="required">
    <th><?php echo $form['email']->label ?></th><td><?php echo $form['email']->control ?>
    <span class = "help">
            <span class = "icon"></span>
            <span class = "text">Povinný údaj, budeme Vás informovat o přijetí objednávky</span>
        </span>

    </td>
</tr>
<th><h2>Vazba práce</h2></th><td></td>
<tr class="required">
    <th><?php echo $form['counthard']->label ?></th><td><?php echo $form['counthard']->control ?><span class = "help">
            <span class = "icon"></span>
            <span class = "text">Zde vyplňte počet prací, které chcete nechat vyrobit</span>
        </span>
    </td>
</tr>
<tr class="required">
    <th><?php echo $form['countring']->label ?></th><td><?php echo $form['countring']->control ?>
    <span class = "help">
            <span class = "icon"></span>
            <span class = "text">Listy se proděraví a svážou pomocí plastové spirály. Z důvodů nízkých finančních nároků je oblíbenou volbou pro vazbu práce určené pro vlastní potřebu.</span>
        </span></td>
</tr>
<tr class="required">
    <th><?php echo $form['term']->label ?></th><td><?php echo $form['term']->control ?>
    <span class = "help">
            <span class = "icon"></span>
            <span class = "text">Zvolte datum kdy si svou práci vyzvednete. Pouze v pracovní dny.</span>
        </span></td>
</tr>
<tr class="required">
    <th><?php echo $form['type']->label; ?></th><td><?php echo $form['type']->control;?>
    <span class = "help">
            <span class = "icon"></span>
            <span class = "text">Důležitý údaj pro výrobu - podle něj zvolíme tloušťku hřbetu, počty stran jsou pro běžný kancelářský papír, máte li práci vytištěnou na jiném papíře, vybírejte podle údajů v mm. Pokud chcete oboustranný tisk Vaši práce, zadejte počet listů a ne stran</span>
        </span></td>
</tr>
<tr class="required">
    <th><?php echo $form['magi']->label ?></th><td><?php echo $form['magi']->control ?>
    <span class = "help">
            <span class = "icon"></span>
            <span class = "text">Vybere si typ práce</span>
        </span></td>
</tr>
<tr class="required">
    <th><?php echo $form['color']->label ?></th><td><?php echo $form['color']->control ?>
    <span class = "help">
            <span class = "icon"></span>
            <span class = "text">Pro školu WSM je to modrá</span>
        </span></td>
</tr>
<tr class="required">
    <th><?php echo $form['textcolor']->label ?></th><td><?php echo $form['textcolor']->control ?>
    <span class = "help">
            <span class = "icon"></span>
            <span class = "text">Barva ražby na deskách. Pro školu WSM je to zlatá</span>
        </span></td>
</tr>
<tr class="required">
    <th><?php echo $form['countcd']->label; ?></th><td><?php echo $form['countcd']->control;?>
    <span class = "help">
            <span class = "icon"></span>
            <span class = "text">Do každé práce se většinou dává 1 kapsa na CD. Je třeba uvést kolik kapes fyzicky požadujete.</span>
        </span></td>
</tr>


<tr class="required">
    <th><?php echo $form['message']->label; ?></th><td><?php echo $form['message']->control;?>
    <span class = "help">
            <span class = "icon"></span>
            <span class = "text">Pole pro jiné požadavky a přání</span>
        </span></td>
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
    <th><?php echo $form['printtype']->label; ?></th><td><?php echo $form['printtype']->control;?>
    <span class = "help">
            <span class = "icon"></span>
            <span class = "text">Vyberte, zda-li tisknout práci celou černobíle, nebo barevně a černobíle</span>
        </span>
    </td>
</tr>
<tr class="required">
    <th><?php echo $form['countprint']->label; ?></th><td><?php echo $form['countprint']->control;?>
    <span class = "help">
            <span class = "icon"></span>
            <span class = "text">Upřesněte kolikrát práci vytiskneme, počítá se i spirálová vazba, pokud ji máte objednanou</span>
        </span>
    </td>
</tr>
<tr class="required">
    <th><?php echo $form['file1']->label ?></th><td id = "fileInput"><?php echo $form['file1']->control ?>
    <span class = "help">
            <span class = "icon"></span>
            <span class = "text">Zde nahrejte Váš soubor, který je komplet nachystán k tisku. POUZE formát PDF, v jiném souboru nebudeme schopni tisknout</span>
        </span>
    </td>
</tr>
<tr class="required file2">
    <th></th><td id = "fileInput"><?php echo $form['file2']->control ?>
    </td>
</tr>
<tr class="required file3">
    <th></th><td id = "fileInput"><?php echo $form['file3']->control ?>
    </td>
</tr>
<tr class="required file4">
    <th></th><td id = "fileInput"><?php echo $form['file4']->control ?>
    </td>
</tr>
<tr class="required file5">
    <th></th><td id = "fileInput"><?php echo $form['file5']->control ?>
    </td>
</tr>
</table>
</div>
<hr  />
<div class = 'form'>
<table>
<tr class="required">
    <th><?php echo $form['place']->label; ?></th><td><?php echo $form['place']->control;?>
    <span class = "help">
            <span class = "icon"></span>
            <span class = "text">Otevřeno každý pracovní den od 8:00 do 16:00 hodin. V případě dotazů volejte 596 324 040.</span>
        </span>
    </td>
</tr>
<tr>
    <th></th><td><?php echo $form['licence']->control;?><?php echo $form['licence']->label;?></td>
</tr>
<tr class="required">
    <th></th><td><?php echo $form['send']->control ?></td>
</tr>
</table>
</div>

</div>

<div id = "pricetab">
<h2>Náhled desek</h2>
<h2> <a href='https://nastartuj.cz/img/wyzsza_szkola_managerska_w_warszawie_magisterska.jpg'><img src='wsm-m.jpg' /></a> </h2>
<h2> <a href='https://nastartuj.cz/img/wyzsza_szkola_managerska_w_warszawie_licencjacka.jpg'><img src='wsm-l.jpg' /></a> </h2>
</div>
<?php $form->render('end') ?>

<?php


//echo $form;

if ($form->isSubmitted() && $form->isValid()) {
$values = $form->getValues();
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
$message .= "Typ práce: $values[magi]\n";
if($values["countcd"] <> 0) $message .= "Počet kapes na CD: $values[countcd]\n";
//$message .= "Budu do vazby vkládat ještě nějaké listy: $values[otherlists]\n";
if($values["message"] <> "") $message .= "Poznámka: $values[message]\n";
if($values["countprint"] <> "") $message .= "Počet výtisků: $values[countprint]\n";
if($values["printtype"] <> "") $message .= "Typ tisku: $values[printtype]\n";
$message .= "Místo vyzvednutí: $values[place]";

$mailname = friendly_url($values["name"]);


$mail = new Message;
$mail->setFrom("$values[name] <$values[email]>")
    //->addTo('lukas.fabik@gmail.com')
    ->addTo('hned@nastartuj.cz')
    ->setSubject("Objednávka ' - W S M - diplomky' $values[name]")
    ->setBody($message);         //    verze prostý text
    //->send();

$mail2 = new Message;
$mail2->setFrom('Quatro reklamka <hned@nastartuj.cz>')
    ->addTo("$values[email]")
    //->addTo('lukas.fabik@gmail.com')
    ->setSubject('Potvrzení objednávky - Quatro reklamka')
    ->setBody($message);
    //->send();




$file1 = $form->values["file1"];
if ($file1->isOK()){
    $i++;
    $type = strtolower(substr($file1->name,strrpos($file1->name,".")));
    $mail->addAttachment("prace-$mailname-1$type", $file1->getContents());
}
$file2 = $form->values["file2"];
if ($file2->isOK()){
    $i++;
    $type = strtolower(substr($file2->name,strrpos($file2->name,".")));
    $mail->addAttachment("prace-$mailname-2$type", $file2->getContents());
}
$file3 = $form->values["file3"];
if ($file3->isOK()){
    $i++;
    $type = strtolower(substr($file3->name,strrpos($file3->name,".")));
    $mail->addAttachment("prace-$mailname-3$type", $file3->getContents());
}
$file4 = $form->values["file4"];
if ($file4->isOK()){
    $i++;
    $type = strtolower(substr($file4->name,strrpos($file4->name,".")));
    $mail->addAttachment("prace-$mailname-4$type", $file4->getContents());
}
$file5 = $form->values["file5"];
if ($file5->isOK()){
    $i++;
    $type = strtolower(substr($file5->name,strrpos($file5->name,".")));
    $mail->addAttachment("prace-$mailname-5$type", $file5->getContents());
}


$mailer = new Nette\Mail\SendmailMailer;


try {
  $mailer->send($mail);
  $mailer->send($mail2);
  echo "sent";
}
catch(Exception $e) {
   alert("Omlouváme se, došlo k problému při odeslání e-mailu. Zkuste to, prosím, později.");
   var_dump($e);
}


?>
<script>
   alert("Děkujeme vám za vaší objednávku. Potvrzení přijetí objednávky přijde na vámi uvedený mail. Pokud ne, kontaktujte nás. Hezký den!");
   window.location.href='wsm.php';
</script>
<?php
?>
<?php
//}
}
else{
   // echo "ajeje";
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

  var holidays= [[1,1],[9,4],[19,4],[22,4],[1,5],[8,5],[5,7],[6,7],[8,7],[9,7],[10,7],[11,7],[12,7],[28,9],[28,10],[17,11],[24,12],[25,12],[26,12]]; // svátky
   // zde zadej data svátků a volných dní;
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


</script>
    <script type="text/javascript">
     function showNextFileInfo(n){
        $( ".fileinfo" + n ).show("slow");
     }

     function showNextFile(n){
        $( ".file" + n ).show("slow");
     }
    </script>
</div>
</body>
</html>
