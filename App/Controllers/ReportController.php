<?php

namespace App\Controllers;

use Framework\Core\BaseController;
use Framework\Http\Request;
use Framework\Http\Responses\Response;

/**
 * Class ReportController
 * Handles actions related to the reports (hlásenia) of a project.
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
        return $this->html();
    }
}