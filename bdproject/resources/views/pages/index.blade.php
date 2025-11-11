@extends('layouts.app')

@section('content')
    <div class="hero-section position-relative text-white text-center w-100"
         style="background-image: url('{{ asset('images/banner.png') }}'); background-size: cover; background-position: center; height: 550px; margin-top: 0 !important;">
        <div class="overlay position-absolute top-0 start-0 w-100 h-100" style="background-color: rgba(0, 0, 0, 0.4);"></div>
        <div class="position-relative w-100 h-100 d-flex flex-column justify-content-center align-items-center" style="z-index: 2;">
            <h1 class="display-4 fw-bold">Găsește-ți noul cel mai bun prieten</h1>
            <p class="lead">Descoperă pisicile noastre care așteaptă o familie iubitoare</p>
            <a href="/posts" class="btn btn-lg btn-light mt-3">Vezi pisicile disponibile</a>
        </div>
    </div>

    <div class="container" style="margin-top: -80px; margin-bottom: 100px;">
        <div class="row text-center justify-content-center">

            <div class="col-md-3 mb-4">
                <div class="card shadow-sm h-100 custom-card-border">
                    <div class="card-body">
                        <i class="bi bi-house-door fs-1 text-primary"></i>
                        <h5 class="card-title mt-3">Adoptă</h5>
                        <p class="card-text">Cunoaște pisici gata să devină parte din familia ta.</p>
                        <a href="/posts" class="btn btn-outline-primary">Vezi pisicile</a>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="card shadow-sm h-100 custom-card-border">
                    <div class="card-body">
                        <i class="bi bi-heart fs-1 text-danger"></i>
                        <h5 class="card-title mt-3">Donează</h5>
                        <p class="card-text">Ajută-ne să oferim îngrijire pisicilor salvate.</p>
                        <a href="/donate" class="btn btn-outline-danger">Donează acum</a>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="card shadow-sm h-100 custom-card-border">
                    <div class="card-body">
                        <i class="bi bi-chat-dots fs-1 text-info"></i>
                        <h5 class="card-title mt-3">Povești</h5>
                        <p class="card-text">Citește povești emoționante despre adopții reușite.</p>
                        <a href="{{ route('adoption.stories') }}" class="btn btn-outline-info">Vezi povești</a>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="card shadow-sm h-100 custom-card-border">
                    <div class="card-body">
                        <i class="bi bi-list-check fs-1 text-success"></i>
                        <h5 class="card-title mt-3">Proces adopție</h5>
                        <p class="card-text">Vezi pașii pe care îi parcurgi pentru a adopta o pisică.</p>
                        <a href="/services" class="btn btn-outline-success">Află mai mult</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="py-5" style="background-color: #b1a48b;">
    <div class="container">
            <h2 class="fw-bold text-center mb-5 text-light">Adoptă o pisicuță!</h2>
            <div class="row justify-content-center g-4">
                @foreach($posts as $post)
                    <div class="col-6 col-sm-4 col-md-3 col-lg-3">
                        <div class="cat-card position-relative overflow-hidden">
                            <img src="{{ asset('storage/cover_images/' . $post->cover_image) }}" alt="{{ $post->title }}" class="img-fluid w-100 h-100">
                            <div class="cat-overlay d-flex justify-content-center align-items-center">
                                <span class="cat-name">{{ $post->title }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach


    <a href="{{ url('/posts') }}" class="btn mt-4 px-5 py-2 text-white fw-semibold" style="background-color: #716758; border-radius: 0;">
                VEZI MAI MULTE
            </a>
        </div>
    </div>
    </div>


<br></br>

{{--    <!-- Secțiune Povești de succes -->--}}
{{--    <div class="py-5" style="background-color: #ffffff; margin-top: 150px;">--}}

{{--        <div class="container">--}}
{{--        <h2 class="fw-bold text-center mb-5 text-dark">Povești de succes</h2>--}}
{{--        <div class="row justify-content-center g-4" >--}}
{{--            @foreach($stories as $story)--}}
{{--                <div class="col-6 col-sm-4 col-md-3 col-lg-3">--}}
{{--                    <div class="cat-card position-relative overflow-hidden">--}}
{{--                        <img src="{{ asset('storage/' . $story->image) }}" alt="{{ $story->title }}" class="img-fluid w-100 h-100">--}}
{{--                        <div class="cat-overlay d-flex justify-content-center align-items-center">--}}
{{--                            <span class="cat-name">{{ $story->user->name }}</span>--}}
{{--                        </div>--}}
{{--                        <a href="{{ route('adoption_stories.show', $story->id) }}" class="stretched-link"></a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            @endforeach--}}

{{--            <a href="{{ route('adoption.stories') }}" class="btn mt-4 px-5 py-2 text-white fw-semibold" style="background-color: #5eb489; border-radius: 0;">--}}
{{--                VEZI MAI MULTE POVEȘTI--}}
{{--            </a>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    </div>--}}

    <div class="position-relative text-white"
         style="background-image: url('{{ asset('images/pisici.png') }}'); background-size: cover; background-position: center; height: 300px; margin-top: 200px;">

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
                            <i class="bi bi-emoji-heart-eyes-fill fs-1 text-warning mb-2"></i>
                            <h5 class="fw-bold text-white">Primești iubire necondiționată</h5>
                            <p class="text-white-50 small">Pisicile adoptate oferă afecțiune sinceră și loialitate pe viață.</p>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <div class="text-center px-4">
                            <i class="bi bi-cash-coin fs-1 text-success mb-2"></i>
                            <h5 class="fw-bold text-white">Costuri mai mici</h5>
                            <p class="text-white-50 small">Adopția este mai accesibilă decât cumpărarea unui animal.</p>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <div class="text-center px-4">
                            <i class="bi bi-exclamation-triangle-fill fs-1 text-warning mb-2"></i>
                            <h5 class="fw-bold text-white">Reduci abandonul</h5>
                            <p class="text-white-50 small">Fiecare adopție înseamnă o viață salvată din stradă.</p>
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
    <style>
        .post-card {
            transition: all 0.3s ease-in-out;
            border: 7px solid transparent;
        }

        .post-card:hover {
            border-color: #2d6a4f;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .cat-card {
            background-color: #bce7bc;
            height: 320px;
            border-radius: 0;
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .cat-card img {
            object-fit: cover;
            height: 100%;
            transition: transform 0.4s ease;
        }

        .cat-card:hover img {
            transform: scale(1.1);
        }

        .cat-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            top: 0;
            background-color: rgba(0, 0, 0, 0.4);
            opacity: 0;
            transition: opacity 0.4s ease;
            z-index: 1;
        }

        .cat-card:hover .cat-overlay {
            opacity: 1;
        }

        .cat-name {
            color: white;
            font-weight: bold;
            font-size: 1.2rem;
            text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.8);
        }

    </style>
