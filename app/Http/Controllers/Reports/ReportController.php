<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Http\Services\Document\DocumentService;
use App\Http\Services\Image\ImageService;
use App\Models\Partner;
use App\Models\Report;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReportController extends Controller
{
    private DocumentService $documentService;
    private ImageService $imageService;

    public function __construct(
        DocumentService $documentService,
        ImageService $imageService
    ) {
        $this->documentService = $documentService;
        $this->imageService = $imageService;
    }

    public function create(): View
    {
        $partners = Partner::all();

        return view('reports.create', [
            'partners' => $partners,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $formData = $request->dynamic_form['dynamic_form'];
        $file = $request->file()['dynamic_form']['dynamic_form'];

        $report = new Report();
        $report->save();

        foreach($formData as $i => $entry) {
            $document = $this->documentService->assignDocument($entry);

            if (!$document->save()) {
                return redirect()->back()->withInput();
            }

            $report->documents()->attach($document->id);

            $this->imageService->upload($file[$i]['file'], $document);
        }

        flashSession('Report created successfully!');

        return redirect()->route('documents.index');
    }

    public function update(Report $report): RedirectResponse
    {
        $report->is_approved = 1;
        $report->approved_by = auth()->id();

        if ($report->save()) {
            flashSession('Unable to approve report!', 'danger');
        }

        flashSession('Report approved!');

        return redirect()->back();
    }

    public function show(Report $report): View
    {
        $report->load([
            'approvalUser',
            'documents',
        ]);

        return view('reports.show', [
            'report' => $report,
        ]);
    }
}
