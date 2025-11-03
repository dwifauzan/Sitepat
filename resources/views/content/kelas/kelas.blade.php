@extends('template.master')

@section('kelas')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="text-capitalize fw-bold">Data kelas</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">DataKelas</li>

                            @if (session()->has('success'))
                            <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                                <div class="toast-body">
                                  {{session('success')}}
                                  <div class="mt-2 pt-2 border-top">
                                    {{-- <button type="button" class="btn btn-primary btn-sm">Take action</button> --}}
                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="toast">Close</button>
                                  </div>
                                </div>
                              </div>
                            @endif
                        </ol>
                    </div>
                </div>

                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tingkat kelas</th>
                            <th>Nama kelas</th>
                            <th>Nama walikelas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataKelas as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->Tingkat_kelas }}</td>
                                <td>{{ $item->Nama_kelas }}</td>
                                <td>{{ $item->Walikelas }}</td>
                                <td>
                                    <button class="btn btn-warning"><a href="{{route('kelasForm', $item->id)}}" style="text-decoration: none; color: white;">Update</a></button>
                                    <form class="d-inline" action="{{route('deleteKelas', $item->id)}}" onsubmit="return confirm('Apakah anda Benar ingin menghapus?')" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn bg-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="card" style="width: 28rem;">
                    <div class="card-body">
                        <h5 class="text-center text-capitalize fw-bold my-2" style="font-family: 'Poppins', sans-serif;">
                            tambah kelas</h5>
                        <form action="{{ route('actionKelas') }}" method="post">
                            @csrf
                            <div class="card-body">
                                {{-- nisn siswa --}}
                                <div class="mb-3">
                                    <label class="text-capitalize" for="exampleSelectBorder">tingkatan kelas
                                        <select class="custom-select form-control-border" id="exampleSelectBorder"
                                            name="tingkatKelas">
                                            <option value="X">X</option>
                                            <option value="XI">XI</option>
                                            <option value="XII">XII</option>
                                        </select>
                                </div>
                                {{-- nama kelas --}}
                                <div class="form-group">
                                    <input type="text" class="form-control" id="exampleInputPassword1"
                                        placeholder="Masukan nama kelas" name="namaKelas">
                                </div>

                                {{-- nama walikelas --}}
                                <div class="form-group">
                                    <input type="text" class="form-control" id="exampleInputPassword1"
                                        placeholder="Masukan nama Walikelas" name="waliKelas">
                                </div>

                                {{-- button --}}
                                <button type="submit" class="btn btn-block rounded-4 shadow"
                                    style="background-color:#BB393E; font-family: 'Poppins', sans-serif; color: white;">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
    </section>
    </div>
@endsection

@push('tableKelas')
<script src="../../plugins/jquery/jquery.min.js"></script>

<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../plugins/jszip/jszip.min.js"></script>
<script src="../../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<script src="../../dist/js/adminlte.min.js?v=3.2.0"></script>

<script>
  $(function () {
    //opsi select kelas & jurusan
    $('.select2').select2();

    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
    </script>
@endpush
