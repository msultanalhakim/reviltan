@section('page_title', 'Reviltan - Dashboard')
@section('style')
    <!-- Form step -->
    <link href="{{ asset('assets/vendor/jquery-smartwizard/dist/css/smart_wizard.min.css') }}" rel="stylesheet">
    <!-- Custom Stylesheet -->
	<link href="{{ asset('assets/vendor/jquery-nice-select/css/nice-select.css') }}" rel="stylesheet">
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
@extends('dashboard.layouts.app')
@php
use Carbon\Carbon;
@endphp
@section('content')
@if ((empty($userBooking) && empty($transactionData)) || (!$userBooking->isNotEmpty() && empty($transactionData)))
    <div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Components</a></li>
            </ol>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-xl-12 col-xxl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Form step</h4>
                    </div>
                    <div class="card-body">
                        <div id="smartwizard" class="form-wizard order-create">
                            <ul class="nav nav-wizard mb-4">
                                <li>
                                    <a class="nav-link" href="#wizard_Service"> 
                                        <span>1</span> 
                                    </a>
                                    <span>Personal Information</span>
                                </li>
                                <li>
                                    <a class="nav-link mb-0" href="#wizard_Time">
                                    <span>2</span>
                                    </a>
                                    <span>Vehicle Information</span>
                                </li>
                                <li>
                                    <a class="nav-link" href="#wizard_Details">
                                    <span>3</span>
                                    </a>
                                    <span>Booking Schedule</span>
                                </li>
                            </ul>
                            <form action="{{ route('service.booking') }}" method="POST">
                                @csrf
                                <div class="tab-content">
                                    <div id="wizard_Service" class="tab-pane" role="tabpanel">
                                        <div class="row">
                                            @php
                                                $requiredFields = [
                                                    'customer_name' => $userData->customer_name ?? '',
                                                    'province_name' => $userData->province_name ?? '',
                                                    'phone' => $userData->phone ?? '',
                                                    'city_name' => $userData->city_name ?? '',
                                                    'address' => $userData->address ?? '',
                                                ];
                                                $hasEmptyFields = in_array('', $requiredFields, true);
                                            @endphp

                                            @if ($hasEmptyFields)
                                            <div class="col-lg-12 mb-2">
                                                <div class="alert alert-danger solid alert-dismissible fade show">
                                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                                                    <strong>Caution!</strong> You must complete the information in your profile.
                                                </div>
                                            </div>
                                            @endif
                                            <input type="hidden" name="customer_id" value="{{ $userData->customer_id }}">
                                            <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    @php
                                                        $customerName = $userData->customer_name ?? '';
                                                        $isInvalid = empty($customerName) ? 'is-invalid' : '';
                                                    @endphp
                                                    <label class="form-label" for="name">Full Name</label>
                                                    <input type="text" class="form-control {{ $isInvalid }}" name="name" id="name" 
                                                        placeholder="{{ empty($customerName) ? 'Full Name' : 'Full Name' }}"
                                                        value="{{ $customerName ?? '' }}" disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    @php
                                                        $customerPhone = $userData->phone ?? '';
                                                        $isInvalid = empty($customerPhone) ? 'is-invalid' : '';
                                                    @endphp
                                                    <label class="form-label" for="phone">Phone</label>
                                                    <input type="text" class="form-control {{ $isInvalid }}" name="phone" id="phone" 
                                                        placeholder="{{ empty($customerPhone) ? 'Phone' : 'Phone' }}"
                                                        value="{{ $customerPhone ?? '' }}" disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    @php
                                                        $customerProvince = $userData->province_id ?? '';
                                                        $customerProvinceName = $userData->province_name ?? 'Select Province';
                                                        $isInvalid = empty($customerProvince) ? 'is-invalid' : '';
                                                    @endphp
                                                    <label class="form-label" for="province">Province</label>
                                                    <select class="form-control wide mb-3 {{ $isInvalid }}" id="province" name="province" disabled>
                                                        <option value="{{ $customerProvince }}" selected>{{ $customerProvinceName }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    @php
                                                        $customerCity = $userData->city_id ?? '';
                                                        $customerCityName = $userData->city_name ?? 'Select City';
                                                        $isInvalid = empty($customerCity) ? 'is-invalid' : '';
                                                    @endphp
                                                    <label class="form-label" for="city">City</label>
                                                    <select class="form-control wide mb-3 {{ $isInvalid }}" id="city" name="city" disabled>
                                                        <option value="{{ $customerCity }}" selected>{{ $customerCityName }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 mb-3">
                                                <div class="mb-3">
                                                    @php
                                                        $customerAddress = $userData->address ?? '';
                                                        $isInvalid = empty($customerAddress) ? 'is-invalid' : '';
                                                    @endphp
                                                    <label class="form-label" for="address">Address</label>
                                                    <textarea class="form-control {{ $isInvalid }}" rows="4" id="address" name="address"
                                                            style="min-height: 140px;"
                                                            placeholder="{{ empty($customerAddress) ? 'Address' : 'Address' }}" disabled>{{ $customerAddress ?? '' }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="wizard_Time" class="tab-pane" role="tabpanel">
                                        <div class="row">
                                            @php
                                                $requiredFields = [
                                                    'vehicle_name' => $vehicleData->first()->vehicle_name ?? '',
                                                    'plate_number' => $vehicleData->first()->plate_number ?? '',
                                                    'chassis_number' => $vehicleData->first()->chassis_number ?? '',
                                                    'engine_number' => $vehicleData->first()->engine_number ?? '',
                                                    'vehicle_color' => $vehicleData->first()->vehicle_color ?? '',
                                                    'mileage' => $vehicleData->first()->mileage ?? '',
                                                ];
                                                $hasEmptyFields = in_array('', $requiredFields, true);

                                                $isInvalid = $vehicleData->isEmpty() ? 'is-invalid' : '';
                                            @endphp

                                            @if ($hasEmptyFields)
                                            <div class="col-lg-12 mb-2">
                                                <div class="alert alert-danger solid alert-dismissible fade show">
                                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                                                    <strong>Caution!</strong> You are required to enter at least one set of vehicle details in the vehicles menu.
                                                </div>
                                            </div>
                                            @endif
                                            <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    <label class="form-label" for="name">Choose Vehicle</label>
                                                    <select class="form-control wide mb-3 {{ $isInvalid }} @error('vehicle_id') is-invalid @enderror" id="vehicle-dropdown" name="vehicle_id">
                                                        @if ($vehicleData->isEmpty())
                                                        <option value="">No vehicles available</option>
                                                        @else
                                                        <option value="">Select Vehicle</option>
                                                            @foreach ($vehicleData as $data)
                                                                    <option value="{{ $data->vehicle_id }}">
                                                                        {{ $data->vehicle_name }}
                                                                    </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    @error('vehicle_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    <label class="form-label" for="plate_number">Plate Number</label>
                                                    <input type="text" class="form-control {{ $isInvalid }}" name="plate_number" id="plate_number" 
                                                        placeholder="Plate Number" disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    <label class="form-label" for="chassis_number">Chassis Number</label>
                                                    <input type="text" class="form-control {{ $isInvalid }}" name="chassis_number" id="chassis_number" 
                                                        placeholder="Chassis Number" disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    <label class="form-label" for="engine_number">Engine Number</label>
                                                    <input type="text" class="form-control {{ $isInvalid }}" name="engine_number" id="engine_number" 
                                                        placeholder="Engine Number" disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    <label class="form-label" for="vehicle_color">Vehicle Color</label>
                                                    <input type="text" class="form-control {{ $isInvalid }}" name="vehicle_color" id="vehicle_color" 
                                                        placeholder="Vehicle Color" disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <div class="mb-3">  
                                                    <label class="form-label" for="mileage">Mileage</label>
                                                    <input type="text" class="form-control {{ $isInvalid }}" name="mileage" id="mileage" 
                                                        placeholder="Mileage" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="wizard_Details" class="tab-pane" role="tabpanel">
                                        <div class="row">
                                                <div class="col-lg-12">
                                                    <button type="button" class="btn btn-sm btn-primary mb-2" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg"><i class="fas fa-calendar"></i> Schedules</button>
                                                    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Schedules</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="table-responsive">
                                                                        <table id="example3" class="table table-sm mb-4 table-striped display"
                                                                            style="min-width: 845px">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>Booking Time</th>
                                                                                    <th>Booking Date</th>
                                                                                    <th>Status</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @foreach ($formattedBookingData as $booking)
                                                                                <tr>
                                                                                    <td>{{ $booking['booking_time'] }}</td>
                                                                                    <td>{{ $booking['booking_date'] }}</td>
                                                                                    <td>{{ $booking['status'] }}</td>
                                                                                </tr>
                                                                                @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <div class="col-lg-6 mb-2">
                                                <label class="form-label">Time</label>
                                                <div class="input-group clockpicker">
                                                    <input type="text" class="form-control @error('time') is-invalid @enderror" name="time" placeholder="00:00" value="{{ old('time') }}" required>
                                                    <span class="input-group-text"><i class="far fa-clock"></i></span>
                                                    @error('time')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <label class="form-label">Date</label>
                                                <input type="text" class="datepicker-default form-control @error('date') is-invalid @enderror" name="date" id="datepicker" placeholder="00 January, 1900" value="{{ old('date') }}" required>
                                                @error('date')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- @elseif () --}}
@elseif (!empty($bookingUnderway) && $bookingUnderway->isNotEmpty())
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Service</a></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-xl-6 col-xxl-12">
                <div class="card">
                    <div class="alert alert-warning solid mx-4 mt-4 mb-0"><strong>Underway!</strong> Please wait until the process is completed.</div>
                    <div class="card-header d-block mb-4">
                        <h4 class="card-title">Service Progress</h4>
                        <p class="mb-3 subtitle">Your vehicle is currently being worked on.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@elseif (!empty($transactionData))
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Service</a></li>
            </ol>
        </div>
        
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4 order-lg-2 mb-4">
                                <h4 class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="text-muted">Your cart</span>
                                    <span class="badge badge-primary badge-pill">3</span>
                                </h4>
                                <ul class="list-group mb-3">
                                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                                        <div>
                                            <h6 class="my-0">Product name</h6>
                                            <small class="text-muted">Brief description</small>
                                        </div>
                                        <span class="text-muted">$12</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                                        <div>
                                            <h6 class="my-0">Second product</h6>
                                            <small class="text-muted">Brief description</small>
                                        </div>
                                        <span class="text-muted">$8</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                                        <div>
                                            <h6 class="my-0">Third item</h6>
                                            <small class="text-muted">Brief description</small>
                                        </div>
                                        <span class="text-muted">$5</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between active">
                                        <div class="text-white">
                                            <h6 class="my-0 text-white">Promo code</h6>
                                            <small>EXAMPLECODE</small>
                                        </div>
                                        <span class="text-white">-$5</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between">
                                        <span>Total (USD)</span>
                                        <strong>$20</strong>
                                    </li>
                                </ul>

                                <form>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Promo code">
                                        <button type="submit" class="input-group-text">Redeem</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-8 order-lg-1">
                                <h4 class="mb-3">Billing address</h4>
                                <form class="needs-validation" novalidate="">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="firstName" class="form-label">First name</label>
                                            <input type="text" class="form-control" id="firstName" placeholder="" value="" required="">
                                            <div class="invalid-feedback">
                                                Valid first name is required.
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="lastName" class="form-label">Last name</label>
                                            <input type="text" class="form-control" id="lastName" placeholder="" value="" required="">
                                            <div class="invalid-feedback">
                                                Valid last name is required.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <div class="input-group">
                                            <span class="input-group-text">@</span>
                                            <input type="text" class="form-control" id="username" placeholder="Username" required="">
                                            <div class="invalid-feedback" style="width: 100%;">
                                                Your username is required.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email <span class="text-muted">(Optional)</span></label>
                                        <input type="email" class="form-control" id="email" placeholder="you@example.com">
                                        <div class="invalid-feedback">
                                            Please enter a valid email address for shipping updates.
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="address" class="form-label">Address</label>
                                        <input type="text" class="form-control" id="address" placeholder="1234 Main St" required="">
                                        <div class="invalid-feedback">
                                            Please enter your shipping address.
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="address2" class="form-label">Address 2 <span class="text-muted">(Optional)</span></label>
                                        <input type="text" class="form-control" id="address2" placeholder="Apartment or suite">
                                    </div>

                                    <div class="row">
                                        <div class="col-md-5 mb-3">
                                            <label class="form-label">Country</label>
                                            <select class="default-select form-control wide w-100">
                                                <option selected="">Choose...</option>
                                                <option value="1">United States</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Please select a valid country.
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">State</label>
                                            <select class="default-select form-control wide w-100">
                                                <option selected="">Choose...</option>
                                                <option>California</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Please provide a valid state.
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="zip" class="form-label">Zip</label>
                                            <input type="text" class="form-control" id="zip" placeholder="" required="">
                                            <div class="invalid-feedback">
                                                Zip code required.
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="mb-4">
                                    <div class="form-check custom-checkbox mb-2">
                                        <input type="checkbox" class="form-check-input" id="same-address">
                                        <label class="form-check-label" for="same-address">Shipping address
                                            is
                                            the same as
                                            my billing address</label>
                                    </div>
                                    <div class="form-check custom-checkbox mb-2">
                                        <input type="checkbox" class="form-check-input" id="save-info">
                                        <label class="form-check-label" for="save-info">Save this
                                            information
                                            for next
                                            time</label>
                                    </div>
                                    <hr class="mb-4">

                                    <h4 class="mb-3">Payment</h4>

                                    <div class="d-block my-3">
                                        <div class="form-check custom-radio mb-2">
                                            <input id="credit" name="paymentMethod" type="radio" class="form-check-input" checked="" required="">
                                            <label class="form-check-label" for="credit">Credit card</label>
                                        </div>
                                        <div class="form-check custom-radio mb-2">
                                            <input id="debit" name="paymentMethod" type="radio" class="form-check-input" required="">
                                            <label class="form-check-label" for="debit">Debit card</label>
                                        </div>
                                        <div class="form-check custom-radio mb-2">
                                            <input id="paypal" name="paymentMethod" type="radio" class="form-check-input" required="">
                                            <label class="form-check-label" for="paypal">Paypal</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="cc-name" class="form-label">Name on card</label>
                                            <input type="text" class="form-control" id="cc-name" placeholder="" required="">
                                            <small class="text-muted">Full name as displayed on card</small>
                                            <div class="invalid-feedback">
                                                Name on card is required
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="cc-number" class="form-label">Credit card number</label>
                                            <input type="text" class="form-control" id="cc-number" placeholder="" required="">
                                            <div class="invalid-feedback">
                                                Credit card number is required
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <label for="cc-expiration" class="form-label">Expiration</label>
                                            <input type="text" class="form-control" id="cc-expiration" placeholder="" required="">
                                            <div class="invalid-feedback">
                                                Expiration date required
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="cc-expiration" class="form-label">CVV</label>
                                            <input type="text" class="form-control" id="cc-cvv" placeholder="" required="">
                                            <div class="invalid-feedback">
                                                Security code required
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="mb-4">
                                    <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to
                                        checkout</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@else
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Service</a></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-xl-6 col-xxl-12">
                <div class="card">
                    <div class="alert alert-primary solid mx-4 mt-4 mb-0"><strong>Scheduled!</strong> Please arrive at your scheduled time!</div>
                    <div class="card-header d-block mb-4">
                        <h4 class="card-title">Booking Schedule </h4>
                        <p class="mb-3 subtitle">Your booking schedule has been set!</p>
                        <span class="btn-sm btn-dark mt-4">
                            @foreach ($formattedBookingData as $booking)
                            {{ $booking['booking_date'] }}
                            at
                            {{ $booking['booking_time'] }}
                            @endforeach
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
@section('script')
    <!-- Datatable -->
    <script src="{{ asset('assets/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins-init/datatables.init.js') }}"></script>
    	<!-- Form Steps -->
	<script src="{{ asset('assets/vendor/jquery-smartwizard/dist/js/jquery.smartWizard.js') }}"></script>
	<script src="{{ asset('assets/vendor/jquery-nice-select/js/jquery.nice-select.min.js') }}"></script>
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
    <script>
   $(document).ready(function() {
        $(document).on('click', '.sweet-submit', function(e) {
            e.preventDefault(); // Prevent default button behavior

            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'question',
            showCancelButton: true,
            confirmButtonClass: 'btn btn-primary',
            cancelButtonClass: 'btn btn-danger',
            confirmButtonText: 'Submit',
            cancelButtonText: 'Cancel',
            }).then((result) => {
            if (result.isConfirmed) {
                $(this).closest('form').submit(); // Submit the form if Swal is confirmed
            }
            });
        });
    });
    $(document).ready(function () {
    $('#vehicle-dropdown').on('change', function () {
        var idVehicle = this.value;
        // Clear and reset all input fields initially
        var fields = ['plate_number', 'chassis_number', 'engine_number', 'vehicle_color', 'mileage'];
        var placeholders = ['Plate Number', 'Chassis Number', 'Engine Number', 'Vehicle Color', 'Mileage'];

        fields.forEach(function(field, index) {
            $("#" + field).val('').removeClass('is-invalid').attr('placeholder', '');
        });

        $.ajax({
                url: "{{url('api/fetch-vehicle-data')}}",
                type: "POST",
                data: {
                    vehicle_id: idVehicle,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (result) {
                    if (result.vehicles && result.vehicles.length > 0) {
                        var vehicle = result.vehicles[0]; // Assuming result.vehicles is an array and we need the first item
                        fields.forEach(function(field, index) {
                            var value = vehicle[field] || ''; // Get field value or empty string if undefined
                            $("#" + field).val(value); // Set the value of the input field
                            
                            // Check if the field value is empty and add the invalid class if it is
                            if (!value) {
                                $("#" + field).addClass('is-invalid').attr('placeholder', placeholders[index]);
                            }
                        });
                    } else {
                        // Add invalid class to all fields if no vehicle found
                        fields.forEach(function(field, index) {
                            $("#" + field).attr('placeholder', placeholders[index]);
                        });
                    }
                },
                error: function (xhr, status, error) {
                    // Optionally handle the AJAX error
                    console.error('AJAX Error: ' + status + error);
                }
            });
        });
    });

    </script>
    <script>
	// Function to check if all fields in the wizard_Service section are not empty
    function validateWizardService() {
        let isValid = true;

        // Iterate over input, textarea, and select elements in wizard_Service
        $('#wizard_Service input, #wizard_Service textarea, #wizard_Service select').each(function() {
            // Check for empty value in input, textarea, and select elements
            if ($(this).val() === '') {
                isValid = false;
                return false; // Break the loop
            }
        });

        return isValid;
    }

    // Function to check if all fields in the wizard_Time section are not empty
    function validateWizardTime() {
        let isValid = true;

        // Iterate over input and select elements in wizard_Time
        $('#wizard_Time input, #wizard_Time select').each(function() {
            // Check for empty value in input and select elements
            if ($(this).val() === '') {
                isValid = false;
                return false; // Break the loop
            }
        });

        return isValid;
    }


    // Function to fetch the ajax content
    function provideContent(idx, stepDirection, stepPosition, selStep, callback) {
        // Ensure fields in the first tab are not empty before proceeding
        if (stepDirection == 'forward' && selStep.attr('href') === '#wizard_Service') {
            if (!validateWizardService()) {
                alert('All fields in the first tab must be filled out before proceeding.');
                callback(); // Important to call the callback to prevent the wizard from getting stuck
                return;
            }
        }

        // You can use stepDirection to get ajax content on the forward movement and stepPosition to identify the step position
        if (stepDirection == 'forward' && stepPosition == 'middle') {
            let ajaxURL = "YOUR AJAX URL";

            // Ajax call to fetch your content
            $.ajax({
                method: "GET",
                url: ajaxURL,
                beforeSend: function(xhr) {
                    // Show the loader
                    $('#smartwizard').smartWizard("loader", "show");
                }
            }).done(function(res) {
                // Build the content HTML
                let html = `<div class="card w-100">
                                <div class="card-body">
                                    <p class="card-text">${res}</p>
                                </div>
                            </div>`;

                // Resolve the Promise with the tab content
                callback(html);

                // Hide the loader
                $('#smartwizard').smartWizard("loader", "hide");
            }).fail(function(err) {
                // Handle ajax error

                // Hide the loader
                $('#smartwizard').smartWizard("loader", "hide");
            });
        } else {
            // The callback must be called in any case to proceed with the steps
            // The empty callback will not apply any dynamic contents to the steps
            callback();
        }
    }

    // SmartWizard initialize with step content callback
$('#smartwizard').smartWizard({
    getContent: provideContent
});

	</script>
@endsection