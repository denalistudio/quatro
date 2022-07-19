<?php

if (isset($_POST['send'])) {

    // Customer details
    $name = $_POST['name'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];

    // Product details
    $pevneDesky = $_POST['pevne-desky'];
    $krouzkoveVazby = $_POST['krouzkove-vazby'];
    $barvaDesek = $_POST['barva-desek'];
    $barvaPisma = $_POST['barva-pisma'];
    $pocetListu = $_POST['pocet-listu'];
    $kapsyCdDvd = $_POST['kapsy-cd-dvd'];
    $chlopneNaPrilohy = $_POST['chlopne-na-prilohy'];
    $listyNavic = "NE";
    if (isset($_POST['listy-navic'])) {
        $listyNavic = "ANO";
    }
    $poznamka = "ŽÁDNÁ";
    if (strlen($_POST['poznamka'])) {
        $poznamka = htmlspecialchars($_POST['poznamka']);
    }

    // From
    $from = 'admin@studiodenali.cz';

    // To send HTML mail, the Content-type header must be set
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

    // Create email headers
    $headers .= 'From: ' . $from . "\r\n" .
        'Reply-To: ' . $from . "\r\n" .
        'X-Mailer: PHP/' . phpversion();


    // Admin email
    $adminTo = 'admin@studiodenali.cz';
    $adminSubject = 'Nová objednávka';
    $adminMessage = '
    <!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xlmns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style type="text/css">
        body {
            margin: 0;
            background-color: #cccccc;
        }

        table {
            border-spacing: 0;
        }

        td {
            padding: 0;
        }

        img {
            border: 0
        }

        .wrapper {
            width: 100%;
            table-layout: fixed;
            background-color: #cccccc;
            padding: 30px 0 60px 0;
        }

        .main {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            padding: 0 50px;
            border-spacing: 0;
            background-color: #ffffff;
            font-family: "Manrope", sans-serif;
            color: #000000;
        }

        .main,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        td {
            font-family: "Manrope", sans-serif;
        }

        h1 {
            color: #000000;
        }
    </style>
</head>

<body>
    <center class="wrapper">
        <table class="main" width="100%">
            <tr>
                <td style="height: 150px">
                    <a href="https://nastartuj.cz">
                        <img src="./logo.png" height="50px" title="Quatro">
                    </a>
                </td>
            </tr>
            <tr>
                <td>
                    <h1>Kontaktní údaje</h1>
                </td>
            </tr>
            <tr>
                <td>Jméno a příjmení</td>
                <td>' . $name . '</td>
            </tr>
            <tr>
                <td>E-mail</td>
                <td>' . $email . '</td>
            </tr>
            <tr>
                <td>Telefonní číslo</td>
                <td>' . $tel . '</td>
            </tr>
            <tr>
                <td>
                    <h1>Vaše objednávka</h1>
                </td>
            </tr>
            <tr>
                <td>
                    <h2>Shrnutí objednávky</h2>
                </td>
            </tr>
            <tr>
                <td>
                    <table width="100%">
                        <tr>
                            <td colspan="2">Vazba práce</td>
                        </tr>
                        <tr>
                            <td>Počet zhotovení pevných desek</td>
                            <td>' . $pevneDesky . '</td>
                        </tr>
                        <tr>
                            <td>Počet zhotovení kroužkových vazeb</td>
                            <td>' . $krouzkoveVazby . '</td>
                        </tr>
                        <tr>
                            <td>Požadovaný termín objednávky</td>
                            <td>datum</td>
                        </tr>
                        <tr>
                            <td>Počet listů</td>
                            <td>' . $pocetListu . '</td>
                        </tr>
                        <tr>
                            <td>Barva desek</td>
                            <td>' . $barvaDesek . '</td>
                        </tr>
                        <tr>
                            <td>Barva písma</td>
                            <td>' . $barvaPisma . '</td>
                        </tr>
                        <tr>
                            <td>Kapsy na CD/DVD</td>
                            <td>' . $kapsyCdDvd . '</td>
                        </tr>
                        <tr>
                            <td>Chlopně na přílohy</td>
                            <td>' . $chlopneNaPrilohy . '</td>
                        </tr>
                        <tr>
                            <td>Budu do vazby vkládat ještě nějaké listy (např. originální zadání)</td>
                            <td>' . $listyNavic . '</td>
                        </tr>
                        <tr>
                            <td>Poznámka</td>
                            <td>' . $poznamka . '</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <h3>Orientační cena:</h3>
                </td>
                <td>
                    <h3>cena</h3>
                </td>
            </tr>
        </table>
    </center>
</body>

</html>
    ';
    $adminMail = mail($adminTo, $adminSubject, $adminMessage, $headers);

    // Client email
    $clientTo = $email;
    $clientSubject = 'Děkujeme za vaši objednávku - Reklamka Quatro';
    $clientMessage = 'client';
    $clientMail = mail($clientTo, $clientSubject, $clientMessage, $headers);

    // Check if the emails were sent
    if ($adminMail && $clientMail) {
        echo 'Děkujeme za vaši objednávku.';
    } else {
        echo 'Litujeme, ale vaši objednávku se nepodařilo odeslat. Zkuste to prosím znovu.';
    }
};
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>(Dev) Objednávka diplomové práce - Quatro</title>
    <link rel="stylesheet" href="../objednavka.css">
