<?php

use App\Models\Report;

/** @var \App\Models\Report $report */
/** @var string[] $errors */
/** @var \Framework\Support\LinkGenerator $link */

// The same form is used for a new report (add) and for an existing one (edit)
$isNew = $report->getId() === null;
$pageTitle = $isNew ? 'New report' : 'Edit report #' . $report->getId();
?>

<!-- Page header: breadcrumbs, title -->
<header class="page-header">
  <nav class="breadcrumbs" aria-label="Breadcrumbs">
    <ol class="breadcrumbs__list">
      <li><a href="#">My projects</a></li>
      <li><a href="<?= $link->url('home.index') ?>">Lantern Woods</a></li>
      <li><a href="<?= $link->url('report.index') ?>">Reports</a></li>
      <li aria-current="page"><?= e($pageTitle) ?></li>
    </ol>
  </nav>
  <div class="page-header__row">
    <div>
      <h1 class="page-header__title"><?= e($pageTitle) ?></h1>
      <p class="page-header__lead"><?= $isNew ? 'Describe the bug or feedback for a specific build of the game.' : 'Change the details or the status of the report.' ?></p>
    </div>
  </div>
</header>

<div class="project-layout">
  <!-- Project menu -->
  <?php $activeItem = 'Report'; require __DIR__ . '/../_Shared/projectMenu.php' ?>

  <div class="project-content">
    <form class="report-form card" method="post" action="<?= $link->url('report.save') ?>">
      <?php if (count($errors) > 0) : ?>
        <div class="form-errors" role="alert">
          <p class="form-errors__title">The report could not be saved:</p>
          <ul class="form-errors__list">
            <?php foreach ($errors as $error) : ?>
              <li><?= e($error) ?></li>
            <?php endforeach ?>
          </ul>
        </div>
      <?php endif ?>

      <!-- Empty for a new report, the report's id when editing -->
      <input type="hidden" name="id" value="<?= e($report->getId()) ?>">

      <div class="field">
        <label class="field__label" for="title">Title</label>
        <input class="input" type="text" id="title" name="title" value="<?= e($report->getTitle()) ?>"
               maxlength="200" required placeholder="e.g. Game crashes when loading a saved position">
      </div>

      <div class="report-form__grid">
        <div class="field">
          <label class="field__label" for="type">Type</label>
          <div class="select">
            <select id="type" name="type" required>
              <option value="" disabled <?= $report->getType() === null ? 'selected' : '' ?>>Choose type</option>
              <?php foreach (Report::TYPES as $code => $label) : ?>
                <option value="<?= e($code) ?>" <?= $report->getType() === $code ? 'selected' : '' ?>><?= e($label) ?></option>
              <?php endforeach ?>
            </select>
          </div>
        </div>

        <div class="field">
          <label class="field__label" for="severity">Severity</label>
          <div class="select">
            <select id="severity" name="severity" required>
              <option value="" disabled <?= $report->getSeverity() === null ? 'selected' : '' ?>>Choose severity</option>
              <?php foreach (Report::SEVERITIES as $code => $label) : ?>
                <option value="<?= e($code) ?>" <?= $report->getSeverity() === $code ? 'selected' : '' ?>><?= e($label) ?></option>
              <?php endforeach ?>
            </select>
          </div>
        </div>

        <div class="field">
          <label class="field__label" for="status">Status</label>
          <div class="select">
            <select id="status" name="status" required>
              <?php foreach (Report::STATUSES as $code => $label) : ?>
                <option value="<?= e($code) ?>" <?= $report->getStatus() === $code ? 'selected' : '' ?>><?= e($label) ?></option>
              <?php endforeach ?>
            </select>
          </div>
        </div>

        <div class="field">
          <label class="field__label" for="buildVersion">Build version</label>
          <input class="input" type="text" id="buildVersion" name="buildVersion" value="<?= e($report->getBuildVersion()) ?>"
                 maxlength="20" required placeholder="e.g. 0.4.1">
        </div>
      </div>

      <div class="field">
        <label class="field__label" for="description">Description</label>
        <textarea class="input" id="description" name="description" rows="8"
                  aria-describedby="description-hint"><?= e($report->getDescription()) ?></textarea>
        <p class="field__hint" id="description-hint">What happened, what you expected and the steps to reproduce it.</p>
      </div>

      <div class="report-form__actions">
        <button class="btn btn--primary" type="submit"><?= $isNew ? 'Create report' : 'Save changes' ?></button>
        <a class="btn" href="<?= $link->url('report.index') ?>">Cancel</a>
      </div>
    </form>
  </div>
</div>
