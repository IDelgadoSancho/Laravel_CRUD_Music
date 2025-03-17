<?php

namespace App\Http\Controllers;

use App\Models\Artista;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class ArtistaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function list()
    {
        $artistas = Artista::all();
        return view('artista.list', ['artistas' => $artistas]);
    }

    /**
     * Store a newly created resource in storage.
     */
    function new(Request $request)
    {
        if ($request->isMethod('post')) {

            $artista = new artista;
            $artista->nom = $request->nom;
            $artista->genere_musical = $request->genere_musical;
            $artista->pais_origen = $request->pais_origen;

            // imagen
            if ($request->file('foto_artista')) {
                $file = $request->file('foto_artista');
                //guardem en una variable $filename el nom que posarem al fitxer
                $extension = $file->getClientOriginalExtension();
                $filename = $artista->nom . "." . $extension;
                $file->move(public_path(env('RUTA_IMATGES')), $filename);
                $artista->foto_artista = $filename;
            }

            $artista->save();

            return redirect()->route('artista_list')->with('status', 'Nou artista ' . $artista->nom . ' creat!');
        }

        return view('artista.new');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, Request $request)
    {
        $artista = artista::find($id);
        if ($request->isMethod('post')) {

            $artista->nom = $request->nom;
            $artista->genere_musical = $request->genere_musical;
            $artista->pais_origen = $request->pais_origen;

            // imagen
            if ($request->file('foto_artista')) {
                $file = $request->file('foto_artista');
                //guardem en una variable $filename el nom que posarem al fitxer
                $extension = $file->getClientOriginalExtension();
                $filename = $artista->nom . "." . $extension;
                $file->move(public_path(env('RUTA_IMATGES')), $filename);
                $artista->foto_artista = $filename;
            }

            $active = $request->input('delete_photo', 1);
            if ($active == 0) {
                $filename = $artista->foto_artista;
                $artista->foto_artista = null;
                File::delete(public_path(env('RUTA_IMATGES')) . $filename);
            }

            $artista->save();

            return redirect()->route('artista_list')->with('status', 'Artista ' .
                $artista->nom . ' editat!');
        }

        return view('artista.edit', ['artista' => $artista]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $artista = artista::find($id);
        $artista->delete();

        return redirect()->route('artista_list')->with('status', 'Artista ' .
            $artista->nom . ' eliminat!');
    }

}
