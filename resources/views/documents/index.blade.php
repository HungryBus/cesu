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
                            <a href="{{ route('reports.create') }}" class="btn btn-primary">
                                Create Report
                            </a>

                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Document ID</th>
                                <th>Documented date</th>
                                <th>Partner</th>
                                <th>Amount</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($documents as $i => $document)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $document->document_identifier }}</td>
                                    <td>{{ $document->document_date?->format('d.m.Y') }}</td>
                                    <td>{{ $document->partner->name ?? 'N/A' }}</td>
                                    <td>{{ number_format($document->amount, 2) }} &euro;</td>
                                    <td>
                                        <a href="{{ route('documents.show', $document->id) }}" class="btn btn-primary btn-sm">View</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">
                                        <i>
                                            There are no documents created yet.
                                            <a href="{{ route('reports.create') }}">Add new?</a>
                                        </i>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
