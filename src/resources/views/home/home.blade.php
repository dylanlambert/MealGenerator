@extends('layout')

@section('content')
    <div class="row">
        <div class="col-md">
            <div class="card lightPinkBg" data-toggle="modal" data-target="#generator">
                <div class="card-body">
                    <h2>Généré une liste</h2>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="generator" tabindex="-1" role="dialog" aria-labelledby="generator" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="/generator">
                    <div class="modal-header">
                        <h5 class="modal-title" id="generatorModalLabel">Générer une liste de repas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <div class="form-group">
                                <label for="generatorNbRecipe">Nombre de repas</label>
                                <input id="generatorNbRecipe" type="number" class="form-control" name="numberOfRecipe">
                            </div>
                            <div class="form-group">
                                <label for="generatorPreparationTime">Nombre de repas</label>
                                <select class="form-control" id="preparationTime" name="preparationTime">
                                    <option>toutes</option>
                                    <option value="600">< 10 m</option>
                                    <option value="900">< 15 m</option>
                                    <option value="1200">< 20 m</option>
                                    <option value="1500">< 25 m</option>
                                    <option value="1800">< 30 m</option>
                                </select>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Générer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
