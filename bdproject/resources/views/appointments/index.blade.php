@extends('layouts.app')

@section('content')
    <div class="w-100 py-5 text-center text-white" style="background-color: #88aa88;">
        <h2 class="fw-bold display-6">Programările mele</h2>
    </div>

    <div class="w-100 text-center py-4 mb-5" style="background-color: #f1f6f1;">
        <p class="text-muted fs-5 mx-auto" style="max-width: 900px;">
            Mai jos sunt afișate toate programările tale pentru întâlnirile cu pisicile pe care dorești să le adopți. Verifică detalii, statusul și feedback-ul. 🐾
        </p>
    </div>

    <div class="container pb-4" style="margin-top: 100px;">
        @php
            $activeAppointments = $appointments->filter(function ($appointment) {
                return $appointment->status !== 'rejected' ||
                    !App\Models\Appointment::where('user_id', auth()->id())
                        ->where('post_id', $appointment->post_id)
                        ->where('status', 'pending')
                        ->exists();
            });
        @endphp

        @if($activeAppointments->isEmpty())
            <div class="container my-5" style="margin-bottom: 50px;">
                <div class="card shadow-sm border-0 text-center" style="background-color: #f1f6f1;margin-bottom: 200px;">
                    <div class="card-body py-5">
                        <h5 class="card-title fw-bold text-dark mb-3">Nu ai nicio programare momentan</h5>
                        <p class="card-text text-muted mb-4" style="max-width: 700px; margin: auto;">
                            Nu ai programat încă nicio întâlnire cu o pisică, dar poți face asta oricând. Caută o pisică pe gustul tău și fă primul pas spre o nouă prietenie blănoasă. 🐾
                        </p>
                        <a href="{{ route('posts.index') }}" class="btn btn-success">
                            Vezi toate pisicile
                        </a>
                    </div>
                </div>
            </div>
        @else
            @foreach($activeAppointments as $appointment)
                <div class="row justify-content-center align-items-start mb-5">
                    <div class="col-auto text-center">
                        @if($appointment->post && $appointment->post->cover_image)
                            <img src="{{ asset('storage/cover_images/' . $appointment->post->cover_image) }}"
                                 alt="Cat Image" class="rounded-circle shadow" width="120" height="120"
                                 style="object-fit: cover;">
                        @else
                            <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center shadow"
                                 style="width:120px; height:120px; color:white;">
                                Fără poză
                            </div>
                        @endif
                    </div>

                    <div class="col-md-8 d-flex">
                        <div class="flex-grow-1 pe-4 border-end">
                            <h4 class="text-dark fw-semibold mb-3">{{ $appointment->post ? $appointment->post->title : 'Pisică inexistentă' }}</h4>

                            <div class="mb-2 d-flex align-items-center">
                                <div class="me-2 fw-semibold">📅 Data programării:</div>
                                <div>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d-m-Y H:i') }}</div>
                            </div>
                        </div>

                        <div class="ps-4 d-flex flex-column justify-content-start" style="min-width: 240px;">
                            <div class="mb-2 d-flex align-items-center">
                                <div class="me-2 fw-semibold">Status:</div>
                                <span class="badge px-3 py-2 fs-6 rounded-pill"
                                      style="background-color:
                                        {{ $appointment->status == 'pending' ? '#f2d694' :
                                           ($appointment->status == 'approved' ? '#a3ddaa' : '#f7a9a9') }};
                                        color: #333;">
                                    {{ ucfirst($appointment->status) }}
                                </span>
                            </div>

                            @if($appointment->status == 'rejected' && $appointment->rejection_reason)
                                <div class="mb-2 text-danger small">
                                    <strong>Motiv:</strong> {{ $appointment->rejection_reason }}
                                </div>
                            @endif

                            <div class="mb-2">
                                <strong>Feedback:</strong>
                                @if($appointment->visit_feedback)
                                    {{ $appointment->visit_feedback }}
                                @else
                                    <span class="text-muted">În așteptare</span>
                                @endif
                            </div>

                            @if($appointment->status == 'rejected')
                                <div class="mb-2">
                                    <a href="{{ route('appointments.create', ['post_id' => $appointment->post_id]) }}"
                                       class="btn btn-outline-success btn-sm w-100">
                                        <i class="fas fa-calendar-alt"></i> Reprogramează
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <hr class="my-4">
            @endforeach
        @endif
    </div>
@endsection
