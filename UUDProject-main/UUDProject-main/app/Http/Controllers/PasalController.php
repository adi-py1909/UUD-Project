<?php

namespace App\Http\Controllers;

use App\Models\Pasals;
use Illuminate\Http\Request;

class PasalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Pasals::with('ayats')->get();
        return response([
            'status' => 200,
            'message' => 'data terload',
            'data' => $data,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = Pasals::create([
            'pasal' => $request->pasal,
            'bab' => $request->bab,
            'judul_bab' => $request->judul_bab
        ]);
        return response([
            'status' => 200,
            'message' => 'Data successfully added',
            'data' => $data,
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($pasal)
    {
        $data = Pasals::with('ayats')->where('pasal', $pasal)->get();
        if ($data == null) {
            return response([
                'status' => 404,
                'message' => "Tidak ada data dengan pasal $pasal",
            ], 404);
        } else {
            return response([
                'status' => 200,
                'message' => 'Data terload',
                'data' => $data,
            ], 200);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Pasals::with('ayats')->find($id);
        if ($data == null) {
            return response([
                'status' => 404,
                'message' => "Tidak ada data dengan id $id",
            ], 404);
        } else {
            return response([
                'status' => 200,
                'message' => 'Data terload',
                'data' => $data,
            ], 200);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $pasal)
    {
        $data = Pasals::find($pasal);
        if ($data == null) {
            return response([
                'status' => 404,
                'message' => "Tidak ada data dengan pasal $pasal",
            ], 404);
        } else {
            $data->update($request->all());
            return response(
                [
                    'message' => 'Update successfully',
                    'status' => 200,
                    'data' => $data
                ],
                200
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Pasals::find($id);
        if ($data == null) {
            return response([
                'status' => 404,
                'message' => "Tidak ada data dengan id $id",
            ], 404);
        } else {
            $data->delete();
            return response(
                [
                    'data' => $data,
                    'message' => 'Delete successfully',
                    'status' => 200
                ],
                200
            );
        }
    }
    public function searchJudulBab($judul_bab)
    {
        $data = Pasals::with('ayats')->where('judul_bab', 'LIKE', "%$judul_bab%")->get();
        if (count($data) > 0) {
            return response([
                'status' => 200,
                'message' => 'Data successful loaded',
                'data' => $data,
            ], 200);
        } else {
            return response([
                'status' => 404,
                'message' => "Tidak ada pasal dengan judul bab $judul_bab",
            ], 404);
        }
    }
}
