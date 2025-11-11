@extends('layouts.app')

@section('content')

    <div style="background-image: url('{{ asset('images/profile.png') }}'); background-size: cover; background-position: center; height: 300px; position: relative; border-radius: 12px; overflow: hidden; margin-bottom: 30px;">
        <div style="background-color: rgba(255,255,255,0.7); position: absolute; top: 0; left: 0; width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;">
            <h1 class="text-success fw-bold" style="font-size: 2.5rem;"><i class="bi bi-person-circle me-2"></i>Profilul meu</h1>
        </div>
    </div>

    <div class="container py-4">
        <table class="table table-borderless" style="background-color: #c4efc9;">
            <tbody>
            <tr style="border-top: 1px solid #ccc;">
                <th style="width: 220px;"><i class="bi bi-person-fill me-2 text-success"></i>Nume</th>
                <td>{{ $user->name }}</td>
            </tr>
            <tr style="border-top: 1px solid #ccc;">
                <th><i class="bi bi-envelope-fill me-2 text-success"></i>Email</th>
                <td>{{ $user->email }}</td>
            </tr>
            <tr style="border-top: 1px solid #ccc;">
                <th><i class="bi bi-telephone-fill me-2 text-success"></i>Telefon</th>
                <td>{{ $user->phone ?? 'Nu este adăugat' }}</td>
            </tr>
            <tr style="border-top: 1px solid #ccc; border-bottom: 1px solid #ccc;">
                <th><i class="bi bi-patch-check-fill me-2 text-success"></i>Status email</th>
                <td>
                    @if ($user->hasVerifiedEmail())
                        <span class="text-success">Verificat <i class="bi bi-check-circle-fill"></i></span>
                    @else
                        <span class="text-danger">Neverificat <i class="bi bi-x-circle-fill"></i></span>
                        <form method="POST" action="{{ route('email.resend') }}" class="d-inline ms-2">
                            @csrf
                            <button class="btn btn-sm btn-outline-success">Trimite link de verificare</button>
                        </form>
                    @endif
                </td>
            </tr>
            </tbody>
        </table>


        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editProfileModal">
            <i class="bi bi-pencil-square me-1"></i> Editează profilul
        </button>

    </div>
    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="border-radius: 16px; background-color: #fdfbf2;">
                <div class="modal-header" style="background-color: #d1eed9; border-top-left-radius: 16px; border-top-right-radius: 16px;">
                    <h5 class="modal-title text-success" id="editProfileModalLabel">
                        <i class="bi bi-pencil-square me-2"></i>Editează profilul
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Închide"></button>
                </div>

                <div class="modal-body px-4 pt-4 pb-2">
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        <table class="table table-borderless mb-0">
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
                                    <button type="button" class="btn btn-outline-success btn-sm" onclick="document.getElementById('password-reset-form').submit();">
                                        <i class="bi bi-envelope-lock me-1"></i> Trimite link de resetare
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                        <div class="text-center mt-4 mb-2">
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-save2-fill me-1"></i> Salvează modificările
                            </button>

                            <p class="mt-3 text-muted" style="font-size: 0.9rem;">
                                Asigură-te că informațiile sunt corecte înainte de salvare.
                            </p>
                        </div>
                    </form>

                    <form id="password-reset-form" action="{{ route('password.email') }}" method="POST" style="display: none;">
                        @csrf
                        <input type="hidden" name="email" value="{{ $user->email }}">
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
