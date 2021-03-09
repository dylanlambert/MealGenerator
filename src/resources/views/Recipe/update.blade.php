@extends('layout')

@section('content')
    <form action="/recipe/update/{{$recipe->getId()}}" method="post">
        @csrf
        <div class="row">
            <div class="col">
                <h1 class="recipeTitle">
                    <input class="form-control" type="text" placeholder="Nom de la recette" name="name"
                           value="{{$recipe->getName()}}">
                </h1>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <ul class="list-group">
                    <li class="list-group-item prepTime amber">
                        <div class="form-group">
                            <label>Temps de préparation <small>en secondes</small></label>
                            <input type="number" name="preparationTime" class="form-control"
                                   placeholder="temps de préparation en secondes"
                                   value="{{$recipe->getPreparationTime()->getSeconds()}}">
                        </div>
                    </li>
                    <li>
                        <h2>Ingrédients :</h2>
                        <br>
                        <div class="col">
                            <div data-role="dynamic-fields">
                                @forelse($recipe->getIngredients() as $ingredientMeasured)
                                    <div class="form-inline dynamicField">
                                        <div class="form-group">
                                            <label class="sr-only" for="field-value">Ingrédient</label>
                                            <select class="selectpicker ingredient" data-live-search="true"
                                                    name="ingredient[{{substr($ingredientMeasured->getId(), 0,  5)}}][id]">
                                                @foreach($ingredients as $ingredient)
                                                    <option data-tokens="{{$ingredient->getName()}}"
                                                            value="{{$ingredient->getId()}}"
                                                            @if($ingredientMeasured->getId() === $ingredient->getId())
                                                            selected
                                                        @endif
                                                    >{{$ingredient->getName()}}</option>

                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="sr-only" for="field-value">Quantitée</label>
                                            <input class="form-control qty" type="number" placeholder="quantité"
                                                   name="ingredient[{{substr($ingredientMeasured->getId(), 0,  5)}}][qty]"
                                                   value="{{$ingredientMeasured->getQtyNumber()}}">
                                        </div>
                                        <div class="form-group">
                                            <label class="sr-only" for="field-value">Unitée</label>
                                            <select class="form-control type"
                                                    name="ingredient[{{substr($ingredientMeasured->getId(), 0,  5)}}][type]">
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
                                                        @if($ingredientMeasured->getQtyType() === 'milliliter')
                                                        selected
                                                    @endif>
                                                    Millilitre
                                                </option>
                                            </select>
                                        </div>
                                        <button class="btn btn-danger" data-role="remove">
                                            -
                                        </button>
                                        <button class="btn btn-primary" data-role="add">
                                            +
                                        </button>
                                    </div>  <!-- /div.form-inline -->
                                @empty
                                    <div class="form-inline dynamicField">
                                        <div class="form-group">
                                            <label class="sr-only" for="field-value">Ingrédient</label>
                                            <select class="selectpicker ingredient" data-live-search="true" name="ingredient[0][id]">
                                                @foreach($ingredients as $ingredient)
                                                    <option data-tokens="{{$ingredient->getName()}}" value="{{$ingredient->getId()}}">{{$ingredient->getName()}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="sr-only" for="field-value">Quantitée</label>
                                            <input class="form-control qty" type="number" placeholder="quantité" name="ingredient[0][qty]" value="0">
                                        </div>
                                        <div class="form-group">
                                            <label class="sr-only" for="field-value">Unitée</label>
                                            <select class="form-control type"
                                                    name="ingredient[0][type]">
                                                <option value="unite">
                                                    Unité
                                                </option>
                                                <option value="gramme">
                                                    Gramme
                                                </option>
                                                <option value="millimeter">
                                                    Millilitre
                                                </option>
                                            </select>
                                        </div>
                                        <button class="btn btn-danger" data-role="remove">
                                            -
                                        </button>
                                        <button class="btn btn-primary" data-role="add">
                                            +
                                        </button>
                                    </div>  <!-- /div.form-inline -->
                                @endforelse
                            </div>
                        </div>
                    </li>
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
