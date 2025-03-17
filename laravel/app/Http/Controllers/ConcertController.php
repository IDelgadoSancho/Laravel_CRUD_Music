<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Concert;
use App\Models\Festival;
use App\Models\Artista;


class ConcertController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function list()
    {
        $concerts = Concert::with('festival')->get();
        return view('concert.list', ['concerts' => $concerts]);
    }

    /**
     * Store a newly created resource in storage.
     */
    function new(Request $request)
    {
        if ($request->isMethod('post')) {

            $concert = new concert;
            $concert->nom = $request->nom;
            $concert->data_hora = $request->data_hora;
            $concert->aforament = $request->aforament;
            $concert->entrades_disponibles = $request->entrades_disponibles;
            $concert->festival_id = $request->festival_id;
            $concert->save();

            return redirect()->route('concert_list')->with('status', 'Nou concert ' . $concert->nom . ' creat!');
        }

        $artistas = Artista::all();
        $festivals = Festival::all();
        return view('concert.new', ['festivals' => $festivals, 'artistas' => $artistas]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, Request $request)
    {
        $concert = concert::find($id);
        if ($request->isMethod('post')) {

            $concert->nom = $request->nom;
            $concert->data_hora = $request->data_hora;
            $concert->aforament = $request->aforament;
            $concert->entrades_disponibles = $request->entrades_disponibles;
            $concert->festival_id = $request->festival_id;
            $concert->save();

            return redirect()->route('concert_list')->with('status', 'Concert ' .
                $concert->nom . ' editat!');
        }

        $festivals = Festival::all();
        return view('concert.edit', ['concert' => $concert, 'festivals' => $festivals]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $concert = concert::find($id);
        $concert->delete();

        return redirect()->route('concert_list')->with('status', 'Concert ' .
            $concert->nom . ' eliminat!');
    }

}
