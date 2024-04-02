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
    <title>Diplomové práce - Quatro</title>
    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./dp/jscripts/ui/themes/base/jquery.ui.all.css">
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
                    <aside id="aside-diplomky"></aside>
                </div>
                <main>
                    <div id="heading-diplomky">
                        <h1>Ceník diplomových prací</h1>
                        <div class="button"><a href="../objednavka">Objednat</a></div>
                    </div>
                    <table id="table-cenik">
                        <tr>
                            <th>položka</th>
                            <th>cena (Kč)</th>
                        </tr>
                        <tr>
                            <td>pevná vazba vč. 4 řádků tisku do 3 dnů</td>
                            <td>199</td>
                        </tr>
                        <tr>
                            <td>pevná vazba vč. 4 řádků tisku do 2 dnů</td>
                            <td>320</td>
                        </tr>
                        <tr>
                            <td>pevná vazba vč. 4 řádků tisku do 24 hodin</td>
                            <td>400</td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <hr>
                            </td>
                        </tr>
                        <tr>
                            <td>desky pro více než 120 listů (>B)</td>
                            <td>70</td>
                        </tr>
                        <tr>
                            <td>další řádek</td>
                            <td>30</td>
                        </tr>
                        <tr>
                            <td>text na hřbet</td>
                            <td>70</td>
                        </tr>
                        <tr>
                            <td>vypálení CD</td>
                            <td>70</td>
                        </tr>
                        <tr>
                            <td>kapsa na CD</td>
                            <td>20</td>
                        </tr>
                        <tr>
                            <td>znovurozvázání/svázaní práce</td>
                            <td>70</td>
                        </tr>
                        <tr>
                            <td>digitální ČB tisk nebo kopírování A4</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>digitální barevný tisk nebo kopírování A4</td>
                            <td>10</td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <hr>
                            </td>
                        </tr>
                        <tr>
                            <td>spirálová (kroužková) vazba vč. krycí fólie a kartonu do 14mm</td>
                            <td>70</td>
                        </tr>
                        <tr>
                            <td>spirálová (kroužková) vazba vč. krycí fólie a kartonu 14-19mm</td>
                            <td>80</td>
                        </tr>
                        <tr>
                            <td>spirálová (kroužková) vazba vč. krycí fólie a kartonu nad 19mm</td>
                            <td>100</td>
                        </tr>
                    </table>
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