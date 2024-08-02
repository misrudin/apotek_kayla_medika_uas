@extends('layouts.auth')

@section('content')
<div class="login-wrapper">
    <div class="login-content">
        <div class="login-userset">
            <div class="login-logo">
                <img src="{{ asset('assets/img/logo.png') }}" alt="img">
            </div>
            <div class="login-userheading">
                <h3>Sign In</h3>
                <h4>Please login to your account</h4>
            </div>
            @if($errors->has('error'))
            <div class="error mb-3">{{ $errors->first('error') }}</div>
        @endif
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-login">
                    <label for="email">Email</label>
                    <div class="form-addons">
                        <input type="text" placeholder="Enter your email address" name="email" id="email"
                            value="{{ old('email') }}" autofocus>
                        <img src="{{ asset('assets/img/icons/mail.svg') }}" alt="img">
                    </div>
                    @if($errors->has('email'))
                        <div class="error">{{ $errors->first('email') }}</div>
                    @endif
                </div>
                <div class="form-login">
                    <label for="password">Password</label>
                    <div class="pass-group">
                        <input type="password" class="pass-input" placeholder="Enter your password" name="password"
                            id="password">
                        <span class="fas toggle-password fa-eye-slash"></span>
                    </div>
                    @if($errors->has('password'))
                        <div class="error">{{ $errors->first('password') }}</div>
                    @endif
                </div>
                <div class="form-login">
                    <button type="submit" class="btn btn-login">Sign In</button>
                </div>
                <div class="signinform text-center">
                    <h4>Don’t have an account? <a href="{{ route('register') }}" class="hover-a">Sign Up</a></h4>
                  </div>
            </form>
        </div>
    </div>
    <div class="login-img">
        <img src="{{ asset('assets/img/login.jpg') }}" alt="img">
    </div>
</div>
@endsection
