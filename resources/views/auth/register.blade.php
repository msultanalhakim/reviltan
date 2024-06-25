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
                                    <h4 class="text-center mb-4 font-w400">Create your account here.</h4>
                                </div>
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="mb-1"><strong>Username</strong></label>
                                        <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" placeholder="Username" value="{{ old('username') }}">
                                        @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="mb-1"><strong>Email</strong></label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="mail@example.com" value="{{ old('email') }}">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="mb-1"><strong>Password</strong></label>
                                        <input type="password" class="form-control mb-2 @error('password') is-invalid @enderror" name="password" id="password" placeholder="****" required autocomplete="new-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-2">
                                        <label class="mb-1"><strong>Confirm Password</strong></label>
                                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="****" required autocomplete="new-password">
                                    </div>
                                    <div class="custom-checkbox mb-3">
                                        <input type="checkbox" class="form-check-input" onclick="togglePasswordVisibility()">
                                        <label class="form-check-label" for="customCheckBox1">Toggle Password</label>
                                    </div>
                                    <div class="text-center mt-4">
                                        <button type="submit" class="btn btn-primary btn-block">
                                            {{ __('Sign Up') }}
                                        </button>
                                    </div>
                                </form>
                                <div class="new-account mt-3">
                                    <p>Already have an account? <a class="text-primary" href="{{ route('login') }}">Sign in</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePasswordVisibility() {
        let passwordInput = document.getElementById('password');
        let confirmPasswordInput = document.getElementById('password_confirmation');
        if (passwordInput.type === "password" && confirmPasswordInput.type === "password") {
            passwordInput.type = "text";
            confirmPasswordInput.type = "text";
        } else {
            passwordInput.type = "password";
            confirmPasswordInput.type = "password";
        }
    }
</script>
@endsection