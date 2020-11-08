@extends('layout')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <form action="/recipes">
                        <div class="form-row">
                            <div class="col-md">
                                <select class="form-control" id="preparationTime" name="preparationTime">
                                    <option value="">toutes</option>
                                    <option value="600">< 10 m</option>
                                    <option value="900">< 15 m</option>
                                    <option value="1200">< 20 m</option>
                                    <option value="1500">< 25 m</option>
                                    <option value="1800">< 30 m</option>
                                </select>
                            </div>
                            <div class="col-md">
                                <button class="form-control pinkNav" type="submit">Rechercher</button>
                            </div>
                        </div>
                    </form>
                </div>
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
                        <h6 class="card-subtitle mb-2 text-muted"><i class="far fa-clock" ></i> {{$recipe->getPreparationTime()->getFormattedPreparationTime()}}</h6>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endsection
