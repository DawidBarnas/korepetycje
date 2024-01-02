@extends('layouts.nav')

@section('contentnav')
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="white-box">
                @can('isTutor')
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
                @endcan
            </div>
        </div>
    </div>
@endsection
