@extends('layout')

@section('content')
    <div class="container-fluid">
        <div class="row">
           <div class="col">
               <h1>Connection</h1>
               <form action="/connection" method="post">
                   @csrf
                   <div class="form-group">
                       <label for="email">Adresse Email</label>
                       <input type="email" class="form-control" name="adresseEmail">
                   </div>
                   <div class="form-group">
                       <label for="email">Mot de passe</label>
                       <input type="password" class="form-control" name="password">
                   </div>

                   <button class="btn btn-success" type="submit">Connection</button>
               </form>
               <br>
               <h2>Pas encore inscrit ? <small> <br> <a href="/inscription"><i class="fas fa-sign-in"></i> inscrivez vous !</a></small></h2>
           </div>
        </div>
    </div>
@endsection
