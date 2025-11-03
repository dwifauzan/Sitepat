@extends('template.master')

@section('qrCode')
    <div class="content content-wrapper">
        <div class="container-fluid">
            <div class="row m-auto d-flex justify-content-center">
                <div class="card mt-5" style="width: 22rem;">
                    <a href="">{!! QrCode::size(350)->generate($data['dataSiswa']->Nisn) !!}</a>
                    <div class="px-2 py-3 d-flex flex-column">
                      <h3 class="text-capitalize">{{ $data['dataSiswa']->Nama_siswa }}</h3>
                      <span class="fw-medium">{{ $data['dataSiswa']->Nisn }}</span>
                      <span>{{ $data['dataSiswa']->jurusan->Nama_jurusan }}</span>
                      <span>{{ $data['dataSiswa']->kelas->Nama_kelas }}</span>
                      <span>{{ $data['dataSiswa']->Alamat }}</span>
                      <a href="{{ route('manage') }}" class="btn btn-primary mt-3">Kembali</a>
                    </div>
                  </div>
            </div>
        </div>
    </div>
@endsection
