<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Concert;
use App\Models\Festival;
use App\Models\Artista;
use Illuminate\Support\Facades\Auth;


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
     * Filters.
     */
    function concert_cerca(Request $request)
    {
        $concert = new Concert;
        $concerts = $concert->cercaArtista($request->cercar);
        return view('concert.list', ['concerts' => $concerts]);
    }

    function concer_filtre_data(Request $request)
    {
        $concert = new Concert;
        $concerts = $concert->filtreData($request->input('sort'));
        return view('concert.list', ['concerts' => $concerts]);
    }

    function concer_filtre_aforament(Request $request)
    {
        $concert = new Concert;
        $concerts = $concert->filtreAforament($request->input('sort'));
        return view('concert.list', ['concerts' => $concerts]);
    }

    function concer_filtre_entrades(Request $request)
    {
        $concert = new Concert;
        $concerts = $concert->filtreEntrades($request->input('sort'));
        return view('concert.list', ['concerts' => $concerts]);
    }

    /**
     * Store a newly created resource in storage.
     */
    function new(Request $request)
    {

        $concert = new concert;

        if ($request->isMethod('post')) {

            $concert->nom = $request->nom;
            $concert->data_hora = $request->data_hora;
            $concert->aforament = $request->aforament;
            $concert->entrades_disponibles = $request->entrades_disponibles;
            $concert->festival_id = $request->festival_id;
            $concert->save();

        }

        if ($request->has('asignado')) {

            $array = [];
            foreach ($request->asignado as $artista_id => $value) {
                $array[$artista_id] = ['sou' => $request->sou[$artista_id]];
            }

            $concert->artistas()->sync($array);
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
        }

        if (isset($request->asignado)) {

            $array = [];
            foreach ($request->asignado as $artista_id => $value) {
                $array[$artista_id] = ['sou' => $request->sou[$artista_id]];
            }

            $concert->artistas()->sync($array);
            return redirect()->route('concert_list')->with('status', 'Concert ' .
                $concert->nom . ' editat!');
        }

        $artistas = Artista::all();
        $festivals = Festival::all();
        return view('concert.edit', ['concert' => $concert, 'festivals' => $festivals, 'artistas' => $artistas]);
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

    public function comprarEntrades(Request $request, $id)
    {
        $concert = Concert::findOrFail($id);
        $usuari = Auth::user();
        $entradesNoves = $request->input('entrades');

        // verifica
        $compra = $concert->usuaris()->where('user_id', $usuari->id)->first();

        if ($compra) {
            // suma
            $entradesTotals = $compra->pivot->entrades_comprades + $entradesNoves;

            // afortament
            if ($entradesTotals > $concert->aforament) {
                return redirect()->back()->with('error', 'No hi ha suficients entrades disponibles.');
            }

            // actualitzar
            $concert->usuaris()->updateExistingPivot($usuari->id, ['entrades_comprades' => $entradesTotals]);
        } else {
            if ($entradesNoves > $concert->entradesDisponibles()) {
                return redirect()->back()->with('error', 'No hi ha suficients entrades disponibles.');
            }

            $concert->usuaris()->attach($usuari->id, ['entrades_comprades' => $entradesNoves]);
        }

        return redirect()->route('concert_list', $concert->id)->with('success', 'Compra realitzada correctament!');
    }

}
