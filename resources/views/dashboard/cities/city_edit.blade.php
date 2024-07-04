@section('page_title', 'Reviltan - City Update')
@extends('dashboard.layouts.app')
@section('content')
<div class="content-body" style="min-height: 60px;">
    <div class="container-fluid">

        <div class="row page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="{{ route('city') }}">Cities</a></li>
                <li class="breadcrumb-item"><a href="" onclick="location.reload(); return false;">Update</a></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-xl-8 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><a href="{{ route('city') }}"><i class="fas fa-arrow-left"></i></a> Update City</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form method="POST" action="{{ route('city.update.store') }}">
                                @csrf
                                <input type="hidden" name="city_id" value="{{ $city->city_id }}">
                                <div class="row mb-2">
                                    <div class="mb-3 col-md-12">
                                        <label class="form-label">City Name</label>
                                        <input type="text" class="form-control  @error('city_name') is-invalid @enderror" value="{{ $city->city_name }}" name="city_name" placeholder="City Name">
                                        @error('city_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label>Province Name</label>
                                        <div class="basic-form">
                                            <select class="default-select form-control wide mb-3  @error('province_id') is-invalid @enderror" name="province_id">
                                                <option value="{{ $city->province_id }}">{{ $city->province_name }}</option>
                                                @foreach ($provinces as $province)
                                                <option value="{{ $province->province_id }}">{{ $province->province_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('province_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
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
@section('script')
<script src="{{ asset('assets/vendor/jquery-nice-select/js/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('assets/vendor/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins-init/select2-init.js') }}"></script>
@endsection