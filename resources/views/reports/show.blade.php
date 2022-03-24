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
                            <tbody>
                            <tr>
                                <th>Approved by</th>
                                <td>{{ $report->approvalUser?->name }}</td>
                            </tr>
                            <tr>
                                <th>Approval comments</th>
                                <td>{{ $report->approval_comments }}</td>
                            </tr>
                            <tr>
                                <th>Report created</th>
                                <td>{{ $report->created_at?->format('d.m.Y, H:i') }}</td>
                            </tr>
                            </tbody>
                        </table>
                        <h4>Report Documents:</h4>
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Document ID</th>
                                <th>Documented date</th>
                                <th>Partner</th>
                                <th>Amount</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($report->documents as $document)
                                <tr>
                                    <td>{{ $document->document_identifier }}</td>
                                    <td>{{ $document->document_date?->format('d.m.Y') }}</td>
                                    <td>{{ $document->partner->name }}</td>
                                    <td>{{ number_format($document->amount) }} &euro;</td>
                                    <td>
                                        <a href="{{ route('documents.show', $document->id) }}"
                                           class="btn btn-primary btn-sm">
                                            View document
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        @if(!$report->is_approved)
                            <a href="{{ route('reports.approve', $report->id) }}" class="btn btn-warning" id="approveConfirm">
                                Approve Report
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('#approveConfirm').on('click', (e) => {
            e.stopPropagation();

            if (confirm('Are you sure you want to approve this report?')) {
                window.location.href = $(this).attr('href');
            }
        })
    </script>
@endsection
