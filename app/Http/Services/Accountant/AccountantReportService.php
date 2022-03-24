<?php

namespace App\Http\Services\Accountant;

use App\Http\Services\Report\ReportService;
use App\Models\Report;
use Illuminate\Database\Eloquent\Collection;

class AccountantReportService
{
    private ReportService $reportService;
    private Collection $reportData;

    public function __construct(ReportService $reportService)
    {
       $this->reportService = $reportService;
    }

    public function generateReport(): Collection
    {
        $this->reportData = $this->reportService->getReportData();

        $this->calculateTotalsByReport();

        return $this->reportData;
    }

    public function calculateTotalsByReport(): Collection|\Illuminate\Support\Collection
    {
        return $this->reportData->each(static function (Report $report) {
            $totals = 0;

            foreach ($report->documents as $document) {
                $totals += $document->amount;
            }

            return $report->totals = $totals;
        });
    }
}
