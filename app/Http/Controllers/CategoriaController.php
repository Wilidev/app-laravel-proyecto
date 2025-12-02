<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Barryvdh\DomPDF\Facade\Pdf;
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
        $categoria = Categoria::create($request->all());

        return response()->json(
            [
                'success' => true,
                'nombre' => 'Wiliam Dida 😎',
                'data' => $categoria
            ]
        );
    }
    public function editarCategoria(Request $request, $id_categoria)
    {
        $validate = $request->validate([
            'descripcion' => 'required|string',
            'nombre_categoria' => 'required'
        ]);

        $categoria = Categoria::find($id_categoria);

        $categoria->update([
            'descripcion' => $request->descripcion,
            'nombre_categoria' => $request->nombre_categoria,
        ]);
        return response()->json([
            'success' => true,
            'nombre' => 'Diego Lipa',
            'data' => $categoria
        ]);
    }
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

    public function exportarPdfCategoria()
    {
        $categorias = Categoria::orderBy('created_at', 'desc')->get();

        $pdf = Pdf::loadView('categorias.pdf', compact('categorias'));

        $pdf->setPaper('a4');

        return $pdf->download('reporte_categoria.pdf');
    }
}
