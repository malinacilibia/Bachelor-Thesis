@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center px-4 py-3 border-bottom border-dark">
        <div>
            <h4 class="text-white mb-0 fw-semibold">
                Programări
                <span class="small fw-normal text-white-50">| Gestionarea programărilor pentru adopție</span>
            </h4>
        </div>
        <div class="bg-dark rounded-3 px-3 py-1 small text-white-50">
            {{ now()->format('d M Y') }}
        </div>
    </div>

    <div class="text-end my-3 px-4">
        <a href="{{ route('admin.appointments.index') }}" class="btn btn-outline-light me-2 {{ request('completed') === null ? 'active' : '' }}">
            Toate
        </a>
        <a href="{{ route('admin.appointments.index', ['completed' => 0]) }}" class="btn btn-outline-light me-2 {{ request('completed') == '0' ? 'active' : '' }}">
            În curs
        </a>
        <a href="{{ route('admin.appointments.index', ['completed' => 1]) }}" class="btn btn-outline-light {{ request('completed') == '1' ? 'active' : '' }}">
            Finalizate
        </a>
    </div>

    @if($appointments->isEmpty())
            <div class="alert alert-info text-center">Nu există programări înregistrate.</div>
        @else
            <div class="row">
                @foreach($appointments as $appointment)
                    @php
                        $status = strtolower($appointment->status);
                        $borderColor = $status === 'approved' ? 'border-success' : ($status === 'rejected' ? 'border-danger' : 'border-warning');
                        $statusTextClass = $status === 'approved' ? 'text-success' : ($status === 'rejected' ? 'text-danger' : 'text-warning');
                        $icon = $status === 'approved'
                            ? '<i class="fas fa-check-circle text-success fs-4"></i>'
                            : ($status === 'rejected'
                                ? '<i class="fas fa-times-circle text-danger fs-4"></i>'
                                : '<i class="fas fa-clock text-warning fs-4"></i>');
                    @endphp

                    <div class="col-md-6 col-xl-6 mb-4 position-relative">
                        <div class="card bg-dark text-light shadow-lg rounded-4 h-100 border {{ $borderColor }} p-4 position-relative">

                            @if($appointment->post->adopted)
                                <div class="ribbon"><span>Adoptată</span></div>
                            @endif

                            <div class="position-absolute top-0 end-0 mt-2 me-3">
                                {!! $icon !!}
                            </div>

                            <div class="row g-3 align-items-center">
                                <div class="col-md-8">
                                    <h4 class="fw-bold text-info mb-3">{{ $appointment->post->title ?? 'Pisică inexistentă' }}</h4>
                                    <p class="mb-1"><strong>Utilizator:</strong> {{ $appointment->user->name ?? 'Utilizator inexistent' }}</p>
                                    <p class="mb-1"><strong>Data programării:</strong> {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d-m-Y H:i') }}</p>
                                    <p class="mb-2"><strong>Status:</strong> <span class="{{ $statusTextClass }}">{{ ucfirst($appointment->status) }}</span></p>
                                </div>
                                <div class="col-md-4 text-end">
                                    <img src="{{ asset('storage/cover_images/' . ($appointment->post->cover_image ?? 'default.jpg')) }}"
                                         alt="Pisică"
                                         class="rounded-circle border border-secondary"
                                         style="width: 110px; height: 110px; object-fit: cover;">
                                </div>
                            </div>

                            <hr class="text-secondary my-3">

                            <p class="mb-2"><strong>Feedback vizită:</strong>
                                @if($appointment->visit_feedback)
                                    {{ $appointment->visit_feedback }}
                                @else
                                    <span class="text-muted">În așteptare</span>
                                @endif
                            </p>

                            @if($status === 'rejected')
                                <p class="text-danger"><strong>Motiv respingere:</strong> {{ $appointment->rejection_reason ?? '-' }}</p>
                            @endif

                            <div class="d-flex flex-column gap-2 mt-3">
                                @if($status === 'pending')
                                    <form action="{{ route('admin.appointments.approve', $appointment->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-light rounded-pill w-100">Aprobă</button>
                                    </form>

                                    <button class="btn btn-outline-light rounded-pill w-100" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#rejectForm-{{ $appointment->id }}">
                                        Respinge
                                    </button>

                                    <div class="collapse mt-2" id="rejectForm-{{ $appointment->id }}">
                                        <form action="{{ route('admin.appointments.reject', $appointment->id) }}" method="POST">
                                            @csrf
                                            <label class="form-label">Motiv respingere:</label>
                                            <textarea name="rejection_reason"
                                                      class="form-control bg-light text-dark rounded-3 mb-2"
                                                      rows="2" required></textarea>
                                            <button type="submit" class="btn btn-outline-light rounded-pill w-100">Trimite respingerea</button>
                                        </form>
                                    </div>
                                @endif

                                @if($status === 'approved')
                                    <button class="btn btn-outline-light rounded-pill w-100" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#feedbackForm-{{ $appointment->id }}">
                                        Adaugă feedback
                                    </button>

                                    <div class="collapse mt-2" id="feedbackForm-{{ $appointment->id }}">
                                        <form method="POST" action="{{ route('admin.appointments.feedback', $appointment->id) }}">
                                            @csrf
                                            <textarea name="visit_feedback"
                                                      class="form-control bg-light text-dark rounded-3 mb-2"
                                                      rows="2">{{ $appointment->visit_feedback }}</textarea>
                                            <button type="submit" class="btn btn-outline-light rounded-pill w-100">Salvează feedback</button>
                                        </form>
                                    </div>

                                    @if(!$appointment->post->adopted)
                                        <form method="POST" action="{{ route('admin.appointments.adopted', $appointment->post->id) }}"
                                              id="adoptForm-{{ $appointment->id }}">
                                            @csrf
                                            <button type="button"
                                                    class="btn btn-outline-success rounded-pill w-100 mt-3"
                                                    onclick="confirmAdoption({{ $appointment->id }})">
                                                <i class="fas fa-paw me-2"></i> Marchează ca adoptată
                                            </button>
                                        </form>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-light rounded-pill mt-4 px-4">Înapoi la Dashboard</a>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmAdoption(id) {
            Swal.fire({
                title: 'Confirmare adoptare',
                text: 'Ești sigur că această pisică a fost adoptată?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Da, marchează',
                cancelButtonText: 'Anulează',
                background: '#1f1f1f',
                color: '#fff',
                confirmButtonColor: '#5eb489',
                cancelButtonColor: '#555',
                customClass: {
                    popup: 'rounded-4 shadow',
                    confirmButton: 'px-4 py-2',
                    cancelButton: 'px-4 py-2'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('adoptForm-' + id).submit();
                }
            });
        }
    </script>
@endpush
@push('styles')
    <style>
        .ribbon {
            width: 150px;
            height: 150px;
            overflow: hidden;
            position: absolute;
            top: -10px;
            right: -10px;
            z-index: 3;
        }

        .ribbon span {
            position: absolute;
            display: block;
            width: 200px;
            padding: 10px 0;
            background-color: #5eb489;
            color: white;
            text-align: center;
            font-weight: bold;
            transform: rotate(45deg);
            top: 30px;
            right: -45px;
            font-size: 14px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.3);
        }
    </style>
@endpush

