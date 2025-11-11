@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="text-white mb-0">Donatii <span class="bg-dark rounded-3 small text-white-50">| Statistici</span></h4>
            <div class="bg-dark rounded-3 px-3 py-1 small text-white-50">
                {{ now()->format('d M Y') }}
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-12">
                <div class="card bg-dark text-white shadow rounded-4 p-4">
                    <h5 class="fw-bold mb-3">Evoluția donațiilor lunare</h5>
                    <canvas id="donationsMonthlyChart" height="100"></canvas>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6 mb-4">
                <div class="card bg-dark text-white shadow rounded-4 p-4 h-100">
                    <h5 class="fw-bold mb-3 text-center">Top 5 Donatori</h5>
                    <canvas id="topDonorsChart" height="230"></canvas>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card bg-dark text-white shadow rounded-4 p-4 h-100 d-flex flex-column justify-content-center align-items-center text-center">
                    <i class="fas fa-donate fa-3x mb-3"></i>
                    <h5 class="mb-3">Ultimele donații</h5>
                    <div id="donationsSlider" class="carousel slide w-100 px-2" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach($donations as $key => $donation)
                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                    <div class="d-flex justify-content-between px-4">
                                        <strong>{{ $donation->user->name }}</strong>
                                        <span>{{ number_format($donation->amount, 2) }} RON</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#donationsSlider" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#donationsSlider" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6 mb-4">
                <div class="card bg-dark text-white shadow rounded-4 p-4 text-center">
                    <i class="fas fa-hand-holding-usd fa-3x mb-3"></i>
                    <h5>Sumă totală strânsă</h5>
                    <h3>{{ number_format($totalDonations, 2) }} RON</h3>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card bg-dark text-white shadow rounded-4 p-4 text-center">
                    <i class="fas fa-users fa-3x mb-3"></i>
                    <h5>Număr de donatori</h5>
                    <h3>{{ $donorsCount }}</h3>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-12">
                <div class="card bg-dark text-white shadow rounded-4 p-5 text-center">
                    <h4 class="mb-4"> Progresul donațiilor</h4>
                    <p class="fs-5">Suma totală strânsă: <strong class="text-success">{{ $totalDonations }} RON</strong> din <strong>{{ $targetAmount }} RON</strong></p>
                    <div class="progress mx-auto mb-4" style="height: 30px; border-radius: 30px; width: 80%; background-color: #2c2f3f;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-success text-white fw-bold d-flex align-items-center justify-content-center"
                             role="progressbar"
                             style="width: {{ $progress }}%; border-radius: 30px;"
                             aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100">
                            {{ round($progress, 1) }}%
                        </div>
                    </div>
                    <p class="fs-5">Mai avem <strong class="text-warning">{{ $targetAmount - $totalDonations }} RON</strong> pentru a ajunge la obiectiv!</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        new Chart(document.getElementById('topDonorsChart'), {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($topDonors->pluck('user.name')) !!},
                datasets: [{
                    data: {!! json_encode($topDonors->pluck('total')) !!},
                    backgroundColor: ['#0d6efd', '#198754', '#dc3545', '#ffc107', '#6f42c1']
                }]
            },
            options: {
                responsive: true
            }
        });

        new Chart(document.getElementById('donationsMonthlyChart'), {
            type: 'bar',
            data: {
                labels: ['Ian', 'Feb', 'Mar', 'Apr', 'Mai', 'Iun', 'Iul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Donații (RON)',
                    data: {!! json_encode($monthlyDonations) !!},
                    backgroundColor: '#ffc107'
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
