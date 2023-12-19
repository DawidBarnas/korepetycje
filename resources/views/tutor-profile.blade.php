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
        </div>
    </div>
</div>
@endsection('contentnav')
