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

                            <a href="{{ route('accountant.create') }}" class="btn btn-success">
                                Create accountant report of all latest documents;
                            </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
