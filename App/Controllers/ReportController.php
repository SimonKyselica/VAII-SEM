<?php

namespace App\Controllers;

use App\Models\Report;
use Framework\Core\BaseController;
use Framework\Http\HttpException;
use Framework\Http\Request;
use Framework\Http\Responses\Response;

/**
 * Class ReportController
 * Handles actions related to the reports of a project.
 *
 * @package App\Controllers
 */
class ReportController extends BaseController
{
    /**
     * Displays the list of reports with filters.
     *
     * @return Response The response object containing the rendered HTML for the reports page.
     */
    public function index(Request $request): Response
    {
        $reports = Report::getAll(orderBy: '`createdAt` desc');
        return $this->html(['reports' => $reports]);
    }

    /**
     * Displays an empty form for a new report.
     *
     * The form view is shared with the edit action, so it always gets a report and a (here empty) list of errors.
     *
     * @return Response The response object containing the rendered HTML for the report form.
     */
    public function add(Request $request): Response
    {
        return $this->html(['report' => new Report(), 'errors' => []], 'form');
    }

    /**
     * Displays the form filled with an existing report.
     *
     * @return Response The response object containing the rendered HTML for the report form.
     * @throws HttpException 404 if the report does not exist.
     */
    public function edit(Request $request): Response
    {
        $report = $this->getReportOr404((int)$request->value('id'));
        return $this->html(['report' => $report, 'errors' => []], 'form');
    }

    /**
     * Saves a new report (empty id) or changes an existing one, then redirects to the list.
     *
     * If the data are not valid, the form is shown again with the errors and the values the user entered.
     *
     * @return Response Redirect to the list, or the form with errors.
     * @throws HttpException 405 if the request is not POST, 404 if the edited report does not exist.
     */
    public function save(Request $request): Response
    {
        if (!$request->isPost()) {
            throw new HttpException(405);
        }

        // New report or an existing one? The hidden id field decides.
        $id = (int)$request->post('id');
        $report = $id > 0 ? $this->getReportOr404($id) : new Report();

        // Copies only the properties listed in Report::$fillable
        $report->setFromRequest($request);
        $report->setTitle(trim((string)$report->getTitle()));
        $report->setBuildVersion(trim((string)$report->getBuildVersion()));
        $report->setDescription(trim((string)$report->getDescription()));

        if ($report->getId() === null) {
            $report->setCreatedAt(date('Y-m-d H:i:s'));
        }

        $errors = $this->validate($report);
        if (count($errors) > 0) {
            return $this->html(['report' => $report, 'errors' => $errors], 'form');
        }

        $report->save();
        return $this->redirect($this->url('report.index'));
    }

    /**
     * Deletes a report and redirects to the list.
     *
     * @return Response Redirect to the list.
     * @throws HttpException 405 if the request is not POST, 404 if the report does not exist.
     */
    public function delete(Request $request): Response
    {
        if (!$request->isPost()) {
            throw new HttpException(405);
        }

        $report = $this->getReportOr404((int)$request->post('id'));
        $report->delete();
        return $this->redirect($this->url('report.index'));
    }

    /**
     * Loads a report by its id or stops with 404 Not Found. Private, so it cannot be called as an action.
     */
    private function getReportOr404(int $id): Report
    {
        $report = Report::getOne($id);
        if ($report === null) {
            throw new HttpException(404);
        }
        return $report;
    }

    /**
     * Checks the values from the form.
     *
     * @return string[] Error messages for the user, empty if everything is valid.
     */
    private function validate(Report $report): array
    {
        $errors = [];

        if ($report->getTitle() === '') {
            $errors[] = 'Title is required.';
        } elseif (mb_strlen($report->getTitle()) > 200) {
            $errors[] = 'Title can have at most 200 characters.';
        }

        if (!array_key_exists((string)$report->getType(), Report::TYPES)) {
            $errors[] = 'Choose a type.';
        }
        if (!array_key_exists((string)$report->getSeverity(), Report::SEVERITIES)) {
            $errors[] = 'Choose a severity.';
        }
        if (!array_key_exists((string)$report->getStatus(), Report::STATUSES)) {
            $errors[] = 'Choose a status.';
        }

        if ($report->getBuildVersion() === '') {
            $errors[] = 'Build version is required.';
        } elseif (mb_strlen($report->getBuildVersion()) > 20) {
            $errors[] = 'Build version can have at most 20 characters.';
        }

        return $errors;
    }
}