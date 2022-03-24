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
                            /** @var App\Models\Document $document */
                        @endphp
                        <table class="table">
                            <tbody>
                            <tr>
                                <th>Document ID</th>
                                <td>{{ $document->id }}</td>
                            </tr>
                            <tr>
                                <th>Documented Date</th>
                                <td>{{ $document->document_date?->format('d.m.Y') }}</td>
                            </tr>
                            <tr>
                                <th>Partner</th>
                                <td>{{ $document->partner->name }}</td>
                            </tr>
                            <tr>
                                <th>Author</th>
                                <td>{{ $document->author->name }}</td>
                            </tr>
                            <tr>
                                <th>Amount</th>
                                <td>{{ number_format($document->amount, 2) }} &euro;</td>
                            </tr>
                            <tr>
                                <th>Comments</th>
                                <td>{{ $document->comments }}</td>
                            </tr>
                            <tr>
                                <th>Uploaded</th>
                                <td>{{ $document->created_at->format('d.m.Y, H:i') }}</td>
                            </tr>
                            <tr>
                                <th>Report</th>
                                <td>
                                    <a href="{{ route('reports.show', $document->report->first()->id) }}" target="_blank">
                                        View report
                                    </a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <a href="{{ asset($document->image->first()->filename) }}" class="btn btn-sm btn-primary" target="_blank">
                            View image
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
