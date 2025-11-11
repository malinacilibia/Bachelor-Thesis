@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center px-4 py-3 border-bottom border-dark">
        <div>
            <h4 class="text-white mb-0 fw-semibold">
                Cereri de Adopție
                <span class="small fw-normal text-white-50">| Gestionarea cererilor pentru adopție</span>
            </h4>
        </div>
        <div class="bg-dark rounded-3 px-3 py-1 small text-white-50">
            {{ now()->format('d M Y') }}
        </div>
    </div>

    <div class="container py-4">

        <div class="row">
            @foreach ($cereri as $cerere)
                @php
                    $status = strtolower($cerere->application_status);

                    if ($status === 'approved') {
                        $borderColor = 'border-success';
                        $statusTextClass = 'text-success';
                        $icon = '<i class="fas fa-check-circle text-success fs-4"></i>';
                    } elseif ($status === 'rejected') {
                        $borderColor = 'border-danger';
                        $statusTextClass = 'text-danger';
                        $icon = '<i class="fas fa-times-circle text-danger fs-4"></i>';
                    } else {
                        $borderColor = 'border-warning';
                        $statusTextClass = 'text-warning';
                        $icon = '<i class="fas fa-clock text-warning fs-4"></i>';
                    }
                @endphp

                <div class="col-md-6 col-xl-6 mb-4 position-relative">
                    <div class="card bg-dark text-light shadow-lg rounded-4 h-100 border {{ $borderColor }} p-4">

                        <div class="position-absolute top-0 end-0 mt-2 me-3">
                            {!! $icon !!}
                        </div>

                        <div class="row g-3 align-items-center">
                            <div class="col-md-8">
                                <h4 class="fw-bold text-info mb-3">{{ $cerere->post->title }}</h4>
                                <p class="mb-1"><strong>Rasă:</strong> {{ $cerere->post->breed }}</p>
                                <p class="mb-1"><strong>Vârstă:</strong> {{ $cerere->post->age }} </p>
                                <p class="mb-1"><strong>Sex:</strong> {{ $cerere->post->gender }}</p>
                                <p class="mb-3"><strong>Comportament:</strong> {{ $cerere->post->behavior }}</p>
                                <p class="mb-1"><strong>Utilizator:</strong> {{ $cerere->user->name }}</p>
                                <p class="mb-1"><strong>Email:</strong> {{ $cerere->user->email }}</p>
                                <p class="mb-1"><strong>Data cererii:</strong> {{ $cerere->created_at->format('d-m-Y H:i') }}</p>
                                <p class="mb-2"><strong>Status:</strong> <span class="{{ $statusTextClass }}">{{ ucfirst($cerere->application_status) }}</span></p>
                            </div>
                            <div class="col-md-4 text-end">
                                <img src="{{ asset('storage/cover_images/' . $cerere->post->cover_image) }}"
                                     alt="Poza pisică"
                                     class="rounded-circle border border-secondary"
                                     style="width: 130px; height: 130px; object-fit: cover;">
                            </div>
                        </div>

                        <hr class="text-secondary my-3">

                        @if ($status === 'pending')
                            <div class="d-flex flex-column gap-2">
                                <form action="{{ route('admin.adoptie.approve', $cerere->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-light rounded-pill w-100">
                                        Aprobă cererea
                                    </button>
                                </form>

                                <button class="btn btn-outline-light rounded-pill w-100" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#rejectForm-{{ $cerere->id }}">
                                    Respinge cererea
                                </button>

                                <div class="collapse mt-2" id="rejectForm-{{ $cerere->id }}">
                                    <form action="{{ route('admin.adoptie.reject', $cerere->id) }}" method="POST">
                                        @csrf
                                        <label class="form-label">Motiv respingere:</label>
                                        <textarea name="rejection_reason" rows="2"
                                                  class="form-control bg-light text-dark rounded-3 mb-2"
                                                  required>{{ old('rejection_reason', $cerere->rejection_reason) }}</textarea>
                                        <button type="submit" class="btn btn-outline-light rounded-pill w-100">
                                            Trimite respingerea
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <p class="text-muted text-center mt-3">Status finalizat – nu mai pot fi efectuate acțiuni.</p>
                        @endif

                        <a href="{{ route('admin.adoptie.show', $cerere->id) }}"
                           class="btn btn-outline-light rounded-pill mt-3 w-100">
                            Vezi Detalii
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
