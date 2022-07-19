<?php

if (isset($_POST['send'])) {

    // Customer details
    $name = $_POST['name'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];

    // Product details
    $pevneDesky = $_POST['pevne-desky'];
    $krouzkoveVazby = $_POST['krouzkove-vazby'];

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
                            <td>počet</td>
                        </tr>
                        <tr>
                            <td>Barva desek</td>
                            <td>barva</td>
                        </tr>
                        <tr>
                            <td>Barva písma</td>
                            <td>barva</td>
                        </tr>
                        <tr>
                            <td>Kapsy na CD/DVD</td>
                            <td>počet</td>
                        </tr>
                        <tr>
                            <td>Chlopně na přílohy</td>
                            <td>počet</td>
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

// Compose a simple HTML email message
/*$message = '
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
                            <td>počet</td>
                        </tr>
                        <tr>
                            <td>Počet zhotovení kroužkových vazeb</td>
                            <td>počet</td>
                        </tr>
                        <tr>
                            <td>Požadovaný termín objednávky</td>
                            <td>datum</td>
                        </tr>
                        <tr>
                            <td>Počet listů</td>
                            <td>počet</td>
                        </tr>
                        <tr>
                            <td>Barva desek</td>
                            <td>barva</td>
                        </tr>
                        <tr>
                            <td>Barva písma</td>
                            <td>barva</td>
                        </tr>
                        <tr>
                            <td>Kapsy na CD/DVD</td>
                            <td>počet</td>
                        </tr>
                        <tr>
                            <td>Chlopně na přílohy</td>
                            <td>počet</td>
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

</html>';*/
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>(Dev) Objednávka diplomové práce - Quatro</title>
</head>

<body>
    <h2>Zákazník</h2>
    <form method="POST" action="">
        <div class="customer-info">
            <input type="text" name="name" placeholder="Jméno a příjmení" value="<?php if (isset($name)) print $name ?>" required>
            <input type="email" name="email" placeholder="E-mail" value="<?php if (isset($email)) print $email ?>" required>
            <input type="tel" name="tel" placeholder="Telefonní číslo" value="<?php if (isset($tel)) print $tel ?>" required>
        </div>
        <div class="product-info">
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
            <!-- Požadovaný termín zhotovení -->
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
        <button type="submit" name="send">Odeslat</button>
    </form>
</body>

</html>