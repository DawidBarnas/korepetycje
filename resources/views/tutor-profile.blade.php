@extends('layouts.nav')

@section('contentnav')
<div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12">
        <div class="white-box">
            <div class="d-md-flex mb-3">
                <h3 class="box-title mb-0">Profil Korepetytora</h3>
            </div>
            <div>
                <p>ID: {{ $tutor->id }}</p>
                <p>Imię: {{ $tutor->name }}</p>
                <p>Nazwisko: {{ $tutor->surname }}</p>
                <p>E-mail: {{ $tutor->email }}</p>
                <!-- Dodaj więcej informacji, jeśli to konieczne -->
            </div>

            @if (!$hasRated) <!-- Dodaj warunek, aby sprawdzić, czy użytkownik jeszcze nie ocenił tego korepetytora -->
                <form action="{{ route('rate.tutor', ['id' => $tutor->id]) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="rating">Ocena:</label>
                        <select name="rating" id="rating" class="form-control">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="comment">Opinia:</label>
                        <textarea name="comment" id="comment" class="form-control" rows="3" maxlength="255"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Oceń</button>
                </form>
            @else
                <p>Już oceniłeś(aś) tego korepetytora.</p>
            @endif

        </div>
    </div>
</div>
@endsection('contentnav')
