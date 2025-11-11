@extends('layouts.app')

@section('content')
    <div class="position-relative text-white mb-5" style="background-image: url('{{ asset('images/cats_banner.png') }}'); background-size: cover; background-position: center; height: 300px; overflow: hidden;">
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.4);"></div>
        <div class="position-relative z-1 d-flex flex-column justify-content-center align-items-center h-100 text-center px-3">
            <h1 class="fw-bold display-5">Pisici disponibile pentru adopție</h1>
            <p class="lead">Caută pisica perfectă pentru tine și oferă-i o șansă la o viață mai bună!</p>
        </div>
    </div>
    <div class="mb-5" id="vue-app">
        <age-filter></age-filter>
    </div>

    <div class="text-center mb-4">
        <hr style="width: 500px; border-top: 3px solid #d7a74f; border-radius: 5px; margin: 0 auto;">
    </div>

    <div class="container-fluid px-5" style="margin-top: 100px; margin-bottom: 100px;">
        <div class="row">
            <div class="col-md-3" style="padding-left: 30px;">
                <div class="card p-3 shadow-sm" style="background-color: #cce5cc; border-radius: 15px; position: sticky; top: 100px; z-index: 1;">
                    <h5 class="mb-3">Filtrează</h5>
                    <form action="{{ route('posts.index') }}" method="GET">
                        <div class="mb-3">
                            <input type="text" name="title" class="form-control" placeholder="Caută după nume" value="{{ request('title') }}">
                        </div>
                        <div class="mb-3">
                            <select name="breed" class="form-select">
                                <option value="">Toate rasele</option>
                                @foreach($breeds as $breed)
                                    <option value="{{ $breed }}" {{ request('breed') == $breed ? 'selected' : '' }}>{{ ucfirst($breed) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <select name="gender" class="form-select">
                                <option value="">Toate genurile</option>
                                @foreach($genders as $gender)
                                    <option value="{{ $gender }}" {{ request('gender') == $gender ? 'selected' : '' }}>{{ ucfirst($gender) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <select name="behavior" class="form-select">
                                <option value="">Toate comportamentele</option>
                                @foreach($behaviors as $behavior)
                                    <option value="{{ $behavior }}" {{ request('behavior') == $behavior ? 'selected' : '' }}>{{ ucfirst($behavior) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <select name="age_category" class="form-select">
                                <option value="">Toate categoriile de vârstă</option>
                                <option value="Pui" {{ request('age_category') == 'Pui' ? 'selected' : '' }}>Pui (sub 1 an)</option>
                                <option value="Tânăr" {{ request('age_category') == 'Tânăr' ? 'selected' : '' }}>Tânăr (1-3 ani)</option>
                                <option value="Adult" {{ request('age_category') == 'Adult' ? 'selected' : '' }}>Adult (3-7 ani)</option>
                                <option value="Senior" {{ request('age_category') == 'Senior' ? 'selected' : '' }}>Senior (7+ ani)</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <select name="adopted" class="form-select">
                                <option value="">Toate pisicile</option>
                                <option value="0" {{ request('adopted') === '0' ? 'selected' : '' }}>Neadoptate</option>
                                <option value="1" {{ request('adopted') === '1' ? 'selected' : '' }}>Adoptate</option>
                            </select>
                        </div>


                        <div class="d-grid gap-2">
                            <button type="submit" class="btn" style="background-color: #5eb489">Filtrează</button>

                            <a href="{{ route('posts.index') }}" class="btn" style="background-color: #5eb489">Reset</a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-9">



                @if($posts->count() > 0)
                    <div class="row g-4">
                        @foreach($posts as $post)
                            <div class="col-md-4 d-flex justify-content-center">
                                <div class="cat-card position-relative {{ $post->adopted ? 'adopted' : '' }}"  style="width: 280px; border-radius: 20px; overflow: hidden; background-color: #cce5cc; box-shadow: 0 4px 10px rgba(0,0,0,0.1); cursor: pointer;" data-bs-toggle="modal" data-bs-target="#catModal{{ $post->id }}">
                                    @if(auth()->check())
                                        <button
                                            class="btn favorite-btn toggle-favorite {{ auth()->user()->hasFavorited($post->id) ? 'active' : '' }}"
                                            data-post-id="{{ $post->id }}"
                                            style="position: absolute; top: 10px; right: 10px; z-index: 4;"
                                        >
                                            <i class="bi bi-heart{{ auth()->user()->hasFavorited($post->id) ? '-fill' : '' }}" style="font-size: 30px; color:rgb(139,0,0);"></i>
                                        </button>
                                    @endif

                                @if($post->adopted)
                                        <div class="adopted-overlay d-flex justify-content-center align-items-center">
                                            <div class="ribbon"><span>Adoptată</span></div>
                                        </div>
                                    @endif
                                    <div style="height: 320px; overflow: hidden;">
                                        <img src="{{ asset('storage/cover_images/' . $post->cover_image) }}" alt="Cat Image" style="width: 100%; height: 100%; object-fit: cover;">
                                    </div>
                                    <div style="padding: 15px; text-align: center;">
                                        <h5 style="font-weight: bold; color: #4a3f0f;">{{ $post->title }}</h5>
                                        <p style="margin: 0;">{{ $post->age }} , {{ $post->gender == 'feminin' ? 'fetiță' : 'băiat' }}</p>
                                    </div>
                                </div>
                            </div>


                            <div class="modal fade" id="catModal{{ $post->id }}" tabindex="-1" aria-labelledby="catModalLabel{{ $post->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-xl modal-dialog-centered">
                                    <div class="modal-content border-0 rounded-4 p-4" style="max-width: 1200px; margin: auto; background-color:#f6f5e9;">
                                        <div class="modal-header border-0 pb-0">
                                            <h2 class="modal-title fw-bold" id="catModalLabel{{ $post->id }}" style="color: #4a3f0f;">{{ $post->title }}</h2>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Închide"></button>
                                        </div>
                                        <div class="modal-body d-flex flex-column flex-md-row-reverse gap-5 pt-3 align-items-start">

                                            <div style="flex: 1; max-width: 60%;">
                                                <div id="catCarousel{{ $post->id }}" class="carousel slide" data-bs-ride="carousel">
                                                    <div class="carousel-inner rounded-4">
                                                        <div class="carousel-item active">
                                                            <img src="{{ asset('storage/cover_images/' . $post->cover_image) }}"
                                                                 class="carousel-image d-block w-100"
                                                                 alt="Imagine principală">
                                                        </div>

                                                        @foreach($post->images as $image)
                                                            <div class="carousel-item">
                                                                <img src="{{ asset('storage/cat_gallery/' . $image->image_path) }}"
                                                                     class="carousel-image d-block w-100"
                                                                     alt="Imagine suplimentară">
                                                            </div>
                                                        @endforeach
                                                    </div>

                                                    @if($post->images->count() > 0)
                                                        <button class="carousel-control-prev" type="button" data-bs-target="#catCarousel{{ $post->id }}" data-bs-slide="prev">
                                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                            <span class="visually-hidden">Anterior</span>
                                                        </button>
                                                        <button class="carousel-control-next" type="button" data-bs-target="#catCarousel{{ $post->id }}" data-bs-slide="next">
                                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                            <span class="visually-hidden">Următor</span>
                                                        </button>
                                                    @endif
                                                </div>
                                            </div>

                                            <div style="flex: 1; max-width: 40%;">
                                                <p style="line-height: 1.8;">{{ $post->description }}</p>
                                                <p><strong>Vârstă:</strong> {{ $post->age }} </p>
                                                <p><strong>Gen:</strong> {{ $post->gender == 'feminin' ? 'Fetiță' : 'Băiat' }}</p>
                                                <p><strong>Rasă:</strong> {{ $post->breed }}</p>
                                                <p><strong>Comportament:</strong> {{ ucfirst($post->behavior) }}</p>
                                                <p><strong>Descriere detaliată:</strong> {{ $post->body }}</p>

                                                <hr class="my-4" style="border-top: 2px solid #4a3f0f; width: 40%;">

                                                @if(!$post->adopted)
                                                <div class="d-flex flex-wrap gap-3">
                                                    <a href="{{ route('adoption.form', ['post_id' => $post->id]) }}" class="btn" style="background-color: #5eb489; color: white; padding: 10px 20px; border-radius: 30px;">Adoptă-mă acum!</a>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                        @endforeach
                    </div>

            </div>
        </div>
    </div>


<div class="pagination-container align-content-center">
            @if ($posts->onFirstPage())
                <span class="pagination-disabled">« Previous</span>
            @else
                <a href="{{ $posts->previousPageUrl() }}" class="pagination-link">« Previous</a>
            @endif

            @foreach ($posts->getUrlRange(1, $posts->lastPage()) as $page => $url)
                <a href="{{ $url }}" class="pagination-link {{ $page == $posts->currentPage() ? 'active' : '' }}">{{ $page }}</a>
            @endforeach

            @if ($posts->hasMorePages())
                <a href="{{ $posts->nextPageUrl() }}" class="pagination-link">Next »</a>
            @else
                <span class="pagination-disabled">Next »</span>
            @endif
        </div>

    @else
        <p class="text-center">No cats available for adoption at the moment.</p>
    @endif
    <div class="mt-5 p-5 text-center rounded-4 shadow" style="background: linear-gradient(135deg, #d4f4dd, rgba(255,248,248,0.67)); border: 2px dashed #c2d5c2;">
        <h3 class="fw-bold mb-3" style="color: #4a3f0f;">Nu ai găsit încă pisica potrivită?</h3>
        <p class="mb-4" style="font-size: 1.1rem; color: #5e4c4c;">Revenim frecvent cu noi blănoși care își caută o familie. Te invităm să revii sau să ne contactezi!</p>
        <a href="https://wa.me/+40744118481?text=Am%20o%20intrebare%20legata%20de%20adopție." class="btn px-4 py-2" style="background-color: #5eb489; color: white; border-radius: 30px;">Contactează-ne</a>

    </div>

@endsection
<script src="{{ mix('js/app.js') }}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.toggle-favorite').forEach(function (btn) {
            btn.addEventListener('click', function (e) {
                e.preventDefault();

                const postId = this.dataset.postId;
                const icon = this.querySelector('i');
                const isActive = this.classList.contains('active');

                fetch(`/favorite-toggle/${postId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({})
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.status === 'added') {
                            this.classList.add('active');
                            icon.classList.remove('bi-heart');
                            icon.classList.add('bi-heart-fill');
                        } else if (data.status === 'removed') {
                            this.classList.remove('active');
                            icon.classList.remove('bi-heart-fill');
                            icon.classList.add('bi-heart');
                        }
                    });
            });
        });
    });
</script>

<style>
    .card {
        border-radius: 20px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }
    .cat-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .cat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0,0,0,0.2);

    }
    .carousel-image {
        width: 100%;
        height: auto;
        max-height: 500px;
        object-fit: cover;
        border-radius: 20px;
    }


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
    .favorite-icon-form {
        z-index: 4;
    }

    .favorite-btn {
        background: transparent;
        color: #aaa;
        border: none;
        font-size: 50px;
        line-height: 1;
        transition: all 0.3s ease;
    }

    .favorite-btn.active {
        color: #e63946;
        background: transparent;
        border: none;
    }

    .favorite-btn:hover {
        color: #e63946;
    }

</style>
