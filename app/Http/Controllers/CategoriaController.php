<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\models\Categorias;


class CategoriaController extends Controller
{

    public function index(Request $request)
    {
        try {
            $categorias = Categorias::all(); // $estado array con los resultados trae una paginación maxima de 15 terminos ejemplo
            return response()->json($categorias, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Not Found'], 404);
        }

    }
}
