<?php

namespace App\Controllers;

use App\Models\Build;
use App\Models\Report;
use Framework\Core\BaseController;
use Framework\Http\HttpException;
use Framework\Http\Request;
use Framework\Http\Responses\Response;

/**
 * Class BuildController
 * CRUD for the builds (test versions) of the project.
 *
 * @package App\Controllers
 */
class BuildController extends BaseController
{
    /**
     * Displays the list of builds, newest first, with the number of reports of each build.
     */
    public function index(Request $request): Response
    {
        $builds = Build::getAll(orderBy: '`releasedAt` desc');
        return $this->html(['builds' => $builds]);
    }

        /**
     * Displays an empty form for a new build.
     */
    public function add(Request $request): Response
    {
        return $this->html(['build' => new Build(), 'errors' => []], 'form');
    }

    /**
     * Displays the form filled with an existing build.
     *
     * @throws HttpException 404 if the build does not exist.
     */
    public function edit(Request $request): Response
    {
        $build = $this->getBuildOr404((int)$request->value('id'));
        return $this->html(['build' => $build, 'errors' => []], 'form');
    }

    /**
     * Saves a new build (empty id) or changes an existing one, then redirects to the list.
     *
     * @throws HttpException 405 if the request is not POST, 404 if the edited build does not exist.
     */
    public function save(Request $request): Response
    {
        if (!$request->isPost()) {
            throw new HttpException(405);
        }

        $id = (int)$request->post('id');
        $build = $id > 0 ? $this->getBuildOr404($id) : new Build();

        $build->setFromRequest($request);
        $build->setVersion(trim((string)$build->getVersion()));
        $build->setChangelog(trim((string)$build->getChangelog()));
        $build->setDownloadUrl(trim((string)$build->getDownloadUrl()));

        $errors = $this->validate($build);
        if (count($errors) > 0) {
            return $this->html(['build' => $build, 'errors' => $errors], 'form');
        }

        $build->save();
        return $this->redirect($this->url('build.index'));
    }

        /**
     * Deletes a build that has no reports and redirects to the list.
     *
     * @throws HttpException 405 if not POST, 404 if the build does not exist, 409 if it still has reports.
     */
    public function delete(Request $request): Response
    {
        if (!$request->isPost()) {
            throw new HttpException(405);
        }

        $build = $this->getBuildOr404((int)$request->post('id'));

        // The FK (ON DELETE RESTRICT) would stop it anyway, but with an SQL error page; this message is readable
        $count = Report::getCount('`buildId` = ?', [$build->getId()]);
        if ($count > 0) {
            throw new HttpException(409, "Build {$build->getVersion()} still has $count report(s). Move them to another build or delete them first.");
        }

        $build->delete();
        return $this->redirect($this->url('build.index'));
    }

    /**
     * Loads a build by its id or stops with 404 Not Found.
     */
    private function getBuildOr404(int $id): Build
    {
        $build = Build::getOne($id);
        if ($build === null) {
            throw new HttpException(404);
        }
        return $build;
    }

    /**
     * @return string[] Error messages for the user, empty if everything is valid.
     */
    private function validate(Build $build): array
    {
        $errors = [];

        if ($build->getVersion() === '') {
            $errors[] = 'Version is required.';
        } elseif (mb_strlen($build->getVersion()) > 20) {
            $errors[] = 'Version can have at most 20 characters.';
        }

        if (!array_key_exists((string)$build->getPlatform(), Build::PLATFORMS)) {
            $errors[] = 'Choose a platform.';
        }

        // Optional field: empty is fine, otherwise it must be a full URL
        if ($build->getDownloadUrl() !== '' && filter_var($build->getDownloadUrl(), FILTER_VALIDATE_URL) === false) {
            $errors[] = 'Download link must be a full URL, e.g. https://…';
        }

        // <input type="date"> sends Y-m-d, the same format as the DATE column
        if (\DateTime::createFromFormat('Y-m-d', (string)$build->getReleasedAt()) === false) {
            $errors[] = 'Choose a release date.';
        }

        return $errors;
    }
}