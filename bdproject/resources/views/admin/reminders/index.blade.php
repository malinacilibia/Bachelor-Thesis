@extends('layouts.admin')

@section('content')
   <div class="d-flex justify-content-between align-items-center px-4 py-3 border-bottom border-dark">
    <div>
        <h4 class="text-white mb-0 fw-semibold">
            Programări
            <span class="small fw-normal text-white-50">| Trimiterea notificarilor pentru programarile de maine -             <span class="small ">{{ \Carbon\Carbon::tomorrow()->format('l, d M Y') }}</span>
</span>
        </h4>
    </div>
    <div class="bg-dark rounded-3 px-3 py-1 small text-white-50">
        {{ now()->format('d M Y') }}
    </div>
    </div>



    @if($appointments->isEmpty())
        <div class="alert alert-info text-center">Nu există programări înregistrate pentru mâine.</div>
    @else
        <div class="row">
            @foreach($appointments as $appointment)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card bg-dark text-light shadow-lg rounded-3">
                        <div class="card-header text-center bg-dark">
                            <h5 class="mb-0 text-white">{{ $appointment->post->title ?? 'Pisică inexistentă' }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <strong>{{ $appointment->user->name ?? 'Utilizator inexistent' }}</strong><br>
                                    <span class="text-muted">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d-m-Y H:i') }}</span>
                                </div>
                                <img src="{{ asset('storage/cover_images/' . ($appointment->post->cover_image ?? 'default.jpg')) }}"
                                     alt="Pisică"
                                     class="rounded-circle border border-secondary"
                                     style="width: 80px; height: 80px; object-fit: cover;">
                            </div>
                            <p class="mb-2"><strong>Status:</strong>
                                <span class="badge
                                @if($appointment->status == 'approved') bg-success
                                @elseif($appointment->status == 'rejected') bg-danger
                                @else bg-warning @endif">
                                    {{ ucfirst($appointment->status) }}
                                </span>
                            </p>

                        </div>
                        <div class="card-footer text-center bg-dark">
                            <form action="{{ route('admin.reminders.send', $appointment->id) }}" method="POST">
                                @csrf
                                <button class="btn btn-outline-light rounded-pill w-100">Trimite Reminder</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection

@push('styles')
    <style>
        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        .card-header {
            border-bottom: 1px solid #5c5c5c;
        }

        .card-footer {
            background-color: #2c2c2c;
        }

        .btn-outline-light {
            background-color: #343a40;
            color: #fff;
            border-color: #5c5c5c;
        }

        .btn-outline-light:hover {
            background-color: #5c5c5c;
            color: #343a40;
        }

        .badge {
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
        }
    </style>
@endpush
