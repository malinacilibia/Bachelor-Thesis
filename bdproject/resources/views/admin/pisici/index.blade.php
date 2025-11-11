@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="text-white mb-0">Postări <span class="bg-dark rounded-3  small text-white-50" >| Gestionarea pisicilor pentru adopție</span></h4>
        <div class="bg-dark rounded-3 px-3 py-1 small text-white-50">
            {{ now()->format('d M Y') }}
        </div>
    </div>    <a href="{{ route('admin.pisici.create') }}" class="btn btn-info mb-4 rounded-pill px-4 py-2">➕ Adaugă Pisică</a>

    <div class="row">
        @foreach ($pisici as $pisica)
            <div class="col-md-6 col-xl-4">
                <div class="card bg-dark text-light shadow rounded-4 p-3 mb-4 position-relative">

                    @if($pisica->adopted)
                        <div class="ribbon"><span>Adoptată</span></div>
                    @endif

                    <div class="card-body">
                        <div class="d-flex flex-column gap-3">

                            <div class="d-flex">
                                <div class="flex-fill pe-3 border-end border-secondary">
                                    <h4 class="fw-bold text-info text-center">{{ $pisica->title }}</h4>
                                    <p class="mb-1"><strong>Rasă:</strong> {{ $pisica->breed }}</p>
                                    <p class="mb-1"><strong>Vârstă:</strong> {{ $pisica->age }} </p>
                                    <p class="mb-1"><strong>Sex:</strong> {{ $pisica->gender }}</p>
                                    <p class="mb-1"><strong>Comportament:</strong> {{ $pisica->behavior }}</p>
                                </div>

                                <div class="flex-fill ps-3">
                                    <div class="mb-2">
                                        @if($pisica->cover_image)
                                            <img src="{{ asset('storage/cover_images/' . $pisica->cover_image) }}" alt="{{ $pisica->title }}"
                                                 class="img-fluid rounded shadow-sm border border-secondary"
                                                 style="height: 120px; width: 100%; object-fit: cover;">
                                        @else
                                            <img src="{{ asset('images/default-cat.jpg') }}" alt="Fără imagine"
                                                 class="img-fluid rounded shadow-sm border border-secondary"
                                                 style="height: 120px; width: 100%; object-fit: cover;">
                                        @endif
                                    </div>

                                    @if($pisica->images->count())
                                        <div class="d-flex justify-content-center flex-wrap gap-2">
                                            @foreach($pisica->images as $img)
                                                <img src="{{ asset('storage/cat_gallery/' . $img->image_path) }}" alt="Imagine"
                                                     class="border border-light shadow-sm"
                                                     style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="d-flex justify-content-center gap-2 flex-wrap pt-3 border-top border-secondary mt-3">
                                <a href="{{ route('admin.pisici.show', $pisica->id) }}" class="btn btn-outline-light rounded-pill">Vizualizează</a>
                                <a href="{{ route('admin.pisici.edit', $pisica->id) }}" class="btn btn-outline-light rounded-pill">Editează</a>
                                <form action="{{ route('admin.pisici.destroy', $pisica->id) }}" method="POST" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-light rounded-pill">Șterge</button>
                                </form>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-4 d-flex justify-content-center">
        {{ $pisici->links('vendor.pagination.custom') }}
    </div>
@endsection

@push('styles')
    <style>
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
    </style>
@endpush
@push('scripts')
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
                            confirmButtonColor: '#5a2525',
                            cancelButtonColor: '#1f1f1f',
                            background: '#1f1f1f',
                            color: '#fff',
                            confirmButtonText: 'Da, șterge!',
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

@endpush

