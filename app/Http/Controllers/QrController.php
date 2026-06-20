<?php

namespace App\Http\Controllers;

use App\Models\datasiswa;
use App\Models\keterlambatan;
use Carbon\Carbon;

class QrController extends Controller
{
    function qrscan()
    {
        return redirect()->route('scanSiswa');
    }

    function scanacti()
    {
        $nisn = request()->nisn;
        $datasiswa = datasiswa::with('kelas', 'jurusan')->where('Nisn', $nisn)->first();

        if (!$datasiswa) {
            return back()->with('pesanNot', 'NISN tidak ditemukan. Pastikan kartu siswa terdaftar di sistem.');
        }

        $today = Carbon::today();

        $cek = datasiswa::where('Nisn', $nisn)->whereDate('updated_at', $today)->first();
        if($cek){
            return back()
                ->with('sudahScan', 'sudah tercatat')
                ->with('siswa_nama', $datasiswa->Nama_siswa)
                ->with('siswa_nisn', $datasiswa->Nisn)
                ->with('siswa_kelas', ($datasiswa->kelas->Tingkat_kelas ?? '') . ' ' . ($datasiswa->kelas->Nama_kelas ?? ''));
        }else{
            $datasiswa->increment('Telat');
            $datasiswa->touch();
            keterlambatan::create([
                'Nisn_siswa' => $nisn,
                'Tanggal' => $today,
                'jurusan_id' => $datasiswa->jurusan_id,
                'kelas_id' => $datasiswa->kelas_id,
                'Telat' => 1,
            ]);
            return back()
                ->with('berhasilDitambah', 'Tercatat terlambat')
                ->with('siswa_nama', $datasiswa->Nama_siswa)
                ->with('siswa_nisn', $datasiswa->Nisn)
                ->with('siswa_kelas', ($datasiswa->kelas->Tingkat_kelas ?? '') . ' ' . ($datasiswa->kelas->Nama_kelas ?? ''));
        }
    }

    function lateTable()
    {
        $dataLateSiswa = \App\Models\keterlambatan::with('datasiswa', 'datasiswa.kelas', 'datasiswa.jurusan')->get();
        return view('content.qrScan.lateTable', compact('dataLateSiswa'));
    }

    function scanSiswa()
    {
        return view('content.qrScan.scanSiswa');
    }
}
