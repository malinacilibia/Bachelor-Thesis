@extends('layouts.admin')

@section('content')

    <div class="container py-4">
        <a href="{{ route('admin.pisici') }}" class="btn btn-outline-light mb-4 rounded-pill px-4">
            Înapoi la listă
        </a>

        <div class="card bg-dark text-light shadow-lg border-0 rounded-4 p-4">
            <div class="row g-4">
                <div class="col-md-5">
                    @if($pisica->cover_image)
                        <img src="{{ asset('storage/cover_images/' . $pisica->cover_image) }}"
                             alt="{{ $pisica->title }}"
                             class="img-fluid rounded-4 shadow border border-secondary"
                             style="object-fit: cover; height: 100%; max-height: 400px; width: 100%;">
                    @else
                        <img src="{{ asset('images/default-cat.jpg') }}"
                             alt="Fără imagine"
                             class="img-fluid rounded-4 shadow border border-secondary"
                             style="object-fit: cover; height: 100%; max-height: 400px; width: 100%;">
                    @endif
                </div>


                <div class="col-md-7 d-flex flex-column justify-content-between">
                    <div>
                        <h2 class="fw-bold">{{ $pisica->title }}</h2>
                        <p class="mb-1"><strong>Rasă:</strong> {{ $pisica->breed }}</p>
                        <p class="mb-1"><strong>Vârstă:</strong> {{ $pisica->age }} </p>
                        <p class="mb-1"><strong>Sex:</strong> {{ ucfirst($pisica->gender) }}</p>
                        <p class="mb-1"><strong>Comportament:</strong> {{ $pisica->behavior }}</p>
                        <p class="mt-3"><strong>Descriere:</strong></p>
                        <div class="bg-secondary bg-opacity-10 border rounded p-3" style="font-size: 0.95rem;">
                            {{ $pisica->body }}
                        </div>
                    </div>


                    <div class="d-flex gap-2 mt-4">
                        <a href="{{ route('admin.pisici.edit', $pisica->id) }}"
                           class="btn btn-outline-light rounded-pill px-4">Editează</a>

                        <form action="{{ route('admin.pisici.destroy', $pisica->id) }}" method="POST" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-light rounded-pill px-4">Șterge</button>
                        </form>
                    </div>
                </div>
            </div>


            @if($pisica->images->count())
                <hr class="text-secondary my-4">
                <h5 class="mb-3">Galerie foto</h5>
                <div class="d-flex flex-wrap gap-3">
                    @foreach($pisica->images as $img)
                        <img src="{{ asset('storage/cat_gallery/' . $img->image_path) }}"
                             alt="Imagine suplimentară"
                             class="rounded shadow-sm border border-secondary"
                             style="width: 100px; height: 100px; object-fit: cover;">
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteForms = document.querySelectorAll('.delete-form');

            deleteForms.forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();

                    Swal.fire({
                        title: 'Ești sigur?',
                        text: 'Această pisică va fi ștearsă definitiv!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#444',
                        cancelButtonColor: '#333',
                        background: '#1f1f1f',
                        color: '#fff',
                        confirmButtonText: 'Da, șterge',
                        cancelButtonText: 'Anulează',
                        customClass: {
                            popup: 'rounded-4 shadow',
                            confirmButton: 'px-4 py-2',
                            cancelButton: 'px-4 py-2'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
@endpush
