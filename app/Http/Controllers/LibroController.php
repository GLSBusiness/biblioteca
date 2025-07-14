<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use Illuminate\Http\Request;

class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return response()->json(Libro::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'autor' => 'required|string|max:255',
            'anio_publicacion' => 'required|integer',
        ]);

        $libro = Libro::create($validated);
        return response()->json($libro, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
         $libro = Libro::find($id);
        if (!$libro) {
            return response()->json(['error' => 'Libro no encontrado'], 404);
        }

        return response()->json($libro);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Libro $libro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
     public function update(Request $request, $id)
    {
        $libro = Libro::find($id);
        if (!$libro) {
            return response()->json(['error' => 'Libro no encontrado'], 404);
        }

        $validated = $request->validate([
            'titulo' => 'string|max:255',
            'autor' => 'string|max:255',
            'anio_publicacion' => 'integer',
        ]);

        $libro->update($validated);
        return response()->json($libro);
    }

    /**
     * Remove the specified resource from storage.
     */
  public function destroy($id)
    {
        $libro = Libro::find($id);
        if (!$libro) {
            return response()->json(['error' => 'Libro no encontrado'], 404);
        }

        $libro->delete();
        return response()->json(['mensaje' => 'Libro eliminado']);
    }
}
