@extends('layouts.admin')

@section('content')

    <div class="min-vh-100 d-flex flex-column justify-content-start pb-5">
        <h2 class="mb-4 text-white fw-bold">Editează informațiile pisicii</h2>

        {!! Form::open(['route' => ['admin.pisici.update', $post->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}

        <div class="row g-4">
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('title', 'Nume pisică', ['class' => 'text-light fw-semibold']) }}
                    {{ Form::text('title', $post->title, ['class' => 'form-control bg-dark text-white border-secondary rounded-pill px-3']) }}
                </div>

                <div class="form-group mt-3">
                    {{ Form::label('breed', 'Rasă', ['class' => 'text-light fw-semibold']) }}
                    {{ Form::text('breed', $post->breed, ['class' => 'form-control bg-dark text-white border-secondary rounded-pill px-3']) }}
                </div>

                <div class="form-group mt-3">
                    {{ Form::label('age', 'Vârstă', ['class' => 'text-light fw-semibold']) }}
                    {{ Form::text('age', $post->age, ['class' => 'form-control bg-dark text-white border-secondary rounded-pill px-3']) }}
                </div>
                <div class="form-group mt-3">
                    {{ Form::label('age_category', 'Categorie de vârstă', ['class' => 'text-light fw-semibold']) }}
                    {{ Form::select('age_category', [
                        'Pui' => 'Pui (sub 1 an)',
                        'Tânăr' => 'Tânăr (1-3 ani)',
                        'Adult' => 'Adult (3-7 ani)',
                        'Senior' => 'Senior (7+ ani)'
                    ], $post->age_category, ['class' => 'form-select bg-dark text-white border-secondary rounded-pill px-3']) }}
                </div>

                <div class="form-group mt-3">
                    {{ Form::label('gender', 'Sex', ['class' => 'text-light fw-semibold']) }}
                    {{ Form::select('gender', ['masculin' => 'Masculin', 'feminin' => 'Feminin'], $post->gender, ['class' => 'form-select bg-dark text-white border-secondary rounded-pill px-3']) }}
                </div>

                <div class="form-group mt-3">
                    {{ Form::label('behavior', 'Comportament', ['class' => 'text-light fw-semibold']) }}
                    {{ Form::text('behavior', $post->behavior, ['class' => 'form-control bg-dark text-white border-secondary rounded-pill px-3']) }}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group h-100 d-flex flex-column">
                    {{ Form::label('body', 'Descriere detaliată', ['class' => 'text-light fw-semibold']) }}
                    {{ Form::textarea('body', $post->body, ['class' => 'form-control bg-dark text-white border-secondary rounded-3 flex-grow-1', 'style' => 'min-height: 230px']) }}
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('cover_image', 'Imagine principală (cover)', ['class' => 'text-light fw-semibold']) }}
                    {{ Form::file('cover_image', ['class' => 'form-control bg-dark text-white border-secondary rounded-pill px-3']) }}

                    <div class="mt-3">
                        <img src="{{ asset('storage/cover_images/' . $post->cover_image) }}"
                             alt="Imagine principală"
                             style="max-width: 100%; max-height: 200px; border-radius: 10px; border: 1px solid #666;">
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('images[]', 'Galerie foto (poze suplimentare)', ['class' => 'text-light fw-semibold']) }}
                    {{ Form::file('images[]', ['multiple' => true, 'class' => 'form-control bg-dark text-white border-secondary rounded-pill px-3']) }}
                </div>
            </div>
        </div>

        <div class="mt-5 text-center">
            {{ Form::submit(' Salvează modificările', ['class' => 'btn px-5 py-2 rounded-pill text-white', 'style' => 'background-color: #5eb489; font-weight: 500;']) }}
        </div>
        {!! Form::close() !!}

        @if($post->images->count())
            <div class="mt-5">
                <label class="text-light fw-semibold">Galerie existentă:</label>
                <div class="d-flex flex-wrap gap-2">
                    @foreach($post->images as $img)
                        <div class="position-relative" style="width: 90px; height: 90px;">
                            <img src="{{ asset('storage/cat_gallery/' . $img->image_path) }}"
                                 alt="Imagine"
                                 class="rounded"
                                 style="width: 100%; height: 100%; object-fit: cover; border: 1px solid #555;">

                            <form action="{{ route('admin.pisici.imagini.destroy', $img->id) }}"
                                  method="POST"
                                  class="position-absolute top-0 end-0"
                                  onsubmit="event.stopPropagation(); return confirm('Ești sigur că vrei să ștergi această imagine?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="btn btn-sm btn-danger rounded-circle"
                                        style="padding: 2px 6px; font-size: 10px;">×</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection
