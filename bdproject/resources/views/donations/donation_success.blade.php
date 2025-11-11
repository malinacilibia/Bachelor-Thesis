@extends('layouts.app')

@section('content')
    <div class="container text-center mt-5 text-light" style="margin: 200px 100px 100px 100px;">
        <div class="row justify-content-end">
            <div class="col-md-6">
                <div class="card shadow-sm p-4" style="background-color: rgba(0,0,0,0.5); border-radius: 10px; border: none;">
                    <h2 class="text-light mb-4">Mulțumim pentru donație! </h2>
                    <p class="lead mb-4 text-light">Ajutorul tău contează enorm pentru pisicuțele care au nevoie de un adăpost și de îngrijire!</p>

                    <p class="text-light">Fiecare contribuție adusă face o diferență și ne ajută să oferim îngrijire medicală, hrană și un cămin iubitor pisicilor care așteaptă să fie adoptate. </p>

                    <p class="mt-4 text-light">
                        Dacă vrei să ajuti mai mult, poți distribui pagina de donație și prietenilor tăi sau să aduci un prieten la adăpostul nostru pentru a face o donație fizic. Fiecare ajutor contează!
                    </p>

                    <div class="mt-5">
                        <a href="{{ route('donation.form') }}" class="btn btn-lg">Donează din nou</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    body {
        background: url('{{ asset('images/success.png') }}') center center / cover no-repeat;
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
