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
    <title>Reklamní předměty - Quatro</title>
    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.min.css">
    <link rel="stylesheet" href="../css/lightbox.css">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="../favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../favicon/favicon-16x16.png">
    <link rel="manifest" href="../favicon/site.webmanifest">
    <link rel="mask-icon" href="../favicon/safari-pinned-tab.svg" color="#ef7c00">
    <link rel="shortcut icon" href="../favicon/favicon.ico">
    <meta name="msapplication-TileColor" content="#ef7c00">
    <meta name="msapplication-config" content="../favicon/browserconfig.xml">
    <meta name="theme-color" content="#264796">
    <!-- jQuery -->
    <script src="../js/jquery.min.js"></script>
</head>

<body>
    <div class="contain">
        <div id="navbar"></div>
        <nav id="nav-mobile"></nav>
        <div id="container">
            <div id="content" class="sluzby">
                <div id="sidebar">
                    <aside></aside>
                </div>
                <main>
                    <h1>Dárkové předměty</h1>
                    <p>Reklamní předměty dokážou potěšit nejednoho zákazníka a jejich široké spektrum, které nabízíme,
                        uspokojí
                        i opravdové fajnovky. Přijďte si vybrat i vy z našich katalogů. Samozřejmostí je i jejich
                        potisk. Dodáme
                        včetně tamponového, termotransferového, sítotisku nebo ofsetového tisku.</p>
                    <div class="reklamni_predmety">
                        <a href="http://primgifts.eu/" target="_blank" rel="noopener">
                            <img src="../images/reklamni-predmety/primgifts.jpg" alt="Primgifts" title="Primgifts">
                        </a>
                        <a href="http://www.katalogmagic.cz/" target="_blank" rel="noopener">
                            <img src="../images/reklamni-predmety/3d_profil.jpg" alt="Magic" title="Magic">
                        </a>
                        <!--<a href="https://gallery.reflects.de/onlinekatalog/COMPLETE_2020_EN-MP/" target="_blank"
                            rel="noopener">
                            <img src="../images/reklamni-predmety/live_01.jpg" alt="Complete" title="Complete">
                        </a>
                        <a href="https://gallery.reflects.de/onlinekatalog/RETUMBLER_2020_EN-MP/10/" target="_blank"
                            rel="noopener">
                            <img src="../images/reklamni-predmety/live_02.jpg" alt="Retumbler" title="Retumbler">
                        </a>-->
                        <a href="https://quatro.alltextiles.cz/" target="_blank" rel="noopener">
                            <img src="../images/reklamni-predmety/quatro_alltextiles.png" alt="">
                        </a>
                        <a href="https://onlinecatalog.malfini.com/nastartuj/cs/catalog" target="_blank" rel="noopener">
                            <picture>
                                <source srcset="../images/reklamni-predmety/malfini.webp" type="image/webp">
                                <source srcset="../images/reklamni-predmety/malfini.jpg" type="image/jpeg">
                                <img src="../images/reklamni-predmety/malfini.jpg" alt="Online katalog Malfini" title="Online katalog Malfini">
                            </picture>
                        </a>
                        <a href="https://quatro.hideagifts.com/cz/" target="_blank" rel="noopener">
                            <picture>
                                <source srcset="../images/reklamni-predmety/hidea.webp" type="image/webp">
                                <source srcset="../images/reklamni-predmety/hidea.jpg" type="image/jpeg">
                                <img src="../images/reklamni-predmety/hidea.jpg" alt="">
                            </picture>
                        </a>
                    </div>
                </main>
            </div>
        </div>
        <footer>
        </footer>
    </div>
    <!-- Google tag (gtag.js) -->
    <script type="text/plain" data-cookiecategory="analytics" src="https://www.googletagmanager.com/gtag/js?id=G-H9F8DP85PF"></script>
    <script type="text/plain" data-cookiecategory="analytics">
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());

        gtag('config', 'G-H9F8DP85PF');
    </script>
    <script src="../js/cookieconsent.js"></script>
    <script src="../js/cookieconsent-init.js"></script>
    <script>
        $("#navbar").load("../components/header.html");
        $("#nav-mobile").load("../components/nav-mobile.html");
        $("#sidebar").load("../components/aside.html");
        $("footer").load("../components/footer.html");
    </script>
    <script src="../js/script.js"></script>
    <script src="../js/lightbox.js"></script>
</body>

</html>