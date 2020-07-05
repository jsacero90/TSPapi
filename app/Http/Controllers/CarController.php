<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\models\Car;
use App\models\Products;

class CarController extends Controller
{

    public function index($request)
    {
        try {
            $productos = Car::paginate(15); // $estado array con los resultados trae una paginación maxima de 15 terminos ejemplo
            //servidor.net/api/productos?page=1 esta seria la url generada
            return response()->json($productos, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Not Found'], 404);
        }

    }

    // para esta instrucción se requiere que en el cuerpo de la petición vengan tres parametos idProd, cantidad, total
    public function create(Request $request){
           try {
                $producto = Products::where('id',$request['idProd'])->get();
                if ($request['cantidad'] >= $producto[0]['cantidad_disponible']+1) {
                    return response()->json("Cantidad no diponible en stock", 400);
                }
                $car = Car::create([
                    'producto' => $producto[0]['id'],
                    'nombre_producto' => $producto[0]['nombre_producto'],
                    'precio_unitario' => $producto[0]['precio_unitario'],
                    'cantidad' => $request['cantidad'],
                    'total' => $request['total'],
                ]);
                return response()->json($car, 201);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Not Found'], 404);
            }
        }
    // para esta instrucción se requiere que en el cuerpo de la petición vengan tres parametos idProd, cantidad, total
    public function update(Request $request){
        try {
            $producto = Products::where('id',$request['idProd'])->get();
            if ($request['cantidad'] >= $producto[0]['cantidad_disponible']+1) {
                return response()->json("Cantidad no diponible en stock", 400);
            }
            Car::where('producto', '=', $request['idProd'])
            ->update([
                'cantidad' => $request['cantidad'],
                'total' => $request['total'],
            ]);
            return response()->json("Se actualiza la cantidad de items", 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Not Found'], 404);
        }
    }
    // para esta instrucción se requiere que en el cuerpo de la petición vengan tres parametos idProd
    public function delete(Request $request){
        try {
            Car::where('producto', '=', $request['idProd'])->delete();
            return response()->json("Se elimina el item", 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Not Found'], 404);
        }
    }
}
