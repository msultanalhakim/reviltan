@section('page_title', 'Reviltan - Verify Email')
@extends('layouts.app')

@section('content')
<div class="container h-100">
    <div class="row justify-content-center h-100 align-items-center">
        <div class="col-md-6">
            <div class="authincation-content">
                <div class="row no-gutters">
                    <div class="col-xl-12">
                        <div class="auth-form">
                            <div class="d-flex justify-content-center mb-4">
                                <img src="{{ asset('assets/img/favicon.png') }}" class="text-center" style="width: 160px; height:160px;" alt="Logo">
                            </div>
                            <div class="my-4">
                                <p class="fs-16 text-center">Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.</p>
                            </div>
                            <div class="mt-4">
                                @if (session('status') == 'verification-link-sent')
                                <p class="fs-14 text-center mt-4" style="color:#2C74B3">
                                    A new verification link has been sent to the email address you provided during registration.
                                </p>
                                @endif
                                <form method="POST" action="{{ route('verification.send') }}">
                                    @csrf
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary btn-block">
                                            {{ __('Resend Verification Email') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="text-center mt-3">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <p class="fs-16">Would you like to try again later? <button type="submit" class="text-primary" style="border: none; background-color: transparent;">Logout</button></p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
