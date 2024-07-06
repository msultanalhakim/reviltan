@section('page_title', 'Reviltan - Customer Update')
@extends('dashboard.layouts.app')
@section('content')
<div class="content-body" style="min-height: 60px;">
    <div class="container-fluid">

        <div class="row page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="{{ route('customer') }}">Customers</a>
                </li>
                <li class="breadcrumb-item"><a href="" onclick="location.reload(); return false;">Update</a></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-xl-8 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><a href="{{ route('customer') }}"><i class="fas fa-arrow-left"></i></a> Update Customer</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form method="POST" action="{{ route('customer.update.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-2">
                                    <input type="hidden" name="customer_id" value="{{ $customer->customer_id }}"required>
                                    <div class="mb-3 col-md-12">
                                        <label class="form-label">Customer Name</label>
                                        <input type="text"
                                            class="form-control @error('customer_name') is-invalid @enderror"
                                            name="customer_name" value="{{ $customer->customer_name }}"
                                            placeholder="Customer Name">
                                        @error('customer_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <label class="form-label">Email</label>
                                        <input type="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            name="email" value="{{ $customer->email }}"
                                            placeholder="Email" required>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <label class="form-label">Phone</label>
                                        <input type="number"
                                            class="form-control @error('phone') is-invalid @enderror"
                                            name="phone" value="{{ $customer->phone }}"
                                            placeholder="Phone">
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <label class="form-label" for="address">Address</label>
                                        <textarea class="form-control @error('address') is-invalid @enderror" rows="4" id="address" name="address"
                                            style="min-height: 180px;"
                                            placeholder="Address">{{ $customer->address ?? old('address') }}</textarea>
                                            @error('address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="province-dropdown">Province</label>
                                        <div class="basic-form">
                                            <select class="form-control wide mb-3 @error('province') is-invalid @enderror" id="province-dropdown" name="province">
                                                <option value="{{ $customer->province_id ?? old('province_id') }}" selected>{{ $customer->province_name ?? 'Select Province' }}</option>
                                                @foreach ($provinces as $data)
                                                <option value="{{$data->province_id}}">
                                                    {{$data->province_name}}
                                                </option>
                                                @endforeach
                                            </select>
                                            @error('province')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="city-dropdown">City</label>
                                        <div class="basic-form">
                                            <select class="form-control wide mb-3 @error('city') is-invalid @enderror" id="city-dropdown" name="city">
                                                <option value="{{ $customer->city_id ?? old('city_id') }}" selected>{{ $customer->city_name ?? 'Select City' }}</option>
                                            </select>
                                            @error('city')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <img id="showImage" src="{{ (!empty($customer->photo) ? url(asset('assets/img/profile/'.$customer->photo)) : url(asset('assets/img/profile/users_default.png'))) }}"
                                            alt="Photo Users" class="img-fluid mt-4 mb-4 rounded-circle"
                                            style="width: 216px; height: 216px; object-fit: cover;">
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <label class="form-label" for="uploadImage">Photo</label>
                                        <div class="form-file">
                                            <input type="file" class="form-file-input form-control @error('photo') is-invalid @enderror" name="photo" id="uploadImage">
                                            @error('photo')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
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
@section('script')
<script src="{{ asset('assets/vendor/jquery-nice-select/js/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('assets/vendor/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins-init/select2-init.js') }}"></script>
<script>
    $(document).ready(function () {
    $('#province-dropdown').on('change', function () {
        var idProvince = this.value;
        $("#city-dropdown").html('');
        $.ajax({
            url: "{{url('api/fetch-city')}}",
            type: "POST",
            data: {
                province_id: idProvince,
                _token: '{{csrf_token()}}'
            },
            dataType: 'json',
            success: function (result) {
                $.each(result.cities, function (key, value) {
                    $("#city-dropdown").append('<option value="' + value
                        .city_id + '">' + value.city_name + '</option>');
                });
            }
        });
    });

    $('#uploadImage').on('change', function(e){
        $('#showImage').attr('src', URL.createObjectURL(e.target.files[0]));
    });
});
</script>
@endsection