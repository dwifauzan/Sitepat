<?php

namespace App\Http\Controllers;

use App\Models\datasiswa;
use App\Models\jurusan;
use App\Models\kelas;
use App\Models\keterlambatan;
use App\Models\role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AllController extends Controller
{
    function index()
    {
        $data = Carbon::now()->isoFormat('dddd, D-M-Y');
        return view('content.home', compact('data'));
    }
    // dashboard
    function dash()
    {
        $allstat = array(
            'statSiswa' => datasiswa::count(),
            'statwalKelas' => kelas::select('Walikelas')->count(),
            'statTelat' => \App\Models\keterlambatan::sum('Telat'),
            'statkapJurusan' => jurusan::select('Nama_kaproli')->count(),
            'data' => User::with('Role')->get()
        );

        // Tampilkan grafik dari semua data keterlambatan
        $data = \App\Models\keterlambatan::selectRaw('DATE(Tanggal) as date, SUM(Telat) as telat')
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get()
            ->keyBy('date')
            ->toArray();

        $dates = [];
        $telatData = [];
        // Ambil semua tanggal yang ada di data
        $allDates = array_keys($data);
        if (!empty($allDates)) {
            foreach ($allDates as $date) {
                $dates[] = Carbon::parse($date)->format('d/m/Y');
                $telatData[] = $data[$date]['telat'];
            }
        }

        return view('admin.dash', compact('allstat', 'dates', 'telatData'));
    }

    function dashUpdate($id)
    {
        $data = array(
            'user' => User::where('id', $id)->with('Role')->first(),
            'role' => role::get()
        );
        if (Auth::user()->role_id == 1) {
            return view('admin.update', compact('data'));
        }
        return back();
    }

    function dashUpdateAction($id)
    {
        User::where('id', $id)->update([
            'name' => request()->name,
            'email' => request()->email,
            'role_id' => request()->role
        ]);

        return redirect(route('dash'));
    }

    function dashdelete($id)
    {
        User::where('id', request()->id)->delete();
        return back();
    }

    function dashCreate()
    {
        $data = role::get();
        if (Auth::user()->role_id == 1) {
            return view('admin.create', compact('data'));
        }
        return back();
    }

    function dashCreateAction()
    {
        // dd(request()->all());
        User::create([
            'name' => request()->name,
            'email' => request()->email,
            'password' => bcrypt(request()->password),
            'role_id' => request()->role
        ]);
    }

    function manage()
    {
        Artisan::call('schedule:run');
        $data = array(
            'dataRelasi' => datasiswa::with('kelas', 'jurusan')->get(),
            'kelas' => \App\Models\kelas::all(),
            'jurusan' => \App\Models\jurusan::all(),
        );
        if (Auth::user()->role_id == 1) {
            return view('content.manage', compact('data'));
        }
        return back();
    }
    function create()
    {
        $data = array(
            'kelas' => kelas::all(),
            'jurusan' => jurusan::all()
        );
        if (Auth::user()->role_id == 1) {
            return view('content.create', compact('data'));
        }
        return back();
    }

    function action()
    {
        $validators = Validator::make(request()->all(), [
            'nisn' => 'min:3|required',
            'siswa' => 'required',
            'gender' => 'required',
            'kelas' => 'required',
            'jurusan' => 'required',
            'alamat' => 'required',
            'nohp' => 'required',
            'ayah' => 'required',
            'ibu' => 'required',
            'hpAyah' => 'required',
            'hpIbu' => 'required'
        ], [
            'nisn.min' => 'minimal 3 karakter yang di isi',
            'nisn.required' => 'wajib di isi',
            'siswa.required' => 'wajib di isi',
            'gender.required' => 'wajib di isi',
            'kelas.required' => 'wajib di isi',
            'jurusan.required' => 'wajib di isi',
            'alamat.required' => 'wajib di isi',
            'nohp.required' => 'wajib di isi',
            'ayah.required' => 'wajib di isi',
            'ibu.required' => 'wajib di isi',
            'hpAyah.required' => 'wajib di isi',
            'hpIbu.required' => 'wajib di isi'
        ]);

        // dd(request()->all());

        if ($validators->fails()) {
            return back()->withInput()->withErrors($validators->errors());
        }

        datasiswa::create([
            'Nisn' => request()->input('nisn'),
            'Nama_siswa' => request()->input('siswa'),
            'Jenis_kelamin' => request()->input('gender'),
            'kelas_id' => request()->input('kelas'),
            'Jurusan_id' => request()->input('jurusan'),
            'Alamat' => request()->input('alamat'),
            'No_Handphone' => request()->input('nohp'),
            'Nama_Ortu_Ayah' => request()->input('ayah'),
            'Nama_Ortu_Ibu' => request()->input('ibu'),
            'No_Handphone_Ayah' => request()->input('hpAyah'),
            'No_Handphone_Ibu' => request()->input('hpIbu'),
        ]);

        return redirect(route('manage'));
    }
    function qrCode($id)
    {
        $findSiswa = datasiswa::find($id);
        $data = array(
            'dataSiswa' => datasiswa::where('id', $id)->first(),
            'dataQr' => array(
                'nisn' => $findSiswa->Nisn,
                'jurusan' => $findSiswa->jurusan_id,
                'kelas' => $findSiswa->kelas_id
            )
        );

        $changeDataQr = json_encode($data['dataQr']);

        return view('content.qrScan.qrcode', compact('data', 'changeDataQr'));
    }

    function reset()
    {
        datasiswa::query()->update(['Telat' => 0]);
        return redirect(route('dash'));
    }
}
