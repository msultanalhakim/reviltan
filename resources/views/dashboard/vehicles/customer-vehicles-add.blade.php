@section('page_title', 'Reviltan - Dashboard Vehicles')
@extends('dashboard.layouts.app')

@section('content')
<div class="content-body" style="min-height: 60px;">
    <div class="container-fluid">

        <div class="row page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="{{ route('customer.vehicles') }}">Vehicles</a></li>
                <li class="breadcrumb-item"><span style="opacity:0.8">Add Vehicle</span></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-xl-8 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add Vehicle</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form method="POST" action="{{ route('customer.vehicle.store') }}">
                                @csrf
                                <div class="row mb-2">
                                    <div class="mb-3 col-md-12">
                                        <label class="form-label">Vehicle Name</label>
                                        <input type="text" class="form-control  @error('vehicle_name') is-invalid @enderror" name="vehicle_name" placeholder="Vehicle Name">
                                        @error('vehicle_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <label class="form-label">Vehicle Color</label>
                                        <input type="text" class="form-control  @error('vehicle_color') is-invalid @enderror" name="vehicle_color" placeholder="Vehicle Color">
                                        @error('vehicle_color')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <label class="form-label">Chassis Number</label>
                                        <input type="text" class="form-control  @error('chassis_number') is-invalid @enderror" name="chassis_number" placeholder="Chassis Number">
                                        @error('chassis_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <label class="form-label">Engine Number</label>
                                        <input type="text" class="form-control  @error('engine_number') is-invalid @enderror" name="engine_number" placeholder="Engine Number">
                                        @error('engine_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <label class="form-label">Mileage</label>
                                        <input type="text" class="form-control  @error('mileage') is-invalid @enderror" name="mileage" placeholder="Mileage">
                                        @error('mileage')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <label class="form-label">Plate Number</label>
                                        <input type="text" class="form-control  @error('plate_number') is-invalid @enderror" name="plate_number" placeholder="Plate Number">
                                        @error('plate_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm" id="submit-button">Add</button>
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