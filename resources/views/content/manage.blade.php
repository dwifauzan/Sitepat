@extends('template.master')

@section('manage')
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Data Siswa</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">DataSiswa</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title text-capitalize">data seluruh siswa SMKN 1 Bondowoso</h3>
                            </div>

                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nisn</th>
                                            <th>Nama Siswa</th>
                                            <th>jenis kelamin</th>
                                            <th>kelas</th>
                                            <th>jurusan</th>
                                            <th>alamat</th>
                                            <th>no handphone</th>
                                            <th>nama ayah</th>
                                            <th>nama ibu</th>
                                            <th>no handphone ayah</th>
                                            <th>no handphone ibu</th>
                                            <th>qr code</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($data['dataRelasi'] as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->Nisn }}</td>
                                                <td>{{ $item->Nama_siswa }}</td>
                                                <td>{{ $item->Jenis_kelamin }}</td>
                                                <td>{{ $item->kelas->Nama_kelas }}</td>
                                                <td>{{ $item->jurusan->Nama_jurusan }}</td>
                                                <td>{{ $item->Alamat }}</td>
                                                <td>{{ $item->No_Handphone }}</td>
                                                <td>{{ $item->Nama_Ortu_Ayah }}</td>
                                                <td>{{ $item->Nama_Ortu_Ibu }}</td>
                                                <td>{{ $item->No_Handphone_Ayah }}</td>
                                                <td>{{ $item->No_Handphone_Ibu }}</td>
                                                <td>
                                                    <a href="{{ route('qrCode', $item->id) }}">{!! QrCode::size(50)->generate($item->Nisn) !!}</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
