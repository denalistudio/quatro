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
    ' 5mm (AA) 20-40 listů' => ' 5mm (AA) 20-40 listů',
    '10mm (A) 41-90 listů' => '10mm (A) 41-90 listů',
    '13mm (B) 91-120 listů' => '13mm (B) 91-120 listů',
    '16mm (C) 121-145 listů' => '16mm (C) 121-145 listů',
    '20mm (D) 146-185 listů' => '20mm (D) 146-185 listů',
    '24mm (E) 186-230 listů' => '24mm (E) 186-230 listů',
    '28mm (F) 231-265 listů' => '28mm (F) 231-265 listů',
    '32mm (G) 266-300 listů' => '32mm (G) 266-300 listů'
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
                          
$form->addSelect('countcd', 'Chci do vazby i kapsy na CD/DVD:', $countcopies)
     ->setPrompt('Zvolte počet')
     ->setRequired('Nutno vyplnit');
     
$form->addSelect('countannex', 'Chci do vazby i chlopně na přílohy:', $countcopies)
     ->setPrompt('Zvolte počet')
     ->setRequired('Nutno vyplnit');
     
$form->addCheckbox('otherlists', 'Budu do vazby vkládat ještě nějaké listy (např. originál zadání)');     

$form->addTextarea('message', 'Poznámka:');

$form->addUpload('fileinfo1', 'Soubor s údaji na desky:')
     ->setAttribute('onChange', 'showNextFileInfo(2)')
     ->addCondition(form::FILLED)
        ->addRule(Form::MAX_FILE_SIZE, 'Maximální velikost souboru je 5 MB.', 5120 * 1024 /* v bytech */);
$form->addUpload('fileinfo2', 'Soubor s údaji na desky (.pdf, .doc, .docx):')
     ->setAttribute('onChange', 'showNextFileInfo(3)')
     ->addCondition(form::FILLED)
        ->addRule(Form::MAX_FILE_SIZE, 'Maximální velikost souboru je 5 MB.', 5120 * 1024 /* v bytech */);
$form->addUpload('fileinfo3', 'Soubor s údaji na desky (.pdf, .doc, .docx):')
     ->setAttribute('onChange', 'showNextFileInfo(4)')
     ->addCondition(form::FILLED)
        ->addRule(Form::MAX_FILE_SIZE, 'Maximální velikost souboru je 5 MB.', 5120 * 1024 /* v bytech */);
$form->addUpload('fileinfo4', 'Soubor s údaji na desky (.pdf, .doc, .docx):')
     ->setAttribute('onChange', 'showNextFileInfo(5)')
     ->addCondition(form::FILLED)
        ->addRule(Form::MAX_FILE_SIZE, 'Maximální velikost souboru je 5 MB.', 5120 * 1024 /* v bytech */);
$form->addUpload('fileinfo5', 'Soubor s údaji na desky (.pdf, .doc, .docx):')
     ->addCondition(form::FILLED)
        ->addRule(Form::MAX_FILE_SIZE, 'Maximální velikost souboru je 5 MB.', 5120 * 1024 /* v bytech */);

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