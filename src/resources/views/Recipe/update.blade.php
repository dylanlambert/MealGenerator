@extends('layout')

@section('content')
    <form action="/recipe/update/{{$recipe->getId()}}" method="post">
        @csrf
        <div class="row">
            <div class="col">
                <h1 class="recipeTitle">
                    <input class="form-control" type="text" placeholder="Nom de la recette" name="name" value="{{$recipe->getName()}}">
                </h1>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <ul class="list-group">
                    <li class="list-group-item prepTime amber">
                        <div class="form-group">
                            <label>Temps de préparation <small>en secondes</small></label>
                            <input type="number" name="preparationTime" class="form-control" placeholder="temps de préparation en secondes" value="{{$recipe->getPreparationTime()->getSeconds()}}">
                        </div>
                    </li>

                    <div class="form-group">
                        <br>
                        <h2>Ingrédients :</h2>
                        <br>
                        <div class="col">
                            <div class="dynamic-wrap">
                            @foreach($recipe->getIngredients() as $ingredientMeasured)
                                    <div class="entry input-group">
                                    <div class="col-md-7">
                                        <select class="ingredients form-control" name="ingredient[{{substr($ingredientMeasured->getId(), 0,  5)}}][id]" >
                                            @foreach($ingredients as $ingredient)
                                                <option value="{{$ingredient->getId()}}">{{$ingredient->getName()}}</option>
                                                @if($ingredientMeasured->getId() === $ingredient->getId())
                                                    <option value="{{$ingredient->getId()}}" selected>{{$ingredient->getName()}}</option>
                                                @else
                                                    <option value="{{$ingredient->getId()}}">{{$ingredient->getName()}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <input class="form-control" type="number" placeholder="quantité" name="ingredient[{{substr($ingredientMeasured->getId(), 0,  5)}}][qty]" value="{{$ingredientMeasured->getQtyNumber()}}">
                                    </div>
                                    <div class="col-md-2">
                                        <select class="form-control" id="preparationTime" name="ingredient[{{substr($ingredientMeasured->getId(), 0,  5)}}][type]">
                                            <option value="unite"
                                                @if($ingredientMeasured->getQtyType() === 'unit')
                                                    selected
                                                @endif
                                            >
                                                Unité
                                            </option>
                                            <option value="gramme"
                                                @if($ingredientMeasured->getQtyType() === 'gramme')
                                                    selected
                                                @endif>
                                                Gramme
                                            </option>
                                            <option value="millimeter"
                                                 @if($ingredientMeasured->getQtyType() === 'millimeter')
                                                    selected
                                                @endif>
                                                Millilitre
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-control formButton btn-remove btn-danger text-center" type="button">
                                            <i class="far fa-minus-square"></i>
                                        </div>
                                    </div>
                                </div>
                                    <br>
                                @endforeach

                                <div class="entry input-group">
                                    <div class="col-md-7">
                                        <select class="ingredients form-control" name="ingredient[0][id]">
                                            <option value="">Selectionner un ingrédient</option>
                                            @foreach($ingredients as $ingredient)
                                                <option value="{{$ingredient->getId()}}">{{$ingredient->getName()}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <input class="form-control" type="number" placeholder="quantité" name="ingredient[0][qty]">
                                    </div>
                                    <div class="col-md-2">
                                        <select class="form-control" id="preparationTime" name="ingredient[0][type]">
                                            <option value="unite">Unité</option>
                                            <option value="gramme">Gramme</option>
                                            <option value="millimeter">Millilitre</option>
                                        </select>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-control btn-success formButton btn-add text-center" type="button">
                                            <i class="far fa-plus-square"></i>
                                        </div>
                                    </div>
                                </div>

                                <br>

                            </div>

                            <small>Appuyer sur <i class="far fa-plus-square"></i> pour ajouter un autre ingrédient</small>
                        </div>
                    </div>
                </ul>
                <br>
            </div>

            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h2>Recette : </h2>
                        <div class="form-group">
                        <textarea rows="10" class="form-control" name="recipe" id="tiny">
                            {{$recipe->getRecipe()}}
                        </textarea>
                        </div>
                    </div>
                </div>
                <br>
                <button type="submit" class="btn btn-success btn-block">Modifier</button>
            </div>
        </div>
    </form>
@endsection
