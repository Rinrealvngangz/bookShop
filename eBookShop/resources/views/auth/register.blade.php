@extends('layouts.app')

@section('content')

        <section class="signup">

            <div class="container">
                <div class="signup-content">
                    <form method="POST" action="{{ route('register') }}" id="signup-form" class="signup-form">
                        @csrf

                        <h2 class="form-title">Create account</h2>
                        <div class="form-group">
                            <input id="firstName" type="text" placeholder="{{ __('First Name') }}" class="form-input @error('firstName') is-invalid @enderror" name="firstName" value="{{ old('firstName') }}" required autocomplete="firstName" autofocus>

                            @error('firstName')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                        <div class="form-group">
                            <input id="lastName" type="text"  placeholder="{{ __('Last Name') }}" class="form-input @error('lastName') is-invalid @enderror" name="lastName" value="{{ old('lastName') }}" required autocomplete="lastName" autofocus>

                            @error('lastName')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>

                        <div class="form-group">
                            <input id="userName" type="text" placeholder="{{ __('User Name') }}" class="form-input @error('userName') is-invalid @enderror" name="userName" value="{{ old('userName') }}" required autocomplete="userName" autofocus>

                            @error('userName')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror

                        </div>

                        <div class="form-group">
                            <input id="email" type="email" placeholder="{{ __('E-Mail Address') }}" class="form-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input id="password" type="password" placeholder="{{ __('Password') }}" class="form-input @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                        <div class="form-group">
                            <input id="password-confirm" type="password" placeholder="{{ __('Confirm Password') }}" class="form-input" name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <div class="form-group">
                            <input type="submit" class="form-submit" value=" {{ __('Register') }}">


                        </div>
                    </form>
                    <p class="loginhere">
                        Have already an account ? <a href="{{ route('login') }}" class="loginhere-link">Login here</a>
                    </p>
                </div>
            </div>
        </section>

@endsection
