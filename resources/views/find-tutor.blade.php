@extends('layouts.nav')

@section('contentnav')

<div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12">
        <div class="white-box">
            <div class="d-md-flex justify-content-between align-items-center mb-3">
                <h3 class="box-title mb-0">Korepetytorzy</h3>
                <form action="{{ route('findTutor') }}" method="get" class="d-flex">
                    <input type="search" id="search" name="search" class="form-control" placeholder="Wyszukiwanie" />
                    <button type="submit" class="btn btn-primary" data-mdb-ripple-init>
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class="border-top-0">Id</th>
                            <th class="border-top-0">Imie</th>
                            <th class="border-top-0">Nazwisko</th>
                            <th class="border-top-0">E-mail</th>
                            <th class="border-top-0">Przedmiot</th>
                            <th class="border-top-0">Akcja</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tutors as $tutor)
                            <tr>
                                <td>{{ $tutor->id }}</td>
                                <td>{{ $tutor->name }}</td>
                                <td>{{ $tutor->surname }}</td>
                                <td>{{ $tutor->email }}</td>
                                <td>
                                    @if($tutor->subjects->isNotEmpty())
                                        {{ $tutor->subjects->first()->name }}
                                    @else
                                        Nie wybrano
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('showTutorProfile', $tutor->id) }}">
                                        <button type="button" class="btn btn-primary">Wyświetl profil</button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $tutors->links() }}
            </div>
        </div>
    </div>
</div>

@endsection('contentnav')
