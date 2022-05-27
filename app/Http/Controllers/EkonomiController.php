<?php

namespace App\Http\Controllers;

use App\Models\Ekonomi;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use function PHPSTORM_META\type;

class EkonomiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listEkonomi = Ekonomi::where('id_user', Auth::user()->id)->get();
        return response($listEkonomi);
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
            'total_pendapatan' => 'required|string',
            'pendapatan_usaha' => 'required|numeric',
            'pendapatan_kiriman' => 'required|numeric',
            'subsidi_pemerintah' => 'required|boolean',
        ]);

        $checkEkonomi = Ekonomi::where('id_user', Auth::user()->id)->get();
        if (count($checkEkonomi) !== 0) {
            throw new ConflictHttpException('Duplicate item');
        }

        $ekonomi = new Ekonomi($input);
        $ekonomi->id_user = Auth::user()->id;
        $ekonomi->save();

        return response($ekonomi);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ekonomi  $ekonomi
     * @return \Illuminate\Http\Response
     */
    public function show(Ekonomi $ekonomi)
    {
        if ($ekonomi->id_user != Auth::user()->id) {
            throw new NotFoundHttpException();
        }
        return response($ekonomi);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ekonomi  $ekonomi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ekonomi $ekonomi)
    {
        if ($ekonomi->id_user != Auth::user()->id) {
            throw new NotFoundHttpException();
        }
        $input = $request->validate([
            'total_pendapatan' => 'required|string',
            'pendapatan_usaha' => 'required|numeric',
            'pendapatan_kiriman' => 'required|numeric',
            'subsidi_pemerintah' => 'required|boolean',
        ]);

        $ekonomi->fill($input);
        $ekonomi->id_user = Auth::user()->id;
        $ekonomi->save();
        return response($ekonomi);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ekonomi  $ekonomi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ekonomi $ekonomi)
    {
        if ($ekonomi->id_user != Auth::user()->id) {
            throw new NotFoundHttpException();
        }
        $ekonomi->delete();
        return response('', 204);
    }
}
