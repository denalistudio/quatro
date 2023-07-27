<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './vendor/autoload.php';

if (isset($_POST['name'], $_POST['email'], $_POST['tel'], $_POST['pevne-desky'], $_POST['krouzkove-vazby'], $_POST['barva-desek'], $_POST['barva-pisma'], $_POST['termin-zhotoveni'], $_POST['pocet-listu'], $_POST['kapsy-cd-dvd'], $_POST['chlopne-na-prilohy'], $_FILES['soubory-desky'])) {
    // Detaily zákazníka
    $name = htmlspecialchars(trim($_POST['name']), ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars(trim($_POST['email']), ENT_QUOTES, 'UTF-8');
    $tel = htmlspecialchars(trim($_POST['tel']), ENT_QUOTES, 'UTF-8');

    // Detaily diplomky
    $pevne_desky = $_POST['pevne-desky'];
    $krouzkove_vazby = $_POST['krouzkove-vazby'];
    $termin_zhotoveni = htmlspecialchars(trim($_POST['termin-zhotoveni']), ENT_QUOTES, 'UTF-8');
    $pocet_listu = $_POST['pocet-listu'];
    $barva_desek = $_POST['barva-desek'];
    $barva_pisma = $_POST['barva-pisma'];
    $kapsy_cd_dvd = $_POST['kapsy-cd-dvd'];
    $chlopne_na_prilohy = $_POST['chlopne-na-prilohy'];
    $listy_navic = 'NE';
    if (isset($_POST['listy-navic'])) {
        $listy_navic = 'ANO';
    }
    $poznamka = 'ŽÁDNÁ';
    if (strlen($_POST['poznamka'])) {
        $poznamka = htmlspecialchars(trim($_POST['poznamka']), ENT_QUOTES, 'UTF-8');
    }

    // Počet listů
    $pocet_listu_admin = '';
    $pocet_listu_customer = '';
    switch ($pocet_listu) {
        case 1:
            $pocet_listu_admin = '5 mm (AA)';
            $pocet_listu_customer = '20 - 40 listů (5 mm (AA))';
            break;
        case 2:
            $pocet_listu_admin = '10 mm (A)';
            $pocet_listu_customer = '41 - 90 listů (10 mm (A))';
            break;
        case 3:
            $pocet_listu_admin = '91 - 120';
            $pocet_listu_customer = '13 mm (B)';
            break;
        case 4:
            $pocet_listu_admin = '121 - 145';
            $pocet_listu_customer = '16 mm (C)';
            break;
        case 5:
            $pocet_listu_admin = '146 - 185';
            $pocet_listu_customer = '20 mm (D)';
            break;
        case 6:
            $pocet_listu_admin = '186 - 230';
            $pocet_listu_customer = '24 mm (E)';
            break;
        case 7:
            $pocet_listu_admin = '231 - 265';
            $pocet_listu_customer = '28 mm (F)';
            break;
        case 8:
            $pocet_listu_admin = '266 - 300';
            $pocet_listu_customer = '32 mm (G)';
            break;
        default:
            $pocet_listu_admin = '';
            $pocet_listu_customer = '';
    }

    // Cena
    $cena = '';
    $cena_admin_col = '';
    $cena_customer_col = '';
    if (isset($_POST['price'])) {
        $cena = htmlspecialchars(trim($_POST['price']), ENT_QUOTES, 'UTF-8');
        $cena_admin_col = '
        <tr>
            <th style="width:50%;padding:8px 10px 8px 10px;border:1px solid #000000;text-align:left;">
                Orientační cena
            </th>
            <td style="width:50%;padding:8px 10px 8px 10px;border:1px solid #000000;text-align:left;">
                ' . $cena . ' Kč
            </td>
        </tr>
        ';
        $cena_customer_col = '
        <tr>
            <th style="width:50%;padding:5px 15px 5px 0;text-align:left;">
                Orientační cena
            </th>
            <td style="width:50%;padding:5px 0 5px 15px;text-align:left;">
                ' . $cena . ' Kč
            </td>
        </tr>
        ';
    }

    // Tisk práce
    $typ_tisku_admin_col = '';
    $typ_tisku_customer_col = '';
    $pocet_vytisku_admin_col = '';
    $pocet_vytisku_customer_col = '';

    if (isset($_POST['vytisknout-praci'])) {
        $typ_tisku = $_POST['typ-tisku'];
        $pocet_vytisku = $_POST['pocet-vytisku'];
        $typ_tisku_admin_col = '
        <tr>
            <th style="width:50%;padding:8px 10px 8px 10px;border:1px solid #000000;text-align:left;">
                Typ tisku
            </th>
            <td style="width:50%;padding:8px 10px 8px 10px;border:1px solid #000000;text-align:left;">
                ' . $typ_tisku . '
            </td>
        </tr>
        ';
        $typ_tisku_customer_col = '
        <tr>
            <th style="width:50%;padding:5px 15px 5px 0;text-align:left;">
                Typ tisku
            </th>
            <td style="width:50%;padding:5px 0 5px 15px;text-align:left;">
                ' . $typ_tisku . '
            </td>
        </tr>
        ';
        $pocet_vytisku_admin_col = '
        <tr>
            <th style="width:50%;padding:8px 10px 8px 10px;border:1px solid #000000;text-align:left;">
                Počet výtisků
            </th>
            <td style="width:50%;padding:8px 10px 8px 10px;border:1px solid #000000;text-align:left;">
                ' . $pocet_vytisku . '
            </td>
        </tr>
        ';
        $pocet_vytisku_customer_col = '
        <tr>
            <th style="width:50%;padding:5px 15px 5px 0;text-align:left;">
                Počet výtisků
            </th>
            <td style="width:50%;padding:5px 0 5px 15px;text-align:left;">
                ' . $pocet_vytisku . '
            </td>
        </tr>
        ';
    }

    $adminBody = '<!DOCTYPE html>
    <html lang="cs" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta name="x-apple-disable-message-reformatting">
        <title></title>
        <!--[if mso]>
                    <noscript>
                        <xml>
                            <o:OfficeDocumentSettings>
                                <o:PixelsPerInch>96</o:PixelsPerInch>
                            </o:OfficeDocumentSettings>
                        </xml>
                    </noscript>
                    <![endif]-->
        <style>
            table,
            td {
                font-family: Arial, sans-serif;
            }
    
            table,
            td,
            th {
                font-size: 16px;
            }
        </style>
    </head>
    
    <body style="Margin:0;padding:0;">
        <table role="presentation"
            style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;">
            <tr>
                <td align="center" style="padding:40px 40px 40px 40px;">
                    <table role="presentation" style="width:600px;border-collapse:collapse;border:0;background:#ffffff;">
                        <tr>
                            <td colspan="2">
                                <table role="presentation" align="center"
                                    style="width:100%;border-collapse:collapse;border:0;background:#ffffff;">
                                    <tr>
                                        <th style="width:50%;padding:8px 10px 8px 10px;border:1px solid #000000;text-align:left;">
                                            Jméno a příjmení
                                        </th>
                                        <td style="width:50%;padding:8px 10px 8px 10px;border:1px solid #000000;text-align:left;">
                                            ' . $name . '
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width:50%;padding:8px 10px 8px 10px;border:1px solid #000000;text-align:left;">
                                            E-mailová adresa
                                        </th>
                                        <td style="width:50%;padding:8px 10px 8px 10px;border:1px solid #000000;text-align:left;">
                                            ' . $email . '
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width:50%;padding:8px 10px 8px 10px;border:1px solid #000000;text-align:left;">
                                            Telefonní číslo
                                        </th>
                                        <td style="width:50%;padding:8px 10px 8px 10px;border:1px solid #000000;text-align:left;">
                                            ' . $tel . '
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width:50%;padding:8px 10px 8px 10px;border:1px solid #000000;text-align:left;">
                                            Počet zhotovení pevných desek
                                        </th>
                                        <td style="width:50%;padding:8px 10px 8px 10px;border:1px solid #000000;text-align:left;">
                                            ' . $pevne_desky . '
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width:50%;padding:8px 10px 8px 10px;border:1px solid #000000;text-align:left;">
                                            Počet zhotovení kroužkových vazeb
                                        </th>
                                        <td style="width:50%;padding:8px 10px 8px 10px;border:1px solid #000000;text-align:left;">
                                            ' . $krouzkove_vazby . '
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width:50%;padding:8px 10px 8px 10px;border:1px solid #000000;text-align:left;">
                                            Požadovaný termín zhotovení
                                        </th>
                                        <td style="width:50%;padding:8px 10px 8px 10px;border:1px solid #000000;text-align:left;">
                                            ' . $termin_zhotoveni . '
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width:50%;padding:8px 10px 8px 10px;border:1px solid #000000;text-align:left;">
                                            Počet listů
                                        </th>
                                        <td style="width:50%;padding:8px 10px 8px 10px;border:1px solid #000000;text-align:left;">
                                            ' . $pocet_listu_admin . '
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width:50%;padding:8px 10px 8px 10px;border:1px solid #000000;text-align:left;">
                                            Barva desek
                                        </th>
                                        <td style="width:50%;padding:8px 10px 8px 10px;border:1px solid #000000;text-align:left;">
                                            ' . $barva_desek . '
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width:50%;padding:8px 10px 8px 10px;border:1px solid #000000;text-align:left;">
                                            Barva písma
                                        </th>
                                        <td style="width:50%;padding:8px 10px 8px 10px;border:1px solid #000000;text-align:left;">
                                            ' . $barva_pisma . '
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width:50%;padding:8px 10px 8px 10px;border:1px solid #000000;text-align:left;">
                                            Počet kapes na CD/DVD
                                        </th>
                                        <td style="width:50%;padding:8px 10px 8px 10px;border:1px solid #000000;text-align:left;">
                                            ' . $kapsy_cd_dvd . '
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width:50%;padding:8px 10px 8px 10px;border:1px solid #000000;text-align:left;">
                                            Počet chlopní na přílohy
                                        </th>
                                        <td style="width:50%;padding:8px 10px 8px 10px;border:1px solid #000000;text-align:left;">
                                            ' . $chlopne_na_prilohy . '
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width:50%;padding:8px 10px 8px 10px;border:1px solid #000000;text-align:left;">
                                            Do vazby budou vkládány další listy
                                        </th>
                                        <td style="width:50%;padding:8px 10px 8px 10px;border:1px solid #000000;text-align:left;">
                                            ' . $listy_navic . '
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width:50%;padding:8px 10px 8px 10px;border:1px solid #000000;text-align:left;">
                                            Poznámka
                                        </th>
                                        <td style="width:50%;padding:8px 10px 8px 10px;border:1px solid #000000;text-align:left;">
                                            ' . $poznamka . '
                                        </td>
                                    </tr>
                                    ' . $typ_tisku_admin_col . '
                                    ' . $pocet_vytisku_admin_col . '
                                    ' . $cena_admin_col . '
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
    
    </html>';

    $customerBody = '<!DOCTYPE html>
    <html lang="cs" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta name="x-apple-disable-message-reformatting">
        <title></title>
        <!--[if mso]>
                <noscript>
                    <xml>
                        <o:OfficeDocumentSettings>
                            <o:PixelsPerInch>96</o:PixelsPerInch>
                        </o:OfficeDocumentSettings>
                    </xml>
                </noscript>
                <![endif]-->
        <style>
            table,
            td,
            div,
            h1,
            p {
                font-family: Arial, sans-serif;
            }
    
            table,
            td,
            th,
            div,
            p {
                font-size: 16px;
            }
    
            h1 {
                font-size: 32px;
            }
    
            h2 {
                font-size: 24px;
            }
    
            table,
            td {
                border: 0 !important;
            }
        </style>
    </head>
    
    <body style="Margin:0;padding:0;">
        <table role="presentation"
            style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#cdcdcd;">
            <tr>
                <td align="center" style="padding:70px 0 70px 0;">
                    <table role="presentation" style="width:600px;border-collapse:collapse;border:0;background:#ffffff;">
                        <tr>
                            <td style="padding:30px 0 30px 30px;border:0;background:#264796">
                                <img src="https://nastartuj.cz/objednavka/logo.png" height="80">
                            </td>
                            <td style="padding:30px 30px 30px 0;border:0;background:#264796;text-align:right;">
                                <h2 style="Margin:0 0 10px 0;padding:0;color:#ffffff;">Quatro - Život v reklamě</h2>
                                <p style="Margin:0;padding:0;color:#ffffff;">Ladislav Frajkowski</p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="padding:40px 40px 40px 40px;">
                                <h1 style="Margin:0 0 10px 0;padding:0;text-align:center;">Děkujeme za vaši objednávku</h1>
                                <p style="Margin:0 0 30px 0;padding:0;text-align:center;">Níže najdete shrnutí vaší
                                    objednávky.</p>
                                <table role="presentation" align="center"
                                    style="width:100%;border-collapse:collapse;border:0;background:#ffffff;">
                                    <tr>
                                        <th style="width:50%;padding:5px 15px 5px 0;text-align:left;">
                                            Jméno a příjmení
                                        </th>
                                        <td style="width:50%;padding:5px 0 5px 15px;text-align:left;">
                                            ' . $name . '
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width:50%;padding:5px 15px 5px 0;text-align:left;">
                                            E-mailová adresa
                                        </th>
                                        <td style="width:50%;padding:5px 0 5px 15px;text-align:left;">
                                            ' . $email . '
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width:50%;padding:5px 15px 5px 0;text-align:left;">
                                            Telefonní číslo
                                        </th>
                                        <td style="width:50%;padding:5px 0 5px 15px;text-align:left;">
                                            ' . $tel . '
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width:50%;padding:5px 15px 5px 0;text-align:left;">
                                            Počet zhotovení pevných desek
                                        </th>
                                        <td style="width:50%;padding:5px 0 5px 15px;text-align:left;">
                                            ' . $pevne_desky . '
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width:50%;padding:5px 15px 5px 0;text-align:left;">
                                            Počet zhotovení kroužkových vazeb
                                        </th>
                                        <td style="width:50%;padding:5px 0 5px 15px;text-align:left;">
                                            ' . $krouzkove_vazby . '
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width:50%;padding:5px 15px 5px 0;text-align:left;">
                                            Požadovaný termín zhotovení
                                        </th>
                                        <td style="width:50%;padding:5px 0 5px 15px;text-align:left;">
                                            ' . $termin_zhotoveni . '
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width:50%;padding:5px 15px 5px 0;text-align:left;">
                                            Počet listů
                                        </th>
                                        <td style="width:50%;padding:5px 0 5px 15px;text-align:left;">
                                            ' . $pocet_listu_customer . '
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width:50%;padding:5px 15px 5px 0;text-align:left;">
                                            Barva desek
                                        </th>
                                        <td style="width:50%;padding:5px 0 5px 15px;text-align:left;">
                                            ' . $barva_desek . '
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width:50%;padding:5px 15px 5px 0;text-align:left;">
                                            Barva písma
                                        </th>
                                        <td style="width:50%;padding:5px 0 5px 15px;text-align:left;">
                                            ' . $barva_pisma . '
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width:50%;padding:5px 15px 5px 0;text-align:left;">
                                            Počet kapes na CD/DVD
                                        </th>
                                        <td style="width:50%;padding:5px 0 5px 15px;text-align:left;">
                                            ' . $kapsy_cd_dvd . '
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width:50%;padding:5px 15px 5px 0;text-align:left;">
                                            Počet chlopní na přílohy
                                        </th>
                                        <td style="width:50%;padding:5px 0 5px 15px;text-align:left;">
                                            ' . $chlopne_na_prilohy . '
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width:50%;padding:5px 15px 5px 0;text-align:left;">
                                            Do vazby budou vkládány další listy
                                        </th>
                                        <td style="width:50%;padding:5px 0 5px 15px;text-align:left;">
                                            ' . $listy_navic . '
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width:50%;padding:5px 15px 5px 0;text-align:left;">
                                            Poznámka
                                        </th>
                                        <td style="width:50%;padding:5px 0 5px 15px;text-align:left;">
                                            ' . $poznamka . '
                                        </td>
                                    </tr>
                                    ' . $typ_tisku_customer_col . '
                                    ' . $pocet_vytisku_customer_col . '
                                    ' . $cena_customer_col . '
                                </table>
                                <p style="Margin:30px 0 5px 0;padding:0;">Místo vyzvednutí:</p>
                                <p style="Margin:5px 0 10px 0;padding:0;">QUATRO - Bohumínská 323/21, Karviná-Staré Město</p>
                                <p style="Margin:10px 0 10px 0;padding:0;">pondělí - pátek: 8.00 - 16.00</p>
                                <p style="Margin:10px 0 0 0;padding:0;">V případě dotazů volejte <a href="tel:+420596324040">+420 596 324 040</a></p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
    
    </html>';

    $adminEmail = new PHPMailer(true);
    $customerEmail = new PHPMailer(true);

    try {
        $adminEmail->setFrom($email, $name);
        $adminEmail->CharSet = 'UTF-8';
        $adminEmail->isHTML(true);
        $adminEmail->Subject = 'Objednávka "diplomky" ' . $name;
        $adminEmail->Body = $adminBody;
        $adminEmail->addAddress('hned@nastartuj.cz');

        $customerEmail->setFrom('hned@nastartuj.cz', 'Reklamka Quatro');
        $customerEmail->CharSet = 'UTF-8';
        $customerEmail->isHTML(true);
        $customerEmail->Subject = 'Shrnutí Vaší objednávky';
        $customerEmail->Body = $customerBody;
        $customerEmail->addAddress($email);

        foreach ($_FILES['soubory-desky']['tmp_name'] as $key => $tmp_name) {
            $name = $_FILES['soubory-desky']['name'][$key];
            $path = $_FILES['soubory-desky']['tmp_name'][$key];
            $adminEmail->addAttachment($path, 'desky--' . $name);
        }

        if (!empty($_FILES['soubory-tisk']['tmp_name'][0])) {
            foreach ($_FILES['soubory-tisk']['tmp_name'] as $key => $tmp_name) {
                $name = $_FILES['soubory-tisk']['name'][$key];
                $path = $_FILES['soubory-tisk']['tmp_name'][$key];
                $adminEmail->addAttachment($path, 'prace--' . $name);
            }
        }

        $adminEmail->send();
        $customerEmail->send();

        header('Location: ./order-sent.html');
        exit();
    } catch (Exception $e) {
        echo "Vaše objednávka nemohla být odeslána. Chyba {$adminMail->ErrorInfo}, {$customerMail->ErrorInfo}";
    }
}
?>
<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Objednávka diplomové práce</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&family=Merriweather&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./bootstrap-datepicker/css/bootstrap-datepicker.standalone.min.css">
    <link rel="stylesheet" href="../css/objednavka.min.css">
</head>

<body>
    <a id="logo-mobile" href="https://nastartuj.cz" target="_blank">
        <svg width="100%" height="100%" viewBox="0 0 246 111" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;">
            <path d="M48.258,101.137l-5.984,-0l0,1.084l3.361,0c0.588,0 0.588,0 1.245,-0.027c-0.242,0.255 -0.643,0.803 -1.138,1.526l-3.628,5.261l-0,1.085l6.225,-0l-0,-1.085l-3.776,0c-0.495,0 -0.669,0 -0.99,0.04l0.147,-0.227c0.054,-0.081 0.107,-0.161 0.174,-0.228c0.081,-0.107 0.161,-0.214 0.241,-0.334l0.295,-0.415l3.828,-5.502l0,-1.178Zm-3.587,-0.884l1.218,0l1.472,-1.74l-1.124,0l-0.964,1.111l-0.95,-1.111l-1.125,0l1.473,1.74Zm10.857,0.884l-1.272,-0l-0,8.929l1.272,-0l-0,-8.929Zm13.788,-0l-1.338,-0l-2.182,5.89c-0.308,0.843 -0.469,1.379 -0.603,1.994c-0.174,-0.709 -0.388,-1.365 -0.629,-1.994l-2.182,-5.89l-1.406,-0l3.414,8.929l1.553,-0l3.373,-8.929Zm10.335,-0l-4.966,-0l-0,8.929l5.073,-0l0,-1.085l-3.801,0l-0,-3.039l3.427,0l-0,-1.084l-3.427,0l-0,-2.637l3.694,0l0,-1.084Zm7.511,-0l-1.272,-0l-0,8.929l5.047,-0l-0,-1.085l-3.775,0l-0,-7.844Zm23.253,-0l-1.339,-0l-2.182,5.89c-0.308,0.843 -0.469,1.379 -0.602,1.994c-0.174,-0.709 -0.389,-1.365 -0.629,-1.994l-2.183,-5.89l-1.405,-0l3.414,8.929l1.552,-0l3.374,-8.929Zm12.061,-0l0,8.929l1.272,-0l0,-3.976l0.737,-0c1.017,-0 1.258,0.187 1.74,1.298l1.151,2.678l1.473,-0l-1.513,-3.254c-0.335,-0.709 -0.576,-0.99 -1.111,-1.217c0.575,-0.108 0.843,-0.215 1.165,-0.469c0.468,-0.388 0.736,-0.978 0.736,-1.633c-0,-0.991 -0.576,-1.821 -1.473,-2.129c-0.562,-0.187 -0.964,-0.227 -2.021,-0.227l-2.156,-0Zm1.272,1.084l0.924,-0c0.562,-0 0.977,0.04 1.245,0.134c0.562,0.187 0.897,0.642 0.897,1.245c-0,0.562 -0.308,1.004 -0.83,1.218c-0.308,0.12 -0.763,0.174 -1.446,0.174l-0.79,-0l0,-2.771Zm15.65,-1.084l-4.967,-0l0,8.929l5.074,-0l-0,-1.085l-3.802,0l0,-3.039l3.427,0l0,-1.084l-3.427,0l0,-2.637l3.695,-0l-0,-1.084Zm7.51,-0l-1.272,-0l0,8.929l1.272,-0l0,-3.508c0,-0.375 0,-0.548 -0.013,-0.91c0.281,0.348 0.642,0.763 0.816,0.95l3.253,3.468l1.848,-0l-4.565,-4.699l4.203,-4.23l-1.713,-0l-3.119,3.239c-0.241,0.255 -0.415,0.455 -0.737,0.817c0.027,-0.308 0.027,-0.455 0.027,-1.071l0,-2.985Zm12.584,-0l-1.272,-0l0,8.929l5.047,-0l-0,-1.085l-3.775,0l-0,-7.844Zm13.36,-0l-1.338,-0l-3.802,8.929l1.379,-0l0.923,-2.263l4.337,0l0.938,2.263l1.432,-0l-3.869,-8.929Zm1.058,5.582l-3.494,-0l0.991,-2.463c0.508,-1.272 0.602,-1.513 0.749,-2.021c0.067,0.334 0.295,0.977 0.723,1.994l1.031,2.49Zm17.992,-5.582l-2.129,-0l-1.7,4.457c-0.629,1.62 -0.883,2.343 -1.071,3.026c-0.066,-0.322 -0.107,-0.455 -0.267,-0.924c-0.094,-0.281 -0.362,-0.977 -0.79,-2.075l-1.754,-4.484l-2.102,-0l0,8.929l1.272,-0l0,-5.007c0,-0.188 -0.013,-0.482 -0.027,-0.883l-0.026,-1.031c-0.014,-0.482 -0.014,-0.482 -0.081,-1.219l0,-0.2l0.081,0.241l0.147,0.455c0.04,0.16 0.134,0.415 0.321,0.923c0.429,1.125 0.723,1.928 0.897,2.383l1.687,4.338l1.231,-0l1.674,-4.338c0.094,-0.227 0.187,-0.495 0.334,-0.91c0.134,-0.348 0.255,-0.696 0.389,-1.058c0.214,-0.589 0.321,-0.896 0.388,-1.111l0.214,-0.696c0.027,-0.067 0.054,-0.147 0.08,-0.227l0,0.187c-0.026,0.776 -0.04,2.289 -0.04,3.052l0,5.101l1.272,-0l-0,-8.929Zm11.419,-0l-4.966,-0l-0,8.929l5.073,-0l0,-1.085l-3.802,0l0,-3.039l3.428,0l-0,-1.084l-3.428,0l0,-2.637l3.695,-0l0,-1.084Zm-3.092,-0.884l1.218,0l1.472,-1.74l-1.124,0l-0.964,1.111l-0.95,-1.111l-1.125,0l1.473,1.74Z" style="fill:#124094;" />
            <path d="M35.167,98.644l-8.271,-8.067c2.668,-1.334 3.895,-2.295 5.283,-4.216c2.348,-3.148 3.575,-7.31 3.575,-12.167c0,-5.816 -1.761,-10.886 -4.856,-14.035c-2.988,-3.041 -7.898,-4.856 -13.128,-4.856c-10.939,-0 -17.77,7.098 -17.77,18.518c-0,5.763 1.708,10.886 4.589,13.874c2.829,2.989 8.219,5.025 13.128,5.025c0.213,0 0.694,0 1.227,-0.053l5.603,5.977l10.62,-0Zm-17.29,-36.35c2.242,-0 4.429,1.174 5.817,3.202c1.494,2.134 2.188,4.909 2.188,8.912c-0,6.884 -3.095,11.26 -7.952,11.26c-2.401,-0 -4.696,-1.281 -6.03,-3.309c-1.387,-2.135 -2.027,-4.696 -2.027,-8.378c-0,-3.949 0.746,-6.778 2.347,-8.805c1.388,-1.761 3.576,-2.882 5.657,-2.882Zm30.204,-6.137l-0,21.025c-0,5.07 0.907,8.112 3.202,10.674c2.721,3.041 7.204,4.758 12.381,4.758c4.322,-0 8.004,-1.236 10.833,-3.638c2.935,-2.561 4.269,-5.87 4.269,-10.726l-0,-22.093l-9.606,0l-0,21.079c-0,3.415 -0.107,4.216 -0.694,5.443c-0.907,1.815 -2.775,2.935 -4.963,2.935c-2.028,0 -3.735,-0.907 -4.749,-2.508c-0.8,-1.227 -1.067,-2.775 -1.067,-5.924l0,-21.025l-9.606,0Zm78.232,35.594l-13.661,-35.594l-11.367,0l-13.554,35.594l9.552,0l2.881,-7.524l13.235,-0l2.722,7.524l10.192,0Zm-15.155,-14.088l-8.859,0l4.003,-12.061c0.266,-0.8 0.48,-1.707 0.587,-2.454c0.16,0.96 0.213,1.28 0.587,2.508l3.682,12.007Zm38.635,14.088l0,-28.283l8.699,-0l-0,-7.097l-27.056,-0l-0,7.097l8.752,-0l-0,28.283l9.605,0Zm29.618,0l-0,-13.715l1.547,0c3.522,0 4.909,1.068 6.084,4.75l2.881,8.965l9.979,0l-3.575,-9.819c-2.081,-5.924 -2.828,-6.937 -5.443,-7.631c4.643,-0.961 7.151,-4.002 7.151,-8.645c-0,-3.415 -1.441,-6.137 -4.056,-7.738c-2.081,-1.227 -4.856,-1.761 -9.499,-1.761l-14.675,0l-0,35.594l9.606,0Zm-0.267,-20.545l-0,-8.218l3.202,-0c4.109,-0 6.083,1.387 6.083,4.215c0,2.722 -1.761,4.003 -5.603,4.003l-3.682,-0Zm48.081,-15.903c-5.23,-0 -10.086,1.868 -13.181,5.017c-2.988,3.095 -4.643,7.897 -4.643,13.501c0,5.763 1.708,10.779 4.696,13.874c2.989,2.989 8.058,4.919 13.128,4.919c5.657,-0 11.046,-2.304 14.088,-5.986c2.402,-2.935 3.789,-7.471 3.789,-12.434c-0,-5.55 -1.387,-10.086 -4.002,-13.181c-3.095,-3.629 -8.112,-5.71 -13.875,-5.71Zm0.054,6.991c4.909,-0 7.951,4.536 7.951,11.9c-0,6.991 -3.042,11.42 -7.898,11.42c-4.963,0 -8.058,-4.482 -8.058,-11.633c-0,-7.151 3.148,-11.687 8.005,-11.687" style="fill:#124094;" />
            <path d="M118.468,11.095c0.381,0 0.759,0.013 1.135,0.035c4.683,-6.224 11.857,-10.46 20.571,-11.13c-7.083,1.853 -11.605,6.518 -13.938,12.764c6.589,2.976 11.193,9.614 11.193,17.292c-0,2.094 -0.344,4.11 -0.976,5.996c2.45,-0.212 5.008,0.225 7.529,1.389c3.31,1.526 5.818,4.093 7.321,7.134c-1.222,-1.394 -2.745,-2.558 -4.532,-3.384c-5.267,-2.43 -11.31,-1.207 -15.252,2.608l-0.006,-0.006c-0.078,0.073 -0.155,0.147 -0.234,0.219c-2.411,-1.982 -4.455,-4.398 -6.009,-7.126c1.755,-1.749 2.845,-4.166 2.845,-6.83c-0,-5.313 -4.333,-9.647 -9.647,-9.647c-5.313,0 -9.646,4.334 -9.646,9.647c-0,4.674 3.354,8.59 7.778,9.464c1.295,3.383 3.194,6.472 5.565,9.133c-1.196,0.238 -2.432,0.364 -3.697,0.364c-10.443,-0 -18.961,-8.518 -18.961,-18.961c0,-10.443 8.518,-18.961 18.961,-18.961" style="fill:#ef7c00;" />
        </svg>
    </a>
    <a id="logo-desktop" href="https://nastartuj.cz" target="_blank">
        <svg width="100%" height="100%" viewBox="0 0 700 152" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;">
            <path d="M271.739,126.015l-16.873,-16.457c5.443,-2.721 7.947,-4.681 10.777,-8.6c4.791,-6.423 7.294,-14.914 7.294,-24.821c0,-11.865 -3.592,-22.207 -9.907,-28.63c-6.096,-6.205 -16.111,-9.907 -26.779,-9.907c-22.316,-0 -36.251,14.48 -36.251,37.775c-0,11.758 3.483,22.208 9.362,28.304c5.77,6.097 16.765,10.252 26.78,10.252c0.436,-0 1.414,-0 2.503,-0.109l11.43,12.193l21.664,0Zm-35.271,-74.154c4.573,0 9.036,2.396 11.866,6.532c3.049,4.354 4.463,10.016 4.463,18.18c0,14.043 -6.313,22.971 -16.219,22.971c-4.899,-0 -9.581,-2.615 -12.302,-6.751c-2.831,-4.354 -4.137,-9.579 -4.137,-17.091c-0,-8.056 1.523,-13.826 4.789,-17.962c2.832,-3.593 7.295,-5.879 11.54,-5.879Zm61.615,-12.519l-0,42.892c-0,10.342 1.851,16.547 6.532,21.772c5.552,6.205 14.697,9.706 25.256,9.706c8.819,0 16.33,-2.521 22.1,-7.421c5.986,-5.223 8.709,-11.974 8.709,-21.88l-0,-45.069l-19.596,0l-0,43.001c-0,6.966 -0.217,8.599 -1.414,11.103c-1.852,3.702 -5.662,5.988 -10.125,5.988c-4.137,0 -7.621,-1.851 -9.689,-5.117c-1.633,-2.504 -2.177,-5.66 -2.177,-12.083l0,-42.892l-19.596,0Zm159.592,72.611l-27.869,-72.611l-23.188,0l-27.651,72.611l19.487,0l5.878,-15.35l26.998,-0l5.552,15.35l20.793,0Zm-30.918,-28.739l-18.071,-0l8.165,-24.603c0.544,-1.633 0.98,-3.484 1.198,-5.007c0.326,1.959 0.435,2.611 1.198,5.116l7.51,24.494Zm78.817,28.739l-0,-57.696l17.744,-0l0,-14.479l-55.193,0l-0,14.479l17.854,-0l-0,57.696l19.595,0Zm60.417,0l-0,-27.978l3.157,-0c7.185,-0 10.015,2.178 12.41,9.688l5.879,18.29l20.356,0l-7.293,-20.031c-4.246,-12.084 -5.77,-14.151 -11.103,-15.567c9.47,-1.959 14.587,-8.164 14.587,-17.635c0,-6.968 -2.939,-12.519 -8.274,-15.785c-4.246,-2.505 -9.906,-3.593 -19.377,-3.593l-29.937,0l-0,72.611l19.595,0Zm-0.544,-41.911l-0,-16.765l6.532,-0c8.382,-0 12.41,2.83 12.41,8.599c-0,5.553 -3.593,8.166 -11.43,8.166l-7.512,-0Zm98.084,-32.442c-10.668,-0 -20.576,3.81 -26.889,10.234c-6.096,6.313 -9.471,16.111 -9.471,27.541c-0,11.758 3.484,21.99 9.58,28.304c6.097,6.097 16.438,10.033 26.78,10.033c11.539,0 22.534,-4.698 28.74,-12.21c4.899,-5.987 7.729,-15.24 7.729,-25.365c-0,-11.321 -2.83,-20.574 -8.165,-26.889c-6.315,-7.402 -16.547,-11.648 -28.304,-11.648Zm0.109,14.261c10.015,0 16.22,9.253 16.22,24.276c-0,14.262 -6.205,23.297 -16.112,23.297c-10.124,0 -16.438,-9.145 -16.438,-23.732c0,-14.588 6.423,-23.841 16.33,-23.841" style="fill:#264796;" />
            <path d="M58.571,34.256c1.178,0 2.344,0.04 3.505,0.109c14.467,-19.228 36.628,-32.312 63.547,-34.382c-21.881,5.724 -35.849,20.134 -43.055,39.429c20.351,9.195 34.575,29.698 34.575,53.416c-0,6.469 -1.062,12.697 -3.014,18.523c7.567,-0.656 15.469,0.695 23.257,4.289c10.225,4.716 17.972,12.644 22.614,22.038c-3.773,-4.307 -8.48,-7.902 -14,-10.453c-16.268,-7.508 -34.937,-3.728 -47.114,8.055l-0.019,-0.018c-0.24,0.228 -0.478,0.455 -0.721,0.679c-7.45,-6.126 -13.762,-13.588 -18.565,-22.015c5.423,-5.401 8.79,-12.869 8.79,-21.098c-0,-16.413 -13.386,-29.799 -29.8,-29.799c-16.413,0 -29.799,13.386 -29.799,29.799c-0,14.439 10.362,26.534 24.028,29.233c4,10.454 9.865,19.996 17.192,28.214c-3.696,0.735 -7.513,1.125 -11.421,1.125c-32.26,-0 -58.571,-26.311 -58.571,-58.572c-0,-32.26 26.311,-58.572 58.571,-58.572" style="fill:#ef7c00;" />
        </svg>
    </a>
    <form id="order-form" class="survey-form" name="order-form" method="POST" action="" enctype="multipart/form-data" required>
        <!-- page 1 -->
        <fieldset class="step-content current" data-step="1">
            <div class="step-indicator">
                <svg viewBox="0 0 122 122" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;">
                    <path d="M121.186,20c-0,-11.046 -8.955,-20 -20,-20l-81.186,0c-11.046,0 -20,8.954 -20,20l0,81.186c0,11.045 8.954,20 20,20l81.186,-0c11.045,-0 20,-8.955 20,-20l-0,-81.186Z" style="fill:#ef7c02;" />
                    <path d="M33,103.044c-1.698,-0 -3.184,-0.637 -4.458,-1.91c-1.273,-1.274 -1.91,-2.76 -1.91,-4.458l0,-72.167c0,-1.698 0.637,-3.183 1.91,-4.457c1.274,-1.273 2.76,-1.91 4.458,-1.91l55.186,-0c1.698,-0 3.184,0.637 4.457,1.91c1.274,1.274 1.911,2.759 1.911,4.457l-0,72.167c-0,1.698 -0.637,3.184 -1.911,4.458c-1.273,1.273 -2.759,1.91 -4.457,1.91l-55.186,-0Zm28.23,-50.305l10.294,-5.943l10.294,5.943l0,-28.23l-20.588,0l-0,28.23Z" style="fill:#fff;fill-rule:nonzero;" />
                </svg>
                <p>Vaše diplomová práce</p>
            </div>
            <section>
                <p class="required-fields-notice"><span>*</span>&nbsp;Povinná pole</p>
            </section>
            <section>
                <h3>Počet zhotovení pevných desek <span class="required-asterisk">*</span></h3>
                <p class="subtitle">Zde vyplňte počet prací, které chcete nechat vyrobit.</p>
                <div class="range-slider range-slider--dotted">
                    <input id="pevne-desky" class="range-slider__input js-dotted-range-slider" type="range" name="pevne-desky" value="0" min="0" max="6" required>
                </div>
                <div id="value-of-pevne-desky" class="input-value"></div>
            </section>
            <section>
                <h3>Počet zhotovení kroužkových vazeb <span class="required-asterisk">*</span></h3>
                <p class="subtitle">Listy se proděraví a svážou pomocí plastové spirály. Z důvodů nízkých finančních nároků je oblíbenou volbou pro vazbu práce určené pro vlastní potřebu.</p>
                <div class="range-slider range-slider--dotted">
                    <input id="krouzkove-vazby" class="range-slider__input js-dotted-range-slider" type="range" name="krouzkove-vazby" value="0" min="0" max="6" required>
                </div>
                <div id="value-of-krouzkove-vazby" class="input-value"></div>
            </section>
            <section>
                <h3>Požadovaný termín zhotovení <span class="required-asterisk">*</span></h3>
                <p class="subtitle">Zvolte datum kdy si svou práci vyzvednete. Pouze v pracovní dny.</p>
                <div id="termin-zhotoveni-datepicker" class="input-group date" data-provide="datepicker">
                    <input id="termin-zhotoveni" type="text" name="termin-zhotoveni" inputmode="none" class="form-control">
                    <div class="input-group-addon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                            <path d="M128 0c17.7 0 32 14.3 32 32V64H288V32c0-17.7 14.3-32 32-32s32 14.3 32 32V64h48c26.5 0 48 21.5 48 48v48H0V112C0 85.5 21.5 64 48 64H96V32c0-17.7 14.3-32 32-32zM0 192H448V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V192zm64 80v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16H80c-8.8 0-16 7.2-16 16zm128 0v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16H208c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16H336zM64 400v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H80c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H208zm112 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H336c-8.8 0-16 7.2-16 16z" />
                        </svg>
                    </div>
                </div>
            </section>
            <section>
                <h3>Moje práce má <span class="required-asterisk">*</span></h3>
                <p class="subtitle">Důležitý údaj pro výrobu - podle něj zvolíme tloušťku hřbetu, počty stran jsou pro běžný kancelářský papír, máte li práci vytištěnou na jiném papíře, vybírejte podle údajů v mm. Pokud chcete oboustranný tisk Vaši práce, zadejte počet listů a ne stran.</p>
                <div class="range-slider range-slider--dotted">
                    <input id="pocet-listu" class="range-slider__input js-dotted-range-slider" type="range" name="pocet-listu" value="1" min="1" max="8" required>
                </div>
                <div id="value-of-pocet-listu" class="input-value"></div>
            </section>
            <div class="price-wrapper">
                <div class="row-1">
                    <h3>Cena:</h2>
                        <p class="price"><ins class="price-value"></ins> Kč</p>
                </div>
                <div class="row-2">
                    <p>Uvedená cena je pouze orientační a nezahrnuje cenu za samotný tisk listů práce a cenu kalkuluje s max. 4 řádky tisku na desky.</p>
                </div>
            </div>
            <div class="buttons">
                <a href="javascript:void(0);" class="btn btn-forward" data-set-step="2">
                    <svg viewBox="0 0 64 64" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;">
                        <rect x="0" y="0" width="64" height="64" style="fill:none;" />
                        <path d="M64,32c0,-2.76 -2.24,-5 -5,-5l-54,0c-2.76,0 -5,2.24 -5,5c0,2.76 2.24,5 5,5l54,0c2.76,0 5,-2.24 5,-5Z" />
                        <path d="M62.537,28.463c-1.952,-1.951 -5.12,-1.951 -7.072,0l-21.213,21.214c-1.951,1.951 -1.951,5.119 0,7.071c1.952,1.951 5.12,1.951 7.071,-0l21.214,-21.213c1.951,-1.952 1.951,-5.12 -0,-7.072Z" />
                        <path d="M62.537,35.537c1.951,-1.952 1.951,-5.12 -0,-7.072l-21.214,-21.213c-1.951,-1.951 -5.119,-1.951 -7.071,0c-1.951,1.952 -1.951,5.12 0,7.071l21.213,21.214c1.952,1.951 5.12,1.951 7.072,-0Z" />
                    </svg>
                </a>
            </div>
        </fieldset>
        <!-- page 2 -->
        <fieldset class="step-content next" data-step="2">
            <div class="step-indicator">
                <svg viewBox="0 0 122 122" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;">
                    <path d="M121.186,20c-0,-11.046 -8.955,-20 -20,-20l-81.186,0c-11.046,0 -20,8.954 -20,20l0,81.186c0,11.045 8.954,20 20,20l81.186,-0c11.045,-0 20,-8.955 20,-20l-0,-81.186Z" style="fill:#ef7c02;" />
                    <path d="M30.896,101.272c-2.541,0 -5.043,-0.429 -7.509,-1.288c-2.465,-0.859 -4.632,-2.26 -6.5,-4.203c2.615,-0.896 4.483,-2.204 5.604,-3.922c1.12,-1.718 1.681,-4.034 1.681,-6.948c-0,-3.287 1.139,-6.07 3.418,-8.349c2.278,-2.279 5.061,-3.418 8.349,-3.418c3.287,0 6.07,1.139 8.348,3.418c2.279,2.279 3.418,5.062 3.418,8.349c0,4.781 -1.625,8.704 -4.874,11.767c-3.25,3.063 -7.229,4.594 -11.935,4.594Zm25.775,-26.559l-10.086,-10.646l42.136,-42.137c1.046,-1.046 2.204,-1.587 3.474,-1.625c1.27,-0.037 2.466,0.505 3.586,1.625l3.25,3.25c1.121,1.121 1.662,2.335 1.625,3.642c-0.037,1.308 -0.579,2.485 -1.625,3.53l-42.36,42.361Z" style="fill:#fff;fill-rule:nonzero;" />
                </svg>
                <p>Přizpůsobte si vaši vazbu</p>
            </div>
            <section>
                <p class="required-fields-notice"><span>*</span>&nbsp;Povinná pole</p>
            </section>
            <section id="section-barva-desek">
                <h3>Barva desek <span class="required-asterisk">*</span></h3>
                <p class="subtitle">Vybere si barvu desek z modré, černé nebo bordó (červené).</p>
                <div class="barvy">
                    <div class="barva-desek">
                        <input type="radio" name="barva-desek" value="Černá" id="black" required checked>
                        <label for="black">Černá</label>
                    </div>
                    <div class="barva-desek">
                        <input type="radio" name="barva-desek" value="Modrá" id="blue">
                        <label for="blue">Modrá</label>
                    </div>
                    <div class="barva-desek">
                        <input type="radio" name="barva-desek" value="Bordó" id="bordeaux">
                        <label for="bordeaux">Bordó</label>
                    </div>
                </div>
            </section>
            <section id="section-barva-pisma">
                <h3>Barva písma <span class="required-asterisk">*</span></h3>
                <p class="subtitle">Barva ražby na deskách. Nabízíme zlatou, nebo stříbrnou.</p>
                <div class="barvy">
                    <div class="barva-pisma">
                        <input type="radio" name="barva-pisma" value="Zlatý tisk" id="gold" required checked>
                        <label for="gold">Zlatý tisk</label>
                    </div>
                    <div class="barva-pisma">
                        <input type="radio" name="barva-pisma" value="Stříbrný tisk" id="silver">
                        <label for="silver">Stříbrný tisk</label>
                    </div>
                </div>
            </section>
            <section>
                <h3>Chci do vazby i kapsy na CD/DVD <span class="required-asterisk">*</span></h3>
                <p class="subtitle">Do každé práce se většinou dává 1 kapsa na CD. Je třeba uvést kolik kapes fyzicky požadujete.</p>
                <div class="range-slider range-slider--dotted">
                    <input id="kapsy-cd-dvd" class="range-slider__input js-dotted-range-slider" type="range" name="kapsy-cd-dvd" value="0" min="0" max="6" required>
                </div>
                <div id="value-of-kapsy-cd-dvd" class="input-value"></div>
            </section>
            <section>
                <h3>Chci do vazby i chlopně na přílohy <span class="required-asterisk">*</span></h3>
                <p class="subtitle">Tento údaj nevyplňujte, pokud máte přílohy součástí práce a budou se vázat do desek. Pokud máte pořílohy zvlášť (většinou výkresy, nebo jiné materiály) je třeba uvést kolik chlopní fyzicky požadujete.</p>
                <div class="range-slider range-slider--dotted">
                    <input id="chlopne-na-prilohy" class="range-slider__input js-dotted-range-slider" type="range" name="chlopne-na-prilohy" value="0" min="0" max="6" required>
                </div>
                <div id="value-of-chlopne-na-prilohy" class="input-value"></div>
            </section>
            <section>
                <input type="checkbox" name="listy-navic" id="listy-navic">
                <label for="listy-navic">Budu do vazby vkládat ještě nějaké listy (např. originál zadání)</label>
            </section>
            <section>
                <textarea id="poznamka" name="poznamka" placeholder="Pole určené pro jiné požadavky a přání."></textarea>
            </section>
            <section class="section-soubory">
                <h3>Soubor s údaji na desky <span class="required-asterisk">*</span></h3>
                <p>Zde vložte pouze přední list (tak, jak mají desky vypadat). Bez toho nejsme schopni desky vyrobit.</p>
                <p>Můžete vložit až 5 souborů. Podporované formáty: PDF, DOCX, DOC</p>
                <input type="file" name="soubory-desky[]" id="soubory-desky" accept=".pdf,.doc,.docx" multiple>
            </section>
            <section>
                <input type="checkbox" name="vytisknout-praci" id="vytisknout-praci">
                <label for="vytisknout-praci">Chci vytisknout i samotnou práci</label>
            </section>
            <div class="price-wrapper">
                <div class="row-1">
                    <h3>Cena:</h2>
                        <p class="price"><ins class="price-value"></ins> Kč</p>
                </div>
                <div class="row-2">
                    <p>Uvedená cena je pouze orientační a nezahrnuje cenu za samotný tisk listů práce a cenu kalkuluje s max. 4 řádky tisku na desky.</p>
                </div>
            </div>
            <div class="buttons">
                <a href="javascript:void(0);" class="btn btn-prev alt" data-set-step="1">
                    <svg viewBox="0 0 64 64" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;">
                        <rect x="0" y="0" width="64" height="64" style="fill:none;" />
                        <g>
                            <path d="M64,32c0,-2.76 -2.24,-5 -5,-5l-54,0c-2.76,0 -5,2.24 -5,5c0,2.76 2.24,5 5,5l54,0c2.76,0 5,-2.24 5,-5Z" />
                            <path d="M29.748,7.252c-1.952,-1.951 -5.12,-1.951 -7.071,0l-21.214,21.213c-1.951,1.952 -1.951,5.12 0,7.072c1.952,1.951 5.12,1.951 7.072,-0l21.213,-21.214c1.951,-1.951 1.951,-5.119 -0,-7.071Z" />
                            <path d="M29.748,56.748c1.951,-1.952 1.951,-5.12 -0,-7.071l-21.213,-21.214c-1.952,-1.951 -5.12,-1.951 -7.072,0c-1.951,1.952 -1.951,5.12 0,7.072l21.214,21.213c1.951,1.951 5.119,1.951 7.071,-0Z" />
                        </g>
                    </svg>
                </a>
                <a href="javascript:void(0);" class="btn btn-forward" data-set-step="3">
                    <svg viewBox="0 0 64 64" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;">
                        <rect x="0" y="0" width="64" height="64" style="fill:none;" />
                        <g>
                            <path d="M64,32c0,-2.76 -2.24,-5 -5,-5l-54,0c-2.76,0 -5,2.24 -5,5c0,2.76 2.24,5 5,5l54,0c2.76,0 5,-2.24 5,-5Z" />
                            <path d="M62.537,28.463c-1.952,-1.951 -5.12,-1.951 -7.072,0l-21.213,21.214c-1.951,1.951 -1.951,5.119 0,7.071c1.952,1.951 5.12,1.951 7.071,-0l21.214,-21.213c1.951,-1.952 1.951,-5.12 -0,-7.072Z" />
                            <path d="M62.537,35.537c1.951,-1.952 1.951,-5.12 -0,-7.072l-21.214,-21.213c-1.951,-1.951 -5.119,-1.951 -7.071,0c-1.951,1.952 -1.951,5.12 0,7.071l21.213,21.214c1.952,1.951 5.12,1.951 7.072,-0Z" />
                        </g>
                    </svg>
                </a>
            </div>
        </fieldset>
        <!-- page 3 -->
        <fieldset class="step-content next hidden" data-step="3">
            <div class="step-indicator">
                <svg viewBox="0 0 122 122" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;">
                    <path d="M121.186,20c-0,-11.046 -8.955,-20 -20,-20l-81.186,0c-11.046,0 -20,8.954 -20,20l0,81.186c0,11.045 8.954,20 20,20l81.186,-0c11.045,-0 20,-8.955 20,-20l-0,-81.186Z" style="fill:#ef7c02;" />
                    <path d="M60.593,60.467c-5.555,-0 -10.099,-1.768 -13.634,-5.302c-3.534,-3.535 -5.301,-8.079 -5.301,-13.634c-0,-5.554 1.767,-10.098 5.301,-13.633c3.535,-3.535 8.079,-5.302 13.634,-5.302c5.554,0 10.099,1.767 13.633,5.302c3.535,3.535 5.302,8.079 5.302,13.633c0,5.555 -1.767,10.099 -5.302,13.634c-3.534,3.534 -8.079,5.302 -13.633,5.302Zm-40.395,40.521l-0,-11.866c-0,-3.198 0.799,-5.933 2.398,-8.205c1.599,-2.273 3.661,-3.998 6.186,-5.176c5.638,-2.525 11.045,-4.418 16.221,-5.681c5.175,-1.262 10.372,-1.893 15.59,-1.893c5.218,-0 10.393,0.652 15.527,1.957c5.133,1.304 10.519,3.177 16.158,5.617c2.609,1.178 4.713,2.903 6.312,5.176c1.599,2.272 2.398,5.007 2.398,8.205l0,11.866l-80.79,0Z" style="fill:#fff;fill-rule:nonzero;" />
                </svg>
                <p>Tisk práce</p>
            </div>
            <section>
                <p class="required-fields-notice"><span>*</span>&nbsp;Povinná pole</p>
            </section>
            <section>
                <h3>Typ tisku <span class="required-asterisk">*</span></h3>
                <div class="subtitle">Vyberte, zda-li tisknout celou práci černobíle, nebo barevně a černobíle.</div>
                <div class="barvy">
                    <div class="typ-tisku">
                        <input type="radio" name="typ-tisku" value="Černobíle" id="bw" checked>
                        <label for="bw">Černobíle</label>
                    </div>
                    <div class="typ-tisku">
                        <input type="radio" name="typ-tisku" value="Barevně" id="colour">
                        <label for="colour">Barevně</label>
                    </div>
                </div>
            </section>
            <section>
                <h3>Počet výtisků <span class="required-asterisk">*</span></h3>
                <div class="subtitle">Upřesněte, kolikrát máme práci vytisknout. Počítá se i spirálová vazba, pokud ji máte objednanou.</div>
                <div class="range-slider range-slider--dotted">
                    <input id="pocet-vytisku" class="range-slider__input js-dotted-range-slider" type="range" name="pocet-vytisku" value="1" min="1" max="6" required>
                </div>
                <div id="value-of-pocet-vytisku" class="input-value"></div>
            </section>
            <section>
                <h3>Soubor k tisku (PDF) <span class="required-asterisk">*</span></h3>
                <div class="subtitle">Zde nahrajte Váš soubor nachystaný k tisku. Pouze formát PDF, v jiném formátu nebudeme schopni práci vytisknout.</div>
                <input type="file" name="soubory-tisk[]" id="soubory-tisk" accept=".pdf" multiple>
            </section>
            <div class="price-wrapper">
                <div class="row-1">
                    <h3>Cena:</h2>
                        <p class="price"><ins class="price-value"></ins> Kč</p>
                </div>
                <div class="row-2">
                    <p>Uvedená cena je pouze orientační a nezahrnuje cenu za samotný tisk listů práce a cenu kalkuluje s max. 4 řádky tisku na desky.</p>
                </div>
            </div>
            <div class="buttons">
                <a href="javascript:void(0);" class="btn btn-prev alt" data-set-step="2">
                    <svg viewBox="0 0 64 64" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;">
                        <rect x="0" y="0" width="64" height="64" style="fill:none;" />
                        <g>
                            <path d="M64,32c0,-2.76 -2.24,-5 -5,-5l-54,0c-2.76,0 -5,2.24 -5,5c0,2.76 2.24,5 5,5l54,0c2.76,0 5,-2.24 5,-5Z" />
                            <path d="M29.748,7.252c-1.952,-1.951 -5.12,-1.951 -7.071,0l-21.214,21.213c-1.951,1.952 -1.951,5.12 0,7.072c1.952,1.951 5.12,1.951 7.072,-0l21.213,-21.214c1.951,-1.951 1.951,-5.119 -0,-7.071Z" />
                            <path d="M29.748,56.748c1.951,-1.952 1.951,-5.12 -0,-7.071l-21.213,-21.214c-1.952,-1.951 -5.12,-1.951 -7.072,0c-1.951,1.952 -1.951,5.12 0,7.072l21.214,21.213c1.951,1.951 5.119,1.951 7.071,-0Z" />
                        </g>
                    </svg>
                </a>
                <a href="javascript:void(0);" class="btn btn-forward" data-set-step="4">
                    <svg viewBox="0 0 64 64" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;">
                        <rect x="0" y="0" width="64" height="64" style="fill:none;" />
                        <g>
                            <path d="M64,32c0,-2.76 -2.24,-5 -5,-5l-54,0c-2.76,0 -5,2.24 -5,5c0,2.76 2.24,5 5,5l54,0c2.76,0 5,-2.24 5,-5Z" />
                            <path d="M62.537,28.463c-1.952,-1.951 -5.12,-1.951 -7.072,0l-21.213,21.214c-1.951,1.951 -1.951,5.119 0,7.071c1.952,1.951 5.12,1.951 7.071,-0l21.214,-21.213c1.951,-1.952 1.951,-5.12 -0,-7.072Z" />
                            <path d="M62.537,35.537c1.951,-1.952 1.951,-5.12 -0,-7.072l-21.214,-21.213c-1.951,-1.951 -5.119,-1.951 -7.071,0c-1.951,1.952 -1.951,5.12 0,7.071l21.213,21.214c1.952,1.951 5.12,1.951 7.072,-0Z" />
                        </g>
                    </svg>
                </a>
            </div>
        </fieldset>
        <!-- page 4 -->
        <fieldset class="step-content next" data-step="4">
            <div class="step-indicator">
                <svg viewBox="0 0 122 122" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;">
                    <path d="M121.186,20c-0,-11.046 -8.955,-20 -20,-20l-81.186,0c-11.046,0 -20,8.954 -20,20l0,81.186c0,11.045 8.954,20 20,20l81.186,-0c11.045,-0 20,-8.955 20,-20l-0,-81.186Z" style="fill:#ef7c02;" />
                    <path d="M60.593,60.467c-5.555,-0 -10.099,-1.768 -13.634,-5.302c-3.534,-3.535 -5.301,-8.079 -5.301,-13.634c-0,-5.554 1.767,-10.098 5.301,-13.633c3.535,-3.535 8.079,-5.302 13.634,-5.302c5.554,0 10.099,1.767 13.633,5.302c3.535,3.535 5.302,8.079 5.302,13.633c0,5.555 -1.767,10.099 -5.302,13.634c-3.534,3.534 -8.079,5.302 -13.633,5.302Zm-40.395,40.521l-0,-11.866c-0,-3.198 0.799,-5.933 2.398,-8.205c1.599,-2.273 3.661,-3.998 6.186,-5.176c5.638,-2.525 11.045,-4.418 16.221,-5.681c5.175,-1.262 10.372,-1.893 15.59,-1.893c5.218,-0 10.393,0.652 15.527,1.957c5.133,1.304 10.519,3.177 16.158,5.617c2.609,1.178 4.713,2.903 6.312,5.176c1.599,2.272 2.398,5.007 2.398,8.205l0,11.866l-80.79,0Z" style="fill:#fff;fill-rule:nonzero;" />
                </svg>
                <p>Představte se nám</p>
            </div>
            <input id="name" type="text" name="name" placeholder="Jméno a příjmení" autocomplete="name" required>
            <input id="email" type="email" name="email" placeholder="E-mail" autocomplete="email" required>
            <input id="tel" type="tel" name="tel" placeholder="Telefonní číslo" autocomplete="tel" required>
            <div class="buttons">
                <a href="javascript:void(0);" class="btn btn-prev alt" data-set-step="3">
                    <svg viewBox="0 0 64 64" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;">
                        <rect x="0" y="0" width="64" height="64" style="fill:none;" />
                        <g>
                            <path d="M64,32c0,-2.76 -2.24,-5 -5,-5l-54,0c-2.76,0 -5,2.24 -5,5c0,2.76 2.24,5 5,5l54,0c2.76,0 5,-2.24 5,-5Z" />
                            <path d="M29.748,7.252c-1.952,-1.951 -5.12,-1.951 -7.071,0l-21.214,21.213c-1.951,1.952 -1.951,5.12 0,7.072c1.952,1.951 5.12,1.951 7.072,-0l21.213,-21.214c1.951,-1.951 1.951,-5.119 -0,-7.071Z" />
                            <path d="M29.748,56.748c1.951,-1.952 1.951,-5.12 -0,-7.071l-21.213,-21.214c-1.952,-1.951 -5.12,-1.951 -7.072,0c-1.951,1.952 -1.951,5.12 0,7.072l21.214,21.213c1.951,1.951 5.119,1.951 7.071,-0Z" />
                        </g>
                    </svg>
                </a>
                <a href="javascript:void(0);" class="btn btn-forward" data-set-step="5">
                    <svg viewBox="0 0 64 64" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;">
                        <rect x="0" y="0" width="64" height="64" style="fill:none;" />
                        <path d="M64,32c0,-2.76 -2.24,-5 -5,-5l-54,0c-2.76,0 -5,2.24 -5,5c0,2.76 2.24,5 5,5l54,0c2.76,0 5,-2.24 5,-5Z" />
                        <path d="M62.537,28.463c-1.952,-1.951 -5.12,-1.951 -7.072,0l-21.213,21.214c-1.951,1.951 -1.951,5.119 0,7.071c1.952,1.951 5.12,1.951 7.071,-0l21.214,-21.213c1.951,-1.952 1.951,-5.12 -0,-7.072Z" />
                        <path d="M62.537,35.537c1.951,-1.952 1.951,-5.12 -0,-7.072l-21.214,-21.213c-1.951,-1.951 -5.119,-1.951 -7.071,0c-1.951,1.952 -1.951,5.12 0,7.071l21.213,21.214c1.952,1.951 5.12,1.951 7.072,-0Z" />
                    </svg>
                </a>
            </div>
        </fieldset>
        <!-- page 5 -->
        <fieldset class="step-content next" data-step="5">
            <div class="step-indicator">
                <svg viewBox="0 0 122 122" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;">
                    <path d="M121.186,20c-0,-11.046 -8.955,-20 -20,-20l-81.186,0c-11.046,0 -20,8.954 -20,20l-0,81.186c0,11.045 8.954,20 20,20l81.186,-0c11.045,-0 20,-8.955 20,-20l-0,-81.186Z" style="fill:#ef7c02;" />
                    <path d="M54.125,77.452l30.643,-30.749l-4.559,-4.56l-26.084,26.19l-12.618,-12.618l-4.559,4.56l17.177,17.177Zm-25.342,21.313c-1.696,-0 -3.181,-0.637 -4.453,-1.909c-1.273,-1.272 -1.909,-2.757 -1.909,-4.453l0,-63.62c0,-1.696 0.636,-3.181 1.909,-4.453c1.272,-1.273 2.757,-1.909 4.453,-1.909l63.62,0c1.696,0 3.181,0.636 4.453,1.909c1.272,1.272 1.909,2.757 1.909,4.453l-0,63.62c-0,1.696 -0.637,3.181 -1.909,4.453c-1.272,1.272 -2.757,1.909 -4.453,1.909l-63.62,-0Z" style="fill:#fff;fill-rule:nonzero;" />
                </svg>
                <p>Je vše v pořádku?</p>
            </div>
            <section>
                <table class="order-summary">
                    <tr>
                        <th>Jméno a příjmení</th>
                        <td data-input="name"></td>
                    </tr>
                    <tr>
                        <th>E-mail</th>
                        <td data-input="email"></td>
                    </tr>
                    <tr>
                        <th>Telefonní číslo</th>
                        <td data-input="tel"></td>
                    </tr>
                    <tr>
                        <th>Počet zhotovení pevných desek</th>
                        <td data-input="pevne-desky"></td>
                    </tr>
                    <tr>
                        <th>Počet zhotovení kroužkových vazeb</th>
                        <td data-input="krouzkove-vazby"></td>
                    </tr>
                    <tr>
                        <th>Požadovaný termín zhotovení</th>
                        <td data-input="termin-zhotoveni"></td>
                    </tr>
                    <tr>
                        <th>Počet listů</th>
                        <td data-input="pocet-listu"></td>
                    </tr>
                    <tr>
                        <th>Barva desek</th>
                        <td data-input="barva-desek"></td>
                    </tr>
                    <tr>
                        <th>Barva písma</th>
                        <td data-input="barva-pisma"></td>
                    </tr>
                    <tr>
                        <th>Počet kapes na CD/DVD</th>
                        <td data-input="kapsy-cd-dvd"></td>
                    </tr>
                    <tr>
                        <th>Počet chlopní na přílohy</th>
                        <td data-input="chlopne-na-prilohy"></td>
                    </tr>
                    <tr>
                        <th>Do vazby budou vkládány další listy</th>
                        <td data-input="listy-navic"></td>
                    </tr>
                    <tr>
                        <th>Poznámka</th>
                        <td data-input="poznamka"></td>
                    </tr>
                    <tr>
                        <th>Soubory s údaji na desky</th>
                        <td data-input="soubory-desky"></td>
                    </tr>
                    <tr id="typ-tisku-row" style="display: none;">
                        <th>Typ tisku</th>
                        <td data-input="typ-tisku"></td>
                    </tr>
                    <tr id="pocet-vytisku-row" style="display: none;">
                        <th>Počet výtisků</th>
                        <td data-input="pocet-vytisku"></td>
                    </tr>
                    <tr id="soubory-tisk-row" style="display: none;">
                        <th>Soubory k tisku</th>
                        <td data-input="soubory-tisk"></td>
                    </tr>
                    <tr>
                        <th>Orientační cena</th>
                        <td><ins class="price-value"></ins> Kč</td>
                    </tr>
                </table>
            </section>
            <section>
                <div class="misto-vyzvednuti">
                    <p>Místo vyzvednutí:</p>
                    <p>QUATRO - Bohumínská 323/21, Karviná - Staré město</p>
                    <p>Pondělí - pátek: 8.00 - 16.00</p>
                    <p>V případě dotazů volejte na <a href="tel:+420596324040">+420 596 324 040</a></p>
                </div>
            </section>
            <section>
                <input type="checkbox" name="obchodni-podminky" id="obchodni-podminky" required>
                <label for="obchodni-podminky" id="label-obchodni-podminky">Souhlasím s <a href="../obchodni_podminky.html" target="_blank">obchodními podmínkami</a>.</label>
                <input type="hidden" name="price" id="price">
            </section>
            <div class="buttons">
                <a href="javascript:void(0);" class="btn btn-prev alt" data-set-step="4">
                    <svg viewBox="0 0 64 64" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;">
                        <rect x="0" y="0" width="64" height="64" style="fill:none;" />
                        <g>
                            <path d="M64,32c0,-2.76 -2.24,-5 -5,-5l-54,0c-2.76,0 -5,2.24 -5,5c0,2.76 2.24,5 5,5l54,0c2.76,0 5,-2.24 5,-5Z" />
                            <path d="M29.748,7.252c-1.952,-1.951 -5.12,-1.951 -7.071,0l-21.214,21.213c-1.951,1.952 -1.951,5.12 0,7.072c1.952,1.951 5.12,1.951 7.072,-0l21.213,-21.214c1.951,-1.951 1.951,-5.119 -0,-7.071Z" />
                            <path d="M29.748,56.748c1.951,-1.952 1.951,-5.12 -0,-7.071l-21.213,-21.214c-1.952,-1.951 -5.12,-1.951 -7.072,0c-1.951,1.952 -1.951,5.12 0,7.072l21.214,21.213c1.951,1.951 5.119,1.951 7.071,-0Z" />
                        </g>
                    </svg>
                </a>
                <button type="submit" class="btn btn-forward">
                    <svg viewBox="0 0 64 64" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:1.5;">
                        <path d="M5,41.6l18.295,17.4l35.705,-54" style="fill:none;stroke:#fff;stroke-width:10px;" />
                    </svg>
                </button>
            </div>
        </fieldset>
    </form>
    <script src="./js/script.js"></script>
    <!-- Google tag (gtag.js) -->
    <script type="text/plain" data-cookiecategory="analytics" src="https://www.googletagmanager.com/gtag/js?id=G-2ETTMLM0RD"></script>
    <script type="text/plain" data-cookiecategory="analytics">
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-2ETTMLM0RD');
    </script>
    <script src="../js/cookieconsent.js"></script>
    <script src="../js/cookieconsent-init.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="./bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="./bootstrap-datepicker/locales/bootstrap-datepicker.cs.min.js"></script>
    <script>
        $("#termin-zhotoveni-datepicker").datepicker({
            startDate: '0',
            language: "cs",
            orientation: "top left",
            daysOfWeekDisabled: "0,6",
            datesDisabled: [
                "01/01/<?php echo date('Y'); ?>",
                "25/03/<?php echo date('Y'); ?>",
                "28/03/<?php echo date('Y'); ?>",
                "26/04/2023",
                "01/05/<?php echo date('Y'); ?>",
                "05/05/2023",
                "08/05/<?php echo date('Y'); ?>",
                "05/07/<?php echo date('Y'); ?>",
                "06/07/<?php echo date('Y'); ?>",
                "07/07/<?php echo date('Y'); ?>",
                "08/07/<?php echo date('Y'); ?>",
                "28/09/<?php echo date('Y'); ?>",
                "04/10/<?php echo date('Y'); ?>",
                "05/10/<?php echo date('Y'); ?>",
                "06/10/<?php echo date('Y'); ?>",
                "07/10/<?php echo date('Y'); ?>",
                "28/10/<?php echo date('Y'); ?>",
                "17/11/<?php echo date('Y'); ?>",
                "24/12/<?php echo date('Y'); ?>",
                "25/12/<?php echo date('Y'); ?>",
                "26/12/<?php echo date('Y'); ?>"
            ],
            autoclose: true
        });
    </script>
    <script src="./js/makePrice.js"></script>
    <script src="./js/updatePrice.js"></script>
</body>

</html>