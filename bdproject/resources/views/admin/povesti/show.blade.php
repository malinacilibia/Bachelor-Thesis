@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="text-white mb-0">
                 Povestea de adopție
                <span class="bg-dark rounded-3 small text-white-50 ms-2 px-2 py-1">| Detalii complete</span>
            </h4>
            <a href="{{ route('admin.stories') }}" class="btn btn-outline-light">
                <i class="fas fa-arrow-left me-1"></i> Înapoi
            </a>
        </div>

        <div class="card bg-dark text-white shadow-lg rounded-4 p-4 mb-5 border border-info">
            <div class="row g-4">
                <div class="col-md-5">
                    @if ($story->image)
                        <img src="{{ asset('storage/' . $story->image) }}"
                             class="rounded-4 w-100 h-auto"
                             style="object-fit: cover; max-height: 300px;"
                             alt="Poză poveste">
                    @else
                        <div class="text-center text-muted fst-italic">
                            Fără imagine atașată
                        </div>
                    @endif
                </div>
                <div class="col-md-7">
                    <h4 class="text-info fw-bold mb-3"><i class="fas fa-heart me-2"></i>{{ $story->title }}</h4>

                    <p><strong>Conținut:</strong><br>{{ $story->content }}</p>
                    <p><strong>Utilizator:</strong> {{ $story->user->name }} ({{ $story->user->email }})</p>
                    <p><strong>Status:</strong>
                        <span class="badge bg-{{ $story->status == 'approved' ? 'success' : ($story->status == 'rejected' ? 'danger' : 'warning') }}">
                            {{ ucfirst($story->status) }}
                        </span>
                    </p>
                    <p><strong>Creată la:</strong> {{ $story->created_at->format('d-m-Y H:i') }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
