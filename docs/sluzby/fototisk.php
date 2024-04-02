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
    <title>Fototisk - Quatro</title>
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
                    <h1>Fototisk</h1>
                    <p>Digitální fotografie dosáhla za posledních několik let významného posunu vstříc k laické
                        veřejnosti. Cenově dosažitelné velmi kvalitní digitální zrcadlovky a fotoaparáty s vysokým
                        rozlišením umožní i úplnému začátečníkovi dosáhnout v krátké době úrovně profesionála. A tak víc
                        a víc platí: “Co Čech, to fotograf”. Abyste se však mohli svými výtvory skutečně pokochat a
                        pochválit svým blízkým, je potřeba dílo dokonat kvalitním tiskem. Panoramatická fotografie
                        velehor nebo krajiny nevynikne na monitoru vašeho počítače, ale teprve na dokonale vytištěné
                        barevné fotografii velkého rozměru.
                    </p>
                    <img src="../images/fototisk/fototisk.jpg">
                    <p>Nabízíme Vám kvalitní tisk fotografií nejrůznějších rozměrů. Navíc Vám rádi pomůžeme a poradíme
                        s výběrem kvalitních rámů, které dokonají estetický dojem a doladí fotografii s interiérem.</p>
                    <p>Poradíme si jak s malými fotografiemi, tak i s panoramatickými fotkami třeba i 150x600cm.
                        Tiskneme na širokou škálu materiálů, ať už to jsou lesklé, matné papíry nebo samolepící fólie.
                        Poradíme si i s tiskem na plátno (canvas), které samozřejmě můžeme dodat včetně klínového rámu.
                    </p>
                    <img src="../images/fototisk/vyroba_fotoobrazu.jpg">
                    <p>Proměňte své povedené snímky na mistrovská díla - fotoobrazy. Další oblíbenou formou prezentace
                        je paspartování fotografií, kde dáte vyniknout svým snímkům.</p>
                </main>
            </div>
            <footer>
            </footer>
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
    <script src="../js/cookieconsent.js"></script>
    <script src="../js/cookieconsent-init.js"></script>
    <script>
        $("#navbar").load("../components/header.html");
        $("#nav-mobile").load("../components/nav-mobile-sluzby.html");
        $("#sidebar").load("../components/aside.html");
        $("footer").load("../components/footer.html");
    </script>
    <script src="../js/script.js"></script>
    <script src="../js/lightbox.js"></script>
</body>

</html>