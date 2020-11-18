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
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