</head>

<body>
    <form method="POST" action="">
        <main>
            <!-- logo -->
            <div class="customer-info">
                <h2>Nová objednávka diplomové práce</h2>
                <input type="text" name="name" placeholder="Jméno a příjmení" value="<?php if (isset($name)) print $name ?>" required>
                <input type="email" name="email" placeholder="E-mail" value="<?php if (isset($email)) print $email ?>" required>
                <input type="tel" name="tel" placeholder="Telefonní číslo" value="<?php if (isset($tel)) print $tel ?>" required>
                <div class="button">
                    <button type="submit">Pokračovat</button>
                </div>
            </div>
        </main>
        <main>
            <div class="product-info">
                <div class="select">
                    <label for="pevne-desky">Počet zhotovení pevných desek</label>
                    <select name="pevne-desky" required>
                        <option value="">Zvolte počet</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                    </select>
                </div>
                <div class="select">
                    <label for="krouzkove-vazby">Počet zhotovení kroužkových vazeb</label>
                    <select name="krouzkove-vazby" required>
                        <option value="">Zvolte počet</option>
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                    </select>
                </div>
                <!-- Požadovaný termín zhotovení -->
                <div class="select">
                    <label for="pocet-listu">Moje práce má</label>
                    <select name="pocet-listu" required>
                        <option value="">Zvolte počet listů</option>
                        <option value="5 mm (AA) 20-40 listů">5 mm (AA) 20-40 listů</option>
                        <option value="10 mm (A) 41-90 listů">10 mm (A) 41-90 listů</option>
                        <option value="13 mm (B) 91-120 listů">13 mm (B) 91-120 listů</option>
                        <option value="16 mm (C) 121-145 listů">16 mm (C) 121-145 listů</option>
                        <option value="20 mm (D) 146-185 listů">20 mm (D) 146-185 listů</option>
                        <option value="24 mm (E) 186-230 listů">24 mm (E) 186-230 listů</option>
                        <option value="28 mm (F) 231-265 listů">28 mm (F) 231-265 listů</option>
                        <option value="32 mm (G) 266-300 listů">32 mm (G) 266-300 listů</option>
                    </select>
                </div>
                <h3>Barva desek</h3>
                <div class="barvy">
                    <div class="barva">
                        <input type="radio" name="barva-desek" value="Černá" id="black" required checked>
                        <label for="black">Černá</label>
                    </div>
                    <div class="barva">
                        <input type="radio" name="barva-desek" value="Modrá" id="blue">
                        <label for="blue">Modrá</label>
                    </div>
                    <div class="barva">
                        <input type="radio" name="barva-desek" value="Bordó" id="bordeaux">
                        <label for="bordeaux">Bordó</label>
                    </div>
                </div>
                <h3>Barva písma</h3>
                <div class="barva">
                    <input type="radio" name="barva-pisma" value="Zlatý tisk" id="gold" required checked>
                    <label for="gold">Zlatý tisk</label>
                    <input type="radio" name="barva-pisma" value="Stříbrný tisk" id="silver">
                    <label for="silver">Stříbrný tisk</label>
                </div>
                <div class="select">
                    <label for="kapsy-cd-dvd">Chci do vazby i kapsy na CD/DVD</label>
                    <select name="kapsy-cd-dvd" required>
                        <option value="">Zvolte počet</option>
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                    </select>
                </div>
                <div class="select">
                    <label for="chlopne-na-prilohy">Chci do vazby i chlopně na přílohy</label>
                    <select name="chlopne-na-prilohy" required>
                        <option value="">Zvolte počet</option>
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                    </select>
                </div>
                <input type="checkbox" name="listy-navic">
                <label for="listy-navic">Budu do vazby vkládat ještě nějaké listy (např. originál zadání)</label>
                <textarea name="poznamka"></textarea>
            </div>
        </main>
        <main>
            <div class="place-order">
                <p>Místo vyzvednutí:</p>
                <p>QUATRO - Bohumínská 323/21, Karviná - Staré město</p>
                <input type="checkbox" name="obchodni-podminky" required>
                <label for="obchodni-podminky">Souhlasím s <a href="" target="_blank">obchodními podmínkami</a>.</label>
                <button type="submit" name="send">Odeslat</button>
            </div>
        </main>
    </form>
</body>

</html>