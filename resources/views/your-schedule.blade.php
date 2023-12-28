@extends('layouts.nav')

@section('contentnav')

@can('isAdmin')
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="white-box">
                <div class="d-md-flex mb-3">
                    <h3 class="box-title mb-0">Zalogowany jako admin - brak mozliwosci rezerwacji terminów</h3>
                </div>
                
            </div>
        </div>
    </div>
@endcan
    
@can('isTutor')
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="white-box">
                <div class="d-md-flex mb-3">
                    <h3 class="box-title mb-0">Twoje terminy</h3>
                    
                </div>
                <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">Id</th>
                                            <th class="border-top-0">Data</th>
                                            <th class="border-top-0">Godzina</th>
                                            <th class="border-top-0">Zarezerwował</th>
                                            <th class="border-top-0">Email</th>
                                            <th class="border-top-0">Akcja</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($tutorSchedules as $tutorSchedule)
                                            <tr>
                                                <td>{{ $tutorSchedule->id }}</td>
                                                <td>{{ $tutorSchedule->date }}</td>
                                                <td>{{ $tutorSchedule->hour }}</td>
                                                <td>
                                                @if(empty($tutorSchedule->user_id))
                                                    Wolny Termin
                                                @else
                                                    {{ $tutorSchedule->user_id }}
                                                @endif
                                                </td>
                                                <td> 
                                                    @if(empty($tutorSchedule->user_id))
                                                        -
                                                    @else
                                                        {{ $tutorSchedule->email }}
                                                    @endif 
                                                </td>
                                                <td>
                                                <a href="tutorSchedule/delete/{{ $tutorSchedule->id }}" onclick="return confirm('Czy na pewno chcesz usunąć termin?')">
                                                    <button type="button" class="btn btn-danger">Usuń</button>
                                                </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    
                                </table>
                                {{ $tutorSchedules->links() }}
                            </div>
            </div>
        </div>
    </div>                  
@endcan

@can('isUser')
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="white-box">
                <div class="d-md-flex mb-3">
                    <h3 class="box-title mb-0">Profil Korepetytora</h3>
                </div>
                <!-- INPUT Z KALENDARZA -->
            </div>
        </div>
    </div>                 
@endcan

@endsection('contentnav')
