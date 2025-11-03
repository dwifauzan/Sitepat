<?php

namespace App\Http\Controllers;

use App\Models\datasiswa;
use App\Models\jurusan;
use App\Models\kelas;
use App\Models\keterlambatan;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class QrController extends Controller
{
    function qrscan()
    {
        // $dataTelat = keterlambatan::all();
        return view('content.qrScan.qrscan');
    }

    function scanacti()
    {
        // dd(request()->input());
        $nisn = request()->nisn;
        $datasiswa = datasiswa::where('Nisn', $nisn)->first();

        if (!$datasiswa) {
            return back()->with('pesanNot', 'Nisn anda tidak terdaftar');
        }

        $today = Carbon::today();

        $cek = datasiswa::where('Nisn', $nisn)->whereDate('updated_at', $today)->first();
        // $cek->increment('Telat'); //debug test 
        if($cek){
            return back()->with('sudahScan', 'qr anda baru saja sudah di scan');
        }else{
            $datasiswa->increment('Telat');
            $datasiswa->touch();
            return back()->with('berhasilDitambah', 'Telah berhasil di scan');
        }
    }

    function lateTable()
    {
        // // Ambil semua data siswa di mana kolom 'Telat' lebih besar dari 1
        $dataCount = Datasiswa::with('kelas','jurusan')->where('Telat',0)->count();
        
        // // Periksa apakah ada data yang ditemukan
        if ($dataCount < 0) {
            // Jika tidak ada data yang ditemukan, Anda bisa mengembalikan view tanpa data
            // return view('content.qrScan.lateTable', ['dataLateSiswa' => null]);
            return response()->json(['error' => 'Terdapat nilai 0 di dalam database'], 400);

        }
        
        // $dataLateSiswa = datasiswa::get();
        $dataLateSiswa = Datasiswa::with('kelas', 'jurusan')->where('Telat', '>=', 1)->get();
        // $siswaTelat = array(
        //     'datasiswa' =>datasiswa::all(),
        //     'kelasList' => kelas::pluck('Nama_kelas', 'id'),
        //     'jurusanList' => jurusan::pluck('Nama_jurusan', 'id'),
        // );
        // Jika ada data yang ditemukan, kembalikan view dengan data
        return view('content.qrScan.lateTable', compact('dataLateSiswa'));
    }

    function destroy()
    {
        $lateSiswa = array(
            'destroy' => DB::table('keterlambatans')->delete()
        );
        return back()->with('succes', 'berhasil dihapus');
    }

    // function qr scan view
    function scanSiswa()
    {
        return view('content.qrScan.scanSiswa');
    }
}
