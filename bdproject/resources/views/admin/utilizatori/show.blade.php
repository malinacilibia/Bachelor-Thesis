@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="text-white mb-0">
                <i class="fas fa-user-circle me-2"></i> Detalii Utilizator
                <span class="bg-dark rounded-3 small text-white-50 ms-2 px-2 py-1">| Profil complet</span>
            </h4>
            <a href="{{ route('admin.utilizatori.index') }}" class="btn btn-outline-light">
                <i class="fas fa-arrow-left me-1"></i> Înapoi
            </a>
        </div>

        <div class="card bg-dark text-white shadow rounded-4 p-4 mb-4">
            <h5 class="text-info fw-bold mb-3"><i class="fas fa-user me-2"></i>Informații generale</h5>
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Nume:</strong> {{ $utilizator->name }}</p>
                    <p><strong>Email:</strong> {{ $utilizator->email }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Telefon:</strong> {{ $utilizator->phone ?? 'N/A' }}</p>
                    <p><strong>Înregistrat pe:</strong> {{ $utilizator->created_at->format('d-m-Y H:i') }}</p>
                </div>
            </div>
        </div>

        <div class="card bg-dark text-white shadow rounded-4 p-4 mb-4">
            <h5 class="text-warning fw-bold mb-3"><i class="fas fa-paw me-2"></i>Cereri de adopție</h5>
            @if ($utilizator->adoptionRequests->count())
                <div class="table-responsive">
                    <table class="table table-dark table-hover align-middle mb-0">
                        <thead class="text-uppercase text-info small border-bottom">
                        <tr>
                            <th>Pisică</th>
                            <th>Data cererii</th>
                            <th>Status</th>
                            <th>Acțiuni</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($utilizator->adoptionRequests as $cerere)
                            <tr class="border-bottom border-secondary">
                                <td>{{ $cerere->post->title ?? 'Pisică ștearsă' }}</td>
                                <td>{{ $cerere->created_at->format('d-m-Y H:i') }}</td>
                                <td>{{ ucfirst($cerere->application_status) }}</td>
                                <td>
                                    <a href="{{ route('admin.adoptie.show', $cerere->id) }}" class="btn btn-sm btn-outline-light">
                                        <i class="fas fa-eye me-1"></i> Vezi detalii
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-muted">Acest utilizator nu a făcut nicio cerere de adopție.</p>
            @endif
        </div>

        <div class="card bg-dark text-white shadow rounded-4 p-4 mb-4">
            <h5 class="text-primary fw-bold mb-3"><i class="fas fa-calendar-alt me-2"></i>Programări</h5>
            @if ($utilizator->appointments->count())
                <div class="table-responsive">
                    <table class="table table-dark table-hover align-middle mb-0">
                        <thead class="text-uppercase text-info small border-bottom">
                        <tr>
                            <th>Data</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($utilizator->appointments as $programare)
                            <tr class="border-bottom border-secondary">
                                <td>{{ \Carbon\Carbon::parse($programare->appointment_date)->format('d-m-Y H:i') }}</td>
                                <td>{{ ucfirst($programare->status) }}</td>
                                <td>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-muted">Acest utilizator nu are programări înregistrate.</p>
            @endif
        </div>

        <div class="card bg-dark text-white shadow rounded-4 p-4 mb-4">
            <h5 class="fw-bold mb-3" style="color: hotpink;"><i class="fas fa-heart me-2"></i>Povești de succes</h5>
            @if ($utilizator->stories->count())
                <ul class="list-group list-group-flush">
                    @foreach ($utilizator->stories as $poveste)
                        <li class="list-group-item bg-transparent border-bottom text-white d-flex justify-content-between align-items-center">
                            <span><strong>{{ $poveste->title }}</strong> - {{ Str::limit($poveste->content, 100) }}</span>
{{--                            <a href="{{ route('admin.povesti.show', $poveste->id) }}" class="btn btn-sm btn-outline-light">--}}
{{--                                <i class="fas fa-eye me-1"></i> Vezi detalii--}}
{{--                            </a>--}}
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-muted">Acest utilizator nu a publicat nicio poveste.</p>
            @endif
        </div>

        <div class="card bg-dark text-white shadow rounded-4 p-4 mb-5">
            <h5 class="text-success fw-bold mb-3"><i class="fas fa-hand-holding-heart me-2"></i>Donații</h5>
            @if ($utilizator->donations->count())
                <div class="table-responsive">
                    <table class="table table-dark table-hover align-middle mb-0">
                        <thead class="text-uppercase text-info small border-bottom">
                        <tr>
                            <th>Suma</th>
                            <th>Data</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($utilizator->donations as $donatie)
                            <tr class="border-bottom border-secondary">
                                <td>{{ $donatie->amount }} RON</td>
                                <td>{{ $donatie->created_at->format('d-m-Y H:i') }}</td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-muted">Acest utilizator nu a făcut nicio donație.</p>
            @endif
        </div>
    </div>
@endsection
