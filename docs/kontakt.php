<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Denali studio">
    <meta name="description"
        content="Reklamní firma s širokým záběrem a bohatými zkušenostmi, profesionálním přístupem a příznivými cenami.">
    <meta name="keywords" content="reklama, karviná, reklamka, levná, akce, sleva, quatro">
    <title>Kontakt - Quatro</title>
    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.min.css">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="./favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./favicon/favicon-16x16.png">
    <link rel="manifest" href="./favicon/site.webmanifest">
    <link rel="mask-icon" href="./favicon/safari-pinned-tab.svg" color="#ef7c00">
    <link rel="shortcut icon" href="./favicon/favicon.ico">
    <meta name="msapplication-TileColor" content="#ef7c00">
    <meta name="msapplication-config" content="./favicon/browserconfig.xml">
    <meta name="theme-color" content="#264796">
    <!-- jQuery -->
    <script src="./js/jquery.min.js"></script>
</head>

<body>
    <div class="contain">
        <div id="navbar"></div>
        <nav id="nav-mobile"></nav>
        <div id="container">
            <div id="content" class="page">
                <main class="kontakt">
                    <div id="kontakt-frajkowski">
                        <h2>Ladislav Frajkowski</h2>
                        <p><b>Mobil:</b> <a href="tel:+420608878770">+420 608 878 770</a></p>
                        <p><b>Telefon:</b> <a href="tel:+420596324040">+420 596 324 040</a></p>
                        <p><b>E-mail:</b> <a href="mailto:reklamka@nastartuj.cz">reklamka@nastartuj.cz</a></p>
                        <div class="button"><a href="./frajkowski.vcf">Uložit kontakt</a></div>
                    </div>
                    <div id="kontakt-oparjukova">
                        <h2>Jana Oparjuková</h2>
                        <p><b>Mobil:</b> <a href="tel:+420771235435">+420 771 235 435</a></p>
                        <p><b>Telefon:</b> <a href="tel:+420596324040">+420 596 324 040</a></p>
                        <p><b>E-mail:</b> <a href="mailto:hned@nastartuj.cz">hned@nastartuj.cz</a></p>
                        <div class="button"><a href="./oparjukova.vcf">Uložit kontakt</a></div>
                    </div>
                    <div id="oteviraci-doba">
                        <h2>Otevírací doba</h2>
                        <p><b>Pondělí - pátek</b></p>
                        <p>8.00 - 16.00</p>
                        <p><b>Sobota a neděle</b></p>
                        <p>Zavřeno</p>
                    </div>
                    <div id="adresa">
                        <h2>Adresa</h2>
                        <p>QUATRO - reklamka</p>
                        <p>Bohumínská 323/21</p>
                        <p>733 01 Karviná - Staré Město</p>
                    </div>
                    <div id="mapa">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2571.356386922012!2d18.50118901591724!3d49.873333536660105!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47115599b9873b4b%3A0xc8d2a1a01e7502d7!2sQUATRO%20-%20%C5%BEivel%20v%20reklam%C4%9B!5e0!3m2!1sen!2scz!4v1646774364487!5m2!1sen!2scz"
                            allowfullscreen="no" loading="lazy">
                        </iframe>
                    </div>
                </main>
                <footer>
                </footer>
            </div>
        </div>
    </div>
    <!-- Google tag (gtag.js) -->
    <script type="text/plain" data-cookiecategory="analytics" src="https://www.googletagmanager.com/gtag/js?id=G-H9F8DP85PF"></script>
    <script type="text/plain" data-cookiecategory="analytics">
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());

        gtag('config', 'G-H9F8DP85PF');
    </script>
    <script src="./js/cookieconsent.js"></script>
    <script src="./js/cookieconsent-init.js"></script>
    <script>
        $("#navbar").load("./components/header.html");
        $("#nav-mobile").load("./components/nav-mobile.html");
        $("footer").load("./components/footer.html");
    </script>
    <script src="./js/script.js"></script>
</body>

</html>