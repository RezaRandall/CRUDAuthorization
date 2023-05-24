<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use Illuminate\Http\Request;

class PesertaController extends Controller
{
    public function index(){
    	// get data peserta
    	$peserta = Peserta::paginate(10);
    	// send peserta data's to view peserta
    	return view('/nilaiPeserta', ['pes' => $peserta]);
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
    		'nama' => 'required|min:3',
    		'email' => 'required|email:dns|unique:users',
            'xVal' => 'required|numeric',
            'yVal' => 'required|numeric',
            'zVal' => 'required|numeric',
            'wVal' => 'required|numeric',
        ]);

        $x = $request->input('xVal');
        $y = $request->input('yVal');
        $nilaiAspekIntelegensi = ((0.4 * $x) + (0.6 * $y)) / 2;        

        //rumus untuk mengkonversi nilai ke dalam rentang 1-5
        $nilaiKonversi1_5Intelegensi = ($nilaiAspekIntelegensi - 0) / (10 - 0) * (5 - 1) + 1;

        //membulatkan nilai ke bilangan bulat terdekat
        $nilaiBulatIntelegensi = round($nilaiKonversi1_5Intelegensi);

        $z = $request->input('zVal');
        $w = $request->input('wVal');
        $nilaiAspekNum = ((0.3 * $z) + (0.7 * $w)) / 2;
        $nilaiKonversi1_5Num = ($nilaiAspekNum - 0) / (10 - 0) * (5 - 1) + 1;

        $nilaiBulatNumerical = round($nilaiKonversi1_5Num);

        $user = Peserta::updateOrCreate([
            'nama' => $request->input('nama'),
            'email' => $request->input('email'),
            'xVal' => $request->input('xVal'),
            'yVal' => $request->input('yVal'),
            'zVal' => $request->input('zVal'),
            'wVal' => $request->input('wVal'),
            'aspek_intelegensi' => $nilaiBulatIntelegensi,
            'aspek_numerical_ability' => $nilaiBulatNumerical
        ]);
        return back();
    }

    public function edit($id)
    {
        $data = Peserta::findOrFail($id);
        return response()->json($data);
    }

    public function getInfoById($id)
    {
        $data = Peserta::find($id);
        return response()->json($data);
    }


    public function update(Request $request, $id)
    {
        $this->validate($request,[
        'nama' => 'required|min:3|max:20',
        'email' => 'required|email:dns|unique:users',
        'xVal' => 'required|numeric',
        'yVal' => 'required|numeric',
        'zVal' => 'required|numeric',
        'wVal' => 'required|numeric'
        ]);

        $peserta = Peserta::find($id);

        $x = $request->input('xVal');
        $y = $request->input('yVal');
        $nilaiAspekIntelegensi = ((0.4 * $x) + (0.6 * $y)) / 2;
        $nilaiKonversi1_5Intelegensi = ($nilaiAspekIntelegensi - 0) / (10 - 0) * (5 - 1) + 1;
        $nilaiBulatIntelegensi = round($nilaiKonversi1_5Intelegensi);

        $z = $request->input('zVal');
        $w = $request->input('wVal');
        $nilaiAspekNum = ((0.3 * $z) + (0.7 * $w)) / 2;
        $nilaiKonversi1_5Num = ($nilaiAspekNum - 0) / (10 - 0) * (5 - 1) + 1;
        $nilaiBulatNumerical = round($nilaiKonversi1_5Num);

        $peserta->nama = $request->nama;
        $peserta->email = $request->email;
        $peserta->xVal = $request->xVal;
        $peserta->yVal = $request->yVal;
        $peserta->zVal = $request->zVal;
        $peserta->wVal = $request->wVal;
        $peserta->aspek_intelegensi = $nilaiBulatIntelegensi;
        $peserta->aspek_numerical_ability = $nilaiBulatNumerical;
        $peserta->save();
        return back();
    }

    public function destroy($id)
    {
        $peserta = Peserta::findOrFail($id);
        $peserta->delete();
        return redirect('/nilaiPeserta')->with('success', 'Data telah dihapus');
    }
}
