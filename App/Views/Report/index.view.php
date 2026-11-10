<?php
/** @var \Framework\Support\LinkGenerator $link */
/** @var \App\Models\Report[] $reports */
/** @var \App\Models\Build[] $builds */
/** @var int $selectedBuildId */
?>

<!-- Page header: breadcrumbs, title, actions -->
<header class="page-header">
  <nav class="breadcrumbs" aria-label="Breadcrumbs">
    <ol class="breadcrumbs__list">
      <li><a href="#">My projects</a></li>
      <li><a href="<?= $link->url('home.index') ?>">Lantern Woods</a></li>
      <li aria-current="page">Reports</li>
    </ol>
  </nav>
  <div class="page-header__row">
    <div>
      <h1 class="page-header__title">Reports</h1>
      <p class="page-header__lead">Bugs and feedback from testers across all builds of the project</p>
    </div>
    <div class="page-header__actions">
      <a class="btn" href="#">Manage tags</a>
      <a class="btn btn--primary" href="<?= $link->url('report.add') ?>">New report</a>
    </div>
  </div>
</header>

<div class="project-layout">
  <!-- Project menu -->
  <?php $activeItem = 'Report'; require __DIR__ . '/../_Shared/projectMenu.php' ?>

  <div class="project-content">
    <!-- Filters -->
    <form class="report-filters" id="filters" action="<?= $link->url('report.index') ?>" method="get" role="search" aria-label="Filter reports">
      <!-- A GET form drops ?c=report from its action, so the controller is sent as a hidden field -->
      <input type="hidden" name="c" value="report">
      <fieldset class="status-tabs">
        <legend class="visually-hidden">Report status</legend>
        <label class="status-tab">
          <input type="radio" name="status" value="" checked>
          All
        </label>
        <label class="status-tab">
          <input type="radio" name="status" value="new">
          <span class="icon icon--new" aria-hidden="true"></span>
          New
        </label>
        <label class="status-tab">
          <input type="radio" name="status" value="confirmed">
          <span class="icon icon--confirmed" aria-hidden="true"></span>
          Confirmed
        </label>
        <label class="status-tab">
          <input type="radio" name="status" value="in_progress">
          <span class="icon icon--progress" aria-hidden="true"></span>
          In progress
        </label>
        <label class="status-tab">
          <input type="radio" name="status" value="fixed">
          <span class="icon icon--fixed" aria-hidden="true"></span>
          Fixed
        </label>
        <label class="status-tab">
          <input type="radio" name="status" value="rejected">
          <span class="icon icon--rejected" aria-hidden="true"></span>
          Rejected
        </label>
      </fieldset>

      <div class="filter-panel">
        <div class="filter-grid">
          <div class="field field--search">
            <label class="field__label" for="filter-q">Search in title</label>
            <div class="input-icon">
              <span class="icon icon--search" aria-hidden="true"></span>
              <input class="input" type="search" id="filter-q" name="q" placeholder="e.g. crash, ladder, sound…">
            </div>
          </div>
          <div class="field">
            <label class="field__label" for="filter-build">Build</label>
            <div class="select">
              <select id="filter-build" name="build">
                <option value="">All builds</option>
                <?php foreach ($builds as $build) : ?>
                  <option value="<?= e($build->getId()) ?>" <?= $selectedBuildId === $build->getId() ? 'selected' : '' ?>><?= e($build->getVersion()) ?></option>
                <?php endforeach ?>
              </select>
            </div>
          </div>
          <div class="field">
            <label class="field__label" for="filter-type">Type</label>
            <div class="select">
              <select id="filter-type" name="type">
                <option value="">All types</option>
                <option value="bug">Bug</option>
                <option value="crash">Crash</option>
                <option value="suggestion">Suggestion</option>
                <option value="other">Other</option>
              </select>
            </div>
          </div>
          <div class="field">
            <label class="field__label" for="filter-severity">Severity</label>
            <div class="select">
              <select id="filter-severity" name="severity">
                <option value="">All</option>
                <option value="critical">Critical</option>
                <option value="high">High</option>
                <option value="medium">Medium</option>
                <option value="low">Low</option>
              </select>
            </div>
          </div>
        </div>

        <div class="filter-tags">
          <span class="filter-tags__label" id="filter-tags-label">Tags</span>
          <div class="chips" role="group" aria-labelledby="filter-tags-label">
            <label class="chip"><input type="checkbox" name="tag" value="graphics">Graphics</label>
            <label class="chip"><input type="checkbox" name="tag" value="sound">Sound</label>
            <label class="chip"><input type="checkbox" name="tag" value="controls">Controls</label>
            <label class="chip"><input type="checkbox" name="tag" value="ui">UI</label>
            <label class="chip"><input type="checkbox" name="tag" value="performance">Performance</label>
            <label class="chip"><input type="checkbox" name="tag" value="saving">Saving</label>
          </div>
          <button class="filter-reset" type="reset">Clear filters</button>
        </div>

        <!-- filters will later be applied via AJAX; the button allows submitting with the Enter key -->
        <button class="visually-hidden" type="submit">Filter</button>
      </div>
    </form>

    <!-- Report list -->
    <section aria-labelledby="reports-title">
      <h2 class="visually-hidden" id="reports-title">Report list</h2>

      <div class="results-bar">
        <p class="results-bar__count">Showing <strong><?= count($reports) ?></strong> <?= count($reports) === 1 ? 'report' : 'reports' ?></p>
        <div class="sort">
          <label class="sort__label" for="sort">Sort by</label>
          <div class="select">
            <select id="sort" name="sort" form="filters">
              <option value="newest">Newest</option>
              <option value="oldest">Oldest</option>
              <option value="severity">Highest severity</option>
              <option value="confirmations">Most confirmations</option>
            </select>
          </div>
        </div>
      </div>

      <div class="table-card">
        <table class="reports">
          <caption class="visually-hidden">Reports of the Lantern Woods project</caption>
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Report</th>
              <th scope="col">Type</th>
              <th scope="col">Severity</th>
              <th scope="col">Build</th>
              <th scope="col"><abbr title="Number of confirmations">+1</abbr></th>
              <th scope="col">Status</th>
              <th scope="col">Priority</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($reports as $report) : ?>
              <tr>
                <td class="reports__id">#<?= e($report->getId()) ?></td>
                <td class="reports__title">
                  <a class="report-link" href="<?= $link->url('report.edit', ['id' => $report->getId()]) ?>"><?= e($report->getTitle()) ?></a>
                  <div class="report-meta">
                    <!-- Tags and author come later with their own entities (Tag, User) -->
                    <span><time datetime="<?= e(date('Y-m-d\TH:i', strtotime($report->getCreatedAt()))) ?>"><?= e(date('M j, Y', strtotime($report->getCreatedAt()))) ?></time></span>
                    <span class="meta-count"><span class="icon icon--comment" aria-hidden="true"></span><span class="visually-hidden">Comments:</span>0</span>
                    <span class="meta-count"><span class="icon icon--clip" aria-hidden="true"></span><span class="visually-hidden">Attachments:</span>0</span>
                  </div>
                </td>
                <td class="reports__type"><?= e($report->getTypeLabel()) ?></td>
                <td class="reports__severity"><span class="severity severity--<?= e($report->getSeverity()) ?>"><?= e($report->getSeverityLabel()) ?></span></td>
                <?php $build = $report->getBuild() ?>
                <td class="reports__build" data-label="Build">
                  <span class="reports__version"><?= e($build?->getVersion()) ?></span>
                  <span class="reports__platform"><?= e($build?->getPlatformLabel()) ?></span>
                </td>
                <!-- Confirmations (+1) and priority are not in the Report entity yet -->
                <td class="reports__votes is-zero" data-label="Confirmations">0</td>
                <td class="reports__status" data-label="Status"><?= e($report->getStatusLabel()) ?></td>
                <td class="reports__priority" data-label="Priority">—</td>
                <td class="reports__actions" data-label="Actions">
                  <div class="row-actions">
                    <a class="btn btn--small" href="<?= $link->url('report.edit', ['id' => $report->getId()]) ?>">Edit</a>
                    <!-- Deleting changes data, so it is a small POST form, not a link -->
                    <form method="post" action="<?= $link->url('report.delete') ?>" data-confirm="Delete report #<?= e($report->getId()) ?>?">
                      <input type="hidden" name="id" value="<?= e($report->getId()) ?>">
                      <button class="btn btn--small btn--danger" type="submit">Delete</button>
                    </form>
                  </div>
                </td>
              </tr>
            <?php endforeach ?>
            <?php if (count($reports) === 0) : ?>
              <tr>
                <td colspan="9">No reports yet.</td>
              </tr>
            <?php endif ?>
          </tbody>
        </table>
      </div>
    </section>
  </div>
</div>
