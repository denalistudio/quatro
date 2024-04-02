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
    <title>Pronájem ploch - Quatro</title>
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
                    <h1>Pronájem ploch</h1>
                    <div class="plocha" style="margin-top: 0;">
                        <h2>Plocha 001 na ulici Ostravská (01-07)</h2>
                        <div class="plocha__grid">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2572.4292218431465!2d18.5304407159166!3d49.85318143809997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47115560611a5ba1%3A0x95a0c8bed2a46e19!2zT3N0cmF2c2vDoSA3NjcvMjcsIEZyecWhdMOhdCwgNzMzIDAxIEthcnZpbsOh!5e0!3m2!1sen!2scz!4v1648064135018!5m2!1sen!2scz"
                                allowfullscreen="" loading="lazy"></iframe>
                            <a href="../images/pronajem-ploch/pl001_01.jpg" data-lightbox="p001">
                                <img src="../images/pronajem-ploch/pl001_01.jpg" alt="Fotka plochy 1">
                            </a>
                            <a href="../images/pronajem-ploch/pl001_02.jpg" data-lightbox="p001">
                                <img src="../images/pronajem-ploch/pl001_02.jpg" alt="Fotka plochy 1">
                            </a>
                            <a href="../images/pronajem-ploch/pl001_03.jpg" data-lightbox="p001">
                                <img src="../images/pronajem-ploch/pl001_03.jpg" alt="Fotka plochy 1">
                            </a>
                        </div>
                        <div id="btn-p001" class="button"><a>Zobrazit více</a></div>
                        <table id="td-p001">
                            <tr>
                                <th scope="row">Adresa</th>
                                <td>
                                    <p>Karviná - Fryštát</p>
                                    <p>Ostravská 767/27</p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Popis</th>
                                <td>příjezd do Karviné od Ostravy, silnice I. třídy</td>
                            </tr>
                            <tr>
                                <th scope="row">Rozměr</th>
                                <td>
                                    <p><b>plocha 1-4</b>: 500 x 350 cm</p>
                                    <p><b>plocha 5</b>: 986 x 406 cm</p>
                                    <p><b>plocha 6-7</b>: 500 x 200 cm</p>
                                </td>
                            </tr>
                            <tr>
                                <!-- Input type="radio" ID jsou ve formátu p001(číslo místa)-1(číslo místa)-1(číslo času) = p001-1-1 -->
                                <th scope="row">Cena za pronájem</th>
                                <td>
                                    <p><b>plocha 1-4</b></p>
                                    <input type="radio" name="p001-1" id="p001-1-1" checked>
                                    <label for="p001-1-1">3 měsíce</label>
                                    <input type="radio" name="p001-1" id="p001-1-2">
                                    <label for="p001-1-2">6 měsíců</label>
                                    <input type="radio" name="p001-1" id="p001-1-3">
                                    <label for="p001-1-3">12 měsíců</label>
                                    <h4 id="p001-1-p">6300 Kč/měsíc</h4>
                                    <script>
                                        document.getElementById("p001-1-1").addEventListener("click", function () {
                                            document.getElementById("p001-1-p").innerHTML = "6300 Kč/měsíc";
                                        });
                                        document.getElementById("p001-1-2").addEventListener("click", function () {
                                            document.getElementById("p001-1-p").innerHTML = "5700 Kč/měsíc";
                                        });
                                        document.getElementById("p001-1-3").addEventListener("click", function () {
                                            document.getElementById("p001-1-p").innerHTML = "5200 Kč/měsíc";
                                        });
                                    </script>
                                    <p><b>plocha 5</b></p>
                                    <input type="radio" name="p001-2" id="p001-2-1" checked>
                                    <label for="p001-2-1">3 měsíce</label>
                                    <input type="radio" name="p001-2" id="p001-2-2">
                                    <label for="p001-2-2">6 měsíců</label>
                                    <input type="radio" name="p001-2" id="p001-2-3">
                                    <label for="p001-2-3">12 měsíců</label>
                                    <h4 id="p001-2-p">5500 Kč/měsíc</h4>
                                    <script>
                                        document.getElementById("p001-2-1").addEventListener("click", function () {
                                            document.getElementById("p001-2-p").innerHTML = "5500 Kč/měsíc";
                                        });
                                        document.getElementById("p001-2-2").addEventListener("click", function () {
                                            document.getElementById("p001-2-p").innerHTML = "5200 Kč/měsíc";
                                        });
                                        document.getElementById("p001-2-3").addEventListener("click", function () {
                                            document.getElementById("p001-2-p").innerHTML = "4600 Kč/měsíc";
                                        });
                                    </script>
                                    <p><b>plocha 6 a 7</b></p>
                                    <input type="radio" name="p001-3" id="p001-3-1" checked>
                                    <label for="p001-3-1">3 měsíce</label>
                                    <input type="radio" name="p001-3" id="p001-3-2">
                                    <label for="p001-3-2">6 měsíců</label>
                                    <input type="radio" name="p001-3" id="p001-3-3">
                                    <label for="p001-3-3">12 měsíců</label>
                                    <h4 id="p001-3-p">9200 Kč/měsíc</h4>
                                    <script>
                                        document.getElementById("p001-3-1").addEventListener("click", function () {
                                            document.getElementById("p001-3-p").innerHTML = "9200 Kč/měsíc";
                                        });
                                        document.getElementById("p001-3-2").addEventListener("click", function () {
                                            document.getElementById("p001-3-p").innerHTML = "8600 Kč/měsíc";
                                        });
                                        document.getElementById("p001-3-3").addEventListener("click", function () {
                                            document.getElementById("p001-3-p").innerHTML = "7800 Kč/měsíc";
                                        });
                                    </script>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Minimální doba pronájmu</th>
                                <td>3 měsíce</td>
                            </tr>
                            <tr>
                                <th scope="row">Poloha</th>
                                <td>kolmo ke komunikaci</td>
                            </tr>
                            <tr>
                                <th scope="row">Umístění panelu</th>
                                <td>v blízkosti mimoúrovňové křižovatky silnic I. třídy</td>
                            </tr>
                            <tr>
                                <th scope="row">GPS</th>
                                <td>49.8531785, 18.5283421</td>
                            </tr>
                            <tr>
                                <th scope="row">Street View</th>
                                <td><a
                                        href="https://www.google.cz/maps/@49.852654,18.530928,3a,75y,78.33h,80.28t/data=!3m4!1e1!3m2!1slqxzi_ZFIiWXpowW_fEXHQ!2e0?hl=cs">Odkaz</a>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <hr>
                    <div class="plocha">
                        <h2>Plocha 002 na třídě 17. listopadu (07-15)</h2>
                        <div class="plocha__grid">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2572.85093255304!2d18.5557815!3d49.8452584!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4713fffe3623731f%3A0x5c7f33ac5b6ae4fb!2zQm_FvmtvdmEgODQ3LzQsIFLDoWosIDczNCAwMSBLYXJ2aW7DoQ!5e0!3m2!1sen!2scz!4v1648104396259!5m2!1sen!2scz"
                                allowfullscreen="" loading="lazy"></iframe>
                            <a href="../images/pronajem-ploch/pl002_01.jpg" data-lightbox="p002">
                                <img src="../images/pronajem-ploch/pl002_01.jpg" alt="Fotka plochy 2">
                            </a>
                            <a href="../images/pronajem-ploch/pl002_02.jpg" data-lightbox="p002">
                                <img src="../images/pronajem-ploch/pl002_02.jpg" alt="Fotka plochy 2">
                            </a>
                            <a href="../images/pronajem-ploch/pl002_03.jpg" data-lightbox="p002">
                                <img src="../images/pronajem-ploch/pl002_03.jpg" alt="Fotka plochy 2">
                            </a>
                        </div>
                        <div id="btn-p002" class="button"><a>Zobrazit více</a></div>
                        <table id="td-p002">
                            <tr>
                                <th scope="row">Adresa</th>
                                <td>
                                    <p>Karviná - Ráj</p>
                                    <p>tř. 17. listopadu (Božkova 847/4)</p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Popis</th>
                                <td>příjezd do Karviné od Českého Těšína, silnice I. třídy</td>
                            </tr>
                            <tr>
                                <th scope="row">Rozměr</th>
                                <td>
                                    <p><b>plocha 8, 9, 11, 12, 14, 15</b>: 500 x 300 cm</p>
                                    <p><b>plocha 10</b>: 430 x 300 cm</p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Cena za pronájem</th>
                                <td>
                                    <p><b>plocha 11, 12, 14 a 15</b></p>
                                    <input type="radio" name="p002-1" id="p002-1-1" checked>
                                    <label for="p002-1-1">3 měsíce</label>
                                    <input type="radio" name="p002-1" id="p002-1-2">
                                    <label for="p002-1-2">6 měsíců</label>
                                    <input type="radio" name="p002-1" id="p002-1-3">
                                    <label for="p002-1-3">12 měsíců</label>
                                    <h4 id="p002-1-p">3900 Kč/měsíc</h4>
                                    <script>
                                        document.getElementById("p002-1-1").addEventListener("click", function () {
                                            document.getElementById("p002-1-p").innerHTML = "3900 Kč/měsíc";
                                        });
                                        document.getElementById("p002-1-2").addEventListener("click", function () {
                                            document.getElementById("p002-1-p").innerHTML = "3400 Kč/měsíc";
                                        });
                                        document.getElementById("p002-1-3").addEventListener("click", function () {
                                            document.getElementById("p002-1-p").innerHTML = "2800 Kč/měsíc";
                                        });
                                    </script>
                                    <p><b>plocha 8, 9 a 10</b></p>
                                    <input type="radio" name="p002-2" id="p002-2-1" checked>
                                    <label for="p002-2-1">3 měsíce</label>
                                    <input type="radio" name="p002-2" id="p002-2-2">
                                    <label for="p002-2-2">6 měsíců</label>
                                    <input type="radio" name="p002-2" id="p002-2-3">
                                    <label for="p002-2-3">12 měsíců</label>
                                    <h4 id="p002-2-p">4500 Kč/měsíc</h4>
                                    <script>
                                        document.getElementById("p002-2-1").addEventListener("click", function () {
                                            document.getElementById("p002-2-p").innerHTML = "4500 Kč/měsíc";
                                        });
                                        document.getElementById("p002-2-2").addEventListener("click", function () {
                                            document.getElementById("p002-2-p").innerHTML = "3900 Kč/měsíc";
                                        });
                                        document.getElementById("p002-2-3").addEventListener("click", function () {
                                            document.getElementById("p002-2-p").innerHTML = "3400 Kč/měsíc";
                                        });
                                    </script>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Minimální doba pronájmu</th>
                                <td>3 měsíce</td>
                            </tr>
                            <tr>
                                <th scope="row">Poloha</th>
                                <td>kolmo ke komunikaci</td>
                            </tr>
                            <tr>
                                <th scope="row">Umístění panelu</th>
                                <td>v blízkosti kruhového objezdu u OD Tesco</td>
                            </tr>
                            <tr>
                                <th scope="row">GPS</th>
                                <td>49.8452584, 18.5557815</td>
                            </tr>
                            <tr>
                                <th scope="row">Street View</th>
                                <td><a
                                        href="https://www.google.cz/maps/@49.845075,18.555862,3a,75y,341.06h,80.15t/data=!3m4!1e1!3m2!1sfLGZeqreRvm2oECdgBQttQ!2e0?hl=cs">Odkaz</a>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <hr>
                    <div class="plocha">
                        <h2>Plocha 003 na ulici Bohumínská</h2>
                        <div class="plocha__grid">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d10285.431604101268!2d18.5033889!3d49.8733051!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x17a221dae1a1adfe!2zNDnCsDUyJzIzLjkiTiAxOMKwMzAnMTIuMiJF!5e0!3m2!1sen!2scz!4v1648105734647!5m2!1sen!2scz"
                                allowfullscreen="" loading="lazy"></iframe>
                            <a href="../images/pronajem-ploch/pl003_01.jpg" data-lightbox="p003">
                                <img src="../images/pronajem-ploch/pl003_01.jpg" alt="Fotka plochy 3">
                            </a>
                            <a href="../images/pronajem-ploch/pl003_02.jpg" data-lightbox="p003">
                                <img src="../images/pronajem-ploch/pl003_02.jpg" alt="Fotka plochy 3">
                            </a>
                        </div>
                        <div id="btn-p003" class="button"><a>Zobrazit více</a></div>
                        <table id="td-p003">
                            <tr>
                                <th scope="row">Adresa</th>
                                <td>
                                    <p>Karviná - Staré město</p>
                                    <p>Bohumínská 323</p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Popis</th>
                                <td>příjezd do Karviné od Bohumína, před průmyslovou zónou, silnice I. třídy</td>
                            </tr>
                            <tr>
                                <th scope="row">Rozměr</th>
                                <td>490 x 260cm</td>
                            </tr>
                            <tr>
                                <th scope="row">Cena za pronájem</th>
                                <td>
                                    <input type="radio" name="p003-1" id="p003-1-1" checked>
                                    <label for="p003-1-1">3 měsíce</label>
                                    <input type="radio" name="p003-1" id="p003-1-2">
                                    <label for="p003-1-2">6 měsíců</label>
                                    <input type="radio" name="p003-1" id="p003-1-3">
                                    <label for="p003-1-3">12 měsíců</label>
                                    <h4 id="p003-1-p">3500 Kč/měsíc</h4>
                                    <script>
                                        document.getElementById("p003-1-1").addEventListener("click", function () {
                                            document.getElementById("p003-1-p").innerHTML = "3500 Kč/měsíc";
                                        });
                                        document.getElementById("p003-1-2").addEventListener("click", function () {
                                            document.getElementById("p003-1-p").innerHTML = "2900 Kč/měsíc";
                                        });
                                        document.getElementById("p003-1-3").addEventListener("click", function () {
                                            document.getElementById("p003-1-p").innerHTML = "2300 Kč/měsíc";
                                        });
                                    </script>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Minimální doba pronájmu</th>
                                <td>3 měsíce</td>
                            </tr>
                            <tr>
                                <th scope="row">Poloha</th>
                                <td>kolmo ke komunikaci</td>
                            </tr>
                            <tr>
                                <th scope="row">Umístění panelu</th>
                                <td>štít rodinného domu</td>
                            </tr>
                            <tr>
                                <th scope="row">GPS</th>
                                <td>49.873306, 18.503389</td>
                            </tr>
                            <tr>
                                <th scope="row">Street View</th>
                                <td><a
                                        href="https://www.google.cz/maps/@49.8735278,18.5035912,3a,75y,206.13h,84.68t/data=!3m6!1e1!3m4!1sz4Ugf_ouag1hXW1f3OUJ0Q!2e0!7i13312!8i6656?hl=cs">Odkaz</a>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <hr>
                    <div class="plocha">
                        <h2>Plocha 005 na ulici Rudé Armády (01-03)</h2>
                        <div class="plocha__grid">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2572.1387160923537!2d18.545339115710053!3d49.85863887939812!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xf1acd065ec9c79bc!2zNDnCsDUxJzMxLjEiTiAxOMKwMzInNTEuMSJF!5e0!3m2!1sen!2scz!4v1648135752036!5m2!1sen!2scz"
                                allowfullscreen="" loading="lazy"></iframe>
                            <a href="../images/pronajem-ploch/pl005_01.jpg" data-lightbox="p005">
                                <img src="../images/pronajem-ploch/pl005_01.jpg" alt="Fotka plochy 5">
                            </a>
                            <a href="../images/pronajem-ploch/pl005_02.jpg" data-lightbox="p005">
                                <img src="../images/pronajem-ploch/pl005_02.jpg" alt="Fotka plochy 5">
                            </a>
                            <a href="../images/pronajem-ploch/pl005_03.jpg" data-lightbox="p005">
                                <img src="../images/pronajem-ploch/pl005_03.jpg" alt="Fotka plochy 5">
                            </a>
                        </div>
                        <div id="btn-p005" class="button"><a>Zobrazit více</a></div>
                        <table id="td-p005">
                            <tr>
                                <th scope="row">Adresa</th>
                                <td>
                                    <p>Karviná - Mizerov</p>
                                    <p>Rudé Armády</p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Popis</th>
                                <td>silnice I. třídy</td>
                            </tr>
                            <tr>
                                <th scope="row">Rozměr</th>
                                <td><b>plochy 1, 2 a 3</b>: 790x250 cm</td>
                            </tr>
                            <tr>
                                <th scope="row">Cena za pronájem</th>
                                <td>
                                    <p><b>plochy 1, 2 a 3</b></p>
                                    <input type="radio" name="p005-1" id="p005-1-1" checked>
                                    <label for="p005-1-1">6 měsíce</label>
                                    <input type="radio" name="p005-1" id="p005-1-2">
                                    <label for="p005-1-2">12 měsíců</label>
                                    <h4 id="p005-1-p">3100 Kč/měsíc</h4>
                                    <script>
                                        document.getElementById("p005-1-1").addEventListener("click", function () {
                                            document.getElementById("p005-1-p").innerHTML = "3100 Kč/měsíc";
                                        });
                                        document.getElementById("p005-1-2").addEventListener("click", function () {
                                            document.getElementById("p005-1-p").innerHTML = "2600 Kč/měsíc";
                                        });
                                    </script>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Minimální doba pronájmu</th>
                                <td>6 měsíců</td>
                            </tr>
                            <tr>
                                <th scope="row">Poloha</th>
                                <td>kolmo ke komunikaci</td>
                            </tr>
                            <tr>
                                <th scope="row">Umístění panelu</th>
                                <td>spojovací silnice Ostrava, Český Těšín směr Petrovice u Karviné</td>
                            </tr>
                            <tr>
                                <th scope="row">GPS</th>
                                <td>49.858638, 18.547335</td>
                            </tr>
                            <tr>
                                <th scope="row">Street View</th>
                                <td><a
                                        href="https://www.google.cz/maps/@49.8584708,18.5474247,3a,75y,185.85h,73.11t/data=!3m6!1e1!3m4!1s3RrXoVBv4NFR6v8xnVvYeg!2e0!7i13312!8i6656">Odkaz</a>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <hr>
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
        $("#nav-mobile").load("../components/nav-mobile-sluzby.html");
        $("#sidebar").load("../components/aside.html");
        $("footer").load("../components/footer.html");
    </script>
    <script src="../js/script.js"></script>
    <script src="../js/lightbox.js"></script>
    <script>
        $('#btn-p001').click(function () {
            if ($('#btn-p001').hasClass("active")) {
                $('#td-p001').hide();
                $('#btn-p001 a').html("Zobrazit více");
                $('#btn-p001').removeClass("active")
            }
            else {
                $('#td-p001').show();
                $('#btn-p001 a').html("Skrýt");
                $('#btn-p001').addClass("active");
            }
        });
        $('#btn-p002').click(function () {
            if ($('#btn-p002').hasClass("active")) {
                $('#td-p002').hide();
                $('#btn-p002 a').html("Zobrazit více");
                $('#btn-p002').removeClass("active")
            }
            else {
                $('#td-p002').show();
                $('#btn-p002 a').html("Skrýt");
                $('#btn-p002').addClass("active");
            }
        });
        $('#btn-p003').click(function () {
            if ($('#btn-p003').hasClass("active")) {
                $('#td-p003').hide();
                $('#btn-p003 a').html("Zobrazit více");
                $('#btn-p003').removeClass("active")
            }
            else {
                $('#td-p003').show();
                $('#btn-p003 a').html("Skrýt");
                $('#btn-p003').addClass("active");
            }
        });
        $('#btn-p005').click(function () {
            if ($('#btn-p005').hasClass("active")) {
                $('#td-p005').hide();
                $('#btn-p005 a').html("Zobrazit více");
                $('#btn-p005').removeClass("active")
            }
            else {
                $('#td-p005').show();
                $('#btn-p005 a').html("Skrýt");
                $('#btn-p005').addClass("active");
            }
        });
    </script>
</body>

</html>