@section('page_title', 'Reviltan - Dashboard')
@extends('dashboard.layouts.app')
@section('content')
<div class="content-body" style="min-height: 60px;">
    <div class="container-fluid">

        <div class="row page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="{{ route('customer') }}">Customer</a></li>
                <li class="breadcrumb-item"><a href="{{ route('customer.add') }}">Add</a></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-xl-8 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add Customer</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form method="POST" action="{{ route('customer.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-2">
                                    <div class="mb-3 col-md-12">
                                        <label class="form-label">Customer Name</label>
                                        <input type="text"
                                            class="form-control @error('customer_name') is-invalid @enderror"
                                            name="customer_name" placeholder="Customer Name" required>
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
                                            name="email" placeholder="Email" required>
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
                                            name="phone" placeholder="Phone" required>
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
                                            placeholder="Address" required></textarea>
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
                                                <option value="" selected>Select Province</option>
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
                                                <option value="" selected>Select City</option>
                                            </select>
                                            @error('city')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <img id="showImage" src="{{ url(asset('assets/img/profile/users_default.png')) }}"
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
                                    <button type="submit" class="btn btn-primary btn-sm" id="submit-button">Insert</button>
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
