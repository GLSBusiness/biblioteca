<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)
{
    $perPage = min($request->get('per_page', 10), 50); // Máximo 50 por página
    $libros = Libro::paginate($perPage);

    return response()->json($libros);
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
        'titulo' => 'required|string',
        'autor' => 'required|string',
        'anio_publicacion' => 'nullable|integer',
    ]);

    $info = $this->consultarOpenLibrary($validated['titulo']);

    $libro = Libro::create([
        'titulo' => $validated['titulo'],
        'autor' => $validated['autor'],
        'anio_publicacion' => $validated['anio_publicacion'] ?? $info['anio'] ?? null,
        'descripcion' => $info['descripcion'] ?? null,
        'paginas' => $info['paginas'] ?? null,
    ]);

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
        'anio_publicacion' => 'nullable|integer',
    ]);

    // Si se envía el título, intentamos consultar OpenLibrary
    $info = [];
    if (!empty($validated['titulo'])) {
        $info = $this->consultarOpenLibrary($validated['titulo']);
    }

    $libro->update([
        'titulo' => $validated['titulo'] ?? $libro->titulo,
        'autor' => $validated['autor'] ?? $libro->autor,
        'anio_publicacion' => $validated['anio_publicacion'] ?? $info['anio'] ?? $libro->anio_publicacion,
        'descripcion' => $info['descripcion'] ?? $libro->descripcion,
        'paginas' => $info['paginas'] ?? $libro->paginas,
    ]);

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
    private function consultarOpenLibrary($titulo)
{
    $response = Http::get("https://openlibrary.org/search.json", [
        'title' => $titulo
    ]);

    if ($response->successful() && isset($response['docs'][0])) {
        $book = $response['docs'][0];

        return [
            'descripcion' => $book['first_sentence'] ?? null,
            'paginas' => $book['number_of_pages_median'] ?? null,
            'anio' => $book['first_publish_year'] ?? null,
        ];
    }

    return [];
}
}