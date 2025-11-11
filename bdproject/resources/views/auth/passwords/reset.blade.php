@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card shadow-sm border-0" style="border-radius: 16px; background-color: #fdfbf2;">
                    <div class="card-header text-center text-success fw-bold" style="background-color: #d1eed9; border-top-left-radius: 16px; border-top-right-radius: 16px; font-size: 1.5rem;">
                        <i class="bi bi-shield-lock-fill me-2"></i>Resetare Parolă
                    </div>

                    <div class="card-body px-4 py-4">

                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="mb-3">
                                <label for="email" class="form-label text-success"><i class="bi bi-envelope-fill me-1"></i>Adresă Email</label>
                                <input id="email" type="email" class="form-control rounded-3 @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label text-success"><i class="bi bi-lock-fill me-1"></i>Parolă Nouă</label>
                                <input id="password" type="password" class="form-control rounded-3 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="password-confirm" class="form-label text-success"><i class="bi bi-lock me-1"></i>Confirmă Parola</label>
                                <input id="password-confirm" type="password" class="form-control rounded-3" name="password_confirmation" required autocomplete="new-password">
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-success px-4 py-2" style="border-radius: 10px;">
                                    <i class="bi bi-arrow-repeat me-1"></i>Resetează parola
                                </button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
