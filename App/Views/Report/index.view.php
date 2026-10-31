<?php /** @var \Framework\Support\LinkGenerator $link */ ?>

<!-- Hlavička stránky: omrvinky, nadpis, akcie -->
<header class="page-header">
  <nav class="breadcrumbs" aria-label="Omrvinky">
    <ol class="breadcrumbs__list">
      <li><a href="#">Moje projekty</a></li>
      <li><a href="<?= $link->url('home.index') ?>">Lantern Woods</a></li>
      <li aria-current="page">Hlásenia</li>
    </ol>
  </nav>
  <div class="page-header__row">
    <div>
      <h1 class="page-header__title">Hlásenia</h1>
      <p class="page-header__lead">Chyby a spätná väzba testerov ku všetkým buildom projektu</p>
    </div>
    <div class="page-header__actions">
      <a class="btn" href="#">Spravovať tagy</a>
    </div>
  </div>
</header>

<div class="project-layout">
  <!-- Menu projektu -->
  <?php $activeItem = 'Report'; require __DIR__ . '/../_Shared/projectMenu.php' ?>

  <div class="project-content">
    <!-- Filtre -->
    <form class="report-filters" id="filters" action="<?= $link->url('report.index') ?>" method="get" role="search" aria-label="Filtrovanie hlásení">
      <!-- GET formulár zahodí ?c=report z action, preto kontrolér posielame ako skryté pole -->
      <input type="hidden" name="c" value="report">
      <fieldset class="status-tabs">
        <legend class="visually-hidden">Stav hlásenia</legend>
        <label class="status-tab">
          <input type="radio" name="stav" value="" checked>
          Všetky <span class="status-tab__count">42</span>
        </label>
        <label class="status-tab">
          <input type="radio" name="stav" value="nove">
          <span class="icon icon--new" aria-hidden="true"></span>
          Nové <span class="status-tab__count">12</span>
        </label>
        <label class="status-tab">
          <input type="radio" name="stav" value="potvrdene">
          <span class="icon icon--confirmed" aria-hidden="true"></span>
          Potvrdené <span class="status-tab__count">5</span>
        </label>
        <label class="status-tab">
          <input type="radio" name="stav" value="riesi-sa">
          <span class="icon icon--progress" aria-hidden="true"></span>
          Rieši sa <span class="status-tab__count">4</span>
        </label>
        <label class="status-tab">
          <input type="radio" name="stav" value="opravene">
          <span class="icon icon--fixed" aria-hidden="true"></span>
          Opravené <span class="status-tab__count">18</span>
        </label>
        <label class="status-tab">
          <input type="radio" name="stav" value="zamietnute">
          <span class="icon icon--rejected" aria-hidden="true"></span>
          Zamietnuté <span class="status-tab__count">3</span>
        </label>
      </fieldset>

      <div class="filter-panel">
        <div class="filter-grid">
          <div class="field field--search">
            <label class="field__label" for="filter-q">Hľadať v názve</label>
            <div class="input-icon">
              <span class="icon icon--search" aria-hidden="true"></span>
              <input class="input" type="search" id="filter-q" name="q" placeholder="napr. pád, rebrík, zvuk…">
            </div>
          </div>
          <div class="field">
            <label class="field__label" for="filter-build">Build</label>
            <div class="select">
              <select id="filter-build" name="build">
                <option value="">Všetky buildy</option>
                <option value="0.4.1">0.4.1</option>
                <option value="0.4.0">0.4.0</option>
                <option value="0.3.2">0.3.2</option>
                <option value="0.3.1">0.3.1</option>
              </select>
            </div>
          </div>
          <div class="field">
            <label class="field__label" for="filter-type">Typ</label>
            <div class="select">
              <select id="filter-type" name="typ">
                <option value="">Všetky typy</option>
                <option value="chyba">Chyba</option>
                <option value="pad">Pád</option>
                <option value="navrh">Návrh</option>
                <option value="ine">Iné</option>
              </select>
            </div>
          </div>
          <div class="field">
            <label class="field__label" for="filter-severity">Závažnosť</label>
            <div class="select">
              <select id="filter-severity" name="zavaznost">
                <option value="">Všetky</option>
                <option value="kriticka">Kritická</option>
                <option value="vysoka">Vysoká</option>
                <option value="stredna">Stredná</option>
                <option value="nizka">Nízka</option>
              </select>
            </div>
          </div>
        </div>

        <div class="filter-tags">
          <span class="filter-tags__label" id="filter-tags-label">Tagy</span>
          <div class="chips" role="group" aria-labelledby="filter-tags-label">
            <label class="chip"><input type="checkbox" name="tag" value="grafika">Grafika</label>
            <label class="chip"><input type="checkbox" name="tag" value="zvuk">Zvuk</label>
            <label class="chip"><input type="checkbox" name="tag" value="ovladanie">Ovládanie</label>
            <label class="chip"><input type="checkbox" name="tag" value="ui">UI</label>
            <label class="chip"><input type="checkbox" name="tag" value="vykon">Výkon</label>
            <label class="chip"><input type="checkbox" name="tag" value="ukladanie">Ukladanie</label>
          </div>
          <button class="filter-reset" type="reset">Zrušiť filtre</button>
        </div>

        <!-- filtre sa neskôr budú aplikovať cez AJAX; tlačidlo umožní odoslanie klávesou Enter -->
        <button class="visually-hidden" type="submit">Filtrovať</button>
      </div>
    </form>

    <!-- Zoznam hlásení -->
    <section aria-labelledby="reports-title">
      <h2 class="visually-hidden" id="reports-title">Zoznam hlásení</h2>

      <div class="results-bar">
        <p class="results-bar__count">Zobrazené <strong>1–8</strong> z 42 hlásení</p>
        <div class="sort">
          <label class="sort__label" for="sort">Zoradiť podľa</label>
          <div class="select">
            <select id="sort" name="zoradit" form="filters">
              <option value="najnovsie">Najnovšie</option>
              <option value="najstarsie">Najstaršie</option>
              <option value="zavaznost">Najvyššia závažnosť</option>
              <option value="potvrdenia">Najviac potvrdení</option>
            </select>
          </div>
        </div>
      </div>

      <div class="table-card">
        <table class="reports">
          <caption class="visually-hidden">Hlásenia projektu Lantern Woods, strana 1 z 6</caption>
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Hlásenie</th>
              <th scope="col">Typ</th>
              <th scope="col">Závažnosť</th>
              <th scope="col">Build</th>
              <th scope="col"><abbr title="Počet potvrdení">+1</abbr></th>
              <th scope="col">Stav</th>
              <th scope="col">Priorita</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="reports__id">#142</td>
              <td class="reports__title">
                <a class="report-link" href="#">Hra spadne pri načítaní uloženej pozície</a>
                <div class="report-meta">
                  <ul class="tags" aria-label="Tagy">
                    <li class="tag">Ukladanie</li>
                  </ul>
                  <span>marek_t · <time datetime="2026-10-20T16:10">pred 2 h</time></span>
                  <span class="meta-count"><span class="icon icon--comment" aria-hidden="true"></span><span class="visually-hidden">Komentáre:</span>2</span>
                  <span class="meta-count"><span class="icon icon--clip" aria-hidden="true"></span><span class="visually-hidden">Prílohy:</span>1</span>
                </div>
              </td>
              <td class="reports__type">Pád</td>
              <td class="reports__severity"><span class="severity severity--critical">Kritická</span></td>
              <td class="reports__build" data-label="Build"><span class="reports__version">0.4.1</span> <span class="reports__platform">Windows</span></td>
              <td class="reports__votes" data-label="Potvrdenia">+5</td>
              <td class="reports__status" data-label="Stav">
                <div class="select select--compact select--status">
                  <select aria-label="Stav hlásenia #142">
                    <option value="nove" selected>Nové</option>
                    <option value="potvrdene">Potvrdené</option>
                    <option value="riesi-sa">Rieši sa</option>
                    <option value="opravene">Opravené</option>
                    <option value="zamietnute">Zamietnuté</option>
                  </select>
                </div>
              </td>
              <td class="reports__priority" data-label="Priorita">
                <div class="select select--compact select--priority">
                  <select aria-label="Priorita hlásenia #142">
                    <option value="" selected>Nastaviť</option>
                    <option value="nizka">Nízka</option>
                    <option value="stredna">Stredná</option>
                    <option value="vysoka">Vysoká</option>
                  </select>
                </div>
              </td>
            </tr>

            <tr>
              <td class="reports__id">#141</td>
              <td class="reports__title">
                <a class="report-link" href="#">Postava sa zasekne o rebrík v 2. kapitole</a>
                <div class="report-meta">
                  <ul class="tags" aria-label="Tagy">
                    <li class="tag">Ovládanie</li>
                  </ul>
                  <span>lucia.h · <time datetime="2026-10-20T13:05">pred 5 h</time></span>
                  <span class="meta-count"><span class="icon icon--comment" aria-hidden="true"></span><span class="visually-hidden">Komentáre:</span>4</span>
                  <span class="meta-count"><span class="icon icon--clip" aria-hidden="true"></span><span class="visually-hidden">Prílohy:</span>2</span>
                </div>
              </td>
              <td class="reports__type">Chyba</td>
              <td class="reports__severity"><span class="severity severity--high">Vysoká</span></td>
              <td class="reports__build" data-label="Build"><span class="reports__version">0.4.1</span> <span class="reports__platform">Windows</span></td>
              <td class="reports__votes" data-label="Potvrdenia">+3</td>
              <td class="reports__status" data-label="Stav">
                <div class="select select--compact select--status">
                  <select aria-label="Stav hlásenia #141">
                    <option value="nove" selected>Nové</option>
                    <option value="potvrdene">Potvrdené</option>
                    <option value="riesi-sa">Rieši sa</option>
                    <option value="opravene">Opravené</option>
                    <option value="zamietnute">Zamietnuté</option>
                  </select>
                </div>
              </td>
              <td class="reports__priority" data-label="Priorita">
                <div class="select select--compact select--priority">
                  <select aria-label="Priorita hlásenia #141">
                    <option value="">Nastaviť</option>
                    <option value="nizka">Nízka</option>
                    <option value="stredna">Stredná</option>
                    <option value="vysoka" selected>Vysoká</option>
                  </select>
                </div>
              </td>
            </tr>

            <tr>
              <td class="reports__id">#139</td>
              <td class="reports__title">
                <a class="report-link" href="#">Hudba v menu hrá dvakrát cez seba</a>
                <div class="report-meta">
                  <ul class="tags" aria-label="Tagy">
                    <li class="tag">Zvuk</li>
                  </ul>
                  <span>kubo · <time datetime="2026-10-19">včera</time></span>
                </div>
              </td>
              <td class="reports__type">Chyba</td>
              <td class="reports__severity"><span class="severity severity--medium">Stredná</span></td>
              <td class="reports__build" data-label="Build"><span class="reports__version">0.4.1</span> <span class="reports__platform">macOS</span></td>
              <td class="reports__votes" data-label="Potvrdenia">+1</td>
              <td class="reports__status" data-label="Stav">
                <div class="select select--compact select--status">
                  <select aria-label="Stav hlásenia #139">
                    <option value="nove">Nové</option>
                    <option value="potvrdene" selected>Potvrdené</option>
                    <option value="riesi-sa">Rieši sa</option>
                    <option value="opravene">Opravené</option>
                    <option value="zamietnute">Zamietnuté</option>
                  </select>
                </div>
              </td>
              <td class="reports__priority" data-label="Priorita">
                <div class="select select--compact select--priority">
                  <select aria-label="Priorita hlásenia #139">
                    <option value="" selected>Nastaviť</option>
                    <option value="nizka">Nízka</option>
                    <option value="stredna">Stredná</option>
                    <option value="vysoka">Vysoká</option>
                  </select>
                </div>
              </td>
            </tr>

            <tr>
              <td class="reports__id">#137</td>
              <td class="reports__title">
                <a class="report-link" href="#">Pridať možnosť zmeniť klávesy ovládania</a>
                <div class="report-meta">
                  <ul class="tags" aria-label="Tagy">
                    <li class="tag">Ovládanie</li>
                    <li class="tag">UI</li>
                  </ul>
                  <span>petra_v · <time datetime="2026-10-19">včera</time></span>
                  <span class="meta-count"><span class="icon icon--comment" aria-hidden="true"></span><span class="visually-hidden">Komentáre:</span>6</span>
                </div>
              </td>
              <td class="reports__type">Návrh</td>
              <td class="reports__severity"><span class="severity severity--low">Nízka</span></td>
              <td class="reports__build" data-label="Build"><span class="reports__version">0.4.0</span> <span class="reports__platform">Windows</span></td>
              <td class="reports__votes" data-label="Potvrdenia">+8</td>
              <td class="reports__status" data-label="Stav">
                <div class="select select--compact select--status">
                  <select aria-label="Stav hlásenia #137">
                    <option value="nove">Nové</option>
                    <option value="potvrdene" selected>Potvrdené</option>
                    <option value="riesi-sa">Rieši sa</option>
                    <option value="opravene">Opravené</option>
                    <option value="zamietnute">Zamietnuté</option>
                  </select>
                </div>
              </td>
              <td class="reports__priority" data-label="Priorita">
                <div class="select select--compact select--priority">
                  <select aria-label="Priorita hlásenia #137">
                    <option value="">Nastaviť</option>
                    <option value="nizka">Nízka</option>
                    <option value="stredna" selected>Stredná</option>
                    <option value="vysoka">Vysoká</option>
                  </select>
                </div>
              </td>
            </tr>

            <tr>
              <td class="reports__id">#135</td>
              <td class="reports__title">
                <a class="report-link" href="#">FPS klesá pod 30 v lese počas dažďa</a>
                <div class="report-meta">
                  <ul class="tags" aria-label="Tagy">
                    <li class="tag">Výkon</li>
                    <li class="tag">Grafika</li>
                  </ul>
                  <span>marek_t · <time datetime="2026-10-14">14. 10.</time></span>
                  <span class="meta-count"><span class="icon icon--comment" aria-hidden="true"></span><span class="visually-hidden">Komentáre:</span>3</span>
                  <span class="meta-count"><span class="icon icon--clip" aria-hidden="true"></span><span class="visually-hidden">Prílohy:</span>3</span>
                </div>
              </td>
              <td class="reports__type">Chyba</td>
              <td class="reports__severity"><span class="severity severity--high">Vysoká</span></td>
              <td class="reports__build" data-label="Build"><span class="reports__version">0.4.0</span> <span class="reports__platform">Windows</span></td>
              <td class="reports__votes" data-label="Potvrdenia">+2</td>
              <td class="reports__status" data-label="Stav">
                <div class="select select--compact select--status">
                  <select aria-label="Stav hlásenia #135">
                    <option value="nove">Nové</option>
                    <option value="potvrdene">Potvrdené</option>
                    <option value="riesi-sa" selected>Rieši sa</option>
                    <option value="opravene">Opravené</option>
                    <option value="zamietnute">Zamietnuté</option>
                  </select>
                </div>
              </td>
              <td class="reports__priority" data-label="Priorita">
                <div class="select select--compact select--priority">
                  <select aria-label="Priorita hlásenia #135">
                    <option value="">Nastaviť</option>
                    <option value="nizka">Nízka</option>
                    <option value="stredna">Stredná</option>
                    <option value="vysoka" selected>Vysoká</option>
                  </select>
                </div>
              </td>
            </tr>

            <tr>
              <td class="reports__id">#131</td>
              <td class="reports__title">
                <a class="report-link" href="#">Text v dialógu presahuje okno</a>
                <div class="report-meta">
                  <ul class="tags" aria-label="Tagy">
                    <li class="tag">UI</li>
                  </ul>
                  <span>lucia.h · <time datetime="2026-10-12">12. 10.</time></span>
                  <span class="meta-count"><span class="icon icon--comment" aria-hidden="true"></span><span class="visually-hidden">Komentáre:</span>1</span>
                  <span class="meta-count"><span class="icon icon--clip" aria-hidden="true"></span><span class="visually-hidden">Prílohy:</span>1</span>
                </div>
              </td>
              <td class="reports__type">Chyba</td>
              <td class="reports__severity"><span class="severity severity--low">Nízka</span></td>
              <td class="reports__build" data-label="Build"><span class="reports__version">0.4.0</span> <span class="reports__platform">macOS</span></td>
              <td class="reports__votes is-zero" data-label="Potvrdenia">0</td>
              <td class="reports__status" data-label="Stav">
                <div class="select select--compact select--status">
                  <select aria-label="Stav hlásenia #131">
                    <option value="nove">Nové</option>
                    <option value="potvrdene">Potvrdené</option>
                    <option value="riesi-sa">Rieši sa</option>
                    <option value="opravene" selected>Opravené</option>
                    <option value="zamietnute">Zamietnuté</option>
                  </select>
                </div>
              </td>
              <td class="reports__priority" data-label="Priorita">
                <div class="select select--compact select--priority">
                  <select aria-label="Priorita hlásenia #131">
                    <option value="">Nastaviť</option>
                    <option value="nizka" selected>Nízka</option>
                    <option value="stredna">Stredná</option>
                    <option value="vysoka">Vysoká</option>
                  </select>
                </div>
              </td>
            </tr>

            <tr>
              <td class="reports__id">#128</td>
              <td class="reports__title">
                <a class="report-link" href="#">Tutoriál je príliš dlhý</a>
                <div class="report-meta">
                  <span>tomas_b · <time datetime="2026-10-09">9. 10.</time></span>
                  <span class="meta-count"><span class="icon icon--comment" aria-hidden="true"></span><span class="visually-hidden">Komentáre:</span>5</span>
                </div>
              </td>
              <td class="reports__type">Iné</td>
              <td class="reports__severity"><span class="severity severity--low">Nízka</span></td>
              <td class="reports__build" data-label="Build"><span class="reports__version">0.3.2</span> <span class="reports__platform">Windows</span></td>
              <td class="reports__votes" data-label="Potvrdenia">+4</td>
              <td class="reports__status" data-label="Stav">
                <div class="select select--compact select--status">
                  <select aria-label="Stav hlásenia #128">
                    <option value="nove">Nové</option>
                    <option value="potvrdene">Potvrdené</option>
                    <option value="riesi-sa">Rieši sa</option>
                    <option value="opravene">Opravené</option>
                    <option value="zamietnute" selected>Zamietnuté</option>
                  </select>
                </div>
              </td>
              <td class="reports__priority" data-label="Priorita">
                <div class="select select--compact select--priority">
                  <select aria-label="Priorita hlásenia #128">
                    <option value="" selected>Nastaviť</option>
                    <option value="nizka">Nízka</option>
                    <option value="stredna">Stredná</option>
                    <option value="vysoka">Vysoká</option>
                  </select>
                </div>
              </td>
            </tr>

            <tr>
              <td class="reports__id">#126</td>
              <td class="reports__title">
                <a class="report-link" href="#">Tiene postáv blikajú na grafikách Intel</a>
                <div class="report-meta">
                  <ul class="tags" aria-label="Tagy">
                    <li class="tag">Grafika</li>
                  </ul>
                  <span>kubo · <time datetime="2026-10-08">8. 10.</time></span>
                  <span class="meta-count"><span class="icon icon--comment" aria-hidden="true"></span><span class="visually-hidden">Komentáre:</span>2</span>
                  <span class="meta-count"><span class="icon icon--clip" aria-hidden="true"></span><span class="visually-hidden">Prílohy:</span>2</span>
                </div>
              </td>
              <td class="reports__type">Chyba</td>
              <td class="reports__severity"><span class="severity severity--medium">Stredná</span></td>
              <td class="reports__build" data-label="Build"><span class="reports__version">0.3.2</span> <span class="reports__platform">Windows</span></td>
              <td class="reports__votes" data-label="Potvrdenia">+1</td>
              <td class="reports__status" data-label="Stav">
                <div class="select select--compact select--status">
                  <select aria-label="Stav hlásenia #126">
                    <option value="nove">Nové</option>
                    <option value="potvrdene">Potvrdené</option>
                    <option value="riesi-sa">Rieši sa</option>
                    <option value="opravene" selected>Opravené</option>
                    <option value="zamietnute">Zamietnuté</option>
                  </select>
                </div>
              </td>
              <td class="reports__priority" data-label="Priorita">
                <div class="select select--compact select--priority">
                  <select aria-label="Priorita hlásenia #126">
                    <option value="">Nastaviť</option>
                    <option value="nizka">Nízka</option>
                    <option value="stredna" selected>Stredná</option>
                    <option value="vysoka">Vysoká</option>
                  </select>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Stránkovanie -->
      <nav class="pagination" aria-label="Stránkovanie hlásení">
        <p class="pagination__info">Strana 1 z 6</p>
        <ul class="pagination__list">
          <li>
            <span class="page-btn page-btn--disabled" aria-disabled="true">
              <span aria-hidden="true">‹</span><span class="page-btn__text">Predchádzajúca</span>
            </span>
          </li>
          <li><a class="page-btn" href="<?= $link->url('report.index') ?>" aria-current="page">1</a></li>
          <li><a class="page-btn" href="#">2</a></li>
          <li><a class="page-btn" href="#">3</a></li>
          <li><span class="pagination__ellipsis" aria-hidden="true">…</span></li>
          <li><a class="page-btn" href="#">6</a></li>
          <li>
            <a class="page-btn" href="#" rel="next">
              <span class="page-btn__text">Ďalšia</span><span aria-hidden="true">›</span>
            </a>
          </li>
        </ul>
      </nav>
    </section>
  </div>
</div>
