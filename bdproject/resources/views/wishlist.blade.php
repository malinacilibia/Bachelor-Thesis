@extends('layouts.app')

@section('content')
    <div class="position-relative text-white mb-5" style="background-image: url('{{ asset('images/cats_banner.png') }}'); background-size: cover; background-position: center; height: 300px; overflow: hidden;">
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.4);"></div>
        <div class="position-relative z-1 d-flex flex-column justify-content-center align-items-center h-100 text-center px-3">
            <h1 class="fw-bold display-5">Pisicile tale favorite </h1>
            <p class="lead">Ține-le aproape pe blănoasele tale preferate!</p>
        </div>
    </div>

    <div class="container-fluid px-5" style="margin-bottom: 100px;">
        @if($favorites->isEmpty())
            <div class="d-flex justify-content-center">
                <div class="card shadow p-4 text-center" style="max-width: 600px; background-color: #f6f5e9; border-radius: 20px;">
                    <h4 class="mb-3" style="color: #4a3f0f;">Nu ai adăugat nicio pisică la favorite încă </h4>
                    <p class="mb-4" style="color: #5e4c4c;">Explorează pisicile disponibile și adaugă-ți preferatele cu o inimioară ❤️</p>
                    <a href="{{ route('posts.index') }}" class="btn px-4 py-2" style="background-color: #5eb489; color: white; border-radius: 30px;">
                        Vezi pisicile disponibile
                    </a>
                </div>
            </div>
        @else


        <div class="row g-4">
                @foreach($favorites as $post)
                    <div class="col-md-4 d-flex justify-content-center">
                        <div class="cat-card position-relative {{ $post->adopted ? 'adopted' : '' }}" style="width: 280px; border-radius: 20px; overflow: hidden; background-color: #cce5cc; box-shadow: 0 4px 10px rgba(0,0,0,0.1); cursor: pointer;" data-bs-toggle="modal" data-bs-target="#catModal{{ $post->id }}">
                            @if($post->adopted)
                                <div class="adopted-overlay d-flex justify-content-center align-items-center">
                                    <div class="ribbon"><span>Adoptată</span></div>
                                </div>
                            @endif
                            <div class="position-absolute top-0 end-0 m-2">
                                <form method="POST" action="{{ route('wishlist.remove', $post->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn p-0 border-0 bg-transparent favorite-btn active" style="font-size: 28px; color: red;">
                                        <i class="bi bi-heart-fill"></i>
                                    </button>
                                </form>
                            </div>
                            <div style="height: 320px; overflow: hidden;">
                                <img src="{{ asset('storage/cover_images/' . $post->cover_image) }}" alt="Cat Image" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                                <div style="padding: 15px; text-align: center;">
                                    <h5 style="font-weight: bold; color: #4a3f0f;">{{ $post->title }}</h5>
                                    <p style="margin: 0;">{{ $post->age }} ani, {{ $post->gender == 'feminin' ? 'fetiță' : 'băiat' }}</p>

                                    <div class="mt-3">
                                        <a href="{{ route('adoption.form', ['post_id' => $post->id]) }}"
                                           class="btn"
                                           style="background-color: #5eb489; color: white; padding: 8px 20px; border-radius: 30px;">
                                            Adoptă-mă acum!
                                        </a>
                                    </div>
                                </div>

                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection

<style>
    .cat-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .cat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0,0,0,0.2);
    }
    .favorite-btn:hover i {
        color: darkred;
    }

</style>
