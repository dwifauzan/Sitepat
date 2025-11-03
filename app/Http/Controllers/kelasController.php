<?php

namespace App\Http\Controllers;

use App\Models\kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class kelasController extends Controller
{
     // khusus kelas
     function kelas(){
        $dataKelas = kelas::all();

        return view('content.kelas.kelas', compact('dataKelas'));
    }

    function actionKelas(){
        // dd(request()->all());
        $validator = Validator::make(request()->all(),[
            'tingkatKelas'=> 'required',
            'namaKelas' => 'required',
            'waliKelas' => 'required'
        ],[
            'namaKelas.required' => 'nama kelas tidak boleh kosong',
            'waliKelas.required' => 'nama kelas harus di isi!' 
        ]);

        if($validator->fails()){
            return back()->with('gagal', $validator->messages()->get('*'));
        }

        kelas::create([
            'Tingkat_kelas' => request()->tingkatKelas,
            'Nama_kelas' => request()->namaKelas,
            'Walikelas' => request()->waliKelas
        ]);

        return redirect(route('kelas'))->with('succes', 'data telah berhasil ditambahkan!');
    }

    function update($id){
        $data = array(
            'kelas' => kelas::where('id', $id)->first(),
            'kelasOri' => kelas::distinct()->pluck('Tingkat_kelas')
        );
        return view('content.kelas.update', compact('data'));
    }

    function kelasUpdate($id){
        $validator = Validator::make(request()->all(),[
            'tingkatKelas'=> 'required',
            'namaKelas' => 'required',
            'waliKelas' => 'required'
        ],[
            'namaKelas.required' => 'nama kelas tidak boleh kosong',
            'waliKelas.required' => 'nama kelas harus di isi!' 
        ]);

        if($validator->fails()){
            return back()->with('gagal', $validator->messages()->get('*'));
        }

        kelas::where('id', $id)->update([
            'Tingkat_kelas' => request()->tingkatKelas,
            'Nama_kelas' => request()->namaKelas,
            'Walikelas' => request()->waliKelas
        ]);
        return redirect(route('kelas'))->with('success', 'Berhasil di perbarui');
    }

    function delete($id){
        Kelas::where('id', $id)->delete();
        return back()->with('success','Data berhasil dihapus');
    }

}
