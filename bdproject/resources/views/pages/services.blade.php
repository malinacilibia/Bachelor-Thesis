@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="rounded-4 p-5 bg-mint">
            <div class="row text-center justify-content-center align-items-start">
                <div class="col-md-2 d-flex flex-column align-items-center border-end border-white">
                    <div class="step-number">1.</div>
                    <div class="mb-3">
                        <img src="{{ asset('images/icons/cat.png') }}" alt="Icon pisică" class="step-icon">
                    </div>
                    <h5 class="fw-semibold text-green">Alege pisica</h5>
                    <p class="text-green">Peste 100 de pisici așteaptă să fie adoptate</p>
                </div>

                <div class="col-md-2 d-flex flex-column align-items-center border-end border-white">
                    <div class="step-number">2.</div>
                    <div class="mb-3">
                        <img src="{{ asset('images/icons/form.png') }}" alt="Icon formular" class="step-icon">
                    </div>
                    <h5 class="fw-semibold text-green">Completează formularul</h5>
                    <p class="text-green">Trimite cererea pentru pisica dorită</p>
                </div>

                <div class="col-md-2 d-flex flex-column align-items-center border-end border-white">
                    <div class="step-number">3.</div>
                    <div class="mb-3">
                        <img src="{{ asset('images/icons/mail.png') }}" alt="Icon mail" class="step-icon">
                    </div>
                    <h5 class="fw-semibold text-green">Așteaptă confirmarea</h5>
                    <p class="text-green">Vezi emailul și notificarea pe site</p>
                </div>

                <div class="col-md-2 d-flex flex-column align-items-center border-end border-white">
                    <div class="step-number">4.</div>
                    <div class="mb-3">
                        <img src="{{ asset('images/icons/calendar.png') }}" alt="Icon calendar" class="step-icon">
                    </div>
                    <h5 class="fw-semibold text-green">Programează o vizită</h5>
                    <p class="text-green">Alege ziua și ora vizitei</p>
                </div>

                <div class="col-md-2 d-flex flex-column align-items-center">
                    <div class="step-number">5.</div>
                    <div class="mb-3">
                        <img src="{{ asset('images/icons/home.png') }}" alt="Icon casă" class="step-icon">
                    </div>
                    <h5 class="fw-semibold text-green">Ia-o acasă</h5>
                    <p class="text-green">Semnezi contractul și o iei acasă</p>
                </div>
            </div>
        </div>

        <div class="card-step">
            <div class="title-section">
                <div class="icon-circle">
                    <img src="{{ asset('images/icons/cat2.png') }}" alt="Icon pisică">
                </div>
                <div class="label">ALEGEREA PISICII</div>
            </div>
            <p>Primul pas în procesul de adopție este să găsești o pisică ce ți se potrivește. Explorează galeria noastră de pisici disponibile, citește detaliile fiecăreia și alege-o pe cea care îți atinge inima. Poți filtra după vârstă, sex, personalitate sau starea de sănătate.</p>
        </div>

        <div class="card-step">
            <div class="title-section">
                <div class="icon-circle">
                    <img src="{{ asset('images/icons/mail2.png') }}" alt="Icon mail">
                </div>
                <div class="label">CONFIRMAREA CERERII</div>
            </div>
            <p>După ce completezi formularul online cu informații despre tine și stilul tău de viață, echipa noastră va analiza cererea. Acest pas este esențial pentru a ne asigura că pisica va ajunge într-un cămin potrivit. Vei primi o confirmare pe email și în contul tău de utilizator.</p>
        </div>

        <div class="card-step">
            <div class="title-section">
                <div class="icon-circle">
                    <img src="{{ asset('images/icons/calendar2.png') }}" alt="Icon calendar">
                </div>
                <div class="label">PROGRAMAREA VIZITEI</div>
            </div>
            <p>Dacă cererea este aprobată, vei avea posibilitatea de a programa o vizită la adăpost. Vei putea alege dintr-un calendar disponibil ziua și ora care îți convine. Această vizită îți oferă ocazia să cunoști pisica aleasă și să interacționezi cu ea direct.</p>
        </div>

        <div class="card-step">
            <div class="title-section">
                <div class="icon-circle">
                    <img src="{{ asset('images/icons/paw.png') }}" alt="Icon centru">
                </div>
                <div class="label">VIZITA LA CENTRU</div>
            </div>
            <p>Te vei prezenta la centru în ziua și ora stabilită. Personalul nostru te va însoți și îți va oferi toate informațiile necesare despre comportamentul și nevoile pisicii. Este un moment ideal pentru a observa dacă între tine și pisică există o conexiune reală.</p>
        </div>

        <div class="card-step">
            <div class="title-section">
                <div class="icon-circle">
                    <img src="{{ asset('images/icons/home2.png') }}" alt="Icon acasă">
                </div>
                <div class="label">ADOPȚIA FINALĂ</div>
            </div>
            <p>Dacă totul decurge bine, vei putea semna contractul de adopție chiar la fața locului. Pisica îți va fi încredințată cu carnetul de sănătate și recomandările medicale. Felicitări! Tocmai ai oferit un cămin unui suflet care avea nevoie de tine.</p>
        </div>


@endsection


