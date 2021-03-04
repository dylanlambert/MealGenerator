@extends('layout')

@section('content')
    <div class="container-fluid">
        <div class="row">
           <div class="col">
               <h1>Insription</h1>
               <form action="/inscription" method="post">
                   @csrf
                   <div class="form-group">
                       <label>Nom</label>
                       <input type="text" class="form-control" name="nom">
                   </div>
                   <div class="form-group">
                       <label>Prenom</label>
                       <input type="text" class="form-control" name="prenom">
                   </div>
                   <div class="form-group">
                       <label>Adresse Email</label>
                       <input type="email" class="form-control" name="adresseEmail">
                   </div>
                   <div class="form-group">
                       <label>Mot de passe</label>
                       <input type="password" class="form-control" name="password">
                   </div>
                   <button class="btn btn-success" type="submit">Inscription</button>
               </form>
           </div>
        </div>
    </div>
@endsection
