@extends('layouts.nav')

@section('contentnav')
<!-- USER -->
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            
            <div class="white-box">
                <div id='calendar'></div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.10.2/dist/fullcalendar.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@3.10.2/dist/fullcalendar.min.css" />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Modal -->
    <div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventModalLabel">Szczegóły wydarzenia</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Zamknij"></button>
                </div>
                <div class="modal-body" id="eventModalBody">
                    <!-- Tutaj będą wyświetlane szczegóły wydarzenia -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
                    <button type="button" class="btn btn-danger" onclick="deleteTutorSchedule()">Usuń rezerwacje</button>
                    <!-- Dodane ukryte pole do przechowywania ID rekordu -->
                    <input type="hidden" id="hiddenTutorScheduleId" value="">
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                dayMaxEventRows: 2,
                locale: 'pl',
                validRange: function (nowDate) {
                    return {
                        start: nowDate
                    };
                },
                timeFormat: 'H:mm',
                events: [
                    @foreach($userSchedules as $userSchedule)
                        {
                            title: 'Zarezerwowano',
                            start: '{{ \Carbon\Carbon::parse($userSchedule->date . ' ' . $userSchedule->hour)->format("Y-m-d\TH:i:s") }}',
                            allDay: false,
                            tutorScheduleId: '{{ $userSchedule->id }}',
                            userName: '{{ $userSchedule->tutor->name }}',
                            userEmail: '{{ $userSchedule->tutor->email }}',  
                        },
                    @endforeach
                ],
                eventTimeFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: false
                },
                timeFormat: 'H:mm',
                contentHeight: 'auto',
                eventClick: function (info) {
                    // Wywołuje się po kliknięciu na wydarzenie w kalendarzu
                    var content = `
                    
                        
                        <p>Data i godzina: ${info.event.start.toLocaleString()}</p>
                        <p>Korepetytor: ${info.event.extendedProps.userName}</p>
                        <p>E-mail: ${info.event.extendedProps.userEmail}</p>
                    `;

                    // Wstawiamy zawartość do modalu
                    document.getElementById('eventModalBody').innerHTML = content;

                    // Ustawiamy wartość ukrytego pola z ID rekordu
                    document.getElementById('hiddenTutorScheduleId').value = info.event.extendedProps.tutorScheduleId;

                    // Wywołujemy modal
                    $('#eventModal').modal('show');
                },
            });

            calendarEl.style.maxWidth = '100%';
            calendarEl.style.height = 'auto';
            calendar.render();
        });

        function prepareDeleteTutorSchedule(id) {
            // Ustawiamy wartość ukrytego pola z ID rekordu
            document.getElementById('hiddenTutorScheduleId').value = id;

            // Wywołujemy modal
            $('#eventModal').modal('show');
        }

        function deleteTutorSchedule() {
            // Pobieramy wartość z ukrytego pola
            var tutorScheduleId = document.getElementById('hiddenTutorScheduleId').value;

            // Wywołujemy potwierdzenie przed usunięciem
            if (confirm("Czy na pewno chcesz usunąć ten termin?")) {
                // Przekierowujemy na trasę usuwania z odpowiednim ID
                window.location.href = "{{ url('tutorScheduleUser/delete') }}" + "/" + tutorScheduleId;
            }
        }

    </script>
@endsection
