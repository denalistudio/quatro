<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xlmns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
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
                <td><?php echo $name; ?></td>
            </tr>
            <tr>
                <td>E-mail</td>
                <td><?php echo $email; ?></td>
            </tr>
            <tr>
                <td>Telefonní číslo</td>
                <td><?php echo $tel; ?></td>
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
                            <td><?php echo $pevneDesky; ?></td>
                        </tr>
                        <tr>
                            <td>Počet zhotovení kroužkových vazeb</td>
                            <td><?php echo $krouzkoveVazby; ?></td>
                        </tr>
                        <tr>
                            <td>Požadovaný termín objednávky</td>
                            <td>datum</td>
                        </tr>
                        <tr>
                            <td>Počet listů</td>
                            <td><?php echo $pocetListu; ?></td>
                        </tr>
                        <tr>
                            <td>Barva desek</td>
                            <td><?php echo $barvaDesek; ?></td>
                        </tr>
                        <tr>
                            <td>Barva písma</td>
                            <td><?php echo $barvaPisma; ?></td>
                        </tr>
                        <tr>
                            <td>Kapsy na CD/DVD</td>
                            <td><?php echo $kapsyCdDvd; ?></td>
                        </tr>
                        <tr>
                            <td>Chlopně na přílohy</td>
                            <td><?php echo $chlopneNaPrilohy; ?></td>
                        </tr>
                        <tr>
                            <td>Budu do vazby vkládat ještě nějaké listy (např. originální zadání)</td>
                            <td><?php echo $listyNavic; ?></td>
                        </tr>
                        <tr>
                            <td>Poznámka</td>
                            <td><?php echo $poznamka; ?></td>
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