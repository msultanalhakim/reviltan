@section('page_title', 'Reviltan - Province Edit')
@extends('dashboard.layouts.app')
@section('content')
<div class="content-body" style="min-height: 60px;">
    <div class="container-fluid">

        <div class="row page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="{{ route('province') }}">Provinces</a></li>
                <li class="breadcrumb-item"><a href="" onclick="location.reload(); return false;">Update</a></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-xl-8 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><a href="{{ route('province') }}"><i class="fas fa-arrow-left"></i></a> Update Province</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form method="POST" action="{{ route('province.update.store') }}">
                                @csrf
                                <input type="hidden" name="province_id" value="{{ $province->province_id }}">
                                <div class="row mb-2">
                                    <div class="mb-3 col-md-12">
                                        <label class="form-label">Province Name</label>
                                        <input type="text" class="form-control  @error('province_name') is-invalid @enderror" value="{{ $province->province_name }}" name="province_name" placeholder="Province Name">
                                        @error('province_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm" class="submit-button">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
