@extends('layouts.app')

@section('content')
    <div style="position: relative; height: 500px; overflow: hidden;">
        <img src="{{ asset('images/stories.png') }}" alt="Adopție pisici" style="width: 100%; height: 100%; object-fit: cover;">
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;
                    background: rgba(0, 0, 0, 0.4); display: flex; align-items: center; justify-content: center;">
            <h1 class="text-white fw-bold display-4">Povești de adopție</h1>
        </div>
    </div>

    <div class=" py-4 px-3 px-md-5 text-center" style="background-color: #cce5cc">
        <p class="fs-5 mb-0"
           style=" font-weight:bold; font-style: italic; max-width: 900px; margin: 0 auto; color: rgba(30, 30, 30, 0.65);">
            Fiecare poveste este un capitol dintr-o viață schimbată — atât pentru pisică, cât și pentru om.
            Citește experiențele minunate ale celor care au ales să ofere o a doua șansă unui suflet blănos. 🐾
        </p>
    </div>


    <div class="container py-5">
        <div class="masonry" style="column-count: 3; column-gap: 2.5rem;">
            @forelse($stories as $story)
                <div class="mb-5 d-inline-block w-100" style="break-inside: avoid;">
                    <div class="card border-0 shadow-sm">
                        @if($story->image)
                            <img src="{{ asset('storage/' . $story->image) }}" class="card-img-top" alt="Poza poveste" style="height: auto; object-fit: cover;">
                        @endif
                        <div class="card-body bg-light d-flex flex-column">
                            <h5 class="fw-semibold">{{ $story->title }}</h5>
                            <p class="text-muted flex-grow-1">{{ \Illuminate\Support\Str::limit($story->content, 150) }}</p>
                            <p class="small text-end text-muted mb-2">Adăugat de: {{ $story->user->name }}</p>
                            <a href="{{ route('adoption_stories.show', $story->id) }}" class="btn btn-outline-dark btn-sm mt-auto align-self-start">
                                Citește toată povestea <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <p>Nu există povești aprobate momentan.</p>
            @endforelse
        </div>
    </div>
    <div class="position-relative text-white"
         style="background-image: url('{{ asset('images/pisici2.png') }}'); background-size: cover; background-position: center; height: 300px; margin-top: 100px;">

        <div class="position-absolute top-0 start-0 w-100 h-100" style="background-color: rgba(0, 0, 0, 0.6); z-index: 1;"></div>

        <div class="container h-100 d-flex flex-column justify-content-center position-relative" style="z-index: 2;">
            <h2 class="text-center fw-bold text-white mb-4">De ce să adopți?</h2>

            <div id="beneficiiCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
                <div class="carousel-inner">

                    <div class="carousel-item active">
                        <div class="text-center px-4">
                            <i class="bi bi-heart-fill fs-1 text-danger mb-2"></i>
                            <h5 class="fw-bold text-white">Salvezi o viață</h5>
                            <p class="text-white-50 small">Fiecare adopție oferă o nouă șansă unei pisici aflate în nevoie.</p>
                        </div>
                    </div>


                    <div class="carousel-item">
                        <div class="text-center px-4">
                            <i class="bi bi-stars fs-1 text-info mb-2"></i>
                            <h5 class="fw-bold text-white">Transformi o poveste</h5>
                            <p class="text-white-50 small">Fiecare adopție este un nou început, un final fericit pentru o poveste tristă.</p>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <div class="text-center px-4">
                            <i class="bi bi-house-heart-fill fs-1 text-light mb-2"></i>
                            <h5 class="fw-bold text-white">Oferi un cămin</h5>
                            <p class="text-white-50 small">Un adăpost e doar temporar. Tu îi poți oferi sentimentul de „acasă”.</p>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <div class="text-center px-4">
                            <i class="bi bi-people-fill fs-1 text-primary mb-2"></i>
                            <h5 class="fw-bold text-white">Devii parte dintr-o comunitate</h5>
                            <p class="text-white-50 small">Cei care adoptă formează o rețea de oameni cu inimi mari și valori comune.</p>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <div class="text-center px-4">
                            <i class="bi bi-heart-fill fs-1 text-danger mb-2"></i>
                            <h5 class="fw-bold text-white">Scrii propria ta poveste de succes</h5>
                            <p class="text-white-50 small">Fiecare pisică salvată devine parte dintr-o poveste emoționantă — a ta.</p>
                        </div>
                    </div>

                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#beneficiiCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon bg-success rounded-circle" aria-hidden="true"></span>
                    <span class="visually-hidden">Anterior</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#beneficiiCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon bg-success rounded-circle" aria-hidden="true"></span>
                    <span class="visually-hidden">Următor</span>
                </button>
            </div>
        </div>
    </div>


@endsection
