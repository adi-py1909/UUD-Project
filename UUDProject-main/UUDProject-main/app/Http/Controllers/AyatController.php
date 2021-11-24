<?php

namespace App\Http\Controllers;

use App\Models\Ayats;
use Illuminate\Http\Request;

class AyatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Ayats::get();
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
        $data = Ayats::create([
            'pasal' => $request->pasal,
            'ayat' => $request->ayat,
            'bunyi' => $request->bunyi
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
    public function show($ayat)
    {
        $data = Ayats::with('pasals')->find($ayat);
        if ($data == null) {
            return response([
                'status' => 404,
                'message' => "Tidak ada data dengan ayat $ayat",
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $ayat)
    {
        $data = Ayats::find($ayat);
        if ($data == null) {
            return response([
                'status' => 404,
                'message' => "Tidak ada data dengan ayat $ayat",
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
    public function destroy($ayat)
    {
        $data = Ayats::find($ayat);
        if ($data == null) {
            return response([
                'status' => 404,
                'message' => "Tidak ada data dengan ayat $ayat",
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
    public function search($bunyi)
    {
        $data = Ayats::with('pasals')->where('bunyi', 'LIKE', "%$bunyi%")->get();
        if (count($data) > 0) {
            return response([
                'status' => 200,
                'message' => 'Data successful loaded',
                'data' => $data,
            ], 200);
        } else {
            return response([
                'status' => 404,
                'message' => "Tidak ada ayat dengan bunyi $bunyi",
            ], 404);
        }
    }
}
