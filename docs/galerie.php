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
    <title>Galerie - Quatro</title>
    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.min.css">
    <link rel="stylesheet" href="./css/lightbox.css">
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
    <!-- Gallery styles -->
    <style>
        figure {
            margin: 0;
            padding: 0;
        }

        img {
            display: block;
            max-width: 100%;
        }

        p {
            margin: 1em 0;
            line-height: 1.4;
        }

        /*
        Shuffle needs either relative or absolute positioning on the container
        It will set it for you, but it'll cause another style recalculation and layout.
        AKA worse performance - so just set it here
        */
        .my-shuffle-container {
            position: relative;
            overflow: hidden;
        }

        .my-sizer-element {
            position: absolute;
            opacity: 0;
            visibility: hidden;
        }

        .picture-item {
            height: 220px;
            margin-top: 24px;
        }

        .picture-item img {
            display: block;
            width: 100%;
        }

        @supports ((-o-object-fit: cover) or (object-fit: cover)) {
            .picture-item img {
                max-width: none;
                height: 100%;
                -o-object-fit: cover;
                object-fit: cover;
            }
        }

        .picture-item--h2 {
            height: 464px;
            /* 2x the height + 1 gutter */
        }

        .picture-item__inner {
            position: relative;
            height: 100%;
            overflow: hidden;
            background: #ecf0f1;
        }

        .picture-item__details {
            display: flex;
            align-items: baseline;
            justify-content: space-between;
            width: 100%;
            padding: 1em;
        }

        .picture-item__description {
            width: 100%;
            padding: 0 2em 1em 1em;
            margin: 0;
        }

        .picture-item__title {
            flex-shrink: 0;
            margin-right: 4px;
        }

        .picture-item__tags {
            flex-shrink: 1;
            text-align: right;
            margin: 0;
        }

        @media only screen and (min-width: 48em) {
            .picture-item--overlay .picture-item__details {
                position: absolute;
                bottom: 0;
                left: 0;
                width: 100%;
                -webkit-backdrop-filter: blur(7px);
                backdrop-filter: blur(7px);
                color: white;
                overflow: hidden;
            }

            .picture-item--overlay .picture-item__description {
                display: none;
            }

            .picture-item--overlay a {
                color: white;
                text-shadow: 0 0 1px black;
            }
        }

        @media only screen and (max-width: 48em) {
            .picture-item {
                height: auto;
                margin-top: 20px;
            }

            .picture-item__details,
            .picture-item__description {
                font-size: 0.875em;
                padding: 0.625em;
            }

            .picture-item__description {
                padding-right: 0.875em;
                padding-bottom: 1.25em;
            }

            .picture-item--h2 {
                height: auto;
            }
        }

        .filters-container {
            gap: 1em;
            display: grid;
            grid-template-rows: auto auto;
            grid-template-columns: 1fr;
            grid-template-areas: "filter-search" "filter-options";
        }

        @media only screen and (min-width: 62em) {
            .filters-container {
                grid-template-rows: auto;
                grid-template-columns: 6fr 4fr;
                grid-template-areas: "filter-options filter-search";
            }
        }

        .filter-label {
            display: block;
            margin-top: 0;
            margin-bottom: 0.5em;
            color: #95a5a6;
        }

        .filters-group {
            padding: 0;
            margin: 0 0 4px;
            border: 0;
        }

        @media only screen and (min-width: 48em) {
            .filters-group-wrap {
                display: flex;
                justify-content: space-between;
            }
        }

        .btn-group {
            gap: 0.5em;
            display: inline-flex;
            flex-wrap: wrap;
        }

        .btn-group .btn {
            border-radius: 5em;
        }

        .btn-group label.btn input[type=radio] {
            position: absolute;
            clip: rect(0, 0, 0, 0);
            pointer-events: none;
        }

        .btn {
            display: inline-block;
            padding: 0.75em 0.8em;
            text-align: center;
            border-radius: 3px;
            border: 1px solid #34495e;
            color: #34495e;
            font-size: 1rem;
            background-color: rgba(52, 73, 94, 0);
            transition: 0.2s ease-out;
            cursor: pointer;
            -webkit-appearance: none;
        }

        @media (-moz-touch-enabled: 0),
        (pointer: fine) {
            .btn:hover {
                color: #fff;
                text-decoration: none;
                background-color: #ef7c00;
            }
        }

        .btn.active,
        .btn:active {
            outline: none;
            color: #fff;
            background-color: #ef7c00;
        }

        .btn.active:hover,
        .btn:active:hover {
            color: #fff;
            background-color: #dd6b08;
        }

        .btn:disabled {
            cursor: not-allowed;
            opacity: 0.7;
            color: #34495e;
            background-color: rgba(52, 73, 94, 0);
        }

        .btn--primary {
            color: #ef7c00;
            border-color: #ef7c00;
            background-color: rgba(52, 152, 219, 0);
        }

        @media (-moz-touch-enabled: 0),
        (pointer: fine) {
            .btn--primary:hover {
                background-color: #ef7c00;
            }
        }

        .btn--primary.active,
        .btn--primary:active {
            background-color: #ef7c00;
        }

        .btn--primary:disabled {
            color: #3498db;
            background-color: rgba(52, 152, 219, 0);
        }

        @media only screen and (max-width: 48em) {
            .btn {
                font-size: 0.875rem;
            }
        }

        .textfield {
            -webkit-appearance: none;
            box-sizing: border-box;
            width: 100%;
            border: 2px solid #95a5a6;
            border-radius: 4px;
            padding: 0.5em;
            font-size: 1rem;
            color: #34495e;
            transition: 0.15s;
        }

        .textfield:-ms-input-placeholder {
            color: #95a5a6;
            -ms-transition: 0.15s;
            transition: 0.15s;
        }

        .textfield::-moz-placeholder {
            color: #95a5a6;
            -moz-transition: 0.15s;
            transition: 0.15s;
        }

        .textfield::placeholder {
            color: #95a5a6;
            transition: 0.15s;
        }

        .textfield:hover {
            outline-width: 0;
            color: #5d6d77;
            border-color: #5d6d77;
        }

        .textfield:hover:-ms-input-placeholder {
            color: #5d6d77;
        }

        .textfield:hover::-moz-placeholder {
            color: #5d6d77;
        }

        .textfield:hover::placeholder {
            color: #5d6d77;
        }

        .textfield:focus {
            outline-width: 0;
            border-color: #34495e;
        }

        .textfield:focus:-ms-input-placeholder {
            color: #34495e;
        }

        .textfield:focus::-moz-placeholder {
            color: #34495e;
        }

        .textfield:focus::placeholder {
            color: #34495e;
        }

        .picture-item__title {
            display: none;
        }

        /* Ensure images take up the same space when they load */
        /* https://vestride.github.io/Shuffle/images */
        .aspect {
            position: relative;
            width: 100%;
            height: 0;
            padding-bottom: 100%;
            overflow: hidden;
        }

        .aspect__inner {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
        }

        .aspect--16x9 {
            padding-bottom: 56.25%;
        }

        .col-1\@xs,
        .col-2\@xs,
        .col-3\@xs,
        .col-4\@xs,
        .col-5\@xs,
        .col-6\@xs,
        .col-1\@sm,
        .col-2\@sm,
        .col-3\@sm,
        .col-4\@sm,
        .col-5\@sm,
        .col-6\@sm,
        .col-7\@sm,
        .col-8\@sm,
        .col-9\@sm,
        .col-10\@sm,
        .col-11\@sm,
        .col-12\@sm,
        .col-1\@md,
        .col-2\@md,
        .col-3\@md,
        .col-4\@md,
        .col-5\@md,
        .col-6\@md,
        .col-7\@md,
        .col-8\@md,
        .col-9\@md,
        .col-10\@md,
        .col-11\@md,
        .col-12\@md {
            position: relative;
            box-sizing: border-box;
            min-height: 1px;
            padding-left: 8px;
            padding-right: 8px;
        }

        .col-1\@xs,
        .col-2\@xs,
        .col-3\@xs,
        .col-4\@xs,
        .col-5\@xs,
        .col-6\@xs {
            float: left;
        }

        .col-1\@xs {
            width: 16.66667%;
        }

        .col-2\@xs {
            width: 33.33333%;
        }

        .col-3\@xs {
            width: 50%;
        }

        .col-4\@xs {
            width: 66.66667%;
        }

        .col-5\@xs {
            width: 83.33333%;
        }

        .col-6\@xs {
            width: 100%;
        }

        @media only screen and (min-width: 48em) {

            .col-1\@sm,
            .col-2\@sm,
            .col-3\@sm,
            .col-4\@sm,
            .col-5\@sm,
            .col-6\@sm,
            .col-7\@sm,
            .col-8\@sm,
            .col-9\@sm,
            .col-10\@sm,
            .col-11\@sm,
            .col-12\@sm {
                float: left;
            }

            .col-1\@sm {
                width: 8.33333%;
            }

            .col-2\@sm {
                width: 16.66667%;
            }

            .col-3\@sm {
                width: 25%;
            }

            .col-4\@sm {
                width: 33.33333%;
            }

            .col-5\@sm {
                width: 41.66667%;
            }

            .col-6\@sm {
                width: 50%;
            }

            .col-7\@sm {
                width: 58.33333%;
            }

            .col-8\@sm {
                width: 66.66667%;
            }

            .col-9\@sm {
                width: 75%;
            }

            .col-10\@sm {
                width: 83.33333%;
            }

            .col-11\@sm {
                width: 91.66667%;
            }

            .col-12\@sm {
                width: 100%;
            }
        }

        @media only screen and (min-width: 62em) {

            .col-1\@md,
            .col-2\@md,
            .col-3\@md,
            .col-4\@md,
            .col-5\@md,
            .col-6\@md,
            .col-7\@md,
            .col-8\@md,
            .col-9\@md,
            .col-10\@md,
            .col-11\@md,
            .col-12\@md {
                float: left;
            }

            .col-1\@md {
                width: 8.33333%;
            }

            .col-2\@md {
                width: 16.66667%;
            }

            .col-3\@md {
                width: 25%;
            }

            .col-4\@md {
                width: 33.33333%;
            }

            .col-5\@md {
                width: 41.66667%;
            }

            .col-6\@md {
                width: 50%;
            }

            .col-7\@md {
                width: 58.33333%;
            }

            .col-8\@md {
                width: 66.66667%;
            }

            .col-9\@md {
                width: 75%;
            }

            .col-10\@md {
                width: 83.33333%;
            }

            .col-11\@md {
                width: 91.66667%;
            }

            .col-12\@md {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="contain">
        <div id="navbar"></div>
        <nav id="nav-mobile"></nav>
        <div id="container">
            <div id="content" class="page">
                <main class="gallery">
                    <h1 style="margin-bottom: 0.5em;">Galerie</h1>
                    <div class="filters-group">
                        <div class="btn-group filter-options">
                            <button class="btn btn--primary active">Všechny</button>
                            <button class="btn btn--primary" data-group="acka">Áčka</button>
                            <button class="btn btn--primary" data-group="bannery">Bannery</button>
                            <button class="btn btn--primary" data-group="drevo">Dřevo</button>
                            <button class="btn btn--primary" data-group="fototapety">Fototapety</button>
                            <button class="btn btn--primary" data-group="informacni-systemy">Informační systémy</button>
                            <button class="btn btn--primary" data-group="interiery">Interiéry</button>
                            <button class="btn btn--primary" data-group="kamen">Kámen</button>
                            <button class="btn btn--primary" data-group="malba-na-zed">Malba na zeď</button>
                            <button class="btn btn--primary" data-group="napisy-na-budovy">Nápisy na budovy</button>
                            <button class="btn btn--primary" data-group="pecetidla">Pečetidla</button>
                            <button class="btn btn--primary" data-group="plexisklo">Plexisklo</button>
                            <button class="btn btn--primary" data-group="polepy">Polepy</button>
                            <button class="btn btn--primary" data-group="potisk-predmetu">Potisk předmětů</button>
                            <button class="btn btn--primary" data-group="reklamni-predmety">Reklamní předměty</button>
                            <button class="btn btn--primary" data-group="rollupy">Rollupy</button>
                            <button class="btn btn--primary" data-group="stitky">Štítky</button>
                            <button class="btn btn--primary" data-group="svetelne-reklamy">Světelné reklamy</button>
                            <button class="btn btn--primary" data-group="tabule">Tabule</button>
                            <button class="btn btn--primary" data-group="tiskoviny">Tiskoviny</button>
                        </div>
                    </div>
                    <div id="grid" class="row my-shuffle-container">
                        <!-- Áčka -->
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["acka"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/acka/01.JPG" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/acka/01.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/acka/01.JPG" type="image/jpeg">
                                        <img src="./images/galerie/new/acka/01.JPG">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["acka"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/acka/02.JPG" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/acka/02.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/acka/02.JPG" type="image/jpeg">
                                        <img src="./images/galerie/new/acka/02.JPG">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["acka"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/acka/03.JPG" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/acka/03.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/acka/03.JPG" type="image/jpeg">
                                        <img src="./images/galerie/new/acka/03.JPG">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["acka"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/acka/04.JPG" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/acka/04.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/acka/04.JPG" type="image/jpeg">
                                        <img src="./images/galerie/new/acka/04.JPG">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["acka"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/acka/05.JPG" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/acka/05.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/acka/05.JPG" type="image/jpeg">
                                        <img src="./images/galerie/new/acka/05.JPG">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["acka"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/acka/06.JPG" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/acka/06.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/acka/06.JPG" type="image/jpeg">
                                        <img src="./images/galerie/new/acka/06.JPG">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["acka"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/acka/07.JPG" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/acka/07.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/acka/07.JPG" type="image/jpeg">
                                        <img src="./images/galerie/new/acka/07.JPG">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <!-- Bannery -->
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["bannery"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/bannery/01.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/bannery/01.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/bannery/01.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/bannery/01.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["bannery"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/bannery/02.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/bannery/02.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/bannery/02.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/bannery/02.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["bannery"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/bannery/03.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/bannery/03.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/bannery/03.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/bannery/03.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["bannery"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/bannery/04.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/bannery/04.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/bannery/04.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/bannery/04.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["bannery"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/bannery/05.jpeg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/bannery/05.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/bannery/05.jpeg" type="image/jpeg">
                                        <img src="./images/galerie/new/bannery/05.jpeg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["bannery"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/bannery/06.jpeg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/bannery/06.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/bannery/06.jpeg" type="image/jpeg">
                                        <img src="./images/galerie/new/bannery/06.jpeg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["bannery"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/bannery/07.jpeg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/bannery/07.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/bannery/07.jpeg" type="image/jpeg">
                                        <img src="./images/galerie/new/bannery/07.jpeg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["bannery"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/bannery/08.JPG" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/bannery/08.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/bannery/08.JPG" type="image/jpeg">
                                        <img src="./images/galerie/new/bannery/08.JPG">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["bannery"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/bannery/09.JPG" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/bannery/09.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/bannery/09.JPG" type="image/jpeg">
                                        <img src="./images/galerie/new/bannery/09.JPG">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["bannery"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/bannery/10.JPG" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/bannery/10.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/bannery/10.JPG" type="image/jpeg">
                                        <img src="./images/galerie/new/bannery/10.JPG">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["bannery"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/bannery/11.JPG" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/bannery/11.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/bannery/11.JPG" type="image/jpeg">
                                        <img src="./images/galerie/new/bannery/11.JPG">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["bannery"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/bannery/12.JPG" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/bannery/12.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/bannery/12.JPG" type="image/jpeg">
                                        <img src="./images/galerie/new/bannery/12.JPG">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["bannery"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/bannery/13.JPG" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/bannery/13.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/bannery/13.JPG" type="image/jpeg">
                                        <img src="./images/galerie/new/bannery/13.JPG">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["bannery"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/bannery/14.JPEG" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/bannery/14.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/bannery/14.JPEG" type="image/jpeg">
                                        <img src="./images/galerie/new/bannery/14.JPEG">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["bannery"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/bannery/15.JPEG" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/bannery/15.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/bannery/15.JPEG" type="image/jpeg">
                                        <img src="./images/galerie/new/bannery/15.JPEG">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["bannery"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/bannery/16.JPEG" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/bannery/16.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/bannery/16.JPEG" type="image/jpeg">
                                        <img src="./images/galerie/new/bannery/16.JPEG">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["bannery"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/bannery/17.JPEG" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/bannery/17.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/bannery/17.JPEG" type="image/jpeg">
                                        <img src="./images/galerie/new/bannery/17.JPEG">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["bannery"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/bannery/18.JPEG" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/bannery/18.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/bannery/18.JPEG" type="image/jpeg">
                                        <img src="./images/galerie/new/bannery/18.JPEG">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["bannery"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/bannery/19.JPG" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/bannery/19.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/bannery/19.JPG" type="image/jpeg">
                                        <img src="./images/galerie/new/bannery/19.JPG">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["bannery"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/bannery/20.JPG" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/bannery/20.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/bannery/20.JPG" type="image/jpeg">
                                        <img src="./images/galerie/new/bannery/20.JPG">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <!-- Dřevo -->
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["drevo"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/drevo/01.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/drevo/01.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/drevo/01.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/drevo/01.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["drevo"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/drevo/02.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/drevo/02.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/drevo/02.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/drevo/02.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["drevo"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/drevo/03.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/drevo/03.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/drevo/03.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/drevo/03.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["drevo"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/drevo/04.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/drevo/04.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/drevo/04.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/drevo/04.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["drevo"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/drevo/05.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/drevo/05.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/drevo/05.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/drevo/05.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["drevo"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/drevo/06.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/drevo/06.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/drevo/06.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/drevo/06.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["drevo"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/drevo/07.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/drevo/07.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/drevo/07.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/drevo/07.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["drevo"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/drevo/08.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/drevo/08.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/drevo/08.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/drevo/08.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["drevo"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/drevo/09.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/drevo/09.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/drevo/09.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/drevo/09.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["drevo"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/drevo/10.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/drevo/10.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/drevo/10.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/drevo/10.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["drevo"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/drevo/11.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/drevo/11.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/drevo/11.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/drevo/11.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["drevo"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/drevo/12.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/drevo/12.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/drevo/12.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/drevo/12.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["drevo"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/drevo/13.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/drevo/13.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/drevo/13.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/drevo/13.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["drevo"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/drevo/14.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/drevo/14.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/drevo/14.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/drevo/14.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["drevo"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/drevo/15.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/drevo/15.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/drevo/15.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/drevo/15.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["drevo"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/drevo/16.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/drevo/16.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/drevo/16.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/drevo/16.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["drevo"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/drevo/17.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/drevo/17.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/drevo/17.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/drevo/17.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["drevo"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/drevo/18.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/drevo/18.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/drevo/18.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/drevo/18.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <!-- Fototapety -->
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["fototapety"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/fototapety/01.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/fototapety/01.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/fototapety/01.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/fototapety/01.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <!-- Informační systémy -->
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["informacni-systemy"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/informacni-systemy/img1.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/informacni-systemy/img1.webp"
                                            type="image/webp">
                                        <source srcset="./images/galerie/new/informacni-systemy/img1.jpg"
                                            type="image/jpeg">
                                        <img src="./images/galerie/new/informacni-systemy/img1.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["informacni-systemy"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/informacni-systemy/img2.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/informacni-systemy/img2.webp"
                                            type="image/webp">
                                        <source srcset="./images/galerie/new/informacni-systemy/img2.jpg"
                                            type="image/jpeg">
                                        <img src="./images/galerie/new/informacni-systemy/img2.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["informacni-systemy"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/informacni-systemy/img3.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/informacni-systemy/img3.webp"
                                            type="image/webp">
                                        <source srcset="./images/galerie/new/informacni-systemy/img3.jpg"
                                            type="image/jpeg">
                                        <img src="./images/galerie/new/informacni-systemy/img3.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["informacni-systemy"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/informacni-systemy/img4.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/informacni-systemy/img4.webp"
                                            type="image/webp">
                                        <source srcset="./images/galerie/new/informacni-systemy/img4.jpg"
                                            type="image/jpeg">
                                        <img src="./images/galerie/new/informacni-systemy/img4.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["informacni-systemy"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/informacni-systemy/img5.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/informacni-systemy/img5.webp"
                                            type="image/webp">
                                        <source srcset="./images/galerie/new/informacni-systemy/img5.jpg"
                                            type="image/jpeg">
                                        <img src="./images/galerie/new/informacni-systemy/img5.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["informacni-systemy"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/informacni-systemy/img6.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/informacni-systemy/img6.webp"
                                            type="image/webp">
                                        <source srcset="./images/galerie/new/informacni-systemy/img6.jpg"
                                            type="image/jpeg">
                                        <img src="./images/galerie/new/informacni-systemy/img6.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["informacni-systemy"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/informacni-systemy/img7.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/informacni-systemy/img7.webp"
                                            type="image/webp">
                                        <source srcset="./images/galerie/new/informacni-systemy/img7.jpg"
                                            type="image/jpeg">
                                        <img src="./images/galerie/new/informacni-systemy/img7.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["informacni-systemy"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/informacni-systemy/img8.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/informacni-systemy/img8.webp"
                                            type="image/webp">
                                        <source srcset="./images/galerie/new/informacni-systemy/img8.jpg"
                                            type="image/jpeg">
                                        <img src="./images/galerie/new/informacni-systemy/img8.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["informacni-systemy"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/informacni-systemy/img9.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/informacni-systemy/img9.webp"
                                            type="image/webp">
                                        <source srcset="./images/galerie/new/informacni-systemy/img9.jpg"
                                            type="image/jpeg">
                                        <img src="./images/galerie/new/informacni-systemy/img9.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["informacni-systemy"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/informacni-systemy/img10.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/informacni-systemy/img10.webp"
                                            type="image/webp">
                                        <source srcset="./images/galerie/new/informacni-systemy/img10.jpg"
                                            type="image/jpeg">
                                        <img src="./images/galerie/new/informacni-systemy/img10.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["informacni-systemy"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/informacni-systemy/img11.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/informacni-systemy/img11.webp"
                                            type="image/webp">
                                        <source srcset="./images/galerie/new/informacni-systemy/img11.jpg"
                                            type="image/jpeg">
                                        <img src="./images/galerie/new/informacni-systemy/img11.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["informacni-systemy"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/informacni-systemy/img12.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/informacni-systemy/img12.webp"
                                            type="image/webp">
                                        <source srcset="./images/galerie/new/informacni-systemy/img12.jpg"
                                            type="image/jpeg">
                                        <img src="./images/galerie/new/informacni-systemy/img12.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["informacni-systemy"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/informacni-systemy/img13.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/informacni-systemy/img13.webp"
                                            type="image/webp">
                                        <source srcset="./images/galerie/new/informacni-systemy/img13.jpg"
                                            type="image/jpeg">
                                        <img src="./images/galerie/new/informacni-systemy/img13.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["informacni-systemy"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/informacni-systemy/img14.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/informacni-systemy/img14.webp"
                                            type="image/webp">
                                        <source srcset="./images/galerie/new/informacni-systemy/img14.jpg"
                                            type="image/jpeg">
                                        <img src="./images/galerie/new/informacni-systemy/img14.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["informacni-systemy"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/informacni-systemy/img15.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/informacni-systemy/img15.webp"
                                            type="image/webp">
                                        <source srcset="./images/galerie/new/informacni-systemy/img15.jpg"
                                            type="image/jpeg">
                                        <img src="./images/galerie/new/informacni-systemy/img15.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["informacni-systemy"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/informacni-systemy/img16.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/informacni-systemy/img16.webp"
                                            type="image/webp">
                                        <source srcset="./images/galerie/new/informacni-systemy/img16.jpg"
                                            type="image/jpeg">
                                        <img src="./images/galerie/new/informacni-systemy/img16.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["informacni-systemy"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/informacni-systemy/img17.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/informacni-systemy/img17.webp"
                                            type="image/webp">
                                        <source srcset="./images/galerie/new/informacni-systemy/img17.jpg"
                                            type="image/jpeg">
                                        <img src="./images/galerie/new/informacni-systemy/img17.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["informacni-systemy"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/informacni-systemy/img18.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/informacni-systemy/img18.webp"
                                            type="image/webp">
                                        <source srcset="./images/galerie/new/informacni-systemy/img18.jpg"
                                            type="image/jpeg">
                                        <img src="./images/galerie/new/informacni-systemy/img18.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["informacni-systemy"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/informacni-systemy/img19.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/informacni-systemy/img19.webp"
                                            type="image/webp">
                                        <source srcset="./images/galerie/new/informacni-systemy/img19.jpg"
                                            type="image/jpeg">
                                        <img src="./images/galerie/new/informacni-systemy/img19.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["informacni-systemy"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/informacni-systemy/img20.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/informacni-systemy/img20.webp"
                                            type="image/webp">
                                        <source srcset="./images/galerie/new/informacni-systemy/img20.jpg"
                                            type="image/jpeg">
                                        <img src="./images/galerie/new/informacni-systemy/img20.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["informacni-systemy"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/informacni-systemy/img21.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/informacni-systemy/img21.webp"
                                            type="image/webp">
                                        <source srcset="./images/galerie/new/informacni-systemy/img21.jpg"
                                            type="image/jpeg">
                                        <img src="./images/galerie/new/informacni-systemy/img21.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["informacni-systemy"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/informacni-systemy/img22.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/informacni-systemy/img22.webp"
                                            type="image/webp">
                                        <source srcset="./images/galerie/new/informacni-systemy/img22.jpg"
                                            type="image/jpeg">
                                        <img src="./images/galerie/new/informacni-systemy/img22.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["informacni-systemy"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/informacni-systemy/img23.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/informacni-systemy/img23.webp"
                                            type="image/webp">
                                        <source srcset="./images/galerie/new/informacni-systemy/img23.jpg"
                                            type="image/jpeg">
                                        <img src="./images/galerie/new/informacni-systemy/img23.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["informacni-systemy"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/informacni-systemy/img24.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/informacni-systemy/img24.webp"
                                            type="image/webp">
                                        <source srcset="./images/galerie/new/informacni-systemy/img24.jpg"
                                            type="image/jpeg">
                                        <img src="./images/galerie/new/informacni-systemy/img24.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["informacni-systemy"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/informacni-systemy/img25.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/informacni-systemy/img25.webp"
                                            type="image/webp">
                                        <source srcset="./images/galerie/new/informacni-systemy/img25.jpg"
                                            type="image/jpeg">
                                        <img src="./images/galerie/new/informacni-systemy/img25.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["informacni-systemy"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/informacni-systemy/img26.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/informacni-systemy/img26.webp"
                                            type="image/webp">
                                        <source srcset="./images/galerie/new/informacni-systemy/img26.jpg"
                                            type="image/jpeg">
                                        <img src="./images/galerie/new/informacni-systemy/img26.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["informacni-systemy"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/informacni-systemy/img27.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/informacni-systemy/img27.webp"
                                            type="image/webp">
                                        <source srcset="./images/galerie/new/informacni-systemy/img27.jpg"
                                            type="image/jpeg">
                                        <img src="./images/galerie/new/informacni-systemy/img27.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["informacni-systemy"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/informacni-systemy/img28.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/informacni-systemy/img28.webp"
                                            type="image/webp">
                                        <source srcset="./images/galerie/new/informacni-systemy/img28.jpg"
                                            type="image/jpeg">
                                        <img src="./images/galerie/new/informacni-systemy/img28.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["informacni-systemy"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/informacni-systemy/img29.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/informacni-systemy/img29.webp"
                                            type="image/webp">
                                        <source srcset="./images/galerie/new/informacni-systemy/img29.jpg"
                                            type="image/jpeg">
                                        <img src="./images/galerie/new/informacni-systemy/img29.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["informacni-systemy"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/informacni-systemy/img30.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/informacni-systemy/img30.webp"
                                            type="image/webp">
                                        <source srcset="./images/galerie/new/informacni-systemy/img30.jpg"
                                            type="image/jpeg">
                                        <img src="./images/galerie/new/informacni-systemy/img30.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <!-- Interiéry -->
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["interiery"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/interiery/img1.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/interiery/img1.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/interiery/img1.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/interiery/img1.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["interiery"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/interiery/img2.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/interiery/img2.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/interiery/img2.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/interiery/img2.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <!-- Kámen -->
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["kamen"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/kamen/img1.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/kamen/img1.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/kamen/img1.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/kamen/img1.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["kamen"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/kamen/img2.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/kamen/img2.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/kamen/img2.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/kamen/img2.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <!-- Malba na zeď -->
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["malba-na-zed"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/malba-na-zed/img1.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/malba-na-zed/img1.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/malba-na-zed/img1.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/malba-na-zed/img1.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["malba-na-zed"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/malba-na-zed/img2.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/malba-na-zed/img2.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/malba-na-zed/img2.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/malba-na-zed/img2.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["malba-na-zed"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/malba-na-zed/img3.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/malba-na-zed/img3.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/malba-na-zed/img3.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/malba-na-zed/img3.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["malba-na-zed"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/malba-na-zed/img4.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/malba-na-zed/img4.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/malba-na-zed/img4.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/malba-na-zed/img4.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["malba-na-zed"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/malba-na-zed/img5.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/malba-na-zed/img5.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/malba-na-zed/img5.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/malba-na-zed/img5.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["malba-na-zed"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/malba-na-zed/img6.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/malba-na-zed/img6.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/malba-na-zed/img6.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/malba-na-zed/img6.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["malba-na-zed"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/malba-na-zed/img7.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/malba-na-zed/img7.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/malba-na-zed/img7.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/malba-na-zed/img7.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["malba-na-zed"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/malba-na-zed/img8.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/malba-na-zed/img8.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/malba-na-zed/img8.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/malba-na-zed/img8.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <!-- Nápisy na budovy -->
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["napisy-na-budovy"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/napisy-na-budovy/img1.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/napisy-na-budovy/img1.webp"
                                            type="image/webp">
                                        <source srcset="./images/galerie/new/napisy-na-budovy/img1.jpg"
                                            type="image/jpeg">
                                        <img src="./images/galerie/new/napisy-na-budovy/img1.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["napisy-na-budovy"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/napisy-na-budovy/img2.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/napisy-na-budovy/img2.webp"
                                            type="image/webp">
                                        <source srcset="./images/galerie/new/napisy-na-budovy/img2.jpg"
                                            type="image/jpeg">
                                        <img src="./images/galerie/new/napisy-na-budovy/img2.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["napisy-na-budovy"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/napisy-na-budovy/img3.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/napisy-na-budovy/img3.webp"
                                            type="image/webp">
                                        <source srcset="./images/galerie/new/napisy-na-budovy/img3.jpg"
                                            type="image/jpeg">
                                        <img src="./images/galerie/new/napisy-na-budovy/img3.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["napisy-na-budovy"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/napisy-na-budovy/img4.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/napisy-na-budovy/img4.webp"
                                            type="image/webp">
                                        <source srcset="./images/galerie/new/napisy-na-budovy/img4.jpg"
                                            type="image/jpeg">
                                        <img src="./images/galerie/new/napisy-na-budovy/img4.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["napisy-na-budovy"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/napisy-na-budovy/img5.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/napisy-na-budovy/img5.webp"
                                            type="image/webp">
                                        <source srcset="./images/galerie/new/napisy-na-budovy/img5.jpg"
                                            type="image/jpeg">
                                        <img src="./images/galerie/new/napisy-na-budovy/img5.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["napisy-na-budovy"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/napisy-na-budovy/img6.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/napisy-na-budovy/img6.webp"
                                            type="image/webp">
                                        <source srcset="./images/galerie/new/napisy-na-budovy/img6.jpg"
                                            type="image/jpeg">
                                        <img src="./images/galerie/new/napisy-na-budovy/img6.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["napisy-na-budovy"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/napisy-na-budovy/img7.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/napisy-na-budovy/img7.webp"
                                            type="image/webp">
                                        <source srcset="./images/galerie/new/napisy-na-budovy/img7.jpg"
                                            type="image/jpeg">
                                        <img src="./images/galerie/new/napisy-na-budovy/img7.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["napisy-na-budovy"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/napisy-na-budovy/img8.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/napisy-na-budovy/img8.webp"
                                            type="image/webp">
                                        <source srcset="./images/galerie/new/napisy-na-budovy/img8.jpg"
                                            type="image/jpeg">
                                        <img src="./images/galerie/new/napisy-na-budovy/img8.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["napisy-na-budovy"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/napisy-na-budovy/img9.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/napisy-na-budovy/img9.webp"
                                            type="image/webp">
                                        <source srcset="./images/galerie/new/napisy-na-budovy/img9.jpg"
                                            type="image/jpeg">
                                        <img src="./images/galerie/new/napisy-na-budovy/img9.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <!-- Pečetidla -->
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["pecetidla"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/pecetidla/img1.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/pecetidla/img1.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/pecetidla/img1.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/pecetidla/img1.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["pecetidla"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/pecetidla/img2.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/pecetidla/img2.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/pecetidla/img2.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/pecetidla/img2.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["pecetidla"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/pecetidla/img3.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/pecetidla/img3.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/pecetidla/img3.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/pecetidla/img3.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["pecetidla"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/pecetidla/img4.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/pecetidla/img4.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/pecetidla/img4.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/pecetidla/img4.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["pecetidla"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/pecetidla/img5.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/pecetidla/img5.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/pecetidla/img5.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/pecetidla/img5.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["pecetidla"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/pecetidla/img6.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/pecetidla/img6.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/pecetidla/img6.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/pecetidla/img6.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["pecetidla"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/pecetidla/img7.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/pecetidla/img7.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/pecetidla/img7.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/pecetidla/img7.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["pecetidla"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/pecetidla/img8.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/pecetidla/img8.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/pecetidla/img8.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/pecetidla/img8.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["pecetidla"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/pecetidla/img9.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/pecetidla/img9.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/pecetidla/img9.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/pecetidla/img9.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["pecetidla"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/pecetidla/img10.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/pecetidla/img10.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/pecetidla/img10.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/pecetidla/img10.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["pecetidla"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/pecetidla/img11.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/pecetidla/img11.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/pecetidla/img11.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/pecetidla/img11.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["pecetidla"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/pecetidla/img12.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/pecetidla/img12.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/pecetidla/img12.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/pecetidla/img12.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <!-- Plexisklo -->
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["plexisklo"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/plexisklo/img1.JPEG" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/plexisklo/img1.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/plexisklo/img1.JPEG" type="image/jpeg">
                                        <img src="./images/galerie/new/plexisklo/img1.JPEG">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["plexisklo"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/plexisklo/img2.JPEG" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/plexisklo/img2.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/plexisklo/img2.JPEG" type="image/jpeg">
                                        <img src="./images/galerie/new/plexisklo/img2.JPEG">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["plexisklo"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/plexisklo/img3.JPEG" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/plexisklo/img3.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/plexisklo/img3.JPEG" type="image/jpeg">
                                        <img src="./images/galerie/new/plexisklo/img3.JPEG">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["plexisklo"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/plexisklo/img4.JPEG" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/plexisklo/img4.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/plexisklo/img4.JPEG" type="image/jpeg">
                                        <img src="./images/galerie/new/plexisklo/img4.JPEG">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["plexisklo"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/plexisklo/img5.JPEG" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/plexisklo/img5.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/plexisklo/img5.JPEG" type="image/jpeg">
                                        <img src="./images/galerie/new/plexisklo/img5.JPEG">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["plexisklo"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/plexisklo/img6.JPEG" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/plexisklo/img6.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/plexisklo/img6.JPEG" type="image/jpeg">
                                        <img src="./images/galerie/new/plexisklo/img6.JPEG">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["plexisklo"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/plexisklo/img7.JPEG" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/plexisklo/img7.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/plexisklo/img7.JPEG" type="image/jpeg">
                                        <img src="./images/galerie/new/plexisklo/img7.JPEG">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["plexisklo"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/plexisklo/img8.JPEG" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/plexisklo/img8.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/plexisklo/img8.JPEG" type="image/jpeg">
                                        <img src="./images/galerie/new/plexisklo/img8.JPEG">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["plexisklo"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/plexisklo/img9.JPEG" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/plexisklo/img9.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/plexisklo/img9.JPEG" type="image/jpeg">
                                        <img src="./images/galerie/new/plexisklo/img9.JPEG">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["plexisklo"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/plexisklo/img10.JPEG" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/plexisklo/img10.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/plexisklo/img10.JPEG" type="image/jpeg">
                                        <img src="./images/galerie/new/plexisklo/img10.JPEG">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["plexisklo"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/plexisklo/img11.JPEG" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/plexisklo/img11.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/plexisklo/img11.JPEG" type="image/jpeg">
                                        <img src="./images/galerie/new/plexisklo/img11.JPEG">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["plexisklo"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/plexisklo/img12.JPEG" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/plexisklo/img12.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/plexisklo/img12.JPEG" type="image/jpeg">
                                        <img src="./images/galerie/new/plexisklo/img12.JPEG">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["plexisklo"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/plexisklo/img13.JPEG" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/plexisklo/img13.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/plexisklo/img13.JPEG" type="image/jpeg">
                                        <img src="./images/galerie/new/plexisklo/img13.JPEG">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["plexisklo"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/plexisklo/img14.JPEG" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/plexisklo/img14.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/plexisklo/img14.JPEG" type="image/jpeg">
                                        <img src="./images/galerie/new/plexisklo/img14.JPEG">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["plexisklo"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/plexisklo/img15.JPEG" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/plexisklo/img15.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/plexisklo/img15.JPEG" type="image/jpeg">
                                        <img src="./images/galerie/new/plexisklo/img15.JPEG">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["plexisklo"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/plexisklo/img16.JPEG" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/plexisklo/img16.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/plexisklo/img16.JPEG" type="image/jpeg">
                                        <img src="./images/galerie/new/plexisklo/img16.JPEG">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["plexisklo"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/plexisklo/img17.JPEG" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/plexisklo/img17.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/plexisklo/img17.JPEG" type="image/jpeg">
                                        <img src="./images/galerie/new/plexisklo/img17.JPEG">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["plexisklo"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/plexisklo/img18.JPEG" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/plexisklo/img18.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/plexisklo/img18.JPEG" type="image/jpeg">
                                        <img src="./images/galerie/new/plexisklo/img18.JPEG">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["plexisklo"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/plexisklo/img19.JPEG" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/plexisklo/img19.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/plexisklo/img19.JPEG" type="image/jpeg">
                                        <img src="./images/galerie/new/plexisklo/img19.JPEG">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["plexisklo"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/plexisklo/img20.JPEG" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/plexisklo/img20.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/plexisklo/img20.JPEG" type="image/jpeg">
                                        <img src="./images/galerie/new/plexisklo/img20.JPEG">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["plexisklo"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/plexisklo/img21.JPEG" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/plexisklo/img21.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/plexisklo/img21.JPEG" type="image/jpeg">
                                        <img src="./images/galerie/new/plexisklo/img21.JPEG">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["plexisklo"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/plexisklo/img22.JPEG" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/plexisklo/img22.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/plexisklo/img22.JPEG" type="image/jpeg">
                                        <img src="./images/galerie/new/plexisklo/img22.JPEG">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["plexisklo"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/plexisklo/img23.JPEG" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/plexisklo/img23.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/plexisklo/img23.JPEG" type="image/jpeg">
                                        <img src="./images/galerie/new/plexisklo/img23.JPEG">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["plexisklo"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/plexisklo/img24.JPEG" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/plexisklo/img24.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/plexisklo/img24.JPEG" type="image/jpeg">
                                        <img src="./images/galerie/new/plexisklo/img24.JPEG">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["plexisklo"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/plexisklo/img25.JPEG" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/plexisklo/img25.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/plexisklo/img25.JPEG" type="image/jpeg">
                                        <img src="./images/galerie/new/plexisklo/img25.JPEG">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["plexisklo"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/plexisklo/img26.JPEG" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/plexisklo/img26.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/plexisklo/img26.JPEG" type="image/jpeg">
                                        <img src="./images/galerie/new/plexisklo/img26.JPEG">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["plexisklo"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/plexisklo/img27.JPEG" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/plexisklo/img27.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/plexisklo/img27.JPEG" type="image/jpeg">
                                        <img src="./images/galerie/new/plexisklo/img27.JPEG">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["plexisklo"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/plexisklo/img28.JPEG" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/plexisklo/img28.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/plexisklo/img28.JPEG" type="image/jpeg">
                                        <img src="./images/galerie/new/plexisklo/img28.JPEG">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["plexisklo"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/plexisklo/img29.JPEG" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/plexisklo/img29.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/plexisklo/img29.JPEG" type="image/jpeg">
                                        <img src="./images/galerie/new/plexisklo/img29.JPEG">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["plexisklo"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/plexisklo/img30.JPEG" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/plexisklo/img30.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/plexisklo/img30.JPEG" type="image/jpeg">
                                        <img src="./images/galerie/new/plexisklo/img30.JPEG">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <!-- Polepy -->
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["polepy"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/polepy/img1.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/polepy/img1.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/polepy/img1.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/polepy/img1.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["polepy"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/polepy/img2.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/polepy/img2.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/polepy/img2.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/polepy/img2.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["polepy"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/polepy/img3.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/polepy/img3.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/polepy/img3.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/polepy/img3.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["polepy"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/polepy/img4.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/polepy/img4.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/polepy/img4.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/polepy/img4.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["polepy"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/polepy/img5.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/polepy/img5.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/polepy/img5.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/polepy/img5.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["polepy"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/polepy/img6.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/polepy/img6.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/polepy/img6.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/polepy/img6.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["polepy"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/polepy/img7.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/polepy/img7.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/polepy/img7.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/polepy/img7.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["polepy"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/polepy/img8.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/polepy/img8.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/polepy/img8.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/polepy/img8.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["polepy"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/polepy/img9.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/polepy/img9.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/polepy/img9.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/polepy/img9.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["polepy"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/polepy/img10.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/polepy/img10.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/polepy/img10.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/polepy/img10.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["polepy"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/polepy/img11.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/polepy/img11.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/polepy/img11.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/polepy/img11.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["polepy"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/polepy/img12.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/polepy/img12.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/polepy/img12.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/polepy/img12.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["polepy"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/polepy/img13.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/polepy/img13.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/polepy/img13.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/polepy/img13.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <!-- Potisk předmětů -->
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["potisk-predmetu"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/potisk-predmetu/img1.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/potisk-predmetu/img1.webp"
                                            type="image/webp">
                                        <source srcset="./images/galerie/new/potisk-predmetu/img1.jpg"
                                            type="image/jpeg">
                                        <img src="./images/galerie/new/potisk-predmetu/img1.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["potisk-predmetu"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/potisk-predmetu/img2.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/potisk-predmetu/img2.webp"
                                            type="image/webp">
                                        <source srcset="./images/galerie/new/potisk-predmetu/img2.jpg"
                                            type="image/jpeg">
                                        <img src="./images/galerie/new/potisk-predmetu/img2.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["potisk-predmetu"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/potisk-predmetu/img3.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/potisk-predmetu/img3.webp"
                                            type="image/webp">
                                        <source srcset="./images/galerie/new/potisk-predmetu/img3.jpg"
                                            type="image/jpeg">
                                        <img src="./images/galerie/new/potisk-predmetu/img3.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["potisk-predmetu"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/potisk-predmetu/img4.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/potisk-predmetu/img4.webp"
                                            type="image/webp">
                                        <source srcset="./images/galerie/new/potisk-predmetu/img4.jpg"
                                            type="image/jpeg">
                                        <img src="./images/galerie/new/potisk-predmetu/img4.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["potisk-predmetu"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/potisk-predmetu/img5.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/potisk-predmetu/img5.webp"
                                            type="image/webp">
                                        <source srcset="./images/galerie/new/potisk-predmetu/img5.jpg"
                                            type="image/jpeg">
                                        <img src="./images/galerie/new/potisk-predmetu/img5.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["potisk-predmetu"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/potisk-predmetu/img6.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/potisk-predmetu/img6.webp"
                                            type="image/webp">
                                        <source srcset="./images/galerie/new/potisk-predmetu/img6.jpg"
                                            type="image/jpeg">
                                        <img src="./images/galerie/new/potisk-predmetu/img6.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["potisk-predmetu"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/potisk-predmetu/img7.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/potisk-predmetu/img7.webp"
                                            type="image/webp">
                                        <source srcset="./images/galerie/new/potisk-predmetu/img7.jpg"
                                            type="image/jpeg">
                                        <img src="./images/galerie/new/potisk-predmetu/img7.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["potisk-predmetu"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/potisk-predmetu/img8.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/potisk-predmetu/img8.webp"
                                            type="image/webp">
                                        <source srcset="./images/galerie/new/potisk-predmetu/img8.jpg"
                                            type="image/jpeg">
                                        <img src="./images/galerie/new/potisk-predmetu/img8.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["potisk-predmetu"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/potisk-predmetu/img9.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/potisk-predmetu/img9.webp"
                                            type="image/webp">
                                        <source srcset="./images/galerie/new/potisk-predmetu/img9.jpg"
                                            type="image/jpeg">
                                        <img src="./images/galerie/new/potisk-predmetu/img9.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["potisk-predmetu"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/potisk-predmetu/img10.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/potisk-predmetu/img10.webp"
                                            type="image/webp">
                                        <source srcset="./images/galerie/new/potisk-predmetu/img10.jpg"
                                            type="image/jpeg">
                                        <img src="./images/galerie/new/potisk-predmetu/img10.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["potisk-predmetu"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/potisk-predmetu/img11.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/potisk-predmetu/img11.webp"
                                            type="image/webp">
                                        <source srcset="./images/galerie/new/potisk-predmetu/img11.jpg"
                                            type="image/jpeg">
                                        <img src="./images/galerie/new/potisk-predmetu/img11.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["potisk-predmetu"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/potisk-predmetu/img12.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/potisk-predmetu/img12.webp"
                                            type="image/webp">
                                        <source srcset="./images/galerie/new/potisk-predmetu/img12.jpg"
                                            type="image/jpeg">
                                        <img src="./images/galerie/new/potisk-predmetu/img12.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["potisk-predmetu"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/potisk-predmetu/img13.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/potisk-predmetu/img13.webp"
                                            type="image/webp">
                                        <source srcset="./images/galerie/new/potisk-predmetu/img13.jpg"
                                            type="image/jpeg">
                                        <img src="./images/galerie/new/potisk-predmetu/img13.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <!-- Reklamní předměty -->
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["reklamni-predmety"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/reklamni-predmety/img1.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/reklamni-predmety/img1.webp"
                                            type="image/webp">
                                        <source srcset="./images/galerie/new/reklamni-predmety/img1.jpg"
                                            type="image/jpeg">
                                        <img src="./images/galerie/new/reklamni-predmety/img1.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["reklamni-predmety"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/reklamni-predmety/img2.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/reklamni-predmety/img2.webp"
                                            type="image/webp">
                                        <source srcset="./images/galerie/new/reklamni-predmety/img2.jpg"
                                            type="image/jpeg">
                                        <img src="./images/galerie/new/reklamni-predmety/img2.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["reklamni-predmety"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/reklamni-predmety/img3.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/reklamni-predmety/img3.webp"
                                            type="image/webp">
                                        <source srcset="./images/galerie/new/reklamni-predmety/img3.jpg"
                                            type="image/jpeg">
                                        <img src="./images/galerie/new/reklamni-predmety/img3.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["reklamni-predmety"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/reklamni-predmety/img4.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/reklamni-predmety/img4.webp"
                                            type="image/webp">
                                        <source srcset="./images/galerie/new/reklamni-predmety/img4.jpg"
                                            type="image/jpeg">
                                        <img src="./images/galerie/new/reklamni-predmety/img4.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["reklamni-predmety"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/reklamni-predmety/img5.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/reklamni-predmety/img5.webp"
                                            type="image/webp">
                                        <source srcset="./images/galerie/new/reklamni-predmety/img5.jpg"
                                            type="image/jpeg">
                                        <img src="./images/galerie/new/reklamni-predmety/img5.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["reklamni-predmety"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/reklamni-predmety/img6.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/reklamni-predmety/img6.webp"
                                            type="image/webp">
                                        <source srcset="./images/galerie/new/reklamni-predmety/img6.jpg"
                                            type="image/jpeg">
                                        <img src="./images/galerie/new/reklamni-predmety/img6.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["reklamni-predmety"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/reklamni-predmety/img7.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/reklamni-predmety/img7.webp"
                                            type="image/webp">
                                        <source srcset="./images/galerie/new/reklamni-predmety/img7.jpg"
                                            type="image/jpeg">
                                        <img src="./images/galerie/new/reklamni-predmety/img7.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <!-- Rollupy -->
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["rollupy"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/rollupy/img1.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/rollupy/img1.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/rollupy/img1.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/rollupy/img1.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <!-- Štítky -->
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["stitky"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/stitky/img1.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/stitky/img1.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/stitky/img1.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/stitky/img1.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["stitky"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/stitky/img2.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/stitky/img2.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/stitky/img2.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/stitky/img2.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["stitky"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/stitky/img3.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/stitky/img3.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/stitky/img3.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/stitky/img3.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["stitky"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/stitky/img4.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/stitky/img4.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/stitky/img4.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/stitky/img4.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["stitky"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/stitky/img5.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/stitky/img5.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/stitky/img5.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/stitky/img5.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["stitky"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/stitky/img6.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/stitky/img6.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/stitky/img6.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/stitky/img6.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["stitky"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/stitky/img7.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/stitky/img7.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/stitky/img7.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/stitky/img7.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["stitky"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/stitky/img8.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/stitky/img8.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/stitky/img8.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/stitky/img8.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["stitky"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/stitky/img9.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/stitky/img9.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/stitky/img9.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/stitky/img9.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["stitky"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/stitky/img10.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/stitky/img10.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/stitky/img10.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/stitky/img10.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["stitky"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/stitky/img11.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/stitky/img11.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/stitky/img11.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/stitky/img11.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["stitky"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/stitky/img12.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/stitky/img12.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/stitky/img12.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/stitky/img12.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["stitky"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/stitky/img13.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/stitky/img13.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/stitky/img13.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/stitky/img13.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["stitky"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/stitky/img14.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/stitky/img14.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/stitky/img14.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/stitky/img14.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["stitky"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/stitky/img15.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/stitky/img15.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/stitky/img15.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/stitky/img15.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["stitky"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/stitky/img16.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/stitky/img16.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/stitky/img16.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/stitky/img16.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["stitky"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/stitky/img17.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/stitky/img17.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/stitky/img17.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/stitky/img17.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["stitky"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/stitky/img18.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/stitky/img18.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/stitky/img18.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/stitky/img18.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["stitky"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/stitky/img19.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/stitky/img19.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/stitky/img19.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/stitky/img19.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["stitky"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/stitky/img20.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/stitky/img20.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/stitky/img20.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/stitky/img20.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["stitky"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/stitky/img21.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/stitky/img21.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/stitky/img21.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/stitky/img21.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["stitky"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/stitky/img22.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/stitky/img22.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/stitky/img22.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/stitky/img22.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["stitky"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/stitky/img23.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/stitky/img23.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/stitky/img23.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/stitky/img23.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["stitky"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/stitky/img24.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/stitky/img24.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/stitky/img24.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/stitky/img24.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["stitky"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/stitky/img25.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/stitky/img25.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/stitky/img25.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/stitky/img25.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["stitky"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/stitky/img26.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/stitky/img26.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/stitky/img26.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/stitky/img26.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["stitky"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/stitky/img27.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/stitky/img27.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/stitky/img27.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/stitky/img27.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["stitky"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/stitky/img28.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/stitky/img28.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/stitky/img28.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/stitky/img28.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["stitky"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/stitky/img29.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/stitky/img29.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/stitky/img29.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/stitky/img29.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["stitky"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/stitky/img30.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/stitky/img30.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/stitky/img30.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/stitky/img30.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["stitky"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/stitky/img31.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/stitky/img31.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/stitky/img31.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/stitky/img31.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["stitky"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/stitky/img32.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/stitky/img32.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/stitky/img32.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/stitky/img32.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["stitky"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/stitky/img33.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/stitky/img33.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/stitky/img33.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/stitky/img33.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["stitky"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/stitky/img34.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/stitky/img34.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/stitky/img34.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/stitky/img34.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["stitky"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/stitky/img35.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/stitky/img35.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/stitky/img35.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/stitky/img35.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["stitky"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/stitky/img36.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/stitky/img36.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/stitky/img36.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/stitky/img36.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["stitky"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/stitky/img37.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/stitky/img37.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/stitky/img37.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/stitky/img37.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["stitky"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/stitky/img38.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/stitky/img38.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/stitky/img38.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/stitky/img38.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["stitky"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/stitky/img39.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/stitky/img39.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/stitky/img39.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/stitky/img39.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["stitky"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/stitky/img40.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/stitky/img40.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/stitky/img40.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/stitky/img40.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["stitky"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/stitky/img41.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/stitky/img41.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/stitky/img41.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/stitky/img41.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <!-- Světelné reklamy -->
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["svetelne-reklamy"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/svetelne-reklamy/img1.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/svetelne-reklamy/img1.webp"
                                            type="image/webp">
                                        <source srcset="./images/galerie/new/svetelne-reklamy/img1.jpg"
                                            type="image/jpeg">
                                        <img src="./images/galerie/new/svetelne-reklamy/img1.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["svetelne-reklamy"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/svetelne-reklamy/img2.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/svetelne-reklamy/img2.webp"
                                            type="image/webp">
                                        <source srcset="./images/galerie/new/svetelne-reklamy/img2.jpg"
                                            type="image/jpeg">
                                        <img src="./images/galerie/new/svetelne-reklamy/img2.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["svetelne-reklamy"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/svetelne-reklamy/img3.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/svetelne-reklamy/img3.webp"
                                            type="image/webp">
                                        <source srcset="./images/galerie/new/svetelne-reklamy/img3.jpg"
                                            type="image/jpeg">
                                        <img src="./images/galerie/new/svetelne-reklamy/img3.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["svetelne-reklamy"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/svetelne-reklamy/img4.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/svetelne-reklamy/img4.webp"
                                            type="image/webp">
                                        <source srcset="./images/galerie/new/svetelne-reklamy/img4.jpg"
                                            type="image/jpeg">
                                        <img src="./images/galerie/new/svetelne-reklamy/img4.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["svetelne-reklamy"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/svetelne-reklamy/img5.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/svetelne-reklamy/img5.webp"
                                            type="image/webp">
                                        <source srcset="./images/galerie/new/svetelne-reklamy/img5.jpg"
                                            type="image/jpeg">
                                        <img src="./images/galerie/new/svetelne-reklamy/img5.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["svetelne-reklamy"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/svetelne-reklamy/img6.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/svetelne-reklamy/img6.webp"
                                            type="image/webp">
                                        <source srcset="./images/galerie/new/svetelne-reklamy/img6.jpg"
                                            type="image/jpeg">
                                        <img src="./images/galerie/new/svetelne-reklamy/img6.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["svetelne-reklamy"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/svetelne-reklamy/img7.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/svetelne-reklamy/img7.webp"
                                            type="image/webp">
                                        <source srcset="./images/galerie/new/svetelne-reklamy/img7.jpg"
                                            type="image/jpeg">
                                        <img src="./images/galerie/new/svetelne-reklamy/img7.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["svetelne-reklamy"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/svetelne-reklamy/img8.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/svetelne-reklamy/img8.webp"
                                            type="image/webp">
                                        <source srcset="./images/galerie/new/svetelne-reklamy/img8.jpg"
                                            type="image/jpeg">
                                        <img src="./images/galerie/new/svetelne-reklamy/img8.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["svetelne-reklamy"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/svetelne-reklamy/img9.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/svetelne-reklamy/img9.webp"
                                            type="image/webp">
                                        <source srcset="./images/galerie/new/svetelne-reklamy/img9.jpg"
                                            type="image/jpeg">
                                        <img src="./images/galerie/new/svetelne-reklamy/img9.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <!-- Tabule -->
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["tabule"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/tabule/img1.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/tabule/img1.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/tabule/img1.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/tabule/img1.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["tabule"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/tabule/img2.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/tabule/img2.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/tabule/img2.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/tabule/img2.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["tabule"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/tabule/img3.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/tabule/img3.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/tabule/img3.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/tabule/img3.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["tabule"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/tabule/img4.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/tabule/img4.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/tabule/img4.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/tabule/img4.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["tabule"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/tabule/img5.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/tabule/img5.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/tabule/img5.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/tabule/img5.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["tabule"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/tabule/img6.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/tabule/img6.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/tabule/img6.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/tabule/img6.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["tabule"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/tabule/img7.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/tabule/img7.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/tabule/img7.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/tabule/img7.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["tabule"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/tabule/img8.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/tabule/img8.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/tabule/img8.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/tabule/img8.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["tabule"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/tabule/img9.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/tabule/img9.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/tabule/img9.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/tabule/img9.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["tabule"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/tabule/img10.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/tabule/img10.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/tabule/img10.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/tabule/img10.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <!-- Tiskoviny -->
                        <figure class="col-3@xs col-4@sm col-3@md picture-item picture-item--overlay"
                            data-groups='["tiskoviny"]'>
                            <div class="picture-item__inner">
                                <a href="./images/galerie/new/tiskoviny/01.jpg" data-lightbox="galerie">
                                    <picture>
                                        <source srcset="./images/galerie/new/tiskoviny/01.webp" type="image/webp">
                                        <source srcset="./images/galerie/new/tiskoviny/01.jpg" type="image/jpeg">
                                        <img src="./images/galerie/new/tiskoviny/01.jpg">
                                    </picture>
                                </a>
                            </div>
                        </figure>
                        <div class="col-1@sm col-1@xs my-sizer-element"></div>
                    </div>
                </main>
                <footer></footer>
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
    <script src="./js/lightbox.js"></script>
    <script src="https://unpkg.com/shufflejs@5"></script>
    <script>
        var Shuffle = window.Shuffle;

        class Demo {
            constructor(element) {
                this.element = element;
                this.shuffle = new Shuffle(element, {
                    itemSelector: '.picture-item',
                    sizer: element.querySelector('.my-sizer-element')
                }); // Log events.

                this.addShuffleEventListeners();
                this._activeFilters = [];
                this.addFilterButtons();
                this.addSorting();
                this.addSearchFilter();
            }
            /**
             * Shuffle uses the CustomEvent constructor to dispatch events. You can listen
             * for them like you normally would (with jQuery for example).
             */


            addShuffleEventListeners() {
                this.shuffle.on(Shuffle.EventType.LAYOUT, data => {
                    console.log('layout. data:', data);
                });
                this.shuffle.on(Shuffle.EventType.REMOVED, data => {
                    console.log('removed. data:', data);
                });
            }

            addFilterButtons() {
                const options = document.querySelector('.filter-options');

                if (!options) {
                    return;
                }

                const filterButtons = Array.from(options.children);

                const onClick = this._handleFilterClick.bind(this);

                filterButtons.forEach(button => {
                    button.addEventListener('click', onClick, false);
                });
            }

            _handleFilterClick(evt) {
                const btn = evt.currentTarget;
                const isActive = btn.classList.contains('active');
                const btnGroup = btn.getAttribute('data-group');

                this._removeActiveClassFromChildren(btn.parentNode);

                let filterGroup;

                if (isActive) {
                    btn.classList.remove('active');
                    filterGroup = Shuffle.ALL_ITEMS;
                } else {
                    btn.classList.add('active');
                    filterGroup = btnGroup;
                }

                this.shuffle.filter(filterGroup);
            }

            _removeActiveClassFromChildren(parent) {
                const {
                    children
                } = parent;

                for (let i = children.length - 1; i >= 0; i--) {
                    children[i].classList.remove('active');
                }
            }

            addSorting() {
                const buttonGroup = document.querySelector('.sort-options');

                if (!buttonGroup) {
                    return;
                }

                buttonGroup.addEventListener('change', this._handleSortChange.bind(this));
            }

            _handleSortChange(evt) {
                // Add and remove `active` class from buttons.
                const buttons = Array.from(evt.currentTarget.children);
                buttons.forEach(button => {
                    if (button.querySelector('input').value === evt.target.value) {
                        button.classList.add('active');
                    } else {
                        button.classList.remove('active');
                    }
                }); // Create the sort options to give to Shuffle.

                const {
                    value
                } = evt.target;
                let options = {};

                function sortByDate(element) {
                    return element.getAttribute('data-created');
                }

                function sortByTitle(element) {
                    return element.getAttribute('data-title').toLowerCase();
                }

                if (value === 'date-created') {
                    options = {
                        reverse: true,
                        by: sortByDate
                    };
                } else if (value === 'title') {
                    options = {
                        by: sortByTitle
                    };
                }

                this.shuffle.sort(options);
            } // Advanced filtering


            addSearchFilter() {
                const searchInput = document.querySelector('.js-shuffle-search');

                if (!searchInput) {
                    return;
                }

                searchInput.addEventListener('keyup', this._handleSearchKeyup.bind(this));
            }
            /**
             * Filter the shuffle instance by items with a title that matches the search input.
             * @param {Event} evt Event object.
             */


            _handleSearchKeyup(evt) {
                const searchText = evt.target.value.toLowerCase();
                this.shuffle.filter((element, shuffle) => {
                    // If there is a current filter applied, ignore elements that don't match it.
                    if (shuffle.group !== Shuffle.ALL_ITEMS) {
                        // Get the item's groups.
                        const groups = JSON.parse(element.getAttribute('data-groups'));
                        const isElementInCurrentGroup = groups.indexOf(shuffle.group) !== -1; // Only search elements in the current group

                        if (!isElementInCurrentGroup) {
                            return false;
                        }
                    }

                    const titleElement = element.querySelector('.picture-item__title');
                    const titleText = titleElement.textContent.toLowerCase().trim();
                    return titleText.indexOf(searchText) !== -1;
                });
            }

        }

        document.addEventListener('DOMContentLoaded', () => {
            window.demo = new Demo(document.getElementById('grid'));
        });
    </script>
</body>