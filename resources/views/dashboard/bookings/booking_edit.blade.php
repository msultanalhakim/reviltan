@section('page_title', 'Reviltan - Booking Update')
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
                <li class="breadcrumb-item active"><a href="{{ route('booking') }}">Bookings</a></li>
                <li class="breadcrumb-item"><a href="" onclick="location.reload(); return false;">Update</a></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-xl-8 col-lg-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <h4 class="card-title"><a href="{{ route('booking') }}"><i class="fas fa-arrow-left"></i></a> Update Booking</h4>
                            </div>
                            <div class="col-md-12 mb-0">
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
                                                    <table id="example3" class="table table-sm mb-4 table-striped display">
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
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form method="POST" action="{{ route('booking.update.store') }}">
                                @csrf
                                <input type="hidden" name="booking_id" value="{{ $bookingData->booking_id }}" required>
                                <div class="row mb-2">
                                    <div class="col-md-6 col-xl-6 col-xxl-6 mb-3">
                                        <label class="form-label">Time</label>
                                        <div class="input-group clockpicker">
                                            <input type="text" class="form-control @error('time') is-invalid @enderror" name="time" placeholder="00:00" value="{{ $time ?: old('time') }}" required>
                                            <span class="input-group-text"><i class="far fa-clock"></i></span>
                                            @error('time')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xl-6 col-xxl-6 mb-3">
                                        <label class="form-label">Date</label>
                                        <input type="text" class="datepicker-default form-control @error('date') is-invalid @enderror" name="date" id="datepicker" placeholder="00 January, 1900" value="{{ $date ?: old('date') }}" required>
                                        @error('date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>                       
                                    <div class="mb-4 col-md-12">
                                        <label>Customer Name</label>
                                        <div class="basic-form">
                                            <select class="py-2 @error('customer') is-invalid @enderror" name="customer" id="single-select" style="border:0.5rem solid #fff" required>
                                                <option value="{{ $bookingData->customer_id }}">{{ $bookingData->email }}</option>
                                                @foreach ($customers as $customer)
                                                <option value="{{ $customer->customer_id }}">{{ $customer->email }}</option>
                                                @endforeach
                                            </select>
                                            @error('customer')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <label>Vehicle Name</label>
                                        <div class="basic-form">
                                            <select class="form-control wide mb-3 @error('vehicle') is-invalid @enderror" name="vehicle" id="vehicle-dropdown" required>
                                                <option value="{{ $bookingData->vehicle_id }}">{{ $bookingData->vehicle_name }}</option>
                                            </select>
                                            @error('vehicle')
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
<!-- clockpicker -->
<script src="{{ asset('assets/vendor/clockpicker/js/bootstrap-clockpicker.min.js') }}"></script>
<!-- pickdate -->
<script src="{{ asset('assets/vendor/pickadate/picker.js') }}"></script>
<script src="{{ asset('assets/vendor/pickadate/picker.date.js') }}"></script>
<!-- Clockpicker init -->
<script src="{{ asset('assets/js/plugins-init/clock-picker-init.js') }}"></script>
<!-- Pickdate -->
<script src="{{ asset('assets/js/plugins-init/pickadate-init.js') }}"></script>
<script>
$(document).ready(function () {
    $('#single-select').on('change', function () {
        var idCustomer = this.value;
        $("#vehicle-dropdown").html('');
        $.ajax({
            url: "{{url('api/fetch-customers')}}",
            type: "POST",
            data: {
                customer_id: idCustomer,
                _token: '{{csrf_token()}}'
            },
            dataType: 'json',
            success: function (result) {
                if (result.vehicles && result.vehicles.length > 0) {
                    $.each(result.vehicles, function (key, value) {
                        $("#vehicle-dropdown").append('<option value="' + value.vehicle_id + '">' + value.vehicle_name + '</option>');
                    });
                } else {
                    $("#vehicle-dropdown").append('<option value="">No available data vehicles</option>');
                }
            },
        });
    });
});
</script>
@endsection