@extends('layouts.app')

@section('content')
<div class="authincation h-100">
    <div class="container h-100">
        <div class="row justify-content-center h-100 align-items-center">
            <div class="col-md-6">
                <div class="authincation-content">
                    <div class="row no-gutters">
                        <div class="col-xl-12">
                            <div class="auth-form">
                                <div class="text-center mb-3">
                                    <h2 class="text-center fs-28 font-w700 mb-0 me-2">Revil<span
                                            class="font-w400 text-primary">tan</span></h2>
                                    <h4 class="text-center mb-4 font-w400">Welcome back! Login to your account.</h4>
                                </div>
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label
                                            class="mb-1" for="account"><strong>{{ __('Email or Username') }}</strong></label>
                                        <input id="account" type="text"
                                            class="form-control @error('account') is-invalid @enderror" name="account" id="account"
                                            required autocomplete="account" placeholder="Email or Username" value="{{ old('account') }}" autofocus>

                                        @error('account')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="mb-1" for="password"><strong>Password</strong></label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password"
                                            autocomplete="current-password" placeholder="Password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="row d-flex justify-content-between mt-4 mb-2">
                                        <div class="mb-3">
                                            <div class="form-check custom-checkbox ms-1">
                                                 <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                                                 <label class="form-check-label" for="remember_me">{{ __('Remember my preferences') }}</label>
                                             </div>
                                         </div>
                                        @if(Route::has('password.request'))
                                            <div class="mb-3">
                                                <a href="{{ route('password.request') }}">Forgot
                                                    Password?</a>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary btn-block">
                                            {{ __('Sign In') }}
                                        </button>
                                    </div>
                                </form>
                                <div class="new-account mt-3">
                                    <p>Don't have an account? <a class="text-primary"
                                            href="{{ route('register') }}">Sign Up</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
