<?php

$response = '';

if (isset($_POST['name'], $_POST['email'], $_POST['tel'], $_POST['pevne-desky'], $_POST['krouzkove-vazby'], $_POST['barva-desek'], $_POST['barva-pisma'], $_POST['pocet-listu'], $_POST['kapsy-cd-dvd'], $_POST['chlopne-na-prilohy'])) {
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

    //// Mail headers
    $headers = 'From: ' . $from . "\r\n" . 'Reply-To: ' . $from . "\r\n" . 'Return-Path: ' . $from . "\r\n" . 'X-Mailer: PHP/' . phpversion() . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-Type: text/html; charset=UTF-8' . "\r\n";

    //// Capture the email template file as a string
    ob_start();
    include 'email-template.php';
    $email_template = ob_get_clean();

    // Admin email
    $adminTo = 'admin@studiodenali.cz';
    $adminSubject = 'Nová objednávka';
    $adminMail = mail($adminTo, $adminSubject, $email_template, $headers);

    // Client email
    $clientTo = $email;
    $clientSubject = 'Děkujeme za vaši objednávku - Reklamka Quatro';
    $clientMail = mail($clientTo, $clientSubject, $email_template, $headers);

    // Try to send the mail
    if ($adminMail && $clientMail) {
        $response = '<h3>Děkujeme vám za vaši objednávku!</h3><p>Vaše objednávka byla úspěšně odeslána.</p>';
    } else {
        $response = '<h3>Vyskytla se chyba!</h3><p>Odeslání vaší objednávky se nezdařilo. Zkuste to prosím znovu.</a>';
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Objednávka diplomové práce</title>
    <link rel="stylesheet" href="objednavka.css">
</head>

<body>
    <a id="logo" href="https://nastartuj.cz" target="_blank">
        <svg width="100%" height="100%" viewBox="0 0 246 111" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;">
            <path d="M48.258,101.137l-5.984,-0l0,1.084l3.361,0c0.588,0 0.588,0 1.245,-0.027c-0.242,0.255 -0.643,0.803 -1.138,1.526l-3.628,5.261l-0,1.085l6.225,-0l-0,-1.085l-3.776,0c-0.495,0 -0.669,0 -0.99,0.04l0.147,-0.227c0.054,-0.081 0.107,-0.161 0.174,-0.228c0.081,-0.107 0.161,-0.214 0.241,-0.334l0.295,-0.415l3.828,-5.502l0,-1.178Zm-3.587,-0.884l1.218,0l1.472,-1.74l-1.124,0l-0.964,1.111l-0.95,-1.111l-1.125,0l1.473,1.74Zm10.857,0.884l-1.272,-0l-0,8.929l1.272,-0l-0,-8.929Zm13.788,-0l-1.338,-0l-2.182,5.89c-0.308,0.843 -0.469,1.379 -0.603,1.994c-0.174,-0.709 -0.388,-1.365 -0.629,-1.994l-2.182,-5.89l-1.406,-0l3.414,8.929l1.553,-0l3.373,-8.929Zm10.335,-0l-4.966,-0l-0,8.929l5.073,-0l0,-1.085l-3.801,0l-0,-3.039l3.427,0l-0,-1.084l-3.427,0l-0,-2.637l3.694,0l0,-1.084Zm7.511,-0l-1.272,-0l-0,8.929l5.047,-0l-0,-1.085l-3.775,0l-0,-7.844Zm23.253,-0l-1.339,-0l-2.182,5.89c-0.308,0.843 -0.469,1.379 -0.602,1.994c-0.174,-0.709 -0.389,-1.365 -0.629,-1.994l-2.183,-5.89l-1.405,-0l3.414,8.929l1.552,-0l3.374,-8.929Zm12.061,-0l0,8.929l1.272,-0l0,-3.976l0.737,-0c1.017,-0 1.258,0.187 1.74,1.298l1.151,2.678l1.473,-0l-1.513,-3.254c-0.335,-0.709 -0.576,-0.99 -1.111,-1.217c0.575,-0.108 0.843,-0.215 1.165,-0.469c0.468,-0.388 0.736,-0.978 0.736,-1.633c-0,-0.991 -0.576,-1.821 -1.473,-2.129c-0.562,-0.187 -0.964,-0.227 -2.021,-0.227l-2.156,-0Zm1.272,1.084l0.924,-0c0.562,-0 0.977,0.04 1.245,0.134c0.562,0.187 0.897,0.642 0.897,1.245c-0,0.562 -0.308,1.004 -0.83,1.218c-0.308,0.12 -0.763,0.174 -1.446,0.174l-0.79,-0l0,-2.771Zm15.65,-1.084l-4.967,-0l0,8.929l5.074,-0l-0,-1.085l-3.802,0l0,-3.039l3.427,0l0,-1.084l-3.427,0l0,-2.637l3.695,-0l-0,-1.084Zm7.51,-0l-1.272,-0l0,8.929l1.272,-0l0,-3.508c0,-0.375 0,-0.548 -0.013,-0.91c0.281,0.348 0.642,0.763 0.816,0.95l3.253,3.468l1.848,-0l-4.565,-4.699l4.203,-4.23l-1.713,-0l-3.119,3.239c-0.241,0.255 -0.415,0.455 -0.737,0.817c0.027,-0.308 0.027,-0.455 0.027,-1.071l0,-2.985Zm12.584,-0l-1.272,-0l0,8.929l5.047,-0l-0,-1.085l-3.775,0l-0,-7.844Zm13.36,-0l-1.338,-0l-3.802,8.929l1.379,-0l0.923,-2.263l4.337,0l0.938,2.263l1.432,-0l-3.869,-8.929Zm1.058,5.582l-3.494,-0l0.991,-2.463c0.508,-1.272 0.602,-1.513 0.749,-2.021c0.067,0.334 0.295,0.977 0.723,1.994l1.031,2.49Zm17.992,-5.582l-2.129,-0l-1.7,4.457c-0.629,1.62 -0.883,2.343 -1.071,3.026c-0.066,-0.322 -0.107,-0.455 -0.267,-0.924c-0.094,-0.281 -0.362,-0.977 -0.79,-2.075l-1.754,-4.484l-2.102,-0l0,8.929l1.272,-0l0,-5.007c0,-0.188 -0.013,-0.482 -0.027,-0.883l-0.026,-1.031c-0.014,-0.482 -0.014,-0.482 -0.081,-1.219l0,-0.2l0.081,0.241l0.147,0.455c0.04,0.16 0.134,0.415 0.321,0.923c0.429,1.125 0.723,1.928 0.897,2.383l1.687,4.338l1.231,-0l1.674,-4.338c0.094,-0.227 0.187,-0.495 0.334,-0.91c0.134,-0.348 0.255,-0.696 0.389,-1.058c0.214,-0.589 0.321,-0.896 0.388,-1.111l0.214,-0.696c0.027,-0.067 0.054,-0.147 0.08,-0.227l0,0.187c-0.026,0.776 -0.04,2.289 -0.04,3.052l0,5.101l1.272,-0l-0,-8.929Zm11.419,-0l-4.966,-0l-0,8.929l5.073,-0l0,-1.085l-3.802,0l0,-3.039l3.428,0l-0,-1.084l-3.428,0l0,-2.637l3.695,-0l0,-1.084Zm-3.092,-0.884l1.218,0l1.472,-1.74l-1.124,0l-0.964,1.111l-0.95,-1.111l-1.125,0l1.473,1.74Z" style="fill:#124094;" />
            <path d="M35.167,98.644l-8.271,-8.067c2.668,-1.334 3.895,-2.295 5.283,-4.216c2.348,-3.148 3.575,-7.31 3.575,-12.167c0,-5.816 -1.761,-10.886 -4.856,-14.035c-2.988,-3.041 -7.898,-4.856 -13.128,-4.856c-10.939,-0 -17.77,7.098 -17.77,18.518c-0,5.763 1.708,10.886 4.589,13.874c2.829,2.989 8.219,5.025 13.128,5.025c0.213,0 0.694,0 1.227,-0.053l5.603,5.977l10.62,-0Zm-17.29,-36.35c2.242,-0 4.429,1.174 5.817,3.202c1.494,2.134 2.188,4.909 2.188,8.912c-0,6.884 -3.095,11.26 -7.952,11.26c-2.401,-0 -4.696,-1.281 -6.03,-3.309c-1.387,-2.135 -2.027,-4.696 -2.027,-8.378c-0,-3.949 0.746,-6.778 2.347,-8.805c1.388,-1.761 3.576,-2.882 5.657,-2.882Zm30.204,-6.137l-0,21.025c-0,5.07 0.907,8.112 3.202,10.674c2.721,3.041 7.204,4.758 12.381,4.758c4.322,-0 8.004,-1.236 10.833,-3.638c2.935,-2.561 4.269,-5.87 4.269,-10.726l-0,-22.093l-9.606,0l-0,21.079c-0,3.415 -0.107,4.216 -0.694,5.443c-0.907,1.815 -2.775,2.935 -4.963,2.935c-2.028,0 -3.735,-0.907 -4.749,-2.508c-0.8,-1.227 -1.067,-2.775 -1.067,-5.924l0,-21.025l-9.606,0Zm78.232,35.594l-13.661,-35.594l-11.367,0l-13.554,35.594l9.552,0l2.881,-7.524l13.235,-0l2.722,7.524l10.192,0Zm-15.155,-14.088l-8.859,0l4.003,-12.061c0.266,-0.8 0.48,-1.707 0.587,-2.454c0.16,0.96 0.213,1.28 0.587,2.508l3.682,12.007Zm38.635,14.088l0,-28.283l8.699,-0l-0,-7.097l-27.056,-0l-0,7.097l8.752,-0l-0,28.283l9.605,0Zm29.618,0l-0,-13.715l1.547,0c3.522,0 4.909,1.068 6.084,4.75l2.881,8.965l9.979,0l-3.575,-9.819c-2.081,-5.924 -2.828,-6.937 -5.443,-7.631c4.643,-0.961 7.151,-4.002 7.151,-8.645c-0,-3.415 -1.441,-6.137 -4.056,-7.738c-2.081,-1.227 -4.856,-1.761 -9.499,-1.761l-14.675,0l-0,35.594l9.606,0Zm-0.267,-20.545l-0,-8.218l3.202,-0c4.109,-0 6.083,1.387 6.083,4.215c0,2.722 -1.761,4.003 -5.603,4.003l-3.682,-0Zm48.081,-15.903c-5.23,-0 -10.086,1.868 -13.181,5.017c-2.988,3.095 -4.643,7.897 -4.643,13.501c0,5.763 1.708,10.779 4.696,13.874c2.989,2.989 8.058,4.919 13.128,4.919c5.657,-0 11.046,-2.304 14.088,-5.986c2.402,-2.935 3.789,-7.471 3.789,-12.434c-0,-5.55 -1.387,-10.086 -4.002,-13.181c-3.095,-3.629 -8.112,-5.71 -13.875,-5.71Zm0.054,6.991c4.909,-0 7.951,4.536 7.951,11.9c-0,6.991 -3.042,11.42 -7.898,11.42c-4.963,0 -8.058,-4.482 -8.058,-11.633c-0,-7.151 3.148,-11.687 8.005,-11.687" style="fill:#124094;" />
            <path d="M118.468,11.095c0.381,0 0.759,0.013 1.135,0.035c4.683,-6.224 11.857,-10.46 20.571,-11.13c-7.083,1.853 -11.605,6.518 -13.938,12.764c6.589,2.976 11.193,9.614 11.193,17.292c-0,2.094 -0.344,4.11 -0.976,5.996c2.45,-0.212 5.008,0.225 7.529,1.389c3.31,1.526 5.818,4.093 7.321,7.134c-1.222,-1.394 -2.745,-2.558 -4.532,-3.384c-5.267,-2.43 -11.31,-1.207 -15.252,2.608l-0.006,-0.006c-0.078,0.073 -0.155,0.147 -0.234,0.219c-2.411,-1.982 -4.455,-4.398 -6.009,-7.126c1.755,-1.749 2.845,-4.166 2.845,-6.83c-0,-5.313 -4.333,-9.647 -9.647,-9.647c-5.313,0 -9.646,4.334 -9.646,9.647c-0,4.674 3.354,8.59 7.778,9.464c1.295,3.383 3.194,6.472 5.565,9.133c-1.196,0.238 -2.432,0.364 -3.697,0.364c-10.443,-0 -18.961,-8.518 -18.961,-18.961c0,-10.443 8.518,-18.961 18.961,-18.961" style="fill:#ef7c00;" />
        </svg>
    </a>
    <form id="order-form" class="survey-form" name="order-form" method="POST" action="" required>
        <fieldset class="step-content current" data-step="1" style="visibility: visible;">
            <div class="step-indicator">
                <svg viewBox="0 0 122 122" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;">
                    <path d="M121.186,20c-0,-11.046 -8.955,-20 -20,-20l-81.186,0c-11.046,0 -20,8.954 -20,20l0,81.186c0,11.045 8.954,20 20,20l81.186,-0c11.045,-0 20,-8.955 20,-20l-0,-81.186Z" style="fill:#ef7c02;" />
                    <path d="M60.593,60.467c-5.555,-0 -10.099,-1.768 -13.634,-5.302c-3.534,-3.535 -5.301,-8.079 -5.301,-13.634c-0,-5.554 1.767,-10.098 5.301,-13.633c3.535,-3.535 8.079,-5.302 13.634,-5.302c5.554,0 10.099,1.767 13.633,5.302c3.535,3.535 5.302,8.079 5.302,13.633c0,5.555 -1.767,10.099 -5.302,13.634c-3.534,3.534 -8.079,5.302 -13.633,5.302Zm-40.395,40.521l-0,-11.866c-0,-3.198 0.799,-5.933 2.398,-8.205c1.599,-2.273 3.661,-3.998 6.186,-5.176c5.638,-2.525 11.045,-4.418 16.221,-5.681c5.175,-1.262 10.372,-1.893 15.59,-1.893c5.218,-0 10.393,0.652 15.527,1.957c5.133,1.304 10.519,3.177 16.158,5.617c2.609,1.178 4.713,2.903 6.312,5.176c1.599,2.272 2.398,5.007 2.398,8.205l0,11.866l-80.79,0Z" style="fill:#fff;fill-rule:nonzero;" />
                </svg>
                <p>Představte se nám</p>
            </div>
            <input id="name" type="text" name="name" placeholder="Jméno a příjmení" required>
            <input id="email" type="email" name="email" placeholder="E-mail" required>
            <input id="tel" type="tel" name="tel" placeholder="Telefonní číslo" required>
            <div class="buttons">
                <a href="#" class="btn" data-set-step="2">
                    <svg viewBox="0 0 64 64" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;">
                        <rect x="0" y="0" width="64" height="64" style="fill:none;" />
                        <path d="M64,32c0,-2.76 -2.24,-5 -5,-5l-54,0c-2.76,0 -5,2.24 -5,5c0,2.76 2.24,5 5,5l54,0c2.76,0 5,-2.24 5,-5Z" />
                        <path d="M62.537,28.463c-1.952,-1.951 -5.12,-1.951 -7.072,0l-21.213,21.214c-1.951,1.951 -1.951,5.119 0,7.071c1.952,1.951 5.12,1.951 7.071,-0l21.214,-21.213c1.951,-1.952 1.951,-5.12 -0,-7.072Z" />
                        <path d="M62.537,35.537c1.951,-1.952 1.951,-5.12 -0,-7.072l-21.214,-21.213c-1.951,-1.951 -5.119,-1.951 -7.071,0c-1.951,1.952 -1.951,5.12 0,7.071l21.213,21.214c1.952,1.951 5.12,1.951 7.072,-0Z" />
                    </svg>
                </a>
            </div>
        </fieldset>
        <!-- page 2 -->
        <fieldset class="step-content next" data-step="2">
            <div class="step-indicator">
                <svg viewBox="0 0 122 122" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;">
                    <path d="M121.186,20c-0,-11.046 -8.955,-20 -20,-20l-81.186,0c-11.046,0 -20,8.954 -20,20l0,81.186c0,11.045 8.954,20 20,20l81.186,-0c11.045,-0 20,-8.955 20,-20l-0,-81.186Z" style="fill:#ef7c02;" />
                    <path d="M33,103.044c-1.698,-0 -3.184,-0.637 -4.458,-1.91c-1.273,-1.274 -1.91,-2.76 -1.91,-4.458l0,-72.167c0,-1.698 0.637,-3.183 1.91,-4.457c1.274,-1.273 2.76,-1.91 4.458,-1.91l55.186,-0c1.698,-0 3.184,0.637 4.457,1.91c1.274,1.274 1.911,2.759 1.911,4.457l-0,72.167c-0,1.698 -0.637,3.184 -1.911,4.458c-1.273,1.273 -2.759,1.91 -4.457,1.91l-55.186,-0Zm28.23,-50.305l10.294,-5.943l10.294,5.943l0,-28.23l-20.588,0l-0,28.23Z" style="fill:#fff;fill-rule:nonzero;" />
                </svg>
                <p>Vaše diplomová práce</p>
            </div>
            <h3>Počet zhotovení pevných desek</h3>
            <div class="range">
                <input type="range" name="pevne-desky" min="1" max="7" steps="1" value="1" required>
            </div>
            <ul class="range-labels">
                <li class="active selected">1</li>
                <li>2</li>
                <li>3</li>
                <li>4</li>
                <li>5</li>
                <li>6</li>
                <li>7</li>
            </ul>
            <h3>Počet zhotovení kroužkových vazeb</h3>
            <div class="range">
                <input type="range" name="krouzkove-vazby" min="1" max="6" steps="1" value="1" required>
            </div>
            <ul class="range-labels">
                <li class="active selected">1</li>
                <li>2</li>
                <li>3</li>
                <li>4</li>
                <li>5</li>
                <li>6</li>
            </ul>
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
            <div class="buttons">
                <a href="#" class="btn alt" data-set-step="1">
                    <svg viewBox="0 0 64 64" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;">
                        <rect x="0" y="0" width="64" height="64" style="fill:none;" />
                        <path d="M64,32c0,-2.76 -2.24,-5 -5,-5l-54,0c-2.76,0 -5,2.24 -5,5c0,2.76 2.24,5 5,5l54,0c2.76,0 5,-2.24 5,-5Z" />
                        <path d="M29.748,7.252c-1.952,-1.951 -5.12,-1.951 -7.071,0l-21.214,21.213c-1.951,1.952 -1.951,5.12 0,7.072c1.952,1.951 5.12,1.951 7.072,-0l21.213,-21.214c1.951,-1.951 1.951,-5.119 -0,-7.071Z" />
                        <path d="M29.748,56.748c1.951,-1.952 1.951,-5.12 -0,-7.071l-21.213,-21.214c-1.952,-1.951 -5.12,-1.951 -7.072,0c-1.951,1.952 -1.951,5.12 0,7.072l21.214,21.213c1.951,1.951 5.119,1.951 7.071,-0Z" />
                    </svg>
                </a>
                <a href="#" class="btn" data-set-step="3">
                    <svg viewBox="0 0 64 64" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;">
                        <rect x="0" y="0" width="64" height="64" style="fill:none;" />
                        <path d="M64,32c0,-2.76 -2.24,-5 -5,-5l-54,0c-2.76,0 -5,2.24 -5,5c0,2.76 2.24,5 5,5l54,0c2.76,0 5,-2.24 5,-5Z" />
                        <path d="M62.537,28.463c-1.952,-1.951 -5.12,-1.951 -7.072,0l-21.213,21.214c-1.951,1.951 -1.951,5.119 0,7.071c1.952,1.951 5.12,1.951 7.071,-0l21.214,-21.213c1.951,-1.952 1.951,-5.12 -0,-7.072Z" />
                        <path d="M62.537,35.537c1.951,-1.952 1.951,-5.12 -0,-7.072l-21.214,-21.213c-1.951,-1.951 -5.119,-1.951 -7.071,0c-1.951,1.952 -1.951,5.12 0,7.071l21.213,21.214c1.952,1.951 5.12,1.951 7.072,-0Z" />
                    </svg>
                </a>
            </div>
        </fieldset>
        <!-- page 3 -->
        <fieldset class="step-content next" data-step="3">
            <div class="step-indicator">
                <svg viewBox="0 0 122 122" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;">
                    <path d="M121.186,20c-0,-11.046 -8.955,-20 -20,-20l-81.186,0c-11.046,0 -20,8.954 -20,20l0,81.186c0,11.045 8.954,20 20,20l81.186,-0c11.045,-0 20,-8.955 20,-20l-0,-81.186Z" style="fill:#ef7c02;" />
                    <path d="M30.896,101.272c-2.541,0 -5.043,-0.429 -7.509,-1.288c-2.465,-0.859 -4.632,-2.26 -6.5,-4.203c2.615,-0.896 4.483,-2.204 5.604,-3.922c1.12,-1.718 1.681,-4.034 1.681,-6.948c-0,-3.287 1.139,-6.07 3.418,-8.349c2.278,-2.279 5.061,-3.418 8.349,-3.418c3.287,0 6.07,1.139 8.348,3.418c2.279,2.279 3.418,5.062 3.418,8.349c0,4.781 -1.625,8.704 -4.874,11.767c-3.25,3.063 -7.229,4.594 -11.935,4.594Zm25.775,-26.559l-10.086,-10.646l42.136,-42.137c1.046,-1.046 2.204,-1.587 3.474,-1.625c1.27,-0.037 2.466,0.505 3.586,1.625l3.25,3.25c1.121,1.121 1.662,2.335 1.625,3.642c-0.037,1.308 -0.579,2.485 -1.625,3.53l-42.36,42.361Z" style="fill:#fff;fill-rule:nonzero;" />
                </svg>
                <p>Přizpůsobte si vaši vazbu</p>
            </div>
            <h3>Barva desek</h3>
            <div class="barvy">
                <div class="barva-desek">
                    <input type="radio" name="barva-desek" value="Černá" id="black" required checked>
                    <label for="black">Černá</label>
                </div>
                <div class="barva-desek">
                    <input type="radio" name="barva-desek" value="Modrá" id="blue">
                    <label for="blue">Modrá</label>
                </div>
                <div class="barva-desek">
                    <input type="radio" name="barva-desek" value="Bordó" id="bordeaux">
                    <label for="bordeaux">Bordó</label>
                </div>
            </div>
            <h3>Barva písma</h3>
            <div class="barvy">
                <div class="barva-pisma">
                    <input type="radio" name="barva-pisma" value="Zlatý tisk" id="gold" required checked>
                    <label for="gold">Zlatý tisk</label>
                </div>
                <div class="barva-pisma">
                    <input type="radio" name="barva-pisma" value="Stříbrný tisk" id="silver">
                    <label for="silver">Stříbrný tisk</label>
                </div>
            </div>
            <div class="select">
                <label for="kapsy-cd-dvd">Chci do vazby i kapsy na CD/DVD</label>
                <select name="kapsy-cd-dvd" data-vypocet="kapsy-cd-dvd" required>
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
            <textarea id="poznamka" name="poznamka" placeholder="Poznámka"></textarea>
            <div class="buttons">
                <a href="#" class="btn alt" data-set-step="2">
                    <svg viewBox="0 0 64 64" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;">
                        <rect x="0" y="0" width="64" height="64" style="fill:none;" />
                        <g>
                            <path d="M64,32c0,-2.76 -2.24,-5 -5,-5l-54,0c-2.76,0 -5,2.24 -5,5c0,2.76 2.24,5 5,5l54,0c2.76,0 5,-2.24 5,-5Z" />
                            <path d="M29.748,7.252c-1.952,-1.951 -5.12,-1.951 -7.071,0l-21.214,21.213c-1.951,1.952 -1.951,5.12 0,7.072c1.952,1.951 5.12,1.951 7.072,-0l21.213,-21.214c1.951,-1.951 1.951,-5.119 -0,-7.071Z" />
                            <path d="M29.748,56.748c1.951,-1.952 1.951,-5.12 -0,-7.071l-21.213,-21.214c-1.952,-1.951 -5.12,-1.951 -7.072,0c-1.951,1.952 -1.951,5.12 0,7.072l21.214,21.213c1.951,1.951 5.119,1.951 7.071,-0Z" />
                        </g>
                    </svg>
                </a>
                <a href="#" class="btn" data-set-step="4">
                    <svg viewBox="0 0 64 64" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;">
                        <rect x="0" y="0" width="64" height="64" style="fill:none;" />
                        <g>
                            <path d="M64,32c0,-2.76 -2.24,-5 -5,-5l-54,0c-2.76,0 -5,2.24 -5,5c0,2.76 2.24,5 5,5l54,0c2.76,0 5,-2.24 5,-5Z" />
                            <path d="M62.537,28.463c-1.952,-1.951 -5.12,-1.951 -7.072,0l-21.213,21.214c-1.951,1.951 -1.951,5.119 0,7.071c1.952,1.951 5.12,1.951 7.071,-0l21.214,-21.213c1.951,-1.952 1.951,-5.12 -0,-7.072Z" />
                            <path d="M62.537,35.537c1.951,-1.952 1.951,-5.12 -0,-7.072l-21.214,-21.213c-1.951,-1.951 -5.119,-1.951 -7.071,0c-1.951,1.952 -1.951,5.12 0,7.071l21.213,21.214c1.952,1.951 5.12,1.951 7.072,-0Z" />
                        </g>
                    </svg>
                </a>
            </div>
        </fieldset>
        <!-- page 4 -->
        <fieldset class="step-content next" data-step="4">
            <div class="step-indicator">
                <svg viewBox="0 0 122 122" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;">
                    <path d="M121.186,20c-0,-11.046 -8.955,-20 -20,-20l-81.186,0c-11.046,0 -20,8.954 -20,20l-0,81.186c0,11.045 8.954,20 20,20l81.186,-0c11.045,-0 20,-8.955 20,-20l-0,-81.186Z" style="fill:#ef7c02;" />
                    <path d="M54.125,77.452l30.643,-30.749l-4.559,-4.56l-26.084,26.19l-12.618,-12.618l-4.559,4.56l17.177,17.177Zm-25.342,21.313c-1.696,-0 -3.181,-0.637 -4.453,-1.909c-1.273,-1.272 -1.909,-2.757 -1.909,-4.453l0,-63.62c0,-1.696 0.636,-3.181 1.909,-4.453c1.272,-1.273 2.757,-1.909 4.453,-1.909l63.62,0c1.696,0 3.181,0.636 4.453,1.909c1.272,1.272 1.909,2.757 1.909,4.453l-0,63.62c-0,1.696 -0.637,3.181 -1.909,4.453c-1.272,1.272 -2.757,1.909 -4.453,1.909l-63.62,-0Z" style="fill:#fff;fill-rule:nonzero;" />
                </svg>
                <p>Je vše v pořádku?</p>
            </div>
            <p>Místo vyzvednutí:</p>
            <p>QUATRO - Bohumínská 323/21, Karviná - Staré město</p>
            <input type="checkbox" name="obchodni-podminky" id="obchodni-podminky" required>
            <label for="obchodni-podminky">Souhlasím s <a href="" target="_blank">obchodními podmínkami</a>.</label>
            <div class="buttons">
                <a href="#" class="btn alt" data-set-step="3">
                    <svg viewBox="0 0 64 64" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;">
                        <rect x="0" y="0" width="64" height="64" style="fill:none;" />
                        <g>
                            <path d="M64,32c0,-2.76 -2.24,-5 -5,-5l-54,0c-2.76,0 -5,2.24 -5,5c0,2.76 2.24,5 5,5l54,0c2.76,0 5,-2.24 5,-5Z" />
                            <path d="M29.748,7.252c-1.952,-1.951 -5.12,-1.951 -7.071,0l-21.214,21.213c-1.951,1.952 -1.951,5.12 0,7.072c1.952,1.951 5.12,1.951 7.072,-0l21.213,-21.214c1.951,-1.951 1.951,-5.119 -0,-7.071Z" />
                            <path d="M29.748,56.748c1.951,-1.952 1.951,-5.12 -0,-7.071l-21.213,-21.214c-1.952,-1.951 -5.12,-1.951 -7.072,0c-1.951,1.952 -1.951,5.12 0,7.072l21.214,21.213c1.951,1.951 5.119,1.951 7.071,-0Z" />
                        </g>
                    </svg>
                </a>
                <button type="submit" class="btn" name="submit">
                    <svg viewBox="0 0 64 64" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:1.5;">
                        <path d="M5,41.6l18.295,17.4l35.705,-54" style="fill:none;stroke:#fff;stroke-width:10px;" />
                    </svg>
                </button>
            </div>
        </fieldset>
        <!-- page 5 -->
        <fieldset class="step-content next" data-step="5">
            <div class="result"><?= $response ?></div>
        </fieldset>
    </form>
    <script>
        document.documentElement.style.setProperty("--currentHeight", document.querySelector(".current").clientHeight + "px");

        document.querySelectorAll("[data-set-step]").forEach(element => {
            element.onclick = event => {
                event.preventDefault();
                setStep(parseInt(element.dataset.setStep));
                document.documentElement.style.setProperty("--currentHeight", document.querySelector(".current").clientHeight + "px");
            };
        });

        document.getElementById("order-form").style.transition = "padding-top 500ms ease-in-out";

        const setStep = step => {
            document.querySelectorAll(".step-content").forEach((element) => {
                if (element.dataset.step < step) {
                    element.classList.remove("current", "next");
                    element.classList.add("previous");
                } else if (element.dataset.step > step) {
                    element.classList.remove("current", "previous");
                    element.classList.add("next");
                } else {
                    element.classList.remove("previous", "next");
                    element.classList.add("current");
                }
            })
        };

        var sheet = document.createElement('style'),
            $rangeInput = $('.range input'),
            prefs = ['webkit-slider-runnable-track', 'moz-range-track', 'ms-track'];

        document.body.appendChild(sheet);

        var getTrackStyle = function(el) {
            var curVal = el.value,
                val = (curVal - 1) * 16.666666667,
                style = '';

            // Set active label
            $('.range-labels li').removeClass('active selected');

            var curLabel = $('.range-labels').find('li:nth-child(' + curVal + ')');

            curLabel.addClass('active selected');
            curLabel.prevAll().addClass('selected');

            // Change background gradient
            for (var i = 0; i < prefs.length; i++) {
                style += '.range {background: linear-gradient(to right, #37adbf 0%, #37adbf ' + val + '%, #fff ' + val + '%, #fff 100%)}';
                style += '.range input::-' + prefs[i] + '{background: linear-gradient(to right, #37adbf 0%, #37adbf ' + val + '%, #b2b2b2 ' + val + '%, #b2b2b2 100%)}';
            }

            return style;
        }

        $rangeInput.on('input', function() {
            sheet.textContent = getTrackStyle(this);
        });

        // Change input value on label click
        $('.range-labels li').on('click', function() {
            var index = $(this).index();

            $rangeInput.val(index + 1).trigger('input');

        });

        <?php if (!empty($_POST)) : ?>
            setStep(5);
        <?php endif; ?>
    </script>
    <script>
        // Výpočet ceny
        
        const items = {
            kapsy: document.querySelector("[data-vypocet='kapsy-cd-dvd']"),
        }
    </script>
</body>

</html>