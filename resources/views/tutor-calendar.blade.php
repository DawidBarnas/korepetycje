@extends('layouts.nav')

@section('contentnav')
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

<!-- modal, ukryty na początku -->
<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Potwierdzenie rezerwacji</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Czy na pewno chcesz zarezerwować tę godzinę?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Anuluj</button>
                <!-- Przycisk, który automatycznie wysyła dane do kontrolera -->
                <button type="button" class="btn btn-primary" id="confirmReservationBtn">Potwierdź</button>
            </div>
        </div>
    </div>
</div>

<!-- Dodaj ukryte pola do formularza -->
<form action="{{ route('save-selected-datetime') }}" method="post" id="reservationForm">
    @csrf
    <input type="hidden" name="selectedDate" id="selectedDateInput">
    <input type="hidden" name="selectedHour" id="selectedHourInput">
    <input type="hidden" name="tutorId" id="tutorIdInput" value="{{ $tutor->id }}">
    <button type="button" class="btn btn-primary" id="confirmReservationFormBtn" style="display: none;">Potwierdź</button>
</form>

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
                @foreach($availableDatesandHours as $availability)
                {
                    title: 'Dostepne',
                    start: '{{ \Carbon\Carbon::parse($availability->date . ' ' . $availability->hour)->format("Y-m-d\TH:i:s") }}',
                    allDay: false,
                },
                @endforeach
            ],
            eventTimeFormat: {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: false
            },
            timeFormat: 'H:mm',
            contentHeight: 'auto',
            
        });

        calendarEl.style.maxWidth = '100%';
        calendarEl.style.height = 'auto';
        calendar.render();

        var confirmationModal = new bootstrap.Modal(document.getElementById('confirmationModal'));

        var selectedEvent; // Dodaj zmienną do przechowywania wybranego zdarzenia

        document.getElementById('confirmReservationBtn').addEventListener('click', function () {
            // Tutaj nie próbuj już znaleźć zdarzenia, tylko sprawdź, czy jest zdefiniowane
            if (selectedEvent) {
                var selectedDate = selectedEvent.start.toISOString().split('T')[0];;
                var selectedHour = selectedEvent.start.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });

                // Wyślij dane do kontrolera za pomocą AJAX
                fetch('/save-selected-datetime', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({
                        selectedDate: selectedDate,
                        selectedHour: selectedHour,
                        userId: {{ $tutor->id }},
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    // Tutaj możesz obsłużyć odpowiedź od kontrolera
                    console.log(data);

                    // Zamknij okno modalne po pomyślnym zapisie
                    confirmationModal.hide();
                })
                .catch(error => {
                    console.error('Błąd podczas przetwarzania żądania AJAX:', error);
                });

                // Ustaw wartości w ukrytych polach formularza
                document.getElementById('selectedDateInput').value = selectedDate;
                document.getElementById('selectedHourInput').value = selectedHour;

                // Wywołaj submit formularza
                document.getElementById('reservationForm').submit();

                // Zamknij okno modalne po pomyślnym zapisie
                confirmationModal.hide();
            } else {
                console.error('Nie można znaleźć zdarzenia o identyfikatorze "selectedEvent".');
            }
        });

        calendar.on('eventClick', function (info) {
            if (info.event.title === 'Dostepne') {
                document.getElementById('confirmationModalLabel').innerText = 'Potwierdzenie rezerwacji';
                document.querySelector('#confirmationModal .modal-body').innerText = 'Czy na pewno chcesz zarezerwować tę godzinę?\nGodzina: ' + info.event.start.toLocaleTimeString() + '\nStatus: ' + info.event.title;

                confirmationModal.show();

                selectedEvent = info.event; // Przypisz zdarzenie do zmiennej
            }
        });
    });
</script>

@endsection('contentnav')
