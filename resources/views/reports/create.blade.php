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

                        <form action="{{ route('reports.store') }}" method="post" id="dynamic_form" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-1">
                                    <label for="document_identifier">Document ID</label>
                                    <input type="text"
                                           name="document_identifier"
                                           id="document_identifier"
                                           placeholder="Document number"
                                           class="form-control">
                                </div>
                                <div class="col-md-2">
                                    <label for="document_date">Document Date</label>
                                    <input type="date"
                                           class="form-control"
                                           name="document_date"
                                           id="document_date"
                                           placeholder="Enter Document Date">
                                </div>
                                <div class="col-md-1">
                                    <label for="partner_id">Select company</label>
                                    <select name="partner_id" id="partner_id" class="form-control">
                                        <option selected disabled>Please, select</option>
                                        @foreach($partners as $partner)
                                            <option @selected(old($partner->id)) value="{{ $partner->id }}">{{ $partner->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label for="amount">Amount (VAT incl.)</label>
                                    <input type="number"
                                           step=".01"
                                           class="form-control"
                                           name="amount"
                                           id="amount"
                                           placeholder="Enter Amount">
                                </div>
                                <div class="col-md-2">
                                    <label for="comments">Comments</label>
                                    <textarea class="form-control"
                                              rows="1"
                                              name="comments"
                                              placeholder="Enter Comments"
                                              id="comments"></textarea>
                                </div>
                                <div class="col-md-2">
                                    <label for="amount">File</label>
                                    <input type="file"
                                           class="form-control"
                                           name="file"
                                           id="file"
                                           placeholder="Upload File">
                                </div>
                                <div class="button-group col-md-2">
                                    <a href="javascript:void(0)" class="btn btn-danger" id="minus5">-</a>
                                    <a href="javascript:void(0)" class="btn btn-primary" id="plus5">+</a>
                                </div>
                                <hr>
                            </div>
                            <button type="submit" class="btn btn-success">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/dynamicForm.js') }}"></script>
    <script>
        $(document).ready(function() {
            var dynamic_form = $("#dynamic_form")
                .dynamicForm("#dynamic_form","#plus5", "#minus5", {
                    limit:10,
                    formPrefix : "dynamic_form",
                    normalizeFullForm : false,
            });

            $("#dynamic_form #minus5").on('click', function(){
                var initDynamicId = $(this).closest('#dynamic_form').parent().find("[id^='dynamic_form']").length;
                if (initDynamicId === 2) {
                    $(this).closest('#dynamic_form').next().find('#minus5').hide();
                }
                $(this).closest('#dynamic_form').remove();
            });

            $('form').on('submit', function(event){
                var values = {};
                $.each($('form').serializeArray(), function(i, field) {
                    values[field.name] = field.value;
                });

                $(this).append('<input type="hidden" name="_token" value="{{ csrf_token() }}" /> ');
                // console.log(values)
                // event.preventDefault();
            })
        });
    </script>
@endsection
