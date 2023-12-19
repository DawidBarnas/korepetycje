@extends('layouts.nav')

@section('contentnav')

       
<div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
        <div class="white-box d-flex">
            
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="plugins/images/users/varun.jpg"><span class="font-weight-bold">{{ Auth::user()->name }}</span><span class="text-black-50">{{ Auth::user()->email }}</span><span> </span></div>
            </div>
            <div class="col-md-9 border-right">
                <div class="p-5 py-7">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Twoje dane</h4>
                    </div>
                    <table class="table table-hover">
                                    
                                    <tbody>
                                            <tr>
                                                <td>Imię</td>
                                                <td>{{ $userData->name }}</td>
                                            </tr>
                                            <tr>
                                                <td>Nazwisko</td>
                                                <td>{{ $userData->surname }}</td>
                                            </tr>
                                            <tr>
                                                <td>Email</td>
                                                <td>{{ $userData->email }}</td>
                                            </tr>
                                            <tr>
                                                <td>Utworzono</td>
                                                <td>{{ $userData->created_at }}</td>
                                            </tr>
                                            
                                    </tbody>
                                </table>
                </div>
            </div>
        
        </div>
    </div>
</div>

@endsection('contentnav')