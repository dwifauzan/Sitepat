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
        $dataLateSiswa = \App\Models\keterlambatan::with('datasiswa', 'datasiswa.kelas', 'datasiswa.jurusan')->get();
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
