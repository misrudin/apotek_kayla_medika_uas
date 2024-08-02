@extends('layouts.auth')

@section('content')
<div class="login-wrapper">
    <div class="login-content">
        <div class="login-userset">
            <div class="login-logo">
                <img src="assets/img/logo.png" alt="img">
            </div>
            <div class="login-userheading">
                <h3>Create an Account</h3>
                <h4>Continue where you left off</h4>
            </div>
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="form-login">
                    <label for="name">Full Name</label>
                    <div class="form-addons">
                        <input name="name" id="name" autofocus type="text" placeholder="Enter your full name"
                            value="{{ old('name') }}">
                        <img src="assets/img/icons/users1.svg" alt="img">
                    </div>
                    @if($errors->has('name'))
                        <div class="error">{{ $errors->first('name') }}</div>
                    @endif
                </div>
                <div class="form-login">
                    <label for="email">Email</label>
                    <div class="form-addons">
                        <input name="email" id="email" type="text" placeholder="Enter your email address"
                            value="{{ old('email') }}">
                        <img src="assets/img/icons/mail.svg" alt="img">
                    </div>
                    @if($errors->has('email'))
                        <div class="error">{{ $errors->first('email') }}</div>
                    @endif
                </div>
                <div class="form-login">
                    <label for="password">Password</label>
                    <div class="pass-group">
                        <input name="password" id="password" type="password" class="pass-input"
                            placeholder="Enter your password">
                        <span class="fas toggle-password fa-eye-slash"></span>
                    </div>
                    @if($errors->has('password'))
                        <div class="error">{{ $errors->first('password') }}</div>
                    @endif
                </div>
                <div class="form-login">
                    <button type="submit" class="btn btn-login">Sign Up</button>
                </div>
                <div class="signinform text-center">
                    <h4>Already a user? <a href="{{ route('login') }}" class="hover-a">Sign In</a>
                    </h4>
                </div>
            </form>
        </div>
    </div>
    <div class="login-img">
        <img src="assets/img/login.jpg" alt="img">
    </div>
</div>
@endsection
