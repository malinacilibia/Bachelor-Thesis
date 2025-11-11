@extends('layouts.app')

@section('content')

    <div class="w-100 text-center py-4" style="background-color: #88aa88; ">
        <h4 class="fw-semibold text-light mb-3">
            Programează o vizită de adopție pentru
        </h4>

        <div class="d-flex flex-column align-items-center">
            @if($post && $post->cover_image)
                <img src="{{ asset('storage/cover_images/' . $post->cover_image) }}"
                     alt="{{ $post->title }}" class="rounded-circle shadow mb-2"
                     style="width: 120px; height: 120px; object-fit: cover;">
            @endif

            <h5 class="fw-bold text-light">{{ $post->title }}</h5>
        </div>
    </div>


    <div class="container calendar-wrapper mt-4">
        <p class="text-muted fs-6 mb-4 text-center">
            Selectează o zi din calendar pentru a programa o întâlnire cu pisicuța aleasă. <br>
            <strong>⚠️ Zilele de weekend nu sunt disponibile</strong> și poți alege doar ore între <strong>08:00 și 16:00</strong>. 🕗
        </p>

        <div id="calendar"></div>
    </div>



    <div class="modal fade" id="appointmentModal" tabindex="-1" aria-labelledby="appointmentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="appointmentModalLabel">Alege ora programării</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="appointmentForm">
                        @csrf
                        <input type="hidden" id="appointment_date" name="appointment_date">
                        <input type="hidden" id="post_id" name="post_id" value="{{ $post_id }}">

                        <div class="mb-3">
                            <label for="appointment_time" class="form-label">Selectează ora:</label>
                            <select class="form-control" id="appointment_time" name="appointment_time" required>
                                <option value="">Alege ora</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-success">Confirmă programarea</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="successToast"
         class="toast align-items-center text-white bg-success border-0 position-fixed top-0 start-50 translate-middle-x m-4 shadow"
         role="alert" aria-live="assertive" aria-atomic="true"
         style="z-index: 2000; display: none; border-radius: 12px; background-color: #88aa88;">

    <div class="d-flex">
            <div class="toast-body">
                🐾 Programarea a fost înregistrată cu succes și a fost trimisă către aprobare!
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto"
                    aria-label="Close" onclick="hideToast()"></button>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var appointmentDate = "";

            fetch("{{ route('appointments.unavailable') }}")
                .then(response => response.json())
                .then(unavailableDates => {
                    var calendar = new FullCalendar.Calendar(calendarEl, {
                        initialView: 'dayGridMonth',
                        selectable: true,
                        events: "{{ route('appointments.fetch') }}",

                        dayCellDidMount: function(info) {
                            let dateStr = info.date.toISOString().split('T')[0];
                            let today = new Date().toISOString().split('T')[0];
                            let cellEl = info.el;
                            let day = new Date(info.date).getDay();

                            cellEl.style.borderRadius = "12px";
                            cellEl.style.transition = "all 0.2s ease-in-out";
                            cellEl.style.padding = "4px";
                            cellEl.style.fontWeight = "500";
                            cellEl.style.fontFamily = "'Segoe UI', sans-serif";

                            if (dateStr < today) {
                                cellEl.style.backgroundColor = "#e0e0e0";
                                cellEl.style.color = "#888";
                                cellEl.style.pointerEvents = "none";
                                cellEl.title = "Zi indisponibilă (în trecut)";
                            }

                            if (day === 0 || day === 6) {
                                cellEl.style.backgroundColor = "#e0e0e0";
                                cellEl.style.color = "#999";
                                cellEl.style.pointerEvents = "none";
                                cellEl.title = "Zi indisponibilă (weekend)";
                            }



                            if (dateStr === today) {
                                cellEl.style.backgroundColor = "#c4e3cb";
                                cellEl.style.color = "#333";
                                cellEl.style.fontWeight = "bold";
                            }

                            if (!unavailableDates.includes(dateStr) && dateStr >= today && day !== 0 && day !== 6) {
                                cellEl.addEventListener("mouseenter", () => {
                                    cellEl.style.backgroundColor = "#d8f2db";
                                    cellEl.style.cursor = "pointer";
                                });
                                cellEl.addEventListener("mouseleave", () => {
                                    cellEl.style.backgroundColor = "";
                                });
                            }
                        },


                        dateClick: function(info) {
                            let dateStr = info.dateStr;

                            if (!unavailableDates.includes(dateStr) && new Date(dateStr) >= new Date()) {
                                appointmentDate = dateStr;
                                document.getElementById('appointment_date').value = appointmentDate;
                                var appointmentModal = new bootstrap.Modal(document.getElementById('appointmentModal'));
                                appointmentModal.show();

                                fetch(`/appointments/unavailable-hours/${dateStr}`)
                                    .then(response => response.json())
                                    .then(bookedHours => {
                                        let timeSelect = document.getElementById('appointment_time');
                                        timeSelect.innerHTML = '<option value="">Alege ora</option>'; // Reset

                                        let availableTimes = [];
                                        let startTime = 8;
                                        let endTime = 17;

                                        for (let hour = startTime; hour < endTime; hour++) {
                                            let timeSlot = `${hour.toString().padStart(2, '0')}:00`;

                                            if (!bookedHours.includes(timeSlot)) {
                                                availableTimes.push(timeSlot);
                                                let option = document.createElement('option');
                                                option.value = timeSlot;
                                                option.textContent = timeSlot;
                                                timeSelect.appendChild(option);
                                            }
                                        }

                                        if (availableTimes.length === 0) {
                                            let option = document.createElement('option');
                                            option.value = "";
                                            option.textContent = "Nicio oră disponibilă";
                                            timeSelect.appendChild(option);
                                            timeSelect.disabled = true;
                                        } else {
                                            timeSelect.disabled = false;
                                        }
                                    });
                            }
                        }
                    });

                    calendar.render();
                });

            document.getElementById('appointmentForm').addEventListener('submit', function(event) {
                event.preventDefault();
                let appointmentTime = document.getElementById('appointment_time').value;
                let fullDateTime = document.getElementById('appointment_date').value + " " + appointmentTime;

                fetch("{{ route('appointments.store') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        appointment_date: fullDateTime,
                        post_id: document.getElementById('post_id').value
                    })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            showToast();
                            setTimeout(() => {
                                window.location.href = data.redirect;
                            }, 3000);
                        } else {
                            alert(data.error);
                        }
                    })
                    .catch(error => console.error("Error:", error));
            });
        });
        function showToast() {
            const toast = document.getElementById("successToast");
            toast.style.display = "block";
            toast.classList.add("show");

            setTimeout(() => {
                toast.classList.remove("show");
                toast.style.display = "none";
            }, 4000);
        }

        function hideToast() {
            const toast = document.getElementById("successToast");
            toast.classList.remove("show");
            toast.style.display = "none";
        }
    </script>
