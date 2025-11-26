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
        $categorias = Categoria::orderBy('created_at','asc')->get();
        // $categorias = categoria::first();
        return response()->json(
            [
                'success' => true,
                'nombre' => 'Wiliam Dida 😎',
                'data' => $categorias
            ]
        );
    }
    public function agregarCategoria()
    {
        $categorias = Categoria::orderBy();
    }
    public function editarCategoria() {}
    public function eliminarCategoria() {}
}
