@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="text-white mb-0">
                Povești de adopție
                <span class="bg-dark rounded-3 small text-white-50 ms-2 px-2 py-1">| Gestionarea poveștilor trimise de utilizatori</span>
            </h4>
            <div class="bg-dark rounded-3 px-3 py-1 small text-white-50">
                {{ now()->format('d M Y') }}
            </div>
        </div>


        <div class="row">
            @foreach ($stories as $story)
                @php
                    $status = strtolower($story->status);

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
                                <h4 class="fw-bold text-info mb-3">{{ $story->title }}</h4>
                                <p class="mb-2">{{ Str::limit($story->content, 150) }}</p>
                                <p class="mb-1"><strong>Utilizator:</strong> {{ $story->user->name }}</p>
                                <p class="mb-1"><strong>Email:</strong> {{ $story->user->email }}</p>
                                <p class="mb-1"><strong>Trimisă pe:</strong> {{ $story->created_at->format('d-m-Y H:i') }}</p>
                                <p class="mb-2"><strong>Status:</strong> <span class="{{ $statusTextClass }}">{{ ucfirst($story->status) }}</span></p>
                            </div>
                            <div class="col-md-4 text-end">
                                @if($story->image)
                                    <img src="{{ asset('storage/' . $story->image) }}"
                                         alt="Imagine poveste"
                                         class="rounded-circle border border-secondary"
                                         style="width: 130px; height: 130px; object-fit: cover;">
                                @endif
                            </div>
                        </div>

                        <hr class="text-secondary my-3">

                        @if ($status === 'pending')
                            <div class="d-flex flex-column gap-2">
                                <form action="{{ route('admin.stories.approve', $story->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-light rounded-pill w-100">
                                        Aprobă povestea
                                    </button>
                                </form>

                                <button class="btn btn-outline-light rounded-pill w-100" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#rejectForm-{{ $story->id }}">
                                    Respinge povestea
                                </button>

                                <div class="collapse mt-2" id="rejectForm-{{ $story->id }}">
                                    <form action="{{ route('admin.stories.reject', $story->id) }}" method="POST">
                                        @csrf
                                        <label class="form-label">Motiv respingere:</label>
                                        <textarea name="reject_reason" rows="2"
                                                  class="form-control bg-light text-dark rounded-3 mb-2"
                                                  required>{{ old('reject_reason') }}</textarea>
                                        <button type="submit" class="btn btn-outline-light rounded-pill w-100">
                                            Trimite respingerea
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <p class="text-muted text-center mt-3">Status finalizat – nu mai pot fi efectuate acțiuni.</p>
                        @endif

                        <a href="{{ route('admin.stories.show', $story->id) }}" class="btn btn-outline-light rounded-pill mt-3 w-100">
                            Vezi Detalii
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
