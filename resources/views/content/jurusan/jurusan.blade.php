@extends('template.master')

@section('jurusan')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="text-capitalize fw-bold">Data Jurusan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Jurusan</li>
                        </ol>
                    </div>
                </div>

                {{-- table jurusan --}}
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama jurusan</th>
                            <th>Nama Kaproli</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataJurusan as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->Nama_jurusan }}</td>
                                <td>{{ $item->Nama_kaproli }}</td>
                                <td>
                                    <button class="btn btn-warning"><a href="{{route('jurusanForm', $item->id)}}" style="text-decoration: none; color: white;">Update</a></button>
                                    <form class="d-inline" action="{{route('deleteJurusan', $item->id)}}" onsubmit="return confirm('Apakah anda Benar ingin menghapus?')" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn bg-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- card form jurusan --}}
                <div class="card" style="width: 28rem;">
                    <div class="card-body">
                        <h5 class="text-center text-capitalize fw-bold my-2" style="font-family: 'Poppins', sans-serif;">
                            tambah
                            jurusan</h5>
                        <form action="{{ route('actionJurusan') }}" method="post">
                            @csrf
                            <div class="card-body">
                                {{-- nisn siswa --}}
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="exampleInputPassword1"
                                        placeholder="Masukan nama Jurusan" name="namaJurusan">
                                </div>
                                {{-- nama siswa --}}
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="exampleInputPassword1"
                                        placeholder="Masukan nama Kepala Jurusan" name="kaproli">
                                </div>

                                {{-- button --}}
                                <button type="submit" class="btn btn-block rounded-4 shadow"
                                    style="background-color:#BB393E; font-family: 'Poppins', sans-serif; color: white;">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
