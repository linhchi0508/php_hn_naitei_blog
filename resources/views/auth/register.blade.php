@extends('layouts.app')

@section('content')
<div class='contained'>
    <h2>{{ trans('auth.signup') }}</h2>
    <form action="" method='POST' action="{{ route('register') }}">
        @csrf
        <input id="username" type="text" class="form-info form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" placeholder="{{ trans('auth.username') }}" required autocomplete="username" autofocus>
        
        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <input id="email" type="email" class="form-info form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email">

        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <input id="password" type="password" class="form-info form-control @error('password') is-invalid @enderror" name="password" value="" placeholder="{{ trans('auth.password') }}" required autocomplete="new-password"> 
        
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        
        <input id="password-confirm" type="password" class="form-info form-control" name="password_confirmation" value="" placeholder="{{ trans('auth.confirm_password') }}" required autocomplete="new-password">
        
        <input type="submit" value="{{ trans('auth.signup') }}" class="button primary" name="signup">
    </form>
</div>
@endsection
