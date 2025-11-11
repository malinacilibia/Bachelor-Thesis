@extends('layouts.app')

@section('content')
    <div class="w-100 py-5 text-center text-white"
         style="background-color: #88aa88; ">
        <h2 class="fw-bold display-6">Cererile mele de adopție</h2>
    </div>

    <div class="w-100 text-center py-4 mb-5" style="background-color: #f1f6f1;">
        <p class="text-muted fs-5 mx-auto" style="max-width: 900px;">
            Mai jos sunt afișate toate cererile tale de adopție. Poți verifica statusul lor, data la care le-ai trimis,
            dar și detaliile complete ale fiecărei cereri. Dacă cererea este aprobată, poți merge mai departe și
            să îți programezi întâlnirea cu pisica aleasă. Fiecare pas te aduce mai aproape de o nouă prietenă felină.
        </p>
    </div>

    <div class="container pb-4">
        @if(count($adoptionRequests) > 0)
            @foreach($adoptionRequests as $request)
                <div class="row justify-content-center align-items-start mb-5">
                    <div class="col-auto text-center">
                        @if($request->post && $request->post->cover_image)
                            <img src="{{ asset('storage/cover_images/' . $request->post->cover_image) }}"
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
                            <h4 class="text-dark fw-semibold mb-3">{{ $request->post ? $request->post->title : 'Pisică inexistentă' }}</h4>

                            <div class="mb-3 d-flex align-items-center">
                                <div class="me-2 fw-semibold">📅 Data trimiterii:</div>
                                <div>{{ $request->created_at->format('d-m-Y') }}</div>
                            </div>
                        </div>

                        <div class="ps-4 d-flex flex-column justify-content-start" style="min-width: 240px;">
                            <div class="mb-2 d-flex align-items-center">
                                <span class="fw-semibold me-2">Status:</span>
                                <span class="badge px-3 py-2 fs-6 rounded-pill text-center"
                                      style="background-color:
                {{ $request->application_status == 'pending' ? '#f2d694' :
                   ($request->application_status == 'approved' ? '#a3ddaa' : '#f7a9a9') }};
                   color: #333;">
            {{ ucfirst($request->application_status) }}
        </span>
                            </div>

                            @if($request->application_status == 'rejected' && !empty($request->rejection_reason))
                                <div class="mb-2 text-danger small">
                                    <strong>Motiv:</strong> {{ $request->rejection_reason }}
                                </div>
                            @endif

                            <button type="button" class="btn btn-outline-success btn-sm w-100" data-bs-toggle="modal" data-bs-target="#adoptionModal{{ $request->id }}">
                                <i class="fas fa-eye"></i> Vezi detalii
                            </button>


                            <div class="mb-2">
                                @if($request->application_status == 'approved')
                                    @php
                                        $appointmentExists = \App\Models\Appointment::where('user_id', auth()->id())
                                            ->where('post_id', $request->post_id)
                                            ->exists();
                                    @endphp

                                    @if($appointmentExists)
                                        <span class="text-success fw-semibold">✔ Programarea a fost făcută</span>
                                    @else
                                        <a href="{{ route('appointments.create', ['post_id' => $request->post_id]) }}"
                                           class="btn btn-outline-success btn-sm w-100">
                                            <i class="fas fa-calendar-alt"></i> Programează-te
                                        </a>
                                    @endif
                                @else
                                    <span class="text-muted small">⏳ Așteaptă aprobarea</span>
                                @endif
                            </div>
                        </div>

                    </div>
                    <div class="modal fade" id="adoptionModal{{ $request->id }}" tabindex="-1" aria-labelledby="adoptionModalLabel{{ $request->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content border-0 rounded-4 p-4" style="background-color: #f6f5e9;">
                                <button type="button" class="btn-close position-absolute end-0 top-0 m-3" data-bs-dismiss="modal" aria-label="Închide"></button>

                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-5 text-center d-flex flex-column justify-content-center align-items-center px-4">
                                            @if($request->post && $request->post->cover_image)
                                                <img src="{{ asset('storage/cover_images/' . $request->post->cover_image) }}"
                                                     alt="Pisică"
                                                     class="rounded-circle shadow mb-3"
                                                     style="width: 120px; height: 120px; object-fit: cover;">
                                            @endif
                                            <h5 class="fw-bold">Cererea pentru:</h5>
                                            <h4 class="text-success">{{ $request->post ? $request->post->title : 'Pisică inexistentă' }}</h4>
                                        </div>

                                        <div class="col-md-1 d-flex justify-content-center">
                                            <div style="width: 2px; background-color: #ccc; height: 100%;"></div>
                                        </div>

                                        <div class="col-md-6">
                                            <div id="adoptionCarousel{{ $request->id }}" class="carousel slide" data-bs-ride="false" data-bs-interval="false">
                                                <div class="carousel-inner text-center">

                                                    <div class="carousel-item active">
                                                        <div class="carousel-slide-content">
                                                            <h5 class="fw-bold mb-3">📌 Date Personale</h5>
                                                            <p><strong>Nume:</strong> {{ $request->full_name }}</p>
                                                            <p><strong>Email:</strong> {{ $request->email }}</p>
                                                            <p><strong>Telefon:</strong> {{ $request->phone }}</p>
                                                            <p><strong>Adresă:</strong> {{ $request->address }}</p>
                                                            <p><strong>Oraș și județ:</strong> {{ $request->city_state }}</p>
                                                            <p><strong>Ocupație:</strong> {{ $request->occupation }}</p>
                                                        </div>
                                                    </div>

                                                    <div class="carousel-item">
                                                        <div class="carousel-slide-content">
                                                            <h5 class="fw-bold mb-3">🏡 Locuință</h5>
                                                            <p><strong>Tip:</strong> {{ ucfirst($request->housing_type) }}</p>
                                                            <p><strong>Proprietate:</strong> {{ $request->is_owner ? 'Da' : 'Nu' }}</p>
                                                            <p><strong>Permisiune animale:</strong> {{ $request->rental_pet_permission ? 'Da' : 'Nu' }}</p>
                                                            <p><strong>Spațiu sigur:</strong> {{ $request->secure_space ? 'Da' : 'Nu' }}</p>
                                                            <p><strong>Alergii:</strong> {{ $request->household_allergy ? 'Da' : 'Nu' }}</p>
                                                            <p><strong>Prezență acasă:</strong> {{ ucfirst($request->home_presence) }}</p>
                                                        </div>
                                                    </div>

                                                    <div class="carousel-item">
                                                        <div class="carousel-slide-content">
                                                            <h5 class="fw-bold mb-3">🐾 Experiență cu Animale</h5>
                                                            <p><strong>Ai mai avut animale?</strong> {{ $request->had_pets_before ? 'Da' : 'Nu' }}</p>
                                                            @if($request->past_pets_details)
                                                                <p><strong>Ce s-a întâmplat cu ele?</strong> {{ $request->past_pets_details }}</p>
                                                            @endif
                                                            <p><strong>Ai alte animale?</strong> {{ $request->has_other_pets ? 'Da' : 'Nu' }}</p>
                                                            @if($request->other_pets)
                                                                @php
                                                                    $pets = json_decode($request->other_pets, true);
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

                                                                <p><strong>Care sunt acestea?</strong> {{ $translated->implode(', ') }}</p>

                                                            @endif

                                                        </div>
                                                    </div>

                                                    <div class="carousel-item">
                                                        <div class="carousel-slide-content">
                                                            <h5 class="fw-bold mb-3">❤️ Motivația Adopției</h5>
                                                            <p><strong>De ce vrei să adopți o pisică?</strong> {{ $request->adoption_reason }}</p>
                                                            <p><strong>Cunoști costurile?</strong> {{ $request->understands_costs ? 'Da' : 'Nu' }}</p>
                                                            <p><strong>Ai mai adoptat?</strong> {{ $request->previous_adoption ? 'Da' : 'Nu' }}</p>
                                                            @if($request->previous_adoption_details)
                                                                <p><strong>Ce s-a întâmplat cu ea?</strong> {{ $request->previous_adoption_details }}</p>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="carousel-item">
                                                        <div class="carousel-slide-content">
                                                            <h5 class="fw-bold mb-3">✅ Responsabilități</h5>
                                                            <p><strong>Grijă în vacanțe:</strong> {{ $request->vacation_care }}</p>
                                                            <p><strong>Dacă renunți?</strong> {{ $request->surrender_plan }}</p>
                                                            <p><strong>Costuri veterinare?</strong> {{ $request->covers_vet_expenses ? 'Da' : 'Nu' }}</p>
                                                            <p><strong>Lucrezi cu specialist?</strong> {{ $request->willing_to_train ? 'Da' : 'Nu' }}</p>
                                                        </div>
                                                    </div>

                                                    <div class="carousel-item">
                                                        <div class="carousel-slide-content">
                                                            <h5 class="fw-bold mb-3">🗒️ Consimțământ</h5>
                                                            <p><strong>Accepți vizite?</strong> {{ $request->agrees_home_visits ? 'Da' : 'Nu' }}</p>
                                                            <p><strong>Angajament pe termen lung?</strong> {{ $request->understands_commitment ? 'Da' : 'Nu' }}</p>
                                                            <p><strong>Termeni acceptați?</strong> {{ $request->accepts_terms ? 'Da' : 'Nu' }}</p>
                                                            @if($request->additional_info)
                                                                <p><strong>Info suplimentare:</strong> {{ $request->additional_info }}</p>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="carousel-item">
                                                        <div class="carousel-slide-content">
                                                            <h5 class="fw-bold mb-3">🗓️ Status Cerere</h5>
                                                            <p><strong>Data cererii:</strong> {{ $request->created_at->format('d-m-Y') }}</p>
                                                            <p><strong>Status:</strong>
                                                                <span class="badge px-3 py-2 rounded-pill text-dark"
                                                                      style="background-color:
                                                  {{ $request->application_status == 'pending' ? '#f2d694' :
                                                     ($request->application_status == 'approved' ? '#a3ddaa' : '#f7a9a9') }};">
                                                {{ ucfirst($request->application_status) }}
                                            </span>
                                                            </p>
                                                            @if($request->application_status == 'rejected')
                                                                <p><strong>Motiv respingere:</strong> {{ $request->rejection_reason }}</p>
                                                            @endif
                                                        </div>
                                                    </div>

                                                </div>

                                                <button class="carousel-control-prev" type="button" data-bs-target="#adoptionCarousel{{ $request->id }}" data-bs-slide="prev">
                                                    <span class="carousel-control-prev-icon bg-success rounded-circle"></span>
                                                    <span class="visually-hidden">Anterior</span>
                                                </button>
                                                <button class="carousel-control-next" type="button" data-bs-target="#adoptionCarousel{{ $request->id }}" data-bs-slide="next">
                                                    <span class="carousel-control-next-icon bg-success rounded-circle"></span>
                                                    <span class="visually-hidden">Următor</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">
            @endforeach
        @else
            <div class="container my-5" style="margin-bottom: 50px;">
                <div class="card shadow-sm border-0 text-center" style="background-color: #f1f6f1;margin-bottom: 200px;">
                    <div class="card-body py-5">
                        <h5 class="card-title fw-bold text-dark mb-3">Nu ai nicio cerere de adopție momentan</h5>
                        <p class="card-text text-muted mb-4" style="max-width: 700px; margin: auto;">
                            Nu ai trimis încă nicio cerere de adopție, dar nu este prea târziu să-ți găsești sufletul blănos pereche.
                            Aruncă o privire peste pisicile noastre disponibile și lasă-ți inima să aleagă.
                        </p>
                        <a href="{{ route('posts.index') }}" class="btn btn-success">
                            Vezi toate pisicile
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
                @push('styles')
                    <style>
                        .carousel-slide-content {
                            padding: 20px;
                            color: #333;
                        }
                    </style>
    @endpush

