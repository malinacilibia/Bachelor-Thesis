@extends('layouts.admin')

@section('content')

    <div class="min-vh-100 d-flex flex-column justify-content-start pb-5">
        <h2 class="mb-4 text-white fw-bold">Adaugă o pisică nouă</h2>

        {!! Form::open(['route' => 'admin.pisici.store', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'flex-grow-1']) !!}

        <div class="row g-4">
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('title', 'Nume pisică', ['class' => 'text-light fw-semibold']) }}
                    {{ Form::text('title', '', ['class' => 'form-control bg-dark text-white border-secondary rounded-pill px-3', 'required' => 'required', 'id' => 'title']) }}
                </div>

                <div class="form-group mt-3">
                    {{ Form::label('breed', 'Rasă', ['class' => 'text-light fw-semibold']) }}
                    {{ Form::text('breed', '', ['class' => 'form-control bg-dark text-white border-secondary rounded-pill px-3', 'required' => 'required', 'id' => 'breed']) }}
                </div>

                <div class="form-group mt-3">
                    {{ Form::label('age', 'Vârstă', ['class' => 'text-light fw-semibold']) }}
                    {{ Form::text('age', '', ['class' => 'form-control bg-dark text-white border-secondary rounded-pill px-3', 'required' => 'required', 'id' => 'age']) }}
                </div>
                <div class="form-group mt-3">
                    {{ Form::label('age_category', 'Categorie de vârstă', ['class' => 'text-light fw-semibold']) }}
                    {{ Form::select('age_category', [
                        'Pui' => 'Pui (sub 1 an)',
                        'Tânăr' => 'Tânăr (1-3 ani)',
                        'Adult' => 'Adult (3-7 ani)',
                        'Senior' => 'Senior (7+ ani)'
                    ], $post->age_category ?? null, ['class' => 'form-select bg-dark text-white border-secondary rounded-pill px-3']) }}
                </div>


                <div class="form-group mt-3">
                    {{ Form::label('gender', 'Sex', ['class' => 'text-light fw-semibold']) }}
                    {{ Form::select('gender', ['masculin' => 'Masculin', 'feminin' => 'Feminin'], null, ['class' => 'form-select bg-dark text-white border-secondary rounded-pill px-3', 'required' => 'required', 'id' => 'gender']) }}
                </div>

                <div class="form-group mt-3">
                    {{ Form::label('behavior', 'Comportament', ['class' => 'text-light fw-semibold']) }}
                    {{ Form::text('behavior', '', ['class' => 'form-control bg-dark text-white border-secondary rounded-pill px-3', 'required' => 'required', 'id' => 'behavior']) }}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('body', 'Descriere detaliată', ['class' => 'text-light fw-semibold']) }}
                    {{ Form::textarea('body', '', ['class' => 'form-control bg-dark text-white border-secondary rounded-3', 'rows' => 8,  'required' => 'required']) }}
                </div>

                <div class="form-group mt-3">
                    {{ Form::label('cover_image', 'Imagine principală', ['class' => 'text-light fw-semibold']) }}
                    {{ Form::file('cover_image', ['class' => 'form-control bg-dark text-white border-secondary rounded-pill px-3', 'id' => 'cover_image_input',  'required' => 'required']) }}

                    <div class="mt-3" id="cover_preview_wrapper" style="display: none;">
                        <img id="cover_preview" src="" alt="Preview"
                             style="max-width: 100%; height: auto; border-radius: 10px; border: 1px solid #666;">
                    </div>
                </div>

                <div class="form-group mt-3">
                    {{ Form::label('images[]', 'Galerie foto (poze suplimentare)', ['class' => 'text-light fw-semibold']) }}
                    {{ Form::file('images[]', ['multiple' => true, 'class' => 'form-control bg-dark text-white border-secondary rounded-pill px-3', 'id' => 'gallery_input']) }}

                    <div class="mt-3 d-flex flex-wrap gap-2" id="gallery_preview" style="display: none;"></div>
                </div>

            </div>

        <div class="mt-5 text-center">
            {{ Form::submit('Salvează pisica', ['class' => 'btn px-5 py-2 rounded-pill text-white', 'style' => 'background-color: #5eb489; font-weight: 500;']) }}
        </div>

        {!! Form::close() !!}
    </div>
@endsection

        @push('scripts')
            <script>
                document.getElementById('cover_image_input').addEventListener('change', function (event) {
                    const input = event.target;
                    const preview = document.getElementById('cover_preview');
                    const wrapper = document.getElementById('cover_preview_wrapper');

                    if (input.files && input.files[0]) {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            preview.src = e.target.result;
                            wrapper.style.display = 'block';

                        }
                        reader.readAsDataURL(input.files[0]);
                    } else {
                        wrapper.style.display = 'none';
                    }
                });

                document.getElementById('gallery_input').addEventListener('change', function (event) {
                    const input = event.target;
                    const previewContainer = document.getElementById('gallery_preview');
                    previewContainer.innerHTML = '';

                    if (input.files && input.files.length > 0) {
                        previewContainer.style.display = 'flex';
                        Array.from(input.files).forEach(file => {
                            const reader = new FileReader();
                            reader.onload = function (e) {
                                const img = document.createElement('img');
                                img.src = e.target.result;
                                img.style.width = '60px';
                                img.style.height = '60px';
                                img.style.objectFit = 'cover';
                                img.style.borderRadius = '8px';
                                img.style.border = '1px solid #555';
                                previewContainer.appendChild(img);
                            }
                            reader.readAsDataURL(file);
                        });
                    } else {
                        previewContainer.style.display = 'none';
                    }
                });
            </script>
    @endpush

