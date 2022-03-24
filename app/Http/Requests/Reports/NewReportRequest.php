<?php

namespace App\Http\Requests\Reports;

use Illuminate\Foundation\Http\FormRequest;

class NewReportRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            '*.document_identifier' => ['required', 'unique:documents,document_identifier'],
            '*.document_date' => ['required', 'date'],
            '*.amount' => ['required', 'numeric'],
            '*.comments' => ['nullable'],
            '*.file' => ['required', 'image', 'max:10000'],
        ];
    }
}
