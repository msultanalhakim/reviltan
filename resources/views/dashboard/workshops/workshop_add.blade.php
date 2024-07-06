@section('page_title', 'Reviltan - Workshop Add')
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

        <div class="row page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('workshop') }}">Workshops</a></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-xl-8 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add Workshop</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form method="POST" action="{{ route('workshop.store') }}">
                                @csrf
                                <div class="row mb-2">
                                    <div class="mb-3 col-md-12">
                                        <label class="form-label">Workshop Name</label>
                                        <input type="text" class="form-control @error('workshop_name') is-invalid @enderror" name="workshop_name" placeholder="Workshop Name" required>
                                        @error('workshop_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <label class="form-label">Status</label>
                                        <select class="default-select form-control wide mb-3  @error('status') is-invalid @enderror" name="status">
                                            <option value="">Select Status</option>
                                            <option value="Underway">Underway</option>
                                            <option value="Postponed">Postponed</option>
                                            <option value="Completed">Completed</option>
                                        </select>
                                        @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                    <div class="mb-4 col-md-6">
                                        <label>Vehicle</label>
                                        <div class="basic-form">
                                            <select class="@error('vehicle_id') is-invalid @enderror" name="vehicle_id" id="single-select" style="border:0.5rem solid #fff">
                                                <option value="">Select Vehicle</option>
                                                @foreach ($vehicles as $vehicle)
                                                <option value="{{ $vehicle->vehicle_id }}">{{ $vehicle->plate_number}} - {{$vehicle->vehicle_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('vehicle_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm">Insert</button>
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
<!-- Daterangepicker -->
<!-- momment js is must -->
<script src="{{ asset('assets/vendor/moment/moment.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<!-- clockpicker -->
<script src="{{ asset('assets/vendor/clockpicker/js/bootstrap-clockpicker.min.js') }}"></script>
<!-- asColorPicker -->
<script src="{{ asset('assets/vendor/jquery-asColor/jquery-asColor.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-asGradient/jquery-asGradient.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-asColorPicker/js/jquery-asColorPicker.min.js') }}"></script>
<!-- Material color picker -->
<script src="{{ asset('assets/vendor/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>
<!-- pickdate -->
<script src="{{ asset('assets/vendor/pickadate/picker.js') }}"></script>
<script src="{{ asset('assets/vendor/pickadate/picker.time.js') }}"></script>
<script src="{{ asset('assets/vendor/pickadate/picker.date.js') }}"></script>
<!-- Daterangepicker -->
<script src="{{ asset('assets/js/plugins-init/bs-daterange-picker-init.js') }}"></script>
<!-- Clockpicker init -->
<script src="{{ asset('assets/js/plugins-init/clock-picker-init.js') }}"></script>
<!-- asColorPicker init -->
<script src="{{ asset('assets/js/plugins-init/jquery-asColorPicker.init.js') }}"></script>
<!-- Material color picker init -->
<script src="{{ asset('assets/js/plugins-init/material-date-picker-init.js') }}"></script>
<!-- Pickdate -->
<script src="{{ asset('assets/js/plugins-init/pickadate-init.js') }}"></script>
@endsection