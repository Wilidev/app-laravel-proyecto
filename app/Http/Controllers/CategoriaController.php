<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    //crud
    //listar
    public function listarCategoria()
    {
        //$categorias = Categoria::all();
        $categorias = Categoria::orderBy('created_at', 'asc')->get();
        // $categorias = categoria::first();
        return response()->json(
            [
                'success' => true,
                'nombre' => 'Wiliam Dida 😎',
                'data' => $categorias
            ]
        );
    }
    public function guardarCategoria(Request $request)
    {
        $validate = $request->validate([
            'descripcion' => 'required|string',
            'nombre_categoria' => 'required'
        ]);
        $categoria = categoria::create($request->all());

        return response()->json(
            [
                'success' => true,
                'nombre' => 'Wiliam Dida 😎',
                'data' => $categoria
            ]
        );
    }
    public function editarCategoria() {}
    public function eliminarCategoria($id_categoria)
    {
        $categoria = Categoria::findOrfail($id_categoria);
        $categoria->delete();

        return response()->json(
            [
                'success' => true,
                'nombre' => 'Wiliam Dida 😎',
                'data' => null
            ]
        );
    }
}
