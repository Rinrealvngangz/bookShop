@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">

                <form method="POST" action="{{ route('login') }}"  class="box">
                    @csrf
                    <h1>{{ __('Login') }}</h1>
                    <p class="text-muted"> Please enter your login and password!</p>

                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"placeholder="password" name="password" required autocomplete="current-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    @if (Route::has('password.request'))
                    <a class="forgot text-muted" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>

                    <button type="submit" class="btn btn-primary">
                        {{ __('Login') }}
                    </button>
                </form>

        </div>
    </div>
</div>
@endsection
