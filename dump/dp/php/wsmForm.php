<?php

use Nette\Forms\Form; // jen verze php 5.3
use Nette\Mail\Message; //jen verze php 5.3
use Nette\Mail\SendmailMailer;
use Nette\Utils\Html;


/******************************VYTVOŘENÍ FORMULÁŘE********************************/
$form = new Form;
$form->getElementPrototype()->id('frm-');
$form->addText('name', 'Jméno a Příjmení:')
      ->setHtmlId('frm-')
     ->setRequired('Nutno vyplnit');
$form->addText('email', 'E-mail:')
     ->setRequired('Nutno vyplnit')
     ->addRule(Form::EMAIL, 'Toto není platný email');
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
    ' 5mm (AA) 20-40 listů' => ' 5mm (AA) 20-40 listů / 40-80 stran',
    '10mm (A) 41-90 listů' => '10mm (A) 41-90 listů / 81-180 stran',
    '13mm (B) 91-120 listů' => '13mm (B) 91-120 listů / 181-240 stran',
    '16mm (C) 121-145 listů' => '16mm (C) 121-145 listů / 241-270 stran',
    '20mm (D) 146-185 listů' => '20mm (D) 146-185 listů / 271-370 stran',
    '24mm (E) 186-230 listů' => '24mm (E) 186-230 listů / 371-460 stran',
    '28mm (F) 231-265 listů' => '28mm (F) 231-265 listů / 461-530 stran',
    '32mm (G) 266-300 listů' => '32mm (G) 266-300 listů / 531-600 stran'
);

$form->addSelect('type', 'Moje práce má:', $type)
     ->setPrompt('Zvolte počet listů')
     ->setRequired('Nutno vyplnit');
                      
$form->addSelect('countcd', 'Chci do vazby i kapsy na CD/DVD:', $countcopies)
     ->setPrompt('Zvolte počet')
     ->setRequired('Nutno vyplnit');
     
$form->addTextarea('message', 'Poznámka:');

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
                                       
$form->addUpload('file1', 'Soubor k tisku (.pdf):')
     ->setAttribute('onChange', 'showNextFile(2)')
     ->addCondition(form::FILLED)
        ->addRule(Form::MAX_FILE_SIZE, 'Maximální velikost souboru je 5 MB.', 5120 * 1024 /* v bytech */);

$form->addUpload('file2', 'Soubor k tisku (.pdf):')
     ->setAttribute('onChange', 'showNextFile(3)')
     ->addCondition(Form::FILLED)
        ->addRule(Form::MAX_FILE_SIZE, 'Maximální velikost souboru je 5 MB.', 5120 * 1024 /* v bytech */);
$form->addUpload('file3', 'Soubor k tisku (.pdf):')
     ->setAttribute('onChange', 'showNextFile(4)')
     ->addCondition(Form::FILLED)
        ->addRule(Form::MAX_FILE_SIZE, 'Maximální velikost souboru je 5 MB.', 5120 * 1024 /* v bytech */);
$form->addUpload('file4', 'Soubor k tisku (.pdf):')
     ->setAttribute('onChange', 'showNextFile(5)')
     ->addCondition(Form::FILLED)
        ->addRule(Form::MAX_FILE_SIZE, 'Maximální velikost souboru je 5 MB.', 5120 * 1024 /* v bytech */);
$form->addUpload('file5', 'Soubor k tisku (.pdf):')
     ->addCondition(Form::FILLED)
        ->addRule(Form::MAX_FILE_SIZE, 'Maximální velikost souboru je 5 MB.', 5120 * 1024 /* v bytech */);
/*--------------------------------------------------------------------*/
$label = Html::el()->setHtml('Souhlasím s <a href="http://www.nastartuj.cz/obchodni_podminky.html" target = "_blank">obchodními podmínkami</a>');
$form->addCheckbox('licence', $label)
     ->addRule(Form::EQUAL, 'Je potřeba souhlasit s podmínkami', TRUE); 
$form->addText('price', 'Cena:');
$form->addText('priceone', 'Tarif:');

$places = array(
    'Staré Město' => 'QUATRO - Bohumínská 323/21, Karviná - Staré Město',
/*    'Fryštát' => 'Univerzitní náměstí 1934/3, Karviná - Fryštát'*/
);


$form->addRadioList('place', 'Místo vyzvednutí:', $places)
     ->setRequired('Nutno vyplnit');  
$form->addSubmit('send', 'Odeslat závaznou objednávku');
?>