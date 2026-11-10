<?php
/** @var \Framework\Support\LinkGenerator $link */
/** @var \App\Models\Build[] $builds */
?>

<header class="page-header">
  <nav class="breadcrumbs" aria-label="Breadcrumbs">
    <ol class="breadcrumbs__list">
      <li><a href="#">My projects</a></li>
      <li><a href="<?= $link->url('home.index') ?>">Lantern Woods</a></li>
      <li aria-current="page">Builds</li>
    </ol>
  </nav>
  <div class="page-header__row">
    <div>
      <h1 class="page-header__title">Builds</h1>
      <p class="page-header__lead">Test versions of the game. Every report belongs to one build.</p>
    </div>
    <div class="page-header__actions">
      <a class="btn btn--primary" href="<?= $link->url('build.add') ?>">New build</a>
    </div>
  </div>
</header>

<div class="project-layout">
  <?php $activeItem = 'Build'; require __DIR__ . '/../_Shared/projectMenu.php' ?>

  <div class="project-content">
    <div class="table-card">
      <table class="reports">
        <caption class="visually-hidden">Builds of the Lantern Woods project</caption>
        <thead>
          <tr>
            <th scope="col">Version</th>
            <th scope="col">Released</th>
            <th scope="col">Changelog</th>
            <th scope="col">Reports</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($builds as $build) : ?>
            <?php $reports = $build->getReports() ?>
            <tr>
              <td>
                <span class="reports__version"><?= e($build->getVersion()) ?></span>
                <span class="reports__platform"><?= e($build->getPlatformLabel()) ?></span>
              </td>
              <td><?= e(date('M j, Y', strtotime($build->getReleasedAt()))) ?></td>
              <td>
                <?= e($build->getChangelog()) ?>
                <?php if ($build->getDownloadUrl() !== '') : ?>
                  <br><a href="<?= e($build->getDownloadUrl()) ?>">Download</a>
                <?php endif ?>
              </td>
              <td>
                <!-- The link to the original entity: the report list filtered to this build -->
                <a href="<?= $link->url('report.index', ['build' => $build->getId()]) ?>">
                  <?= count($reports) ?> <?= count($reports) === 1 ? 'report' : 'reports' ?>
                </a>
              </td>
              <td>
                <div class="row-actions">
                <a class="btn btn--small" href="<?= $link->url('build.edit', ['id' => $build->getId()]) ?>">Edit</a>
                <?php if (count($reports) === 0) : ?>
                    <!-- A build with reports cannot be deleted, so the button is shown only for empty builds -->
                    <form method="post" action="<?= $link->url('build.delete') ?>" data-confirm="Delete build <?= e($build->getVersion()) ?>?">
                    <input type="hidden" name="id" value="<?= e($build->getId()) ?>">
                    <button class="btn btn--small btn--danger" type="submit">Delete</button>
                    </form>
                <?php endif ?>
                </div>
              </td>
            </tr>
          <?php endforeach ?>
          <?php if (count($builds) === 0) : ?>
            <tr>
              <td colspan="5">No builds yet.</td>
            </tr>
          <?php endif ?>
        </tbody>
      </table>
    </div>
  </div>
</div>