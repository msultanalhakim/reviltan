@section('page_title', 'Reviltan - 400')
@extends('errors.layouts.app')
@section('content')
<div class="authincation h-100">
    <div class="container h-100">
        <div class="row justify-content-center h-100 align-items-center">
            <div class="col-md-5">
                <div class="form-input-content text-center error-page">
                    <h1 class="error-text fw-bold">400</h1>
                    <h4><i class="fa fa-thumbs-down text-danger"></i> Bad Request</h4>
                    <p>Your Request resulted in an error</p>
                    <div>
                        <a class="btn btn-primary" href="{{ route('dashboard') }}">Back to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection