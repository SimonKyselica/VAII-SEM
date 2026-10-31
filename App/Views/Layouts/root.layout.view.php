<?php

/** @var string $contentHTML */
/** @var \Framework\Auth\AppUser $user */
/** @var \Framework\Support\LinkGenerator $link */
?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="PlaytestHub – platforma na testovanie hier pred vydaním.">
    <title><?= App\Configuration::APP_NAME ?></title>
    <link rel="icon" href="<?= $link->asset('images/logo.svg') ?>" type="image/svg+xml">
    <link rel="stylesheet" href="<?= $link->asset('css/main.css') ?>">
    <link rel="stylesheet" href="<?= $link->asset('css/hlasenia.css') ?>">
</head>
<body>
<a class="skip-link" href="#obsah">Preskočiť na obsah</a>

<!-- Hlavička: logo, názov, hlavné menu, účet -->
<header class="site-header">
    <div class="container site-header__inner">
        <a class="brand" href="<?= $link->url('home.index') ?>">
            <img class="brand__logo" src="<?= $link->asset('images/logo.svg') ?>" alt="" width="36" height="36">
            <span class="brand__name">PlaytestHub</span>
        </a>

        <!-- Na menších obrazovkách sa menu otvára cez checkbox (bez JavaScriptu) -->
        <input class="nav-toggle visually-hidden" type="checkbox" id="nav-toggle">
        <label class="nav-toggle__button" for="nav-toggle">
            <span class="icon icon--menu" aria-hidden="true"></span>
            <span class="visually-hidden">Zobraziť menu</span>
        </label>

        <nav class="main-nav" aria-label="Hlavné menu">
            <ul class="main-nav__list">
                <li><a class="main-nav__link" href="#">Katalóg</a></li>
                <li><a class="main-nav__link" href="#">Môj prehľad</a></li>
                <li><a class="main-nav__link" href="<?= $link->url('home.index') ?>" aria-current="true">Moje projekty</a></li>
            </ul>
        </nav>

        <details class="account">
            <summary class="account__summary">
                <span class="avatar" aria-hidden="true">ŠK</span>
                <span class="account__text">
                    <span class="account__name">Šimon K.</span>
                    <span class="account__role">Vývojár</span>
                </span>
                <span class="visually-hidden">Menu účtu</span>
                <span class="icon icon--chevron account__chevron" aria-hidden="true"></span>
            </summary>
            <ul class="account__menu">
                <li><a href="#">Môj profil</a></li>
                <li><a href="#">Nastavenia účtu</a></li>
                <li class="account__menu-sep"><a href="#">Odhlásiť sa</a></li>
            </ul>
        </details>
    </div>
</header>

<main class="page" id="obsah">
    <div class="container">
        <?= $contentHTML ?>
    </div>
</main>

<!-- Päta -->
<footer class="site-footer">
    <div class="container site-footer__inner">
        <p>© 2026 PlaytestHub</p>
        <p>Semestrálny projekt · 5ZYI31</p>
    </div>
</footer>
</body>
</html>
