<?php

namespace App\Http\Controllers\Documents;

use App\Http\Controllers\Controller;
use App\Http\Services\Document\DocumentService;
use App\Http\Services\Report\ReportService;
use App\Models\Document;
use Illuminate\Contracts\View\View;

class DocumentController extends Controller
{
    private DocumentService $documentService;
    private ReportService $reportService;

    public function __construct(
        DocumentService $documentService,
        ReportService $reportService
    ) {
        $this->documentService = $documentService;
        $this->reportService = $reportService;
    }

    public function index(): View
    {
        $documents = $this->documentService->getLatestDocuments();
        $reports = $this->reportService->getLatestReports();

        return view('documents.index', [
            'documents' => $documents,
            'reports' => $reports,
        ]);
    }

    public function show(Document $document): View
    {
        $document->load([
            'partner',
            'image',
            'author',
            'report',
        ]);

        return view('documents.show', [
            'document' => $document,
        ]);
    }
}
