<?php

namespace App\Http\Controllers;

use App\Models\Ayats;
use App\Models\Pasals;
use Exception;
use Illuminate\Http\Request;

class WebAyatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function detailAyat($id)
    {
        $data = Ayats::get()->where('id', $id)->first();
        $pasal = Pasals::get()->where('pasal', $data->pasal);

        return view('ayat.detailAyat', [
            'data' => $data,
            'pasal' => $pasal
        ]);
    }
    public function index()
    {

        $notFound = "";

        $ayat = Ayats::get();
        $data = Ayats::orderByRaw('CONVERT(pasal, SIGNED) ASC');
        $filter = $data->filter(request(['search']))->paginate(8)->withQueryString();

        if (count($ayat) == 0) {
            $notFound = "Ayats tidak ditemukan";
        }

        return view('ayat.index', [
            'halaman' => 'ayat',
            'ayat' => $filter,
            'notfound' => $notFound
        ]);
    }
    public function addPage()
    {
        return view('ayat.crud.addayat', [
            'halaman' => 'ayat',
        ]);
    }
    public function editPage($id)
    {
        $ayat = Ayats::where('id', $id)->first();

        return view('ayat.crud.editayat', [
            'halaman' => 'ayat',
            'ayat' => $ayat
        ]);
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
        try {
            Ayats::create([
                'pasal' => $request->pasal,
                'ayat' => $request->ayat,
                'bunyi' => $request->bunyi,
            ]);
            $request->session()->flash('statusSuccess', 'Ayat berhasil di tambah!');
            return redirect('/ayat');
        } catch (Exception $ex) {
            $request->session()->flash('statusError', 'Ayat gagal di tambah! error');
            return redirect('/ayat');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        $request->validate([
            "pasal" => ['required'],
            "ayat" => ['required'],
            "bunyi" => ['required'],
        ]);
        try {
            $ayat = Ayats::find($id);
            $ayat->pasal = $request->pasal;
            $ayat->ayat = $request->ayat;
            $ayat->bunyi = $request->bunyi;
            $ayat->save();
            return redirect('/ayat')->with('statusSuccess', 'Ayat berhasil di Edit');
        } catch (Exception $ex) {
            return redirect('/ayat')->with('statusError', 'Ayat gagal di Edit');
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
        try {
            Ayats::destroy($id);
            return redirect('/ayat')->with('statusSuccess', 'Ayat berhasil dihapus !');
        } catch (Exception $ex) {
            return redirect('/ayat')->with('statusError', 'Ayat gagal dihapus / terjadi kesalahan !');
        }
    }
}
