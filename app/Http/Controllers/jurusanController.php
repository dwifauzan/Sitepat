<?php

namespace App\Http\Controllers;

use App\Models\jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class jurusanController extends Controller
{
    // jurusan
    function jurusan(){
        $dataJurusan = jurusan::get();

        return view('content.jurusan.jurusan', compact('dataJurusan'));
    }

    function actionJurusan(){
        $validator = Validator::make(request()->all(),[
            'namaJurusan' => 'required',
            'kaproli' => 'required'
        ],[
            'namaJurusan.required' => 'nama kelas tidak boleh kosong',
            'kaproli.required' => 'nama kelas harus di isi!' 
        ]);

        if($validator->fails()){
            return back()->withInput()->withErrors($validator->errors());
        }

        jurusan::create([
            'Nama_jurusan' => request()->namaJurusan,
            'Nama_kaproli' => request()->kaproli
        ]);

        return redirect(route('jurusan'))->with('succes', 'data telah berhasil ditambahkan!');
    }

    function update($id){
        $data = array(
            'jurusan' => jurusan::where('id', $id)->first(),
            'jurusanOri' => jurusan::get()
        );
        return view('content.jurusan.update', compact('data'));
    }

    function jurusanUpdate($id){
        $validator = Validator::make(request()->all(),[
            'namaJurusan' => 'required',
            'Nama_kaproli' => 'required'
        ],[
            'namaJurusan.required' => 'nama jurusan tidak boleh kosong',
            'Nama_kaproli.required' => 'nama kaproli harus di isi!' 
        ]);

        if($validator->fails()){
            return back()->withInput()->withErrors($validator->errors());
        }

        jurusan::where('id', $id)->update([
            'Nama_jurusan' => request()->namaJurusan,
            'Nama_kaproli' => request()->Nama_kaproli
        ]);
        return redirect(route('jurusan'))->with('success', 'Berhasil di perbarui');
    }

    function delete($id){
        jurusan::where('id', $id)->delete();
        return back()->with('success','Data berhasil dihapus');
    }
}
