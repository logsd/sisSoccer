<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoriaRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use Exception;
use Illuminate\Validation\Rules\Can;

class categoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = Category::latest()->get();
        return view('categoria.index', ['categorias' => $categorias]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categoria.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoriaRequest $request)
    {

        try {
            DB::beginTransaction();

            // Validar y obtener los datos validados
            $validatedData = $request->validated();

            Category::create($validatedData);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
        return redirect()->route('categorias.index')->with('success', 'Categoría registrada!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $categoria)
    {
        return view('categoria.edit', ['categoria' => $categoria]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCategoriaRequest $request, Category $categoria)
    {
        $categoria->update($request->validated());
        return redirect()->route('categorias.index')->with('success', 'Categoría actualizada!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $message = '';
        $categoria = Category::find($id);

        if ($categoria->state == 1) {
            $categoria->update([
                'state' => 0
            ]);
            $message = 'Categoría Deshabilitado';
        } else {
            $categoria->update([
                'state' => 1
            ]);
            $message = 'Categoría Habilitada';
        }
        return redirect()->route('categorias.index')->with('success', $message);
    }

    public function forceDelete($id)
    {
        $categoria = Category::find($id);
        if ($categoria) {
            $categoria->delete();
            return redirect()->route('categorias.index')->with('success', 'Categoría eliminada definitivamente');
        }

        return redirect()->route('categorias.index')->with('error', 'La Categoría no fue encontrado');
    }
}
