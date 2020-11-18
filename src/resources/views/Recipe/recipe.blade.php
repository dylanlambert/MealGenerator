@extends('layout')

@section('content')

    <div class="row">
        <div class="col">
            <h1 class="recipeTitle">
                <i class="far fa-folder-open"></i> {{$recipe->getName()}}
                <a href="/recipe/update/{{$recipe->getId()}}" style="float: right; color: #FFF"><i class="far fa-edit"></i></a>
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <ul class="list-group">
                <li class="list-group-item prepTime amber">
                    <i class="far fa-clock" ></i> {{$recipe->getPreparationTime()->getFormattedPreparationTime()}}
                </li>
                @foreach($recipe->getIngredients() as $ingredient)
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
            <br>
        </div>

        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h2>Recette : </h2>
                    {!! $recipe->getRecipe() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
