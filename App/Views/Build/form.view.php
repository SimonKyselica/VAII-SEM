<?php

use App\Models\Build;

/** @var \App\Models\Build $build */
/** @var string[] $errors */
/** @var \Framework\Support\LinkGenerator $link */

$isNew = $build->getId() === null;
$pageTitle = $isNew ? 'New build' : 'Edit build ' . $build->getVersion();
?>

<header class="page-header">
  <nav class="breadcrumbs" aria-label="Breadcrumbs">
    <ol class="breadcrumbs__list">
      <li><a href="#">My projects</a></li>
      <li><a href="<?= $link->url('home.index') ?>">Lantern Woods</a></li>
      <li><a href="<?= $link->url('build.index') ?>">Builds</a></li>
      <li aria-current="page"><?= e($pageTitle) ?></li>
    </ol>
  </nav>
  <div class="page-header__row">
    <div>
      <h1 class="page-header__title"><?= e($pageTitle) ?></h1>
    </div>
  </div>
</header>

<div class="project-layout">
  <?php $activeItem = 'Build'; require __DIR__ . '/../_Shared/projectMenu.php' ?>

  <div class="project-content">
    <form class="report-form card" method="post" action="<?= $link->url('build.save') ?>">
      <?php if (count($errors) > 0) : ?>
        <div class="form-errors" role="alert">
          <p class="form-errors__title">The build could not be saved:</p>
          <ul class="form-errors__list">
            <?php foreach ($errors as $error) : ?>
              <li><?= e($error) ?></li>
            <?php endforeach ?>
          </ul>
        </div>
      <?php endif ?>

      <input type="hidden" name="id" value="<?= e($build->getId()) ?>">

      <div class="report-form__grid">
        <div class="field">
          <label class="field__label" for="version">Version</label>
          <input class="input" type="text" id="version" name="version" value="<?= e($build->getVersion()) ?>"
                 maxlength="20" required placeholder="e.g. 0.4.1">
        </div>

        <div class="field">
          <label class="field__label" for="platform">Platform</label>
          <div class="select">
            <select id="platform" name="platform" required>
              <option value="" disabled <?= $build->getPlatform() === null ? 'selected' : '' ?>>Choose platform</option>
              <?php foreach (Build::PLATFORMS as $code => $label) : ?>
                <option value="<?= e($code) ?>" <?= $build->getPlatform() === $code ? 'selected' : '' ?>><?= e($label) ?></option>
              <?php endforeach ?>
            </select>
          </div>
        </div>

        <div class="field">
          <label class="field__label" for="releasedAt">Release date</label>
          <input class="input" type="date" id="releasedAt" name="releasedAt" value="<?= e($build->getReleasedAt()) ?>" required>
        </div>

        <div class="field">
          <label class="field__label" for="downloadUrl">Download link</label>
          <input class="input" type="url" id="downloadUrl" name="downloadUrl" value="<?= e($build->getDownloadUrl()) ?>"
                 maxlength="255" placeholder="https://…">
        </div>
      </div>

      <div class="field">
        <label class="field__label" for="changelog">Changelog</label>
        <textarea class="input" id="changelog" name="changelog" rows="6"><?= e($build->getChangelog()) ?></textarea>
      </div>

      <div class="report-form__actions">
        <button class="btn btn--primary" type="submit"><?= $isNew ? 'Create build' : 'Save changes' ?></button>
        <a class="btn" href="<?= $link->url('build.index') ?>">Cancel</a>
      </div>
    </form>
  </div>
</div>