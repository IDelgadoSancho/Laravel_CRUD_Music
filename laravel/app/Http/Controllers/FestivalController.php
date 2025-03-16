<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Festival;
use App\Models\User;
use Illuminate\Support\Facades\File;

class FestivalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function list()
    {
        $festivals = Festival::with('organitzador')->get();
        return view('festival.list', ['festivals' => $festivals]);
    }

    /**
     * Store a newly created resource in storage.
     */
    function new(Request $request)
    {
        if ($request->isMethod('post')) {

            $festival = new festival;
            $festival->nom = $request->nom;
            $festival->ubicacio = $request->ubicacio;
            $festival->data_inici = $request->data_inici;
            $festival->data_fi = $request->data_fi;

            // imagen
            if ($request->file('cartell')) {
                $file = $request->file('cartell');
                //guardem en una variable $filename el nom que posarem al fitxer
                $extension = $file->getClientOriginalExtension();
                $filename = $festival->nom . "_" . $festival->data_inici . "." . $extension;
                $file->move(public_path(env('RUTA_IMATGES')), $filename);
                $festival->cartell = $filename;
            }

            $festival->user_id = $request->user_id;
            $festival->save();

            return redirect()->route('festival_list')->with('status', 'Nou festival ' . $festival->nom . ' creat!');
        }

        $users = User::all();

        return view('festival.new', ['users' => $users]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, Request $request)
    {
        $festival = festival::find($id);
        if ($request->isMethod('post')) {

            $festival->nom = $request->nom;
            $festival->ubicacio = $request->ubicacio;
            $festival->data_inici = $request->data_inici;
            $festival->data_fi = $request->data_fi;
            $festival->user_id = $request->user_id;

            // imagen
            if ($request->file('cartell')) {
                $file = $request->file('cartell');
                //guardem en una variable $filename el nom que posarem al fitxer
                $extension = $file->getClientOriginalExtension();
                $filename = $festival->nom . "_" . $festival->data_inici . "." . $extension;
                $file->move(public_path(env('RUTA_IMATGES')), $filename);
                $festival->cartell = $filename;
            }

            $active = $request->input('delete_photo', 1);
            if ($active == 0) {
                $filename = $festival->cartell;
                $festival->cartell = null;
                File::delete(public_path(env('RUTA_IMATGES')) . $filename);
            }

            $festival->save();

            return redirect()->route('festival_list')->with('status', 'Festival ' .
                $festival->nom . ' editat!');
        }

        $users = User::all();
        return view('festival.edit', ['festival' => $festival, 'users' => $users]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $festival = festival::find($id);
        $festival->delete();

        return redirect()->route('festival_list')->with('status', 'Festival ' .
            $festival->nom . ' eliminat!');
    }
}
