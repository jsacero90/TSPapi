<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\models\Products;

class ProductsController extends Controller
{

    public function index(Request $request)
    {
        try {
            $productos = Products::paginate(15); // $estado array con los resultados trae una paginación maxima de 15 terminos ejemplo
            //servidor.net/api/productos?page=1 esta seria la url generada
            return response()->json($productos, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Not Found'], 404);
        }

    }

    public function id_producto(Request $request, $id)
        {
            try {
                $productos = Products::where('id',$id)->get();
                return response()->json($productos, 200);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Not Found'], 404);
            }
        }
}
