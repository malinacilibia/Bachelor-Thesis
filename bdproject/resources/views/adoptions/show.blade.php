{{--@extends('layouts.app')--}}

{{--@section('content')--}}
{{--    <div class="w-100 py-5 text-center text-white" style="background-color: #88aa88;">--}}
{{--        <h2 class="fw-bold mb-4">Cererea ta de adopție pentru:</h2>--}}

{{--        @if($adoptionRequest->post && $adoptionRequest->post->cover_image)--}}
{{--            <img src="{{ asset('storage/cover_images/' . $adoptionRequest->post->cover_image) }}"--}}
{{--                 alt="Pisicuță"--}}
{{--                 class="rounded-circle shadow"--}}
{{--                 style="width: 120px; height: 120px; object-fit: cover; border: 4px solid white;">--}}
{{--        @else--}}
{{--            <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center"--}}
{{--                 style="width: 120px; height: 120px; color: white; margin: auto;">--}}
{{--                Fără poză--}}
{{--            </div>--}}
{{--        @endif--}}

{{--        <h4 class="fw-bold mt-3 text-white">--}}
{{--            {{ $adoptionRequest->post ? $adoptionRequest->post->title : 'Pisică inexistentă' }}--}}
{{--        </h4>--}}
{{--    </div>--}}

{{--    <div class="container my-5">--}}
{{--        <div class="big-card shadow p-4 mx-auto">--}}

{{--            <div id="adoptionCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="7000">--}}
{{--                <div class="carousel-inner">--}}

{{--                    <div class="carousel-item active">--}}
{{--                        <div class="carousel-slide-content">--}}
{{--                            <h5 class="fw-bold mb-3">📌 Date Personale</h5>--}}
{{--                            <p><strong>Nume solicitant:</strong> {{ $adoptionRequest->full_name }}</p>--}}
{{--                            <p><strong>Email:</strong> {{ $adoptionRequest->email }}</p>--}}
{{--                            <p><strong>Telefon:</strong> {{ $adoptionRequest->phone }}</p>--}}
{{--                            <p><strong>Adresă:</strong> {{ $adoptionRequest->address }}</p>--}}
{{--                            <p><strong>Oraș și județ:</strong> {{ $adoptionRequest->city_state }}</p>--}}
{{--                            <p><strong>Ocupație:</strong> {{ $adoptionRequest->occupation }}</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="carousel-item">--}}
{{--                        <div class="carousel-slide-content">--}}
{{--                            <h5 class="fw-bold mb-3">🏡 Informații despre Locuință</h5>--}}
{{--                            <p><strong>Tip locuință:</strong> {{ ucfirst($adoptionRequest->housing_type) }}</p>--}}
{{--                            <p><strong>Este locuința în proprietatea ta?</strong> {{ $adoptionRequest->is_owner ? 'Da' : 'Nu' }}</p>--}}
{{--                            <p><strong>Proprietarul permite animale?</strong> {{ $adoptionRequest->rental_pet_permission ? 'Da' : 'Nu' }}</p>--}}
{{--                            <p><strong>Locuința are spațiu sigur pentru pisică?</strong> {{ $adoptionRequest->secure_space ? 'Da' : 'Nu' }}</p>--}}
{{--                            <p><strong>Alergii în casă?</strong> {{ $adoptionRequest->household_allergy ? 'Da' : 'Nu' }}</p>--}}
{{--                            <p><strong>Cât de des este cineva acasă?</strong> {{ ucfirst($adoptionRequest->home_presence) }}</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="carousel-item">--}}
{{--                        <div class="carousel-slide-content">--}}
{{--                            <h5 class="fw-bold mb-3">🐾 Experiență cu Animale</h5>--}}
{{--                            <p><strong>Ai mai avut animale?</strong> {{ $adoptionRequest->had_pets_before ? 'Da' : 'Nu' }}</p>--}}
{{--                            @if($adoptionRequest->past_pets_details)--}}
{{--                                <p><strong>Ce s-a întâmplat cu ele?</strong> {{ $adoptionRequest->past_pets_details }}</p>--}}
{{--                            @endif--}}
{{--                            <p><strong>Ai alte animale?</strong> {{ $adoptionRequest->has_other_pets ? 'Da' : 'Nu' }}</p>--}}
{{--                            @if($adoptionRequest->other_pets)--}}
{{--                                <p><strong>Care sunt acestea?</strong> {{ implode(', ', json_decode($adoptionRequest->other_pets, true)) }}</p>--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="carousel-item">--}}
{{--                        <div class="carousel-slide-content">--}}
{{--                            <h5 class="fw-bold mb-3">❤️ Motivația Adopției</h5>--}}
{{--                            <p><strong>De ce vrei să adopți o pisică?</strong> {{ $adoptionRequest->adoption_reason }}</p>--}}
{{--                            <p><strong>Cunoști costurile?</strong> {{ $adoptionRequest->understands_costs ? 'Da' : 'Nu' }}</p>--}}
{{--                            <p><strong>Ai mai adoptat?</strong> {{ $adoptionRequest->previous_adoption ? 'Da' : 'Nu' }}</p>--}}
{{--                            @if($adoptionRequest->previous_adoption_details)--}}
{{--                                <p><strong>Ce s-a întâmplat cu ea?</strong> {{ $adoptionRequest->previous_adoption_details }}</p>--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="carousel-item">--}}
{{--                        <div class="carousel-slide-content">--}}
{{--                            <h5 class="fw-bold mb-3">✅ Responsabilități</h5>--}}
{{--                            <p><strong>Cine are grijă în vacanțe?</strong> {{ $adoptionRequest->vacation_care }}</p>--}}
{{--                            <p><strong>Dacă renunți, ce faci?</strong> {{ $adoptionRequest->surrender_plan }}</p>--}}
{{--                            <p><strong>Acoperi costuri veterinare?</strong> {{ $adoptionRequest->covers_vet_expenses ? 'Da' : 'Nu' }}</p>--}}
{{--                            <p><strong>Vei lucra cu specialist?</strong> {{ $adoptionRequest->willing_to_train ? 'Da' : 'Nu' }}</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="carousel-item">--}}
{{--                        <div class="carousel-slide-content">--}}
{{--                            <h5 class="fw-bold mb-3">🗒️ Consimțământ</h5>--}}
{{--                            <p><strong>Accepți vizite de verificare?</strong> {{ $adoptionRequest->agrees_home_visits ? 'Da' : 'Nu' }}</p>--}}
{{--                            <p><strong>Angajament pe termen lung?</strong> {{ $adoptionRequest->understands_commitment ? 'Da' : 'Nu' }}</p>--}}
{{--                            <p><strong>Ai acceptat termenii?</strong> {{ $adoptionRequest->accepts_terms ? 'Da' : 'Nu' }}</p>--}}
{{--                            @if($adoptionRequest->additional_info)--}}
{{--                                <p><strong>Informații suplimentare:</strong> {{ $adoptionRequest->additional_info }}</p>--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="carousel-item">--}}
{{--                        <div class="carousel-slide-content">--}}
{{--                            <h5 class="fw-bold mb-3">🗓️ Status Cerere</h5>--}}
{{--                            <p><strong>Data cererii:</strong> {{ $adoptionRequest->created_at->format('d-m-Y') }}</p>--}}
{{--                            <p><strong>Status:</strong>--}}
{{--                                <span class="badge px-3 py-2 fs-6 rounded-pill"--}}
{{--                                      style="background-color:--}}
{{--                                        {{ $adoptionRequest->application_status == 'pending' ? '#f2d694' :--}}
{{--                                           ($adoptionRequest->application_status == 'approved' ? '#a3ddaa' : '#f7a9a9') }};">--}}
{{--                                    {{ ucfirst($adoptionRequest->application_status) }}--}}
{{--                                </span>--}}
{{--                            </p>--}}
{{--                            @if($adoptionRequest->application_status == 'rejected')--}}
{{--                                <p><strong>Motivul respingerii:</strong> {{ $adoptionRequest->rejection_reason }}</p>--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                </div>--}}

{{--                <button class="carousel-control-prev" type="button" data-bs-target="#adoptionCarousel" data-bs-slide="prev">--}}
{{--                    <span class="carousel-control-prev-icon bg-success rounded-circle" aria-hidden="true"></span>--}}
{{--                    <span class="visually-hidden">Anterior</span>--}}
{{--                </button>--}}
{{--                <button class="carousel-control-next" type="button" data-bs-target="#adoptionCarousel" data-bs-slide="next">--}}
{{--                    <span class="carousel-control-next-icon bg-success rounded-circle" aria-hidden="true"></span>--}}
{{--                    <span class="visually-hidden">Următor</span>--}}
{{--                </button>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div class="text-center mt-4">--}}
{{--        <a href="{{ route('home') }}" class="btn btn-outline-success">Înapoi</a>--}}
{{--    </div>--}}
{{--@endsection--}}

{{--@push('styles')--}}
{{--    <style>--}}
{{--        .big-card {--}}
{{--            background: rgba(255, 255, 255, 0.3);--}}
{{--            backdrop-filter: blur(12px);--}}
{{--            border-radius: 25px;--}}
{{--            max-width: 900px;--}}
{{--        }--}}

{{--        .carousel-slide-content {--}}
{{--            padding: 20px;--}}
{{--            color: #333;--}}
{{--        }--}}
{{--    </style>--}}
{{--@endpush--}}
