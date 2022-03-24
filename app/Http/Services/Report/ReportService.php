<?php

namespace App\Http\Services\Report;

use App\Models\Report;
use Illuminate\Database\Eloquent\Collection;

class ReportService
{
    public function getLatestReports(): Collection
    {
        return Report::orderBy('created_at', 'asc')
            ->withCount([
                'documents'
            ])
            ->take(10)
            ->get();
    }

    public function getReportData(): Collection
    {
        return Report::where('is_approved', 1)
            ->select([
                'id',
                'is_approved',
                'approved_by',
                'created_at'
            ])
            ->with('documents')
            ->get();
    }
}
