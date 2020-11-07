@extends('layout')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <h2>Liste des courses</h2>
            <ul class="list-group">
                <li class="list-group-item">
                    <div>
                        ingrédient 1
                        <span style="float: right">
                            150g
                        </span>
                    </div>
                </li>
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
                                <h6 class="card-subtitle mb-2 text-muted"><i class="far fa-clock" ></i> {{$recipe->getPreparationTime()}}</h6>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