@endsection
<style>
    .calendar-wrapper #calendar {
        background-color: #f1f6f1;
        padding: 30px;
        border-radius: 20px;
        box-shadow: 0 0 15px rgba(0,0,0,0.05);
        font-family: 'Segoe UI', sans-serif;
        margin: 0 auto 50px auto;
        max-width: 800px;
    }


    .calendar-wrapper .fc-toolbar-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: #445544;
    }

    .calendar-wrapper .fc .fc-button {
        background-color: #88aa88 !important;
        border: none;
        border-radius: 12px;
        color: white;
        padding: 6px 14px;
        transition: 0.3s ease-in-out;
    }

    .calendar-wrapper .fc .fc-button:hover {
        background-color: #6f936f !important;
    }

    .calendar-wrapper .fc-daygrid-day {
        border-radius: 10px;
        transition: 0.2s ease-in-out;
        padding: 5px;
    }

    .calendar-wrapper .fc-daygrid-day-number {
        color: #445544;
        font-weight: 600;
    }

    .calendar-wrapper .fc-day-today {
        background-color: #c4e3cb !important;
    }

    .calendar-wrapper .fc-daygrid-day:hover {
        background-color: #d8f2db !important;
        cursor: pointer;
    }

    .calendar-wrapper .fc-day-disabled {
        background-color: #ececec !important;
        color: #bbb !important;
        pointer-events: none;
    }

    .calendar-wrapper .fc-col-header-cell-cushion {
        font-weight: 600;
        color: #88aa88;
    }
    .modal-content {
        border-radius: 20px;
        border: 1px solid #88aa88;
        background-color: #fcfefc;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
    }

    .modal-header {
        background-color: #88aa88;
        color: white;
        border-top-left-radius: 20px;
        border-top-right-radius: 20px;
    }

    .modal-title {
        font-size: 1.25rem;
        font-weight: 600;
        font-family: 'Segoe UI', sans-serif;
    }

    .form-label {
        font-weight: 500;
        color: #445544;
        font-family: 'Segoe UI', sans-serif;
    }

    select.form-control {
        border-radius: 10px;
        border: 1px solid #c4e3cb;
        padding: 8px;
        font-family: 'Segoe UI', sans-serif;
    }

    .btn-success {
        background-color: #88aa88;
        border-color: #88aa88;
        border-radius: 10px;
    }

    .btn-success:hover {
        background-color: #6f936f;
        border-color: #6f936f;
    }

    .btn-close {
        filter: brightness(0.8);
    }

</style>
