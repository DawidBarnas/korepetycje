@extends('layouts.nav')

@section('contentnav')

       
<div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
        <div class="white-box d-flex">
            
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="plugins/images/users/varun.jpg"><span class="font-weight-bold">{{ Auth::user()->name }}</span><span class="text-black-50">{{ Auth::user()->email }}</span><span> </span></div>
            </div>
            <div class="col-md-5 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Ustawienia profilu</h4>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6"><label class="labels">Imię</label><input type="text" class="form-control" placeholder="imię" value=""></div>
                        <div class="col-md-6"><label class="labels">Nazwisko</label><input type="text" class="form-control" value="" placeholder="nazwisko"></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12"><label class="labels">Telefon</label><input type="text" class="form-control" placeholder="nr telefonu" value=""></div>
                        <div class="col-md-12"><label class="labels">Powiat</label><input type="text" class="form-control" placeholder="powiat" value=""></div>
                        <div class="col-md-12"><label class="labels">Gmina</label><input type="text" class="form-control" placeholder="gmina" value=""></div>
                        <div class="col-md-12"><label class="labels">Kod pocztowy</label><input type="text" class="form-control" placeholder="kod pocztowy" value=""></div>
                        <div class="col-md-12"><label class="labels">nr domu</label><input type="text" class="form-control" placeholder="nr domu" value=""></div>
                        <div class="col-md-12"><label class="labels">Email</label><input type="text" class="form-control" placeholder="email" value=""></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6"><label class="labels">Państwo</label><input type="text" class="form-control" placeholder="państwo" value=""></div>
                        <div class="col-md-6"><label class="labels">Województwo</label><input type="text" class="form-control" value="" placeholder="wojewodztwo"></div>
                    </div>
                    <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="button">Zapisz</button></div>
                </div>
            </div>
        
        </div>
    </div>
</div>

@endsection('contentnav')