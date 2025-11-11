@extends('layouts.app')

@section('content')
    <div class="donate-section" style="background: url('{{ asset('images/donations.png') }}') center center / cover no-repeat; padding: 80px 0; color: white; text-align: center; background-attachment: fixed; height:800px;">

        <div class="card shadow-lg p-4 mb-5 text-light" style="background-color: rgba(0, 0, 0, 0.5); border-radius: 12px; max-width: 700px; margin: 0 auto;">
            <h2>Donație pentru pisicuțe!</h2>
            <p>Fiecare donație contează și poate face o diferență imensă în viața pisicilor abandonate și neajutorate. Ajută-ne să le oferim un adăpost sigur, hrană adecvată și îngrijire medicală, astfel încât să poată avea o viață mai bună. Poți contribui cu orice sumă dorești și, indiferent de valoarea acesteia, contribuția ta va fi apreciată enorm!</p>

            <p>Din fiecare donație, ne angajăm să folosim resursele într-un mod responsabil și eficient, pentru a sprijini pisicile care au nevoie de ajutorul nostru. Alege suma pe care vrei să o donezi și alătură-te cauzei noastre. Împreună, putem face o schimbare reală!</p>
        </div>

        <div class="d-flex justify-content-around flex-wrap" style="gap: 20px;">

            <div class="card shadow-lg p-4 text-light" style="background-color: rgba(0, 0, 0, 0.5); border-radius: 12px; max-width: 500px; flex: 1;">
                <h4 class="text-center mb-4">Alege suma dorită pentru donație</h4>
                <form method="POST" action="{{ route('donation.process') }}">
                    @csrf

                    <div class="form-group mb-4">
                        <label class="form-label">Alege suma pe care vrei să o donezi:</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="amount" id="amount50" value="50" onchange="toggleCustomAmount()">
                            <label class="form-check-label" for="amount50">50 RON</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="amount" id="amount100" value="100" onchange="toggleCustomAmount()">
                            <label class="form-check-label" for="amount100">100 RON</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="amount" id="amount200" value="200" onchange="toggleCustomAmount()">
                            <label class="form-check-label" for="amount200">200 RON</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="amount" id="amount_other" value="other" onchange="toggleCustomAmount()">
                            <label class="form-check-label" for="amount_other">Altă sumă</label>
                        </div>
                    </div>

                    <div class="form-group mb-4" id="customAmountDiv" style="display: none;">
                        <label for="custom_amount" class="form-label">Introdu suma dorită:</label>
                        <input type="number" name="custom_amount" id="custom_amount" class="form-control" placeholder="Introdu suma dorită" min="1">
                    </div>

                    <div class="form-group text-center mt-4">
                        <button type="submit" class="btn btn-success btn-lg">Donează acum</button>
                    </div>
                </form>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success mt-4">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger mt-4">
                {{ session('error') }}
            </div>
        @endif
    </div>

    <script>
        function toggleCustomAmount() {
            const customAmountInput = document.getElementById("custom_amount");
            const customAmountDiv = document.getElementById("customAmountDiv");
            const selectedAmount = document.querySelector('input[name="amount"]:checked');

            if (selectedAmount && selectedAmount.value === 'other') {
                customAmountDiv.style.display = "block";
                customAmountInput.required = true;
            } else {
                customAmountDiv.style.display = "none";
                customAmountInput.required = false;
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            const defaultAmount = document.querySelector('input[name="amount"]:checked');
            if (defaultAmount) {
                toggleCustomAmount();
            }
        });
    </script>
@endsection
