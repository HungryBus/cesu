<?php

namespace App\Http\Controllers\Accountant;

use App\Http\Controllers\Controller;
use App\Http\Services\Accountant\AccountantReportService;
use Illuminate\View\View;

class ReportController extends Controller
{
    private AccountantReportService $reportService;

    public function __construct(AccountantReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    public function create(): View
    {
        $reports = $this->reportService->generateReport();

        return view('accountant/report', [
            'reports' => $reports,
        ]);
    }
}
