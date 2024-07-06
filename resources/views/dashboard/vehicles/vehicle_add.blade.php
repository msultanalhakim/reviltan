@section('page_title', 'Reviltan - Vehicle Add')
@extends('dashboard.layouts.app')
@section('style')
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
                <li class="breadcrumb-item active"><a href="{{ route('vehicle') }}">Vehicles</a></li>
                <li class="breadcrumb-item"><a href="{{ route('vehicle.add') }}">Add</a></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-xl-8 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><a href="{{ route('vehicle') }}"><i class="fas fa-arrow-left"></i></a> Add Vehicle</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form method="POST" action="{{ route('vehicle.store') }}">
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
                                        <input type="number" class="form-control  @error('mileage') is-invalid @enderror" name="mileage" placeholder="Mileage">
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
                                    <div class="mb-3 col-md-12">
                                        <label>Vehicle Owner</label>
                                        <div class="basic-form">
                                            <select class="@error('customer_id') is-invalid @enderror" name="customer_id" id="single-select" style="border:0.5rem solid #fff">
                                                <option value="">Vehicle Owner</option>
                                                @foreach ($customers as $customer)
                                                <option value="{{ $customer->customer_id }}">{{ $customer->email }}</option>
                                                @endforeach
                                            </select>
                                            @error('customer_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm">Add</button>
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
