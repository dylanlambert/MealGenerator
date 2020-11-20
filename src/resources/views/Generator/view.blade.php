@extends('layout')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <h2>Liste des courses</h2>
            <ul class="list-group">
                @foreach($ingredients as $ingredient)
                    <li class="list-group-item">
                        <div>
                            {{$ingredient->getName()}}
                            <span style="float: right">
                            {{$ingredient->getQuantity()}}
                        </span>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="col-md">
            <h2>Listes des recettes</h2>
            <form action="/historic/save" method="post">
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="historicName">Nom de la liste</label>
                            <input id="historicName" class="form-control" type="text" name="name">
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach($recipes as $recipe)
                        <div class="col-md-4">
                            <a href="{{$recipe->getUrl()}}" class="card">
                                <div class="card-body">
                                    <div class="card-title">
                                        {{$recipe->getName()}}
                                    </div>
                                    <h6 class="card-subtitle mb-2 text-muted"><i
                                            class="far fa-clock"></i> {{$recipe->getPreparationTime()->getFormattedPreparationTime()}}
                                    </h6>
                                </div>
                            </a>
                            <input type="text" hidden name="recipesId[]" value="{{$recipe->getId()}}" />
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col">
                        <input type="submit" class="btn btn-success" value="Enregistrer">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
