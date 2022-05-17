<?php
require './dp/Nette/loader.php';
date_default_timezone_set('Europe/Prague');
?>
<?php
//funkce na převod řetězců
function friendly_url($old_url)
{
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
//use Nette\Mail\SendmailMailer;
use Nette\Utils\Html;
//use Tracy\Debugger;

//Debugger::enable(); // aktivujeme Laděnku

include "dp/php/defineForm.php";
?>
<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="QUATRO - živel v reklamě">
    <meta name="description" content="Reklamní firma s širokým záběrem a bohatými zkušenostmi, profesionálním přístupem a příznivými cenami.">
    <meta name="keywords" content="reklama, karviná, reklamka, levná, akce, sleva, quatro">
    <title>Objednávka diplomové práce - Quatro</title>
    <link rel="stylesheet" href="./dp/jscripts/ui/themes/base/jquery.ui.all.css">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../lightbox.css">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="../favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../favicon/favicon-16x16.png">
    <link rel="manifest" href="../favicon/site.webmanifest">
    <link rel="mask-icon" href="../favicon/safari-pinned-tab.svg" color="#ef7c00">
    <link rel="shortcut icon" href="../favicon/favicon.ico">
    <meta name="msapplication-TileColor" content="#ef7c00">
    <meta name="msapplication-config" content="../favicon/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <!-- jQuery -->
    <script src="../js/jquery.min.js"></script>
</head>

<body>
    <style>
        .help>summary {
            list-style-type: url(../images/napoveda.svg);
        }
    </style>
    <div class="contain">
        <div id="navbar"></div>
        <nav id="nav-mobile"></nav>
        <div id="container">
            <div id="content" class="sluzby">
                <div id="vypocet_ceny-mobile">
                    <h2>Výpočet ceny: <span style="float: right;"><ins id="showprice-mobile">0</ins> Kč</span></h2>
                    <details>
                        <summary>Více informací</summary>
                        <p>Uvedená cena je pouze orientační a nezahrnuje cenu za samotný tisk listů práce a cenu kalkuluje s max. 4 řádky tisku na desky.</p>
                    </details>
                </div>
                <script>
                    $(function() {
                        var showPriceHeight = $("#vypocet_ceny-mobile").outerHeight();

                        $(window).resize(function() {
                            var showPriceHeight = $("#vypocet_ceny-mobile").outerHeight();
                        })

                        $(":root").css("--vypocet_ceny-mobile-height", showPriceHeight + "px");
                    })
                </script>
                <div id="sidebar">
                    <aside id="aside-diplomky"></aside>
                </div>
                <main class="diplomky">
                    <h1>Diplomové práce</h1>
                    <?php $form->render('begin') ?>

                    <?php $form->render('errors') ?>
                    <?php /******************************VYKRESLENÍ FORMULÁŘE********************************/ ?>
                    <div id='form'>
                        <div class='form'>
                            <h2>Zákazník</h2>
                            <table>
                                <tr class="required">
                                    <th><?php echo $form['name']->label ?></th>
                                    <td>
                                        <div class="input">
                                            <?php echo $form['name']->control ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="required">
                                    <th><?php echo $form['phone']->label ?></th>
                                    <td>
                                        <div class="input">
                                            <?php echo $form['phone']->control ?>
                                        </div>
                                        <div class="napoveda">
                                            <img src="../images/napoveda.svg" title="V případě nejasností Vás budeme kontaktovat na uvedeném telefonním čísle.">
                                        </div>
                                    </td>
                                </tr>
                                <tr class="required">
                                    <th><?php echo $form['email']->label ?></th>
                                    <td>
                                        <div class="input">
                                            <?php echo $form['email']->control ?>
                                        </div>
                                        <div class="napoveda">
                                            <img src="../images/napoveda.svg" title="Budeme vás informovat o přijetí objednávky.">
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <h2>Vazba práce</h2>
                            <table>
                                <tr class="required">
                                    <th><?php echo $form['counthard']->label ?></th>
                                    <td>
                                        <div class="select">
                                            <?php echo $form['counthard']->control ?>
                                        </div>
                                        <div class="napoveda">
                                            <img src="../images/napoveda.svg" title="Zde vyplňte počet prací, které chcete nechat vyrobit.">
                                        </div>
                                    </td>
                                </tr>
                                <tr class="required">
                                    <th><?php echo $form['countring']->label ?></th>
                                    <td>
                                        <div class="select">
                                            <?php echo $form['countring']->control ?>
                                        </div>
                                        <div class="napoveda">
                                            <img src="../images/napoveda.svg" title="Listy se proděraví a svážou pomocí plastové spirály. Z důvodů nízkých finančních nároků je oblíbenou volbou pro vazbu práce určené pro vlastní potřebu.">
                                        </div>
                                    </td>
                                </tr>
                                <tr class="required">
                                    <th><?php echo $form['term']->label ?></th>
                                    <td>
                                        <div class="input">
                                            <?php echo $form['term']->control ?>
                                        </div>
                                        <div class="napoveda">
                                            <img src="../images/napoveda.svg" title="Zvolte datum kdy si svou práci vyzvednete. Pouze v pracovní dny.">
                                        </div>
                                    </td>
                                </tr>
                                <tr class="required">
                                    <th><?php echo $form['type']->label; ?></th>
                                    <td>
                                        <div class="select">
                                            <?php echo $form['type']->control; ?>
                                        </div>
                                        <div class="napoveda">
                                            <img src="../images/napoveda.svg" title="Důležitý údaj pro výrobu - podle něj zvolíme tloušťku hřbetu, počty stran jsou pro běžný kancelářský papír, máte li práci vytištěnou na jiném papíře, vybírejte podle údajů v mm. Pokud chcete oboustranný tisk Vaši práce, zadejte počet listů a ne stran.">
                                        </div>
                                    </td>
                                </tr>
                                <tr class="required">
                                    <th><?php echo $form['color']->label ?></th>
                                    <td>
                                        <div class="select">
                                            <?php echo $form['color']->control ?>
                                        </div>
                                        <div class="napoveda">
                                            <img src="../images/napoveda.svg" title="Vybere si barvu desek z modré, černé nebo červené.">
                                        </div>
                                    </td>
                                </tr>
                                <tr class="required">
                                    <th><?php echo $form['textcolor']->label ?></th>
                                    <td>
                                        <div class="select">
                                            <?php echo $form['textcolor']->control ?>
                                        </div>
                                        <div class="napoveda">
                                            <img src="../images/napoveda.svg" title="Barva ražby na deskách. Nabízíme zlatou, nebo stříbrnou.">
                                        </div>
                                    </td>
                                </tr>
                                <tr class="required">
                                    <th><?php echo $form['countcd']->label; ?></th>
                                    <td>
                                        <div class="select">
                                            <?php echo $form['countcd']->control; ?>
                                        </div>
                                        <div class="napoveda">
                                            <img src="../images/napoveda.svg" title="Do každé práce se většinou dává 1 kapsa na CD. Je třeba uvést kolik kapes fyzicky požadujete.">
                                        </div>
                                    </td>
                                </tr>
                                <tr class="required">
                                    <th><?php echo $form['countannex']->label; ?></th>
                                    <td>
                                        <div class="select">
                                            <?php echo $form['countannex']->control; ?>
                                        </div>
                                        <div class="napoveda">
                                            <img src="../images/napoveda.svg" title="Tento údaj nevyplňujte, pokud máte přílohy součástí práce a budou se vázat do desek. Pokud máte pořílohy zvlášť (většinou výkresy, nebo jiné materiály) je třeba uvést kolik chlopní fyzicky požadujete.">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td><?php echo $form['otherlists']->control;
                                        echo $form['otherlists']->label; ?></td>
                                </tr>
                                <tr class="required">
                                    <th><?php echo $form['message']->label; ?></th>
                                    <td>
                                        <div class="textarea">
                                            <?php echo $form['message']->control; ?>
                                        </div>
                                        <div class="napoveda">
                                            <img src="../images/napoveda.svg" title="Pole určené pro jiné požadavky a přání.">
                                        </div>
                                    </td>
                                </tr>
                                <tr class="required">
                                    <th><?php echo $form['fileinfo1']->label; ?></th>
                                    <td>
                                        <?php echo $form['fileinfo1']->control; ?>
                                        <div class="napoveda">
                                            <img src="../images/napoveda.svg" title="Povinné pole. Zde vložte pouze přední list (tak jak mají desky vypadat) bez toho nejsme schopni desky vyrobit (.pdf, .doc, .docx).">
                                        </div>
                                    </td>
                                </tr>
                                <tr class="fileinfo2">
                                    <th></th>
                                    <td><?php echo $form['fileinfo2']->control; ?>
                                    </td>
                                </tr>
                                <tr class="fileinfo3">
                                    <th></th>
                                    <td><?php echo $form['fileinfo3']->control; ?>
                                    </td>
                                </tr>
                                <tr class="fileinfo4">
                                    <th></th>
                                    <td><?php echo $form['fileinfo4']->control; ?>
                                    </td>
                                </tr>
                                <tr class="fileinfo5">
                                    <th></th>
                                    <td><?php echo $form['fileinfo5']->control; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td><?php echo $form['printall']->control;
                                        echo $form['printall']->label; ?></td>
                                </tr>
                            </table>
                        </div>

                        <div class='form hide'>
                            <h2>Tisk práce</h2>
                            <table>
                                <tr class="required">
                                    <th><?php echo $form['printtype']->label; ?></th>
                                    <td>
                                        <div class="select">
                                            <?php echo $form['printtype']->control; ?>
                                        </div>
                                        <div class="napoveda">
                                            <img src="../images/napoveda.svg" title="Vyberte, zda-li tisknout práci celou černobíle, nebo barevně a černobíle.">
                                        </div>
                                    </td>
                                </tr>
                                <tr class="required">
                                    <th><?php echo $form['countprint']->label; ?></th>
                                    <td>
                                        <div class="select">
                                            <?php echo $form['countprint']->control; ?>
                                        </div>
                                        <div class="napoveda">
                                            <img src="../images/napoveda.svg" title="Upřesněte kolikrát práci vytiskneme, počítá se i spirálová vazba, pokud ji máte objednanou.">
                                        </div>
                                    </td>
                                </tr>
                                <tr class="required">
                                    <th><?php echo $form['file1']->label ?></th>
                                    <td id="fileInput"><?php echo $form['file1']->control ?>
                                        <div class="napoveda">
                                            <img src="../images/napoveda.svg" title="Zde nahrejte Váš soubor, který je komplet nachystán k tisku. POUZE formát PDF, v jiném souboru nebudeme schopni tisknout.">
                                        </div>
                                    </td>
                                </tr>
                                <tr class="file2">
                                    <th></th>
                                    <td id="fileInput"><?php echo $form['file2']->control ?>
                                    </td>
                                </tr>
                                <tr class="file3">
                                    <th></th>
                                    <td id="fileInput"><?php echo $form['file3']->control ?>
                                    </td>
                                </tr>
                                <tr class="file4">
                                    <th></th>
                                    <td id="fileInput"><?php echo $form['file4']->control ?>
                                    </td>
                                </tr>
                                <tr class="file5">
                                    <th></th>
                                    <td id="fileInput"><?php echo $form['file5']->control ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <hr />
                        <div class='form'>
                            <table>
                                <tr class="required">
                                    <th><?php echo $form['place']->label; ?></th>
                                    <td><?php echo $form['place']->control; ?>
                                        <div class="napoveda">
                                            <img src="../images/napoveda.svg" title="Otevřeno každý pracovní den od 8:00 do 16:00 hodin. V případě dotazů volejte +420 596 324 040.">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td><?php echo $form['licence']->control; ?><?php echo $form['licence']->label; ?></td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td><?php echo $form['send']->control ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="hideevery">
                        <?php echo $form['price']->control ?>
                        <?php echo $form['priceone']->control ?>
                    </div>
                    <?php $form->render('end') ?>
                    <?php
                    //echo $form;
                    if ($form->isSubmitted() && $form->isValid()) {
                        $values = $form->getValues();

                        $time = date("H:i");
                        $day = date("d.m.Y");
                        if ($values["otherlists"] == 1) $values["otherlists"] = "Ano";
                        else $values["otherlists"] = "Ne";

                        $message = "$day, $time\n";
                        $message .= "Jméno: $values[name]\n";
                        $message .= "E-mail: $values[email]\n";
                        $message .= "Telefon: $values[phone]\n";
                        $message .= "Počet zhotovení pevných desek: $values[counthard]\n";
                        if ($values["countring"] <> 0) $message .= "Počet zhotovení kroužkových vazeb: $values[countring]\n";
                        $message .= "Termín zhotovení: $values[term]\n";
                        $message .= "Typ desek: $values[type]\n";
                        $message .= "Barva desek: $values[color]\n";
                        $message .= "Barva písma: $values[textcolor]\n";
                        if ($values["countcd"] <> 0) $message .= "Počet kapes na CD: $values[countcd]\n";
                        if ($values["countannex"] <> 0) $message .= "Počet chlopní na přílohy: $values[countannex]\n";
                        $message .= "Budu do vazby vkládat ještě nějaké listy: $values[otherlists]\n";
                        if ($values["message"] <> "") $message .= "Poznámka: $values[message]\n";
                        if ($values["countprint"] <> "") $message .= "Počet výtisků: $values[countprint]\n";
                        if ($values["printtype"] <> "") $message .= "Typ tisku: $values[printtype]\n";
                        $message .= "Vypočítaná orientační cena: $values[price]";
                        $message .= ",- Kč\n";
                        $message .= "Cenový tarif: $values[priceone]";
                        $message .= ",- Kč\n";
                        $message .= "Místo vyzvednutí: $values[place]";

                        $mailname = friendly_url($values["name"]);

                        $mail = new Message;
                        $mail->setFrom("$values[name] <$values[email]>")
                            //->addTo('lukas.fabik@gmail.com')
                            ->addTo('hned@nastartuj.cz')
                            ->setSubject("Objednávka 'diplomky' $values[name]")
                            ->setBody($message);         //    verze prostý text
                        //->send();

                        $mail2 = new Message;
                        $mail2->setFrom('Quatro reklamka <hned@nastartuj.cz>')
                            ->addTo("$values[email]")
                            ->setSubject('Potvrzení objednávky - Quatro reklamka')
                            ->setBody($message);
                        //->send();

                        $fileinfo1 = $form->values["fileinfo1"];
                        if ($fileinfo1->isOK()) {
                            $i++;
                            $type = strtolower(substr($fileinfo1->name, strrpos($fileinfo1->name, ".")));
                            $mail->addAttachment("desky-$mailname-1$type", $fileinfo1->getContents());
                        }
                        $fileinfo2 = $form->values["fileinfo2"];
                        if ($fileinfo2->isOK()) {
                            $i++;
                            $type = strtolower(substr($fileinfo2->name, strrpos($fileinfo2->name, ".")));
                            $mail->addAttachment("desky-$mailname-2$type", $fileinfo2->getContents());
                        }
                        $fileinfo3 = $form->values["fileinfo3"];
                        if ($fileinfo3->isOK()) {
                            $i++;
                            $type = strtolower(substr($fileinfo3->name, strrpos($fileinfo3->name, ".")));
                            $mail->addAttachment("desky-$mailname-3$type", $fileinfo3->getContents());
                        }
                        $fileinfo4 = $form->values["fileinfo4"];
                        if ($fileinfo4->isOK()) {
                            $i++;
                            $type = strtolower(substr($fileinfo4->name, strrpos($fileinfo4->name, ".")));
                            $mail->addAttachment("desky-$mailname-4$type", $fileinfo4->getContents());
                        }
                        $fileinfo5 = $form->values["fileinfo5"];
                        if ($fileinfo5->isOK()) {
                            $i++;
                            $type = strtolower(substr($fileinfo5->name, strrpos($fileinfo5->name, ".")));
                            $mail->addAttachment("desky-$mailname-5$type", $fileinfo5->getContents());
                        }

                        $file1 = $form->values["file1"];
                        if ($file1->isOK()) {
                            $i++;
                            $type = strtolower(substr($file1->name, strrpos($file1->name, ".")));
                            $mail->addAttachment("prace-$mailname-1$type", $file1->getContents());
                        }
                        $file2 = $form->values["file2"];
                        if ($file2->isOK()) {
                            $i++;
                            $type = strtolower(substr($file2->name, strrpos($file2->name, ".")));
                            $mail->addAttachment("prace-$mailname-2$type", $file2->getContents());
                        }
                        $file3 = $form->values["file3"];
                        if ($file3->isOK()) {
                            $i++;
                            $type = strtolower(substr($file3->name, strrpos($file3->name, ".")));
                            $mail->addAttachment("prace-$mailname-3$type", $file3->getContents());
                        }
                        $file4 = $form->values["file4"];
                        if ($file4->isOK()) {
                            $i++;
                            $type = strtolower(substr($file4->name, strrpos($file4->name, ".")));
                            $mail->addAttachment("prace-$mailname-4$type", $file4->getContents());
                        }
                        $file5 = $form->values["file5"];
                        if ($file5->isOK()) {
                            $i++;
                            $type = strtolower(substr($file5->name, strrpos($file5->name, ".")));
                            $mail->addAttachment("prace-$mailname-5$type", $file5->getContents());
                        }

                        $mailer = new Nette\Mail\SendmailMailer;

                        try {
                            $mailer->send($mail);
                            $mailer->send($mail2);
                            echo "sent";
                        } catch (Exception $e) {
                            alert("Omlouváme se, došlo k problému při odeslání e-mailu. Zkuste to, prosím, později.");
                            var_dump($e);
                        }
                    ?>
                        <script>
                            alert("Děkujeme vám za vaší objednávku. Potvrzení přijetí objednávky přijde na vámi uvedený mail. Pokud ne, kontaktujte nás. Hezký den!");
                            window.location.href = 'objednavka';
                        </script>
                    <?php
                    } else {
                    }
                    ?>
                    <div id="vypocet_ceny-desktop">
                        <h2>Výpočet ceny: <span style="float: right;"><ins id="showprice-desktop">0</ins> Kč</span></h2>
                        <p>Uvedená cena je pouze orientační a nezahrnuje cenu za samotný tisk listů práce a cenu kalkuluje s max. 4 řádky tisku na desky.</p>
                    </div>
                </main>
            </div>
            <footer id="footer-diplomky">
            </footer>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-migrate-1.2.1.js"></script>
    <script src="https://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
    <script src="./dp/jscripts/ui/i18n/jquery.ui.datepicker-cs.js"></script>
    <script src="./dp/jscripts/makePrice.js"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script type="text/plain" data-cookiecategory="analytics" src="https://www.googletagmanager.com/gtag/js?id=UA-39022857-1"></script>
    <script type="text/plain" data-cookiecategory="analytics">
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());

        gtag('config', 'UA-39022857-1');
    </script>
    <script src="../js/cookieconsent.js"></script>
    <script src="../js/cookieconsent-init.js"></script>
    <script>
        $("#navbar").load("../components/header-sluzby.html");
        $("#nav-mobile").load("../components/nav-mobile-sluzby.html");
        $("#sidebar").load("../components/aside.html");
        $("footer").load("../components/footer.html");
    </script>
    <script src="../js/script.js"></script>
    <script>
        $(function() {

            var holidays = [
                [1, 1],
                [25, 3],
                [28, 3],
                [1, 5],
                [8, 5],
                [5, 7],
                [6, 7],
                [28, 9],
                [4, 10],
                [5, 10],
                [6, 10],
                [7, 10],
                [28, 10],
                [17, 11],
                [24, 12],
                [25, 12],
                [26, 12]
            ];

            var workingDayOffset = 10,
                selectedDate = new Date();

            function nonWorkingDays(date) {
                for (var j = 0; j < holidays.length; j++) {
                    if (date.getMonth() == holidays[j][1] - 1 && date.getDate() == holidays[j][0]) {
                        return [false, ''];
                    }
                }
                return [true, ''];
            }

            function nonAvailableDays(date) {
                var noWeekend = $.datepicker.noWeekends(date),
                    holiday = nonWorkingDays(date);
                return [noWeekend[0] && holiday[0], ''];
            }

            for (var i = 0; i < workingDayOffset; i++) {
                selectedDate.setDate(selectedDate.getDate() + 1);
                if (!nonAvailableDays(selectedDate)[0]) {
                    i--;
                }
            }

            var date = new Date(); // vytvoří proměnnou obsahující aktuální datum
            var thishour = date.getHours();
            var thisday = date.getDay();
            var days = 0;

            if (thisday == 5) {
                if (thishour > 15) {
                    days = 4;
                } else {
                    days = 3;
                }
            } else if (thisday == 6) {
                days = 3;
            } else if (thisday == 0) {
                days = 2;
            } else {
                if (thishour > 15) {
                    days = 2;
                } else {
                    days = 1;
                }
            }

            $("#frm-term").datepicker({
                minDate: +days,
                beforeShowDay: nonAvailableDays
            })
        });
    </script>
    <script>
        $(document).ready(function() {
            if (!$('#frm-printall').is(':checked')) {
                $('.hide').fadeOut();

            }
            $('.hideevery').fadeOut();
        });
    </script>
    <script>
        $('#frm-printall').change(function() {
            $('.hide').fadeToggle();
        });
    </script>
    <script>
        $('#frm-term').change(function() {
            makeprice();
        });

        $('#frm-counthard').change(function() {
            makeprice();
        });

        $('#frm-countring').change(function() {
            makeprice();
        });

        $('#frm-countcd').change(function() {
            makeprice();
        });

        $('#frm-countannex').change(function() {
            makeprice();
        });
    </script>
    <script>
        function showNextFileInfo(n) {
            $(".fileinfo" + n).show("slow");
        }

        function showNextFile(n) {
            $(".file" + n).show("slow");
        }
    </script>
</body>

</html>