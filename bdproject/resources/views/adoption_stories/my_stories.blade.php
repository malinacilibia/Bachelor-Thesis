@extends('layouts.app')

@section('content')
    <div style="position: relative; height: 500px; overflow: hidden;">
        <img src="{{ asset('images/stories.png') }}" alt="Adopție pisici" style="width: 100%; height: 100%; object-fit: cover;">
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;
                    background: rgba(0, 0, 0, 0.4); display: flex; align-items: center; justify-content: center;">
            <h1 class="text-white fw-bold display-4">Poveștile mele de adopție</h1>
        </div>
    </div>

    <div class="py-4 px-3 px-md-5 text-center" style="background-color: #cce5cc">
        <p class="fs-5 mb-0"
           style=" font-weight:bold; font-style: italic; max-width: 900px; margin: 0 auto; color: rgba(30, 30, 30, 0.65);">
            Ai adoptat o pisică și ți-a schimbat viața?
            Povestește-ne cum a fost experiența ta și inspiră și alți iubitori de animale! Fiecare poveste merită să fie spusă.
        </p>
    </div>

    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
            <h2 class="mb-3">Gestionează-ți poveștile tale de adopție</h2>
            <a href="{{ route('story.create') }}" class="btn btn-lg" style="background-color: #cce5cc; color: white; border-radius: 30px; padding: 10px 30px; font-weight: bold; transition: 0.3s;">
                💌 Adaugă o poveste nouă
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success border-0 rounded-3 shadow-sm text-center fs-6 fw-semibold" style="background-color: #d4edda; color: #155724;">
                {{ session('success') }}
            </div>
        @endif

        <div class="row" id="stories-grid" data-masonry='{"itemSelector": ".story-card", "columnWidth": ".story-card", "percentPosition": true }'>
            @forelse($stories as $story)
                <div class="col-md-6 col-lg-4 mb-4 story-card">
                    <div class="card shadow-sm border-0 h-100" style="border-radius: 20px; overflow: hidden;">
                        @if($story->image)
                            <img src="{{ asset('storage/' . $story->image) }}" class="card-img-top" style="object-fit: cover; height: auto;" alt="Poza poveste">
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold">{{ $story->title }}</h5>
                            <p class="card-text">{{ $story->content }}</p>
                            <p class="text-muted small">Status: <strong>{{ ucfirst($story->status) }}</strong></p>

                            @if($story->status === 'rejected' && $story->reject_reason)
                                <div class="alert alert-warning mt-2">
                                    <strong>Motiv respingere:</strong> {{ $story->reject_reason }}
                                </div>
                            @endif

                            <div class="mt-auto d-flex justify-content-between">
                                <a href="{{ route('story.edit', $story->id) }}"
                                   class="btn btn-sm"
                                   style="background-color: #adebb3; color: white; border-radius: 20px; padding: 5px 15px; font-weight: 500;">
                                    ✏️ Editează
                                </a>

                                <form action="{{ route('story.destroy', $story->id) }}" method="POST" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm" style="background-color: #5eb489; color: white; border-radius: 20px; padding: 5px 15px; font-weight: 500;">
                                        🗑️ Șterge
                                    </button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p>Nu ai adăugat nicio poveste încă.</p>
            @endforelse
        </div>
    </div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteForms = document.querySelectorAll('.delete-form');

        deleteForms.forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Ești sigur?',
                    text: 'Povestea va fi ștearsă definitiv!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Da, șterge!',
                    cancelButtonText: 'Anulează'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
