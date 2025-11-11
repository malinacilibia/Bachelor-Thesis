@extends('layouts.app')

@section('content')
    <div style="position: relative;background-size: cover; height: 400px; overflow: hidden;">
        <div style="display: flex; width: 100%; height: 100%;">

            <div style="width: 50%; background-image: url('{{ asset('images/paw-bg.png') }}'); display: flex; align-items: center; justify-content: center;">
                <div class="overlay position-absolute top-0 start-0 w-100 h-100" style="background-color: rgba(0, 0, 0, 0.4);"></div>

                <div class="position-relative w-100 h-100 d-flex flex-column justify-content-center align-items-center" style="z-index: 2;">
                    <h1 class="text-white fw-bold display-5 text-center px-3" style="text-shadow: 1px 1px 5px rgba(0,0,0,0.6);">
                        Povestea lui {{ $story->user->name }}
                    </h1>
                </div>
            </div>

            <div style="width: 50%;">
                <img src="{{ asset('storage/' . $story->image) }}"
                     alt="Poză poveste"
                     style="width: 100%; height: 100%; object-fit: cover; object-position: center;">
            </div>
        </div>
    </div>

    <div class="container py-5 text-center" style=" background-color: #cce5cc; margin:50px 200px 10px 150px; padding: 0 300px 0 300px;">
        <h2 class="fw-bold mb-4">{{ $story->title }}</h2>
        <p class="fs-5" style="white-space: pre-line;">{{ $story->content }}</p>
        <p class="text-muted mt-5">Adăugat de: {{ $story->user->name }}</p>
    </div>
    <div class="container text-center mb-4" style="margin-bottom:500px;">
        <a href="{{ url('/adoption-stories') }}" class="btn btn-sm btn-outline-secondary" style="margin-bottom:100px;border-radius: 20px; padding: 6px 20px;">
            ← Înapoi la povești
        </a>
    </div>

    <div class="w-100 mt-5" style="background-color: #f6f6f6; padding: 40px 20px 30px 20px; border-top: 1px solid #ddd;">
        <div class="container text-center">
            <h4 class="fw-semibold mb-3" style="color: #4a4a4a;">Ți-a plăcut povestea lui {{ $story->user->name }}?</h4>
            <p class="mb-4" style="color: #6a6a6a;">Poate și sufletul tău așteaptă o prietenă pufoasă. Intră acum și descoperă pisicile care își caută o familie!</p>
            <a href="{{ url('/posts') }}" class="btn btn-outline-success" style="border-radius: 30px; padding: 8px 24px; font-weight: 500;">Adoptă și tu o pisică</a>
        </div>
    </div>



@endsection
