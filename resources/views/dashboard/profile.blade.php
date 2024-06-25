@section('page_title', 'Reviltan - Profile User')
@extends('dashboard.layouts.app')
@section('content')
<div class="content-body">
    <div class="container-fluid">


        <div class="row page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="{{ route('dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('profile.view') }}">Profile</a></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-xl-4">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12 text-center mb-2">
                                        <img src="{{ (!empty($userData->photo) ? url(asset('assets/img/profile/'.$userData->photo)) : url(asset('assets/img/profile/users_default.png'))) }}"
                                            alt="" class="img-fluid mt-4 mb-4 rounded-circle"
                                            style="width: 216px; height: 216px; object-fit: cover;">
                                    </div>
                                    <div class="col-lg-12 text-center">
                                        <h4>
                                            {{ $userData->customer_name ?? 'User' }}
                                        </h4>
                                        <p class="mb-0 mt-0">{{ $userData->email ?? 'user@gmail.com'}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Profile User</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form method="POST" action="{{ route('profile.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="name">Full Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Full Name"
                                            value="{{ $userData->customer_name ?? '' }}">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="username">Username</label>
                                        <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="username" placeholder="Username"
                                            value="{{ $userData->username ?? '' }}">
                                            @error('username')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="phone">Phone</label>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" placeholder="Phone"
                                            value="{{ $userData->phone ?? '' }}">
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
                                            placeholder="Address">{{ $userData->address ?? '' }}</textarea>
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
                                                <option value="{{ $userData->province_id ?? '' }}" selected>{{ $userData->province_name ?? 'Select Province' }}</option>
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
                                                <option value="{{ $userData->city_id ?? '' }}" selected>{{ $userData->city_name ?? 'Select City' }}</option>
                                            </select>
                                            @error('city')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <img id="showImage" src="{{ (!empty($userData->photo) ? url(asset('assets/img/profile/'.$userData->photo)) : url(asset('assets/img/profile/users_default.png'))) }}"
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
                                    <div class="mt-3 pb-3 row">
                                        <div class="col-sm-12 text-right">
                                            <button type="submit" class="btn btn-primary">Update</button>
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
