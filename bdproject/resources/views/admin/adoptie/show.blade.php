@extends('layouts.admin')

@section('content')
    <div class="container py-4">
        <a href="{{ route('admin.adoptie') }}" class="btn btn-outline-light rounded-pill px-4 mb-4">Înapoi</a>

        <div class="card bg-dark text-light shadow-lg border-0 rounded-4 p-4">
            <h3 class="fw-bold text-center mb-5">Detalii cerere de adopție</h3>

            <div class="row mb-5 position-relative text-center justify-content-center">
                <div class="col-md-6 pe-md-4 d-flex flex-column align-items-center">
                    <h5 class="mb-4 text-info">
                        <i class="fas fa-user me-2"></i>Solicitant
                    </h5>
                    <p><strong>Nume:</strong> {{ $cerere->full_name }}</p>
                    <p><strong>Email:</strong> {{ $cerere->email }}</p>
                    <p><strong>Telefon:</strong> {{ $cerere->phone }}</p>
                    <p><strong>Adresă:</strong> {{ $cerere->address }}, {{ $cerere->city_state }}</p>
                    <p><strong>Ocupație:</strong> {{ $cerere->occupation }}</p>
                </div>

                <div class="col-md-6 ps-md-4 d-flex flex-column align-items-center border-start border-secondary">
                    <h5 class="mb-4 text-info">
                        <i class="fas fa-cat me-2"></i>Pisică
                    </h5>
                    @if($cerere->post && $cerere->post->cover_image)
                        <img src="{{ asset('storage/cover_images/' . $cerere->post->cover_image) }}"
                             class="rounded-circle mb-3 border border-secondary shadow-sm"
                             style="width: 120px; height: 120px; object-fit: cover;"
                             alt="Poza pisică">
                    @endif
                    <p><strong>Nume:</strong> {{ $cerere->post->title ?? 'Pisică inexistentă' }}</p>
                    <p><strong>Rasă:</strong> {{ $cerere->post->breed ?? '-' }}</p>
                    <p><strong>Vârstă:</strong> {{ $cerere->post->age ?? '-' }} ani</p>
                </div>
            </div>


            <hr class="text-secondary mb-4">

            <h5 class="text-info mb-3"><i class="fas fa-home me-2"></i>Informații despre Locuință</h5>
            <ul class="list-unstyled mb-4">
                <li><strong>Tip locuință:</strong> {{ ucfirst($cerere->housing_type) }}</li>
                <li><strong>Locuință în proprietate:</strong> {{ $cerere->is_owner ? 'Da' : 'Nu' }}</li>
                <li><strong>Chirie cu permisiune animale:</strong> {{ $cerere->rental_pet_permission ? 'Da' : 'Nu' }}</li>
                <li><strong>Spațiu sigur pentru pisică:</strong> {{ $cerere->secure_space ? 'Da' : 'Nu' }}</li>
                <li><strong>Alergii în locuință:</strong> {{ $cerere->household_allergy ? 'Da' : 'Nu' }}</li>
                <li><strong>Prezență acasă:</strong> {{ ucfirst($cerere->home_presence) }}</li>
            </ul>

            <hr class="text-secondary my-4">

            <h5 class="text-info mb-3"><i class="fas fa-paw me-2"></i>Experiență cu Animale</h5>
            <ul class="list-unstyled mb-4">
                <li><strong>A mai avut animale:</strong> {{ $cerere->had_pets_before ? 'Da' : 'Nu' }}</li>
                @if($cerere->past_pets_details)
                    <li><strong>Ce s-a întâmplat:</strong> {{ $cerere->past_pets_details }}</li>
                @endif
                <li><strong>Are alte animale:</strong> {{ $cerere->has_other_pets ? 'Da' : 'Nu' }}</li>
                @if($cerere->other_pets)
                    @php
                        $pets = json_decode($cerere->other_pets, true);
                        $dictionary = [
                            'dog' => 'câine',
                            'cat' => 'pisică',
                            'birds' => 'păsări',
                            'other' => 'alt animal'
                        ];
                        $translated = collect($pets)->map(function ($pet) use ($dictionary) {
                            return $dictionary[$pet] ?? $pet;
                        });
                    @endphp
                    <li><strong>Care sunt:</strong> {{ $translated->implode(', ') }}</li>
                @endif

            </ul>

            <hr class="text-secondary my-4">

            <h5 class="text-info mb-3"><i class="fas fa-question-circle me-2"></i>Motivația Adopției</h5>
            <ul class="list-unstyled mb-4">
                <li><strong>Motiv:</strong> {{ $cerere->adoption_reason }}</li>
                <li><strong>Înțelege costurile:</strong> {{ $cerere->understands_costs ? 'Da' : 'Nu' }}</li>
                <li><strong>A mai adoptat:</strong> {{ $cerere->previous_adoption ? 'Da' : 'Nu' }}</li>
                @if($cerere->previous_adoption_details)
                    <li><strong>Ce s-a întâmplat:</strong> {{ $cerere->previous_adoption_details }}</li>
                @endif
            </ul>

            <hr class="text-secondary my-4">

            <h5 class="text-info mb-3"><i class="fas fa-user-check me-2"></i>Responsabilități și Angajamente</h5>
            <ul class="list-unstyled mb-4">
                <li><strong>Îngrijire vacanțe:</strong> {{ $cerere->vacation_care }}</li>
                <li><strong>Plan în caz de renunțare:</strong> {{ $cerere->surrender_plan }}</li>
                <li><strong>Costuri veterinare:</strong> {{ $cerere->covers_vet_expenses ? 'Da' : 'Nu' }}</li>
                <li><strong>Colaborare cu specialist:</strong> {{ $cerere->willing_to_train ? 'Da' : 'Nu' }}</li>
            </ul>

            <hr class="text-secondary my-4">

            <h5 class="text-info mb-3"><i class="fas fa-file-signature me-2"></i>Consimțământ</h5>
            <ul class="list-unstyled mb-4">
                <li><strong>Vizite acasă:</strong> {{ $cerere->agrees_home_visits ? 'Da' : 'Nu' }}</li>
                <li><strong>Înțelege angajamentul:</strong> {{ $cerere->understands_commitment ? 'Da' : 'Nu' }}</li>
                <li><strong>A acceptat termenii:</strong> {{ $cerere->accepts_terms ? 'Da' : 'Nu' }}</li>
                @if($cerere->additional_info)
                    <li><strong>Informații suplimentare:</strong> {{ $cerere->additional_info }}</li>
                @endif
            </ul>

            <hr class="text-secondary my-4">

            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="mb-1"><strong>Data cererii:</strong> {{ $cerere->created_at->format('d-m-Y H:i') }}</p>
                    <p class="mb-1">
                        <strong>Status:</strong>
                        <span class="badge px-3 py-2 rounded-pill bg-{{ $cerere->application_status === 'approved' ? 'success' : ($cerere->application_status === 'rejected' ? 'danger' : 'warning') }}">
                            {{ ucfirst($cerere->application_status) }}
                        </span>
                    </p>
                    @if($cerere->application_status === 'rejected')
                        <p class="mt-2"><strong>Motiv respingere:</strong> {{ $cerere->rejection_reason }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
