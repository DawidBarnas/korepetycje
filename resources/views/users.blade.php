@extends('layouts.nav')

@section('contentnav')

<div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="white-box">
                            <div class="d-md-flex mb-3">
                                <h3 class="box-title mb-0">Użytkownicy</h3>
                                <div class="col-md-3 col-sm-4 col-xs-6 ms-auto">
                                    <select class="form-select shadow-none row border-top">
                                        <option>Wszyscy</option>
                                        <option>Użytkownicy</option>
                                        <option>Korepetytorzy</option>
                                    </select>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">#</th>
                                            <th class="border-top-0">Imie</th>
                                            <th class="border-top-0">Nazwisko</th>
                                            <th class="border-top-0">E-mail</th>
                                            <th class="border-top-0">Rola</th>
                                            <th class="border-top-0">Akcja</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $user)
                                            <tr>
                                                <td>{{ $user->id }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->surname }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    @if($user->role === 'user')
                                                        Użytkownik
                                                    @elseif($user->role === 'admin')
                                                        Administrator
                                                    @elseif($user->role === 'tutor')
                                                        Korepetytor
                                                    @else
                                                        Inna rola
                                                    @endif    
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


@endsection('contentnav')