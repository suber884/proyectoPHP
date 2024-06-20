<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $datos['libros'] = Libro::paginate(2);
        return view('libro.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('libro.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $campos = [
        'titulo' => 'required|string|max:100',
        'autor' => 'required|string|max:100',
        'categoria' => 'required|string|max:100',
        'editorial' => 'required|string|max:100',
        'isbn' => 'required|string|max:100|unique:libros,isbn',
        'imagen' => 'required|max:10000|mimes:jpg,jpeg,png,gif',
        'precio' => 'required|integer|max:100',
              ];
       $mensaje = [
        'required' => 'El :attribute es requerido',
        'categoria.required'=>'La categoria es requerida',
        'editorial.required'=>'La editorial es requerida',
        'imagen.required'=>'La imagen es requerida',
        'unique'=>'El ISBN ya esta registrado',
       ];
       

       $this->validate($request, $campos, $mensaje);

        $datosLibro = request()->except('_token');
        if ($request->hasFile('imagen')) {
            $datosLibro['imagen'] = $request->file('imagen')->store('uploads', 'public');
        }
        Libro::insert($datosLibro);
        // return response()->json($datosLibro);
        return redirect('libro')->with('mensaje', 'Libro insertado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Libro $libro)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $libro = Libro::findOrFail($id);
        return view('libro.edit', compact('libro'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $campos = [
            'titulo' => 'required|string|max:100',
            'autor' => 'required|string|max:100',
            'categoria' => 'required|string|max:100',
            'editorial' => 'required|string|max:100',
            'isbn' => 'required|string|max:100|unique:libros,isbn',
            'precio' => 'required|integer|max:100',
           
           ];
           $mensaje = [
            'required' => 'El :attribute es requerido',
            'categoria.required'=>'La categoria es requerida',
            'editorial.required'=>'La editorial es requerida',
           'unique'=>'El ISBN ya esta registrado',
           ];
           if ($request->hasFile('imagen')) {
            $campos=[ 'imagen' => 'required|max:10000|mimes:jpg,jpeg,png,gif'];
            $mensaje=[ 'imagen.required' => 'La imagen es requerida'];
           }

           $this->validate($request, $campos, $mensaje);
        $datosLibro = request()->except(['_token', '_method']);

        if ($request->hasFile('imagen')) {
            $libro = Libro::findOrFail($id);
            Storage::delete('public/' . $libro->imagen);
            $datosLibro['imagen'] = $request->file('imagen')->store('uploads', 'public');
        }
        Libro::where('id', '=', $id)->update($datosLibro);
        $libro = Libro::findOrFail($id);
        // return view('libro.edit', compact('libro'));
        return redirect('libro')->with('mensaje', 'Libro modificado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $libro = Libro::findOrFail($id);
        if (Storage::delete('public/' . $libro->imagen)) {
            Libro::destroy($id);
        }
        return redirect('libro')->with('mensaje', 'Libro borrado');
    }
}
