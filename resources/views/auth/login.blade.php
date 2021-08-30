@extends('layouts.app')

@section('content')
<div class='contained'>
    <h2>{{ trans('auth.login') }}</h2>

    <form action="{{ route('login') }}" method='POST'>
        @csrf
        <input id="email" type="email" class="form-info form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email" autofocus> 
        
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        
        <input id="password" type="password" class="form-info form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="{{ trans('auth.password') }}">
        
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
                
        <p class="remember_me">
            <input type="checkbox" name="remember" id="remember" <?php (old('remember')) ? 'checked' : '' ?>>
            <label for="remember">{{ trans('auth.remember') }}</label>
        </p>

        <input type="submit" value="{{ trans('auth.login') }}" class="button primary" name="login">
    </form>
    <a class='create-acc-link' href="{{ route('register') }}">{{ trans('auth.create_account') }}</a>
    
</div>
@endsection
