<?php

namespace App\Http\Services\Document;

use App\Models\Document;
use Illuminate\Database\Eloquent\Collection;

class DocumentService
{
    public function getLatestDocuments(): Collection
    {
        return Document::orderBy('created_at', 'asc')
            ->with([
                'partner'
            ])
            ->take(10)
            ->get();
    }

    public function assignDocument(array $payload): Document
    {
        $document = new Document();
        $document->document_identifier = $payload['document_identifier'];
        $document->document_date = $payload['document_date'];
        $document->partner_id = $payload['partner_id'];
        $document->created_by = auth()->id();
        $document->amount = $payload['amount'];
        $document->comments = $payload['comments'];

        return $document;
    }
}
