@extends('layouts.nav')

@section('contentnav')

<style>
    .btnhour {
        width: 100%;
        padding: 10px;
        margin: 5px;
        border: none;
        background-color: #ddd;
        cursor: pointer;
    }

    .btnhour.selected {
        background-color: #007bff;
        color: #fff;
    }

    /* Dodane style dla kalendarza */
    #datepicker-container {
        position: relative;
        display: inline-block;
        width: 200px;
    }

    #datepicker {
        width: 100%;
        padding: 10px;
        margin: 5px;
        border: none;
        background-color: #ddd;
        cursor: pointer;
    }
</style>

<div class="row">
    <!-- .col -->
    <div class="col-md-12 col-lg-8 col-sm-12">
        <div class="card white-box p-0">
            <div class="container-fluid px-0 px-sm-4 mx-auto">
                <div class="row justify-content-center mx-0">
                    <div class="col-lg-10">
                        <div class="card border-0">
                            <form action="{{ route('tutor.availability') }}" method="POST" id="availabilityForm">
                                @csrf
                                <div class="card-header bg-dark">
                                    <div class="mx-0 mb-0 row justify-content-sm-center justify-content-start px-1">
                                        <!-- Input z kalendarzem -->
                                        <div id="datepicker-container">
                                            <input type="text" id="datepicker" placeholder="Wybierz dzień" name="date" readonly>
                                            <input type="hidden" id="selectedDateInput" name="selected_date" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-3 p-sm-5">
                                <div class="row text-center mx-0">
                                    @foreach($hours as $hour)
                                        <div class="col-md-2 col-4 my-1 px-2">
                                            <button type="button" name="selected_hours[]" value="{{ $hour }}" class="btnhour" onclick="toggleHour(this)">{{ $hour }}</button>
                                        </div>
                                    @endforeach
                                </div>

                                <input type="hidden" id="selectedHoursInput" name="selected_hours[]" value="">
                                <button type="submit" class="btn btn-primary">Zapisz dostępność</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.col -->
</div>

<!-- Dodane skrypty dla kalendarza -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.8.0/pikaday.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.8.0/css/pikaday.min.css">

<script>
    var selectedHours = [];
    var picker = new Pikaday({
        field: document.getElementById('datepicker'),
        format: 'YYYY-MM-DD',
        minDate: new Date(),  // Ustawienie minimalnej daty na dzisiejszą datę
        onSelect: function(date) {
            // Zresetuj zaznaczone godziny przy zmianie daty
            selectedHours = [];
            updateSelectedHoursInput();
            
            // Ustaw wybraną datę w polu ukrytym
            document.getElementById('selectedDateInput').value = moment(date).format('YYYY-MM-DD');
        },
        i18n: {
            previousMonth: 'Poprzedni miesiąc',
            nextMonth: 'Następny miesiąc',
            months: [
                'Styczeń',
                'Luty',
                'Marzec',
                'Kwiecień',
                'Maj',
                'Czerwiec',
                'Lipiec',
                'Sierpień',
                'Wrzesień',
                'Październik',
                'Listopad',
                'Grudzień'
            ],
            weekdays: [
                'Niedziela',
                'Poniedziałek',
                'Wtorek',
                'Środa',
                'Czwartek',
                'Piątek',
                'Sobota'
            ],
            weekdaysShort: [
                'Niedz.',
                'Pon.',
                'Wt.',
                'Śr.',
                'Czw.',
                'Pt.',
                'Sob.'
            ]
        }
    });

    function toggleHour(button) {
    var hourValue = button.value;

    if (selectedHours.includes(hourValue)) {
        selectedHours = selectedHours.filter(function (value) {
            return value !== hourValue;
        });
        button.classList.remove('selected');
    } else {
        var hoursToAdd = hourValue.split(',');
        selectedHours = selectedHours.concat(hoursToAdd);

        hoursToAdd.forEach(function (hour) {
            var hourButton = document.querySelector('button[value="' + hour + '"]');
            if (hourButton) {
                hourButton.classList.add('selected');
            }
        });
    }

    updateSelectedHoursInput();
}

function updateSelectedHoursInput() {
    document.getElementById('selectedHoursInput').value = JSON.stringify(selectedHours);
}

    document.getElementById('availabilityForm').addEventListener('submit', function(event) {
        var selectedDate = document.getElementById('selectedDateInput').value;

        if (!selectedDate) {
            alert('Proszę wybrać datę przed zapisaniem dostępności.');
            event.preventDefault();
        }
    });
</script>


@endsection('contentnav')
