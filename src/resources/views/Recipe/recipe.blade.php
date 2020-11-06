@extends('layout')

@section('content')

    <div class="row">
        <div class="col">
            <h1 class="recipeTitle">
                <i class="far fa-folder-open"></i> {{$recipe->getName()}}
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <ul class="list-group">
                <li class="list-group-item prepTime amber">
                    <i class="far fa-clock" ></i> {{$recipe->getPreparationTime()}}
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
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad consequuntur cum debitis, error et
                        ex fuga
                        nihil nobis perspiciatis placeat quas qui quidem quo recusandae similique temporibus totam vel
                        voluptates!
                    </p>
                    <p>Accusantium ad at aut, autem cumque deserunt dicta doloremque dolores, eius enim eos ex fugit
                        labore
                        libero magnam mollitia natus, non nostrum odit perspiciatis quae quam quos reprehenderit soluta
                        voluptate!
                    </p>
                    <p>Debitis delectus deserunt eaque, eos facere fugit ipsum itaque magnam natus neque nihil odio
                        praesentium qui sit tempore, vero voluptates voluptatibus! Aut, facere ipsa nemo odit officia
                        quasi
                        recusandae voluptatum.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
