@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        {{-- Breadcrumb bar --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="text-white mb-0">
                <i class="fas fa-users me-2"></i> Utilizatori
                <span class="bg-dark rounded-3 small text-white-50 ms-2 px-2 py-1">
                | Management conturi
            </span>
            </h4>
            <div class="bg-dark rounded-3 px-3 py-1 small text-white-50">
                {{ now()->format('d M Y') }}
            </div>
        </div>
    </div>

    <div class="container py-4">
        <!-- Titlu și acțiuni -->
        <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
            <h2 class="fw-bold mb-3 mb-md-0 text-dark">Gestionare Utilizatori</h2>
            <form method="GET" action="{{ route('admin.utilizatori.index') }}" class="d-flex w-100 w-md-auto">
                <input type="text" name="search" class="form-control bg-light border-0 rounded-start-pill px-4 shadow-sm"
                       placeholder="Caută după nume, email sau ID..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-outline-primary rounded-end-pill px-4 shadow-sm">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>

        <!-- Tabel utilizatori -->
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-dark table-hover align-middle mb-0">
                        <thead class="text-uppercase text-info small border-bottom">
                        <tr>
                            <th>ID</th>
                            <th>Nume</th>
                            <th>Email</th>
                            <th>Telefon</th>
                            <th>Înregistrat</th>
                            <th>Cereri</th>
                            <th>Programări</th>
                            <th>Povești</th>
                            <th class="text-end pe-3">Acțiuni</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($utilizatori as $utilizator)
                            <tr class="border-bottom border-secondary">
                                <td class="fw-semibold">{{ $utilizator->id }}</td>
                                <td>{{ $utilizator->name }}</td>
                                <td>{{ $utilizator->email }}</td>
                                <td>{{ $utilizator->phone ?? 'N/A' }}</td>
                                <td>{{ $utilizator->created_at->format('d-m-Y H:i') }}</td>
                                <td>{{ $utilizator->adoption_requests_count }}</td>
                                <td>{{ $utilizator->appointments_count }}</td>
                                <td>{{ $utilizator->stories_count }}</td>
                                <td class="text-end pe-3">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end shadow-sm">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('admin.utilizatori.show', $utilizator->id) }}">
                                                    <i class="fas fa-user-circle me-2 text-info"></i> Detalii
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>

@endsection
