<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Application\Recipe\RecipeRegisterer;
use App\Application\Recipe\RecipeRegistererRequest;

final class ImportController extends Controller
{
    public function import(RecipeRegisterer $registerer) {
//        if (($handle = fopen('recettesTime.csv', "r")) !== FALSE) {
//            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
//                $request = new RecipeRegistererRequest(
//                    $data[0],
//                    (int) $data[1],
//                );
//                $registerer->register($request);
//            }
//            fclose($handle);
//        }
    }
}
