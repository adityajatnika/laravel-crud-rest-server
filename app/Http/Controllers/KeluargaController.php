<?php

namespace App\Http\Controllers;

use App\Models\Keluarga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class KeluargaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $listKeluarga = Keluarga::where('id_user', $user->id)->get();
        return response($listKeluarga);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->validate([
            'nama' => 'required|string',
            'status_keluarga' => 'required|string',
            'jenis_kelamin' => 'required|string',
            'umur' => 'required|numeric',
            'pendidikan' => 'required|string',
            'pendapatan' => 'required|string',
        ]);

        $keluarga = new Keluarga($input);
        $keluarga->id_user = Auth::user()->id;
        $keluarga->save();

        return response($keluarga);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Keluarga  $keluarga
     * @return \Illuminate\Http\Response
     */
    public function show(Keluarga $keluarga)
    {
        if ($keluarga->id_user != Auth::user()->id) {
            throw new NotFoundHttpException("Keluarga not found");
        }
        return response($keluarga);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Keluarga  $keluarga
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Keluarga $keluarga)
    {
        if ($keluarga->id_user != Auth::user()->id) {
            throw new NotFoundHttpException("Keluarga not found");
        }
        $input = $request->validate([
            'nama' => 'required|string',
            'status_keluarga' => 'required|string',
            'jenis_kelamin' => 'required|string',
            'umur' => 'required|numeric',
            'pendidikan' => 'required|string',
            'pendapatan' => 'required|string',
        ]);

        $keluarga->fill($input);
        $keluarga->id_user = Auth::user()->id;
        $keluarga->save();

        return response($keluarga);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Keluarga  $keluarga
     * @return \Illuminate\Http\Response
     */
    public function destroy(Keluarga $keluarga)
    {
        if ($keluarga->id_user != Auth::user()->id) {
            throw new NotFoundHttpException("Keluarga not found");
        }

        $keluarga->delete();
        return response('', 204);
    }
}
