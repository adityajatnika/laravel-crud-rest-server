<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class LokasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $listLokasi = Lokasi::where('id_user', $user->id)->get();
        return response($listLokasi);
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
            'kota_kab' => 'required|string',
            'kecamatan' => 'required|string',
            'kelurahan_desa' => 'required|string',
            'rt' => 'required|string',
            'rw' => 'required|string',
            'lat' => 'required|numeric',
            'lon' => 'required|numeric',
        ]);

        $lokasi = new Lokasi($input);
        $lokasi->id_user = Auth::user()->id;
        $lokasi->save();

        return response($lokasi);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lokasi  $lokasi
     * @return \Illuminate\Http\Response
     */
    public function show(Lokasi $lokasi)
    {
        if ($lokasi->id_user != Auth::user()->id) {
            throw new NotFoundHttpException("Lokasi not found");
        }
        return response($lokasi);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lokasi  $lokasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lokasi $lokasi)
    {
        if ($lokasi->id_user != Auth::user()->id) {
            throw new NotFoundHttpException("Lokasi not found");
        }
        $input = $request->validate([
            'kota_kab' => 'required|string',
            'kecamatan' => 'required|string',
            'kelurahan_desa' => 'required|string',
            'rt' => 'required|string',
            'rw' => 'required|string',
            'lat' => 'required|numeric',
            'lon' => 'required|numeric',
        ]);

        $lokasi->fill($input);
        $lokasi->id_user = Auth::user()->id;
        $lokasi->save();

        return response($lokasi);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lokasi  $lokasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lokasi $lokasi)
    {
        if ($lokasi->id_user != Auth::user()->id) {
            throw new NotFoundHttpException("Lokasi not found");
        }

        $lokasi->delete();
        return response('', 204);
    }
}
