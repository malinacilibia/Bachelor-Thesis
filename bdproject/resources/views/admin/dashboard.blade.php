@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="text-white mb-0">Dashboard <span class="bg-dark rounded-3  small text-white-50" >| Statistici generale</span></h4>
            <div class="bg-dark rounded-3 px-3 py-1 small text-white-50">
                {{ now()->format('d M Y') }}
            </div>
        </div>


        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <div class="card bg-dark text-white shadow rounded-4 p-4 d-flex flex-column align-items-center justify-content-center h-100">
                    <h5 class="fw-bold mb-4 text-center">Cereri săptămânale</h5>
                    <canvas id="adoptionChart" height="250"></canvas>
                </div>
            </div>
            <div class="col-md-8">
                <div class="row g-3 h-100 text-center">
                    <div class="col-md-6 col-xl-3">
                        <div class="card bg-dark text-light shadow-sm rounded-4 p-4 h-100 d-flex flex-column align-items-center justify-content-center">
                            <h5 class="text-white fw-bold mb-3">Cereri</h5>
                            <img src="{{ asset('images/icons/admin/paw.png') }}" alt="cereri" width="40" class="mb-2">
                            <div class="fs-4 fw-bold">{{ $totalAdoptionRequests }}</div>
                            <div class="small text-white-50 mt-2">
                                 Aprobate: {{ $approved }}<br>
                                 Respins: {{ $rejected }}<br>
                                 În așteptare: {{ $pending }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3">
                        <div class="card bg-dark text-light shadow-sm rounded-4 p-4 h-100 d-flex flex-column align-items-center justify-content-center">
                            <h5 class="text-white fw-bold mb-3">Programări</h5>
                            <img src="{{ asset('images/icons/admin/calendar.png') }}" alt="calendar" width="40" class="mb-2">
                            <div class="fs-4 fw-bold">{{ $totalAppointments }}</div>
                            <div class="small text-white-50 mt-2">
                                 Confirmate: {{ $confirmed }}<br>
                                 Anulate: {{ $cancelled }}<br>
                                 În așteptare: {{ $waiting }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3">
                        <div class="card bg-dark text-light shadow-sm rounded-4 p-4 h-100 d-flex flex-column align-items-center justify-content-center">
                            <h5 class="text-white fw-bold mb-3">Pisici adoptate</h5>
                            <img src="{{ asset('images/icons/admin/cat.png') }}" alt="cat" width="40" class="mb-2">
                            <div class="fs-4 fw-bold">{{ $totalAdopted }}</div>
                            <div class="small text-white-50 mt-2">
                                Luna aceasta: {{ $monthlyAdopted }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3">
                        <div class="card bg-dark text-light shadow-sm rounded-4 p-4 h-100 d-flex flex-column align-items-center justify-content-center">
                            <h5 class="text-white fw-bold mb-3">Utilizatori</h5>
                            <img src="{{ asset('images/icons/admin/users.png') }}" alt="users" width="40" class="mb-2">
                            <div class="fs-4 fw-bold"> {{ $totalUsers }}</div>
                            <div class="small text-white-50 mt-2">
                                 Noi înscriși săptămâna asta: {{ $newUsersThisWeek }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-3 mb-5">
                <div class="col-md-8">
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="card bg-dark text-white shadow rounded-4 p-4">
                                <h5 class="fw-bold mb-3">Cereri lunare</h5>
                                <canvas id="adoptionMonthlyChart" height="90"></canvas>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card bg-dark text-white shadow rounded-4 p-4">
                                <h5 class="fw-bold mb-3">Programări lunare</h5>
                                <canvas id="appointmentMonthlyChart" height="130"></canvas>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card bg-dark text-white shadow rounded-4 p-4">
                                <h5 class="fw-bold mb-3">Pisici adoptate lunar</h5>
                                <canvas id="catsMonthlyChart" height="130"></canvas>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card bg-dark text-white shadow rounded-4 p-4">
                                <h5 class="fw-bold mb-3">Utilizatori noi lunar</h5>
                                <canvas id="userChart" height="130"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card bg-dark text-white shadow rounded-4 p-4 d-flex flex-column align-items-center justify-content-center h-100">
                        <h5 class="fw-bold mb-4 text-center">Programări săptămânale</h5>
                        <canvas id="appointmentChart" height="400" style="max-width: 100%;"></canvas>
                    </div>
                </div>
            </div>

            @endsection


            @section('scripts')
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script>
                    console.log("Chart.js loaded");console.log("✅ Scripturile au fost încărcate");
                    console.log("📊 adoptionData", {!! json_encode($adoptionData) !!});
        new Chart(document.getElementById('adoptionChart'), {
            type: 'doughnut',
            data: {
                labels: ['Aprobate', 'Respins', 'În așteptare'],
                datasets: [{
                    data: [{{ $adoptionData['approved'] }}, {{ $adoptionData['rejected'] }}, {{ $adoptionData['pending'] }}],
                    backgroundColor: ['#198754', '#dc3545', '#ffc107']
                }]
            }
        });

        new Chart(document.getElementById('appointmentChart'), {
            type: 'doughnut',
            data: {
                labels: ['Confirmate', 'Anulate', 'În așteptare'],
                datasets: [{
                    data: [{{ $appointmentData['confirmed'] }}, {{ $appointmentData['cancelled'] }}, {{ $appointmentData['waiting'] }}],
                    backgroundColor: ['#0d6efd', '#6c757d', '#f39c12']
                }]
            }
        });

        new Chart(document.getElementById('userChart'), {
            type: 'bar',
            data: {
                labels: ['Ian', 'Feb', 'Mar', 'Apr', 'Mai', 'Iun', 'Iul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Utilizatori noi',
                    data: {!! json_encode($userRegistrations) !!},
                    backgroundColor: '#0dcaf0'
                }]
            }
        });

        new Chart(document.getElementById('adoptionMonthlyChart'), {
            type: 'line',
            data: {
                labels: ['Ian', 'Feb', 'Mar', 'Apr', 'Mai', 'Iun', 'Iul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Cereri noi / lună',
                    data: {!! json_encode($monthlyAdoptionRequests) !!},
                    backgroundColor: 'rgba(13, 110, 253, 0.5)',
                    borderColor: '#0d6efd',
                    fill: true,
                    tension: 0.3
                }]
            }
        });

        new Chart(document.getElementById('appointmentMonthlyChart'), {
            type: 'line',
            data: {
                labels: ['Ian', 'Feb', 'Mar', 'Apr', 'Mai', 'Iun', 'Iul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Programări / lună',
                    data: {!! json_encode($monthlyAppointments) !!},
                    backgroundColor: 'rgba(25, 135, 84, 0.5)',
                    borderColor: '#198754',
                    fill: true,
                    tension: 0.3
                }]
            }
        });

        new Chart(document.getElementById('catsMonthlyChart'), {
            type: 'bar',
            data: {
                labels: ['Ian', 'Feb', 'Mar', 'Apr', 'Mai', 'Iun', 'Iul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Pisici adoptate / lună',
                    data: {!! json_encode($monthlyAdoptedCats) !!},
                    backgroundColor: '#ffc107'
                }]
            }
        });
    </script>
@endsection
