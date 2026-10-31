<?php

/** @var \Framework\Support\LinkGenerator $link */
/** @var string $activeItem Set by the view before the require: 'Main' or 'Report' */
?>
<aside class="project-menu" aria-label="Projekt">
  <div class="project-card">
    <img class="project-card__cover" src="<?= $link->asset('images/lantern-woods.svg') ?>" alt="" width="56" height="56">
    <div>
      <p class="project-card__name">Lantern Woods</p>
      <p class="project-card__meta">Verejný · testovanie otvorené</p>
    </div>
  </div>
  <nav class="project-nav" aria-label="Menu projektu">
    <ul class="project-nav__list">
      <li><a class="project-nav__link" href="<?= $link->url('home.index') ?>"<?= $activeItem === 'Main' ? ' aria-current="page"' : '' ?>>Prehľad</a></li>
      <li><a class="project-nav__link" href="#">Buildy</a></li>
      <li><a class="project-nav__link" href="<?= $link->url('report.index') ?>"<?= $activeItem === 'Report' ? ' aria-current="page"' : '' ?>>Hlásenia <span class="badge">12 nových</span></a></li>
      <li><a class="project-nav__link" href="#">Dotazníky</a></li>
      <li><a class="project-nav__link" href="#">Odpovede</a></li>
      <li><a class="project-nav__link" href="#">Testeri</a></li>
      <li><a class="project-nav__link" href="#">Štatistiky</a></li>
      <li><a class="project-nav__link" href="#">Nastavenia projektu</a></li>
    </ul>
  </nav>
</aside>
