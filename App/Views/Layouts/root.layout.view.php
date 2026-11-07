<?php

/** @var string $contentHTML */
/** @var \Framework\Auth\AppUser $user */
/** @var \Framework\Support\LinkGenerator $link */

// URL of a file in public/ with its modification time (e.g. css/main.css?v=1762531309). After every change of the
// file the URL is different, so the browser downloads it again instead of using an old copy from its cache.
$versioned = fn (string $path): string => $link->asset($path) . '?v=' . filemtime(dirname(__DIR__, 3) . '/public/' . $path);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="PlaytestHub – a platform for playtesting games before release.">
    <title><?= App\Configuration::APP_NAME ?></title>
    <link rel="icon" href="<?= $link->asset('images/logo.svg') ?>" type="image/svg+xml">
    <link rel="stylesheet" href="<?= $versioned('css/main.css') ?>">
    <link rel="stylesheet" href="<?= $versioned('css/hlasenia.css') ?>">
</head>
<body>
<a class="skip-link" href="#content">Skip to content</a>

<!-- Header: logo, name, main menu, account -->
<header class="site-header">
    <div class="container site-header__inner">
        <a class="brand" href="<?= $link->url('home.index') ?>">
            <img class="brand__logo" src="<?= $link->asset('images/logo.svg') ?>" alt="" width="36" height="36">
            <span class="brand__name">PlaytestHub</span>
        </a>

        <!-- On smaller screens the menu opens with a checkbox (no JavaScript) -->
        <input class="nav-toggle visually-hidden" type="checkbox" id="nav-toggle">
        <label class="nav-toggle__button" for="nav-toggle">
            <span class="icon icon--menu" aria-hidden="true"></span>
            <span class="visually-hidden">Show menu</span>
        </label>

        <nav class="main-nav" aria-label="Main menu">
            <ul class="main-nav__list">
                <li><a class="main-nav__link" href="#">Catalog</a></li>
                <li><a class="main-nav__link" href="#">My dashboard</a></li>
                <li><a class="main-nav__link" href="<?= $link->url('home.index') ?>" aria-current="true">My projects</a></li>
            </ul>
        </nav>

        <details class="account">
            <summary class="account__summary">
                <span class="avatar" aria-hidden="true">ŠK</span>
                <span class="account__text">
                    <span class="account__name">Šimon K.</span>
                    <span class="account__role">Developer</span>
                </span>
                <span class="visually-hidden">Account menu</span>
                <span class="icon icon--chevron account__chevron" aria-hidden="true"></span>
            </summary>
            <ul class="account__menu">
                <li><a href="#">My profile</a></li>
                <li><a href="#">Account settings</a></li>
                <li class="account__menu-sep"><a href="#">Log out</a></li>
            </ul>
        </details>
    </div>
</header>

<main class="page" id="content">
    <div class="container">
        <?= $contentHTML ?>
    </div>
</main>

<!-- Footer -->
<footer class="site-footer">
    <div class="container site-footer__inner">
        <p>© 2026 PlaytestHub</p>
        <p>Semester project · 5ZYI31</p>
    </div>
</footer>
</body>
</html>
