@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/login-style.css') }}">
@endpush

@section('content')
    <div class="login-wrapper">
        <div class="login-left">
            <h2>Autentifică-te</h2>
            <p class="subtitle">Câmpurile obligatorii sunt marcate cu un asterisc*</p>
            @if(session('error'))
                <div class="global-error">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <label for="email">* Introdu adresa ta de e-mail</label>
                <input id="email" type="email" name="email" class="@error('email') is-invalid @enderror" value="{{ old('email') }}" required autofocus>
                @error('email')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror

                <label for="password">* Introdu parola</label>
                <input id="password" type="password" name="password" class="@error('password') is-invalid @enderror" required>
                @error('password')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror

                <a href="{{ route('password.request') }}" class="forgot-password">Ai uitat parola?</a>

                <button type="submit" class="login-button">Autentifică-te</button>
            </form>

            <p class="new-user">Sunteți nou la WhiskerRescue? <a href="{{ route('register') }}">Creează cont</a></p>
        </div>

        <div class="login-right">
            <img src="{{ asset('images/login.png') }}" alt="Starbucks drinks">
        </div>
    </div>
@endsection
<style>
    .login-wrapper {
        display: flex;
        height: 100vh;
        font-family: 'Helvetica Neue', sans-serif;
    }

    .login-left {
        flex: 1;
        padding: 60px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        background-color: #e8faea;
    }

    .login-left h2 {
        font-size: 32px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .subtitle {
        color: #555;
        margin-bottom: 30px;
    }

    form label {
        display: block;
        margin-top: 20px;
        font-weight: 600;
    }

    form input {
        width: 100%;
        padding: 12px;
        border-radius: 8px;
        border: 1px solid #ccc;
        margin-top: 5px;
    }

    .invalid-feedback {
        color: red;
        font-size: 14px;
    }

    .forgot-password {
        display: block;
        margin-top: 10px;
        color: #006241;
        text-decoration: underline;
    }

    .login-button {
        background-color: #006241;
        color: white;
        padding: 12px;
        border: none;
        border-radius: 30px;
        margin-top: 30px;
        cursor: pointer;
        font-weight: bold;
    }

    .new-user {
        margin-top: 20px;
        font-size: 14px;
    }

    .login-right {
        flex: 1;
        display: flex;
        justify-content: flex-end;
        align-items: center;
        background-color: #e8faea;
        padding-right: 30px;
        border-left: 2px solid #5eb489;

    }

    .login-right img {
        width: 600px;
        height: auto;

    }
    .global-error {
        background-color: #ffcccc;
        color: #a70000;
        padding: 12px;
        border-radius: 8px;
        margin-bottom: 20px;
        font-weight: bold;
    }


</style>
