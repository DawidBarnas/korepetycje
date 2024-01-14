@extends('layouts.nav')

@section('contentnav')
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="white-box">
                <h2>Witaj w Aplikacji Korepetycyjnej!</h2>
                <h3>Cieszymy się, że dołączyłeś do naszej społeczności edukacyjnej. Nasza aplikacja umożliwia łatwe znalezienie korepetytora oraz zarządzanie korepetycjami.</h3>
                <br></br>
                <br></br>
                <h2>Najważniejsze informacje:</h2>
                <br></br>
                <h3>Przeglądanie dostępnych korepetytorów:</h3>
                <h4>W aplikacji znajdziesz listę dostępnych korepetytorów wraz z ich profilami. Możesz przeglądać ich głowne informację oraz opinie innych użytkowników.</h4>
                <br></br>

                <h3>Rezerwowanie korepetycji:</h3>
                <h4>Po znalezieniu odpowiedniego korepetytora możesz umówić się na korepetycje. Wybierz dostępny termin, potwierdź rezerwację, a następnie spotkaj się z korepetytorem w wyznaczonym czasie. Zajęcia są z góry ustalone na czas 1h.</h4>
                <br></br>

                <h3>Oceny i opinie:</h3>
                <h4>Użytkownicy mają możliwość wystawiania ocen oraz dodawania opinii po zakończonych korepetycjach. Dzięki temu inni użytkownicy mogą dowiedzieć się więcej o jakości nauczania danego korepetytora.</h4>
                <br></br>
                <br></br>


                

            </div>
            @can('isTutor')
            <div class="white-box">
                
                <form action="{{ route('saveSelectedSubject') }}" method="post">
                    @csrf
                    <label for="subject">Wybierz swój główny przedmiot:</label>
                    <select name="subject_id" id="subject">
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                        @endforeach
                    </select>
                    <button type="submit">Zapisz przedmiot</button>
                </form>
                
            </div>
            @endcan
        </div>
    </div>
@endsection
