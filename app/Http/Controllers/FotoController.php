<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class FotoController extends Controller
{
    public function index() 
    {
        $fotos = Foto::orderBy('nombre_original')->get();
        return view('imagen.index', compact('fotos'));
    }

    public function create()
    {
        return view('imagen.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $file = $request->file('file');
        $originalName = $file->getClientOriginalName();
        $timestamp = Carbon::now()->format('Y_m_d_H_i_s');
        $fileName = $timestamp . '_' . $originalName;
        $filePath = 'foto/' . $fileName;

        Storage::disk('private')->putFileAs('foto', $file, $fileName);


        Foto::create([
            'nombre_original' => $originalName,
            'nombre' => $fileName,
            'link' => $filePath,
        ]);

        return redirect()->route('foto.index')->with('success', 'Foto subida correctamente');;
    }

    public function show($id)
    {
        $fotos = Foto::orderBy('created_at', 'desc')->get();

        return view('fotos.show', compact('fotos'));
    }

    public function destroy($id)
    {
        $foto = Foto::findOrFail($id);
    
        Storage::disk('private')->delete($foto->link);
    
        $foto->delete();
    
        return redirect()->back()->with('success', 'Foto eliminada correctamente');
    }
    

    public function view(Foto $photo)
    {
        $path = storage_path('app/private/' . $photo->link);

        if (!file_exists($path)) {
            abort(404);
        }

        $file = file_get_contents($path);
        $type = mime_content_type($path);

        return response($file, 200)->header('Content-Type', $type);
    }


public function lista() 
{
    // Obtiene todas las fotos
    $fotos = Foto::orderBy('created_at', 'desc')->get();

    // Retorna la vista con las fotos
    return view('imagen.show', compact('fotos'));
}



}