<?php

/** @var \Framework\Support\LinkGenerator $link */
/** @var string $activeItem Set by the view before the require: 'Main' or 'Report' */
?>
<aside class="project-menu" aria-label="Project">
  <div class="project-card">
    <img class="project-card__cover" src="<?= $link->asset('images/lantern-woods.svg') ?>" alt="" width="56" height="56">
    <div>
      <p class="project-card__name">Lantern Woods</p>
      <p class="project-card__meta">Public · testing open</p>
    </div>
  </div>
  <nav class="project-nav" aria-label="Project menu">
    <ul class="project-nav__list">
      <li><a class="project-nav__link" href="<?= $link->url('home.index') ?>"<?= $activeItem === 'Main' ? ' aria-current="page"' : '' ?>>Overview</a></li>
      <li><a class="project-nav__link" href="<?= $link->url('build.index') ?>"<?= $activeItem === 'Build' ? ' aria-current="page"' : '' ?>>Builds</a></li>
      <li><a class="project-nav__link" href="<?= $link->url('report.index') ?>"<?= $activeItem === 'Report' ? ' aria-current="page"' : '' ?>>Reports <span class="badge">12 new</span></a></li>
      <li><a class="project-nav__link" href="#">Questionnaires</a></li>
      <li><a class="project-nav__link" href="#">Responses</a></li>
      <li><a class="project-nav__link" href="#">Testers</a></li>
      <li><a class="project-nav__link" href="#">Statistics</a></li>
      <li><a class="project-nav__link" href="#">Project settings</a></li>
    </ul>
  </nav>
</aside>
