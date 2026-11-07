<?php /** @var \Framework\Support\LinkGenerator $link */ ?>

<!-- Page header: breadcrumbs, title, actions -->
<header class="page-header">
  <nav class="breadcrumbs" aria-label="Breadcrumbs">
    <ol class="breadcrumbs__list">
      <li><a href="#">My projects</a></li>
      <li><a href="<?= $link->url('home.index') ?>">Lantern Woods</a></li>
      <li aria-current="page">Overview</li>
    </ol>
  </nav>
  <div class="page-header__row">
    <div>
      <h1 class="page-header__title">Overview</h1>
      <p class="page-header__lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
    </div>
    <div class="page-header__actions">
      <a class="btn" href="#">Edit project</a>
      <a class="btn btn--primary" href="#">Add build</a>
    </div>
  </div>
</header>

<div class="project-layout">
  <!-- Project menu – shown only on the pages of a specific project -->
  <?php $activeItem = 'Main'; require __DIR__ . '/../_Shared/projectMenu.php' ?>

  <!-- Page content – placeholder content -->
  <div class="project-content">
    <section class="placeholder" aria-labelledby="placeholder-title">
      <div class="placeholder__label">
        <h2 class="placeholder__title" id="placeholder-title">Page content</h2>
        <p>Catalog, table, form or detail – depending on the current page.</p>
      </div>
    </section>

    <section class="section" aria-labelledby="blocks-title">
      <h2 class="section__title" id="blocks-title">Sample content blocks</h2>
      <div class="card-grid">
        <article class="card">
          <h3 class="card__title">Latest build</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante venenatis dapibus.</p>
        </article>
        <article class="card">
          <h3 class="card__title">New reports</h3>
          <p>Curabitur blandit tempus porttitor. Donec ullamcorper nulla non metus auctor fringilla.</p>
        </article>
        <article class="card">
          <h3 class="card__title">Active testers</h3>
          <p>Maecenas faucibus mollis interdum. Vestibulum id ligula porta felis euismod semper.</p>
        </article>
      </div>
    </section>

    <section class="section card" aria-labelledby="about-title">
      <h2 class="section__title" id="about-title">About the project</h2>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
      <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    </section>
  </div>
</div>
