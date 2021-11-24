<?php

namespace App\Http\Controllers;

use App\Models\Ayats;
use App\Models\Pasals;
use Exception;
use Illuminate\Http\Request;

class WebPasalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function detailPasal($id)
    {
        $data = Pasals::get()->where('id', $id)->first();
        $ayat = Ayats::get()->where('pasal', $data->pasal);

        return view('pasal.detailPasal', [
            'data' => $data,
            'ayat' => $ayat

        ]);
    }
    public function index()
    {

        $notFound = "";
        $data = Pasals::orderByRaw('CONVERT(pasal, SIGNED) ASC');
        $pasal = Pasals::get();
        $filter = $data->filter(request(['search']))->paginate(8)->withQueryString();
        if (count($pasal) == 0) {
            $notFound = "Pasal tidak ditemukan";
        }
        return view('pasal.index', [
            'halaman' => 'pasal',
            'pasal' => $filter,
            'notfound' => $notFound
        ]);
    }
    public function addPage()
    {
        return view('pasal.crud.addpasal', [
            'halaman' => 'pasal',
        ]);
    }
    public function editPage($id)
    {
        $pasal = Pasals::where('id', $id)->first();

        return view('pasal.crud.editpasal', [
            'halaman' => 'pasal',
            'pasal' => $pasal
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
        $request->validate([
            "pasal" => ['required'],
            "bab" => ['required'],
            "judul_bab" => ['required'],
        ]);
        try {
            Pasals::create([
                "pasal" => $request->pasal,
                "bab" => $request->bab,
                "judul_bab" => $request->judul_bab,
            ]);
            $request->session()->flash('statusSuccess', 'Pasal berhasil di tambah!');
            return redirect('/');
        } catch (Exception $ex) {
            $request->session()->flash('statusError',  $ex->getMessage());
            return redirect('/');
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
            "bab" => ['required'],
            "judul_bab" => ['required'],
        ]);
        try {
            $pasal = Pasals::find($id);
            $pasal->pasal = $request->pasal;
            $pasal->bab = $request->bab;
            $pasal->judul_bab = $request->judul_bab;
            $pasal->save();
            return redirect('/')->with('statusSuccess', 'Pasal berhasil di Edit');
        } catch (Exception $ex) {
            return redirect('/')->with('statusError', 'Pasal gagal di Edit');
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
            Pasals::destroy($id);
            return redirect('/')->with('statusSuccess', 'Pasal berhasil dihapus !');
        } catch (Exception $ex) {
            return redirect('/')->with('statusError', 'Pasal gagal dihapus / terjadi kesalahan !');
        }
    }
}
