@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('message'))
                            <div class="alert alert-{{ session('alert-class') }}" role="alert">
                                {!! session('message') !!}
                            </div>
                        @endif
                        @php
                            /** @var App\Models\Report $report */
                        @endphp

                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Report ID</th>
                                <th>Approval status</th>
                                <th>Documents</th>
                                <th>Totals</th>
                                <th>Creation date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($reports as $i => $report)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $report->id }}</td>
                                    <td>{{ $report->approvalUser?->name }}</td>
                                    <td>
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>Document ID</th>
                                                <th>Amount</th>
                                                <th>Document Date</th>
                                                <th>Document description</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($report->documents as $document)
                                                <tr>
                                                    <td>
                                                        <a href="{{ route('documents.show', $document->id) }}"
                                                           target="_blank">
                                                            {{ $document->document_identifier }}
                                                        </a>
                                                    </td>
                                                    <td>{{ number_format($document->amount, 2) }} &euro;</td>
                                                    <td>{{ $document->document_date?->format('d.m.Y') }}</td>
                                                    <td>
                                                        {{ $document->comments }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </td>
                                    <td>{{ number_format($report->totals, 2) }} &euro;</td>
                                    <td>{{ $report->created_at?->format('d.m.Y') }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
