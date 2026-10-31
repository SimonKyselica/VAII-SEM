<?php /** @var \Framework\Support\LinkGenerator $link */ ?>

<!-- Hlavička stránky: omrvinky, nadpis, akcie -->
<header class="page-header">
  <nav class="breadcrumbs" aria-label="Omrvinky">
    <ol class="breadcrumbs__list">
      <li><a href="#">Moje projekty</a></li>
      <li><a href="<?= $link->url('home.index') ?>">Lantern Woods</a></li>
      <li aria-current="page">Prehľad</li>
    </ol>
  </nav>
  <div class="page-header__row">
    <div>
      <h1 class="page-header__title">Prehľad</h1>
      <p class="page-header__lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
    </div>
    <div class="page-header__actions">
      <a class="btn" href="#">Upraviť projekt</a>
      <a class="btn btn--primary" href="#">Pridať build</a>
    </div>
  </div>
</header>

<div class="project-layout">
  <!-- Menu projektu – zobrazuje sa len na stránkach konkrétneho projektu -->
  <?php $activeItem = 'Main'; require __DIR__ . '/../_Shared/projectMenu.php' ?>

  <!-- Obsah stránky – zástupný obsah -->
  <div class="project-content">
    <section class="placeholder" aria-labelledby="placeholder-title">
      <div class="placeholder__label">
        <h2 class="placeholder__title" id="placeholder-title">Obsah stránky</h2>
        <p>Katalóg, tabuľka, formulár alebo detail – podľa aktuálnej stránky.</p>
      </div>
    </section>

    <section class="section" aria-labelledby="blocks-title">
      <h2 class="section__title" id="blocks-title">Ukážkové bloky obsahu</h2>
      <div class="card-grid">
        <article class="card">
          <h3 class="card__title">Posledný build</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante venenatis dapibus.</p>
        </article>
        <article class="card">
          <h3 class="card__title">Nové hlásenia</h3>
          <p>Curabitur blandit tempus porttitor. Donec ullamcorper nulla non metus auctor fringilla.</p>
        </article>
        <article class="card">
          <h3 class="card__title">Aktívni testeri</h3>
          <p>Maecenas faucibus mollis interdum. Vestibulum id ligula porta felis euismod semper.</p>
        </article>
      </div>
    </section>

    <section class="section card" aria-labelledby="about-title">
      <h2 class="section__title" id="about-title">O projekte</h2>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
      <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    </section>
  </div>
</div>
