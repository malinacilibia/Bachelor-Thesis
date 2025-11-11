@extends('layouts.app')

@section('content')
    <div class="donate-section" style="background: url('{{ asset('images/donations.png') }}') center center / cover no-repeat; padding: 80px 0; color: white; text-align: center; background-attachment: fixed;">
        <h2>Cum poți ajuta?</h2>

        <div class="donate-options" style="display: flex; justify-content: space-evenly; gap: 30px; flex-wrap: wrap;">

            <div class="donate-card" style="background-color: rgba(0, 0, 0, 0.5); border-radius: 12px; padding: 30px 20px; width: 240px; min-height: 360px; display: flex; flex-direction: column; justify-content: space-between;">
                <div class="icon" style="font-size: 40px; margin-bottom: 15px;">💡</div>
                <h4>De ce să donezi?</h4>
                <p>Ajută-ne să oferim pisicilor un viitor mai bun. Orice donație contează!</p>
            </div>

            <div class="donate-card" style="background-color: rgba(0, 0, 0, 0.5); border-radius: 12px; padding: 30px 20px; width: 240px; min-height: 360px; display: flex; flex-direction: column; justify-content: space-between;">
                <div class="icon" style="font-size: 40px; margin-bottom: 15px;">🐾</div>
                <h4>Donează</h4>
                <a href="{{ route('donation.form') }}" class="btn btn-doneaza" style="background-color: #5d4026; color: white; padding: 10px 20px; border-radius: 20px; font-weight: bold;">Donează</a>
            </div>

            <div class="donate-card" style="background-color: rgba(0, 0, 0, 0.5); border-radius: 12px; padding: 30px 20px; width: 240px; min-height: 360px; display: flex; flex-direction: column; justify-content: space-between;">
                <div class="icon" style="font-size: 40px; margin-bottom: 15px;">💰</div>
                <h4>Unde se duc banii?</h4>
                <p>Fondurile vor fi folosite pentru hrana și îngrijirea pisicilor din adăpost, precum și pentru medicamente.</p>
            </div>
        </div>

        <div class="card mb-5 text-light" style="padding: 20px; border-radius: 15px; background-color: rgba(0, 0, 0, 0.5); margin-top:200px;">
            <div class="text-center mb-5">
                <h4 class="mb-3">Progresul donațiilor</h4>
                <p class="lead">Suma totală strânsă: <strong>{{ $totalDonations }} RON</strong> din <strong>{{ $targetAmount }} RON</strong></p>

                <div class="progress mb-4" style="height: 25px; border-radius: 20px; background-color: #e0e0e0; width: 80%; margin: 0 auto;">
                    <div class="progress-bar" role="progressbar" style="width: {{ $progress }}%; background-color: #4caf50;" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100">
                        <span class="sr-only">{{ round($progress, 2) }}%</span>
                    </div>
                </div>

                <p class="lead">Mai avem <strong>{{ $targetAmount - $totalDonations }} RON</strong> pentru a ajunge la obiectiv!</p>
            </div>
        </div>

        <p class="mt-5" style="font-style: italic;">Vă mulțumim și contăm pe sprijinul dumneavoastră! </p>
    </div>
@endsection
