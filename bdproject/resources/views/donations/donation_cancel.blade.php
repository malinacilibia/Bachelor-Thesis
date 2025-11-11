@extends('layouts.app')

@section('content')
    <div class="container text-center mt-5 text-light" style="margin: 200px 100px 100px 100px;">
        <div class="row justify-content-end">
            <div class="col-md-6">
                <div class="card shadow-sm p-4" style="background-color: rgba(0,0,0,0.5); border-radius: 10px; border: none;">
                    <h2 class="text-warning mb-4">Plata a fost anulată</h2>
                    <p class="lead mb-4 text-light">Poate te răzgândești mai târziu </p>

                    <p class="text-light">Nu te îngrijora! Înțelegem că poate nu a fost momentul potrivit pentru donație. Dacă vrei să revii, suntem mereu aici pentru pisicile care au nevoie de ajutorul tău!</p>

                    <p class="mt-4 text-light">
                        Te încurajăm să vizitezi din nou pagina de donație și să aduci ajutorul de care pisicile au atâta nevoie. Fiecare contribuție contează!
                    </p>

                    <div class="mt-5">
                        <a href="{{ route('donation.form') }}" class="btn btn-lg">Reîncearcă donația</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    body {
        background: url('{{ asset('images/cancel.png') }}') center center / cover no-repeat;
        height: 200px;
        padding-top: 50px;
    }

    .container {
        max-width: 800px;
    }

    .card {
        border-radius: 10px;
        background-color: rgba(255, 255, 255, 0.85);
        border: none;
    }

    .btn-lg {
        font-size: 1.25rem;
        padding: 10px 30px;
        background-color: #5a5a5a;
        border-color: #5a5a5a;
    }

    .btn-lg:hover {
        background-color: #4e4e4e;
        border-color: #4e4e4e;
    }

    .row {
        display: flex;
        justify-content: flex-end;
    }

    .col-md-6 {
        display: flex;
        justify-content: center;
    }
</style>
