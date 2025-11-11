@extends('layouts.app')

@section('content')

    <div style="background-image: url('{{ asset('images/profile.png') }}'); background-size: cover; background-position: center; height: 300px; position: relative; border-radius: 12px; overflow: hidden; margin-bottom: 30px;">
        <div style="background-color: rgba(255,255,255,0.7); position: absolute; top: 0; left: 0; width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;">
            <h1 class="text-success fw-bold" style="font-size: 2.5rem;"><i class="bi bi-pencil-square me-2"></i>Editează profilul</h1>
        </div>
    </div>

    <div class="container py-4">

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('message'))
            <div class="alert alert-info">{{ session('message') }}</div>
        @endif

        @if(!auth()->user()->hasVerifiedEmail())
            <div class="alert alert-warning">
                Emailul tău nu este verificat.
                <form method="POST" action="{{ route('email.resend') }}" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-link">Trimite din nou linkul</button>
                </form>
            </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            <table class="table table-borderless" style="background-color: #c4efc9;">
                <tbody>
                <tr style="border-top: 1px solid #ccc;">
                    <th style="width: 220px;"><i class="bi bi-person-fill me-2 text-success"></i>Nume</th>
                    <td>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                    </td>
                </tr>
                <tr style="border-top: 1px solid #ccc;">
                    <th><i class="bi bi-telephone-fill me-2 text-success"></i>Telefon</th>
                    <td>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
                    </td>
                </tr>
                <tr style="border-top: 1px solid #ccc;">
                    <th><i class="bi bi-envelope-fill me-2 text-success"></i>Email</th>
                    <td>
                        <input type="email" class="form-control" value="{{ $user->email }}" disabled>
                    </td>
                </tr>
                <tr style="border-top: 1px solid #ccc; border-bottom: 1px solid #ccc;">
                    <th><i class="bi bi-lock-fill me-2 text-success"></i>Parolă</th>
                    <td>
                        <form action="{{ route('password.email') }}" method="POST" class="d-inline">
                            @csrf
                            <input type="hidden" name="email" value="{{ $user->email }}">
                            <button type="submit" class="btn btn-outline-success btn-sm">
                                <i class="bi bi-envelope-lock me-1"></i> Trimite link de resetare
                            </button>
                        </form>
                    </td>
                </tr>
                </tbody>
            </table>

            <div class="d-flex gap-3 mt-4" style="margin-bottom:80px;">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-save2-fill me-1"></i> Salvează
                </button>
            </div>
        </form>
    </div>
@endsection
