<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update Jurusan</title>
    <link rel="stylesheet" href="{{ asset('bootstrap.min.css') }}">
</head>

<body>
    <div class="container">
        <div class="d-flex justify-content-center ms-auto mt-5">
            <div class="card" style="width: 28rem;">
                <div class="card-body">
                    <h5 class="text-center text-capitalize fw-bold my-2" style="font-family: 'Poppins', sans-serif;">
                        Update Jurusan</h5>
                    <form action="{{ route('jurusanUpdate', $data['jurusan']->id) }}" method="post">
                        @csrf
                        <div class="card-body">
                            {{-- nama Jurusan --}}
                            <div class="mb-3">
                                <input type="text" class="form-control" id="exampleInputPassword1"
                                    placeholder="Masukan nama Jurusan" name="namaJurusan"
                                    value="{{ $data['jurusan']->Nama_jurusan }}">
                                @error('namaJurusan')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- kepala Jurusan --}}
                            <div class="mb-3">
                                <input type="text" class="form-control" id="exampleInputPassword1"
                                    placeholder="Masukan nama kepala jurusan" name="Nama_kaproli"
                                    value="{{ $data['jurusan']->Nama_kaproli }}">
                            </div>

                            {{-- button --}}
                            <button type="submit" class="btn btn-block rounded-4 shadow mt-2"
                                style="width: 100%; background-color:#BB393E; font-family: 'Poppins', sans-serif; color: white;">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    {{-- script js bootstrap and jquery --}}
    <script src="{{ asset('bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('jquery-3.7.1.min.js') }}"></script>
</body>

</html>
