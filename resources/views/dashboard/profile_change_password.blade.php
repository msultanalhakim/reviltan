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
                        <h4 class="card-title">Change Password</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form method="POST" action="{{ route('profile.store_password') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="old_password">Old Password</label>
                                        <input type="password" class="form-control @error('name') is-invalid @enderror" name="old_password" id="old_password" placeholder="Old Password">
                                            @error('old_password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="new_password">New Password</label>
                                        <input type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" id="new_password" placeholder="New Password">
                                            @error('new_password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="new_password_confirmation">Confirm Password</label>
                                        <input type="password" class="form-control @error('new_password_confirmation') is-invalid @enderror" name="new_password_confirmation" id="new_password_confirmation" placeholder="Confirm Password">
                                            @error('new_password_confirmation')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
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
