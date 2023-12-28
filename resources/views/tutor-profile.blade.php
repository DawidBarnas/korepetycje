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
            <a href="{{ route('showTutorCalendar', $tutor->id) }}">
                <button type="button" class="btn btn-primary">Wyświetl Dostępne terminy</button>
            </a>

            @if (!$hasRated)
                <!-- Dodaj warunek, aby sprawdzić, czy użytkownik jeszcze nie ocenił tego korepetytora -->
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


            <div class="row d-flex ">
                <div class="col-md-12 col-lg-10">
                    <div class="card text-dark">
                        <div class="card-body p-4">
                            <h4 class="mb-0 fw-bold">Komentarze</h4>
                            <p class="fw-light mb-4 pb-2">Poniżej ostatnie komentarze wybranego korepetytora</p>

                            @if ($comments->isEmpty())
                                <p>Brak komentarzy</p>
                            @else
                                @foreach ($comments as $comment)
                                    <div class="d-flex flex-start mb-4 border-bottom">
                                        <img class="rounded-circle shadow-1-strong me-3"
                                            src="{{ asset('plugins/images/users/1.jpg') }}"
                                            alt="avatar" width="60" height="60" />
                                        <div>
                                            <h6 class="fw-bold mb-1">{{ $comment->user->name }}  wystawił ocenę: {{ $comment->rating }}</h6>
                                            <div class="d-flex align-items-center mb-3">
                                                <p class="mb-0">{{ $comment->created_at->format('F d, Y') }}</p>
                                            </div>
                                            <p class="mb-0">{{ $comment->comment }}</p>
                                            </br>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection('contentnav')
