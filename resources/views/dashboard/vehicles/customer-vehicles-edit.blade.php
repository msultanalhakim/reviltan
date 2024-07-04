@section('page_title', 'Reviltan - Dashboard')
@extends('dashboard.layouts.app')
@section('style')
    <!-- Daterange picker -->
    <link href="{{ asset('assets/vendor/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
    <!-- Clockpicker -->
    <link href="{{ asset('assets/vendor/clockpicker/css/bootstrap-clockpicker.min.css') }}" rel="stylesheet">
    <!-- asColorpicker -->
    <link href="{{ asset('assets/vendor/jquery-asColorPicker/css/asColorPicker.min.css') }}" rel="stylesheet">
    <!-- Material color picker -->
    <link href="{{ asset('assets/vendor/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet">
	
    <!-- Pick date -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/pickadate/themes/default.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/pickadate/themes/default.date.css') }}">
    <style>
        /* Custom CSS for select2 to match input style */
        .select2-container--default .select2-selection--single {
            border: 0.0625rem solid #efefef;
            height: calc(2.25rem + 2px); /* Match the height of .form-control */
            padding: 0.3125rem 1.25rem; /* Match the padding of .form-control */
            font-size: 0.875rem; /* Match the font size of .form-control */
            line-height: 1.5; /* Match the line height of .form-control */
            color: #6e6e6e; /* Match the text color of .form-control */
            background-color: #fff; /* Match the background color of .form-control */
            background-clip: padding-box; /* Match the background clip of .form-control */
            border-radius: 1rem; /* Match the border radius of .form-control */
            transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out; /* Match the transition of .form-control */
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            padding-left: 0; /* Reset padding to match .form-control */
            padding-right: 0; /* Reset padding to match .form-control */
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            top: 50%;
            transform: translateY(-50%);
            right: 1rem;
        }
        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #886CC0;
            color: white;
        }
        .select2-container--default .select2-search--dropdown .select2-search__field {
            border: 1px solid #886CC0;
        }
        .select2-dropdown {
            border: 1px solid #efefef;
        }
    </style>
@endsection
@section('content')
<div class="content-body" style="min-height: 60px;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-8 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Update Employee</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form method="POST" action="{{ route('customer.vehicle.update.store') }}">
                                @csrf
                                <div class="row mb-2">
                                    <input type="hidden" name="vehicle_id" value="{{ $vehicle->vehicle_id }}" required>
                                    <div class="mb-3 col-md-12">
                                        <label class="form-label">Vehicle Name</label>
                                        <input type="text" class="form-control @error('vehicle_name') is-invalid @enderror" name="vehicle_name" value="{{ $vehicle->vehicle_name }}" placeholder="Vehicle Name" required>
                                        @error('vehicle_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <label class="form-label">Chassis Number</label>
                                        <input type="text" class="form-control @error('chassis_number') is-invalid @enderror" name="chassis_number" value="{{ $vehicle->chassis_number }}" placeholder="Chassis Number" required>
                                        @error('chassis_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <label class="form-label">Engine Number</label>
                                        <input type="text" class="form-control @error('engine_number') is-invalid @enderror" name="engine_number" value="{{ $vehicle->engine_number }}" placeholder="Engine Number" required>
                                        @error('engine_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <label class="form-label">Vehicle Color</label>
                                        <input type="text" class="form-control @error('vehicle_color') is-invalid @enderror" name="vehicle_color" value="{{ $vehicle->vehicle_color }}" placeholder="Vehicle Color" required>
                                        @error('vehicle_color')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <label class="form-label">Mileage</label>
                                        <input type="text" class="form-control @error('mileage') is-invalid @enderror" name="mileage" value="{{ $vehicle->mileage }}" placeholder="Mileage" required>
                                        @error('mileage')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <label class="form-label">Plate Number</label>
                                        <input type="text" class="form-control @error('plate_number') is-invalid @enderror" name="plate_number" value="{{ $vehicle->plate_number }}" placeholder="Plate Number" required>
                                        @error('plate_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                <button type="submit" class="btn btn-primary btn-sm" id="submit-button">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection