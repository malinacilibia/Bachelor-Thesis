
    @extends('layouts.app')

    @section('content')


        <div class="py-4 px-3 px-md-5 text-center" style="background-color: #cce5cc">
            <p class="fs-5 mb-0"
               style=" font-weight:bold; font-style: italic; max-width: 900px; margin: 0 auto; color: rgba(30, 30, 30, 0.65);">
                Împărtășește cu noi întreaga ta experiență de adopție: cum ai descoperit pisica, cum a decurs procesul, ce impresie ți-au lăsat angajații și cum s-a schimbat viața ta de atunci. Povestește-ne ce face acum pisica ta – este jucăușă, iubăreață, sănătoasă? Ai pățit ceva amuzant cu ea? Adaugă toate detaliile care pot inspira și alți oameni să ofere o a doua șansă unui suflet blănos. ❤️
            </p>
        </div>

        <div class="container py-5 d-flex justify-content-center">
        <div class="card shadow-lg border-0 w-100" style="max-width: 700px; border-radius: 20px;">
            <div class="card-body p-5">
                <h2 class="mb-4 text-center fw-bold" style="color: #4e705a;">Adaugă o poveste nouă de adopție</h2>

                @if($errors->any())
                    <div class="alert alert-danger rounded-3">
                        <ul class="mb-0 ps-3">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('story.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label fw-semibold">Titlu</label>
                        <input type="text" class="form-control rounded-3" id="title" name="title" required>
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label fw-semibold">Povestea ta</label>
                        <textarea class="form-control rounded-3" id="content" name="content" rows="5" required></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="image" class="form-label fw-semibold">Adaugă o poză (opțional)</label>
                        <input type="file" class="form-control rounded-3" id="image" name="image" accept="image/*">
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn px-5 py-2 fw-bold" style="background-color: #cce5cc; color: #333; border-radius: 30px;">
                             Trimite povestea
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
