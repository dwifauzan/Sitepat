<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update Kelas</title>
    <link rel="stylesheet" href="{{asset('bootstrap.min.css')}}">    
</head>
<body>
    <div class="container">
        <div class="d-flex justify-content-center ms-auto mt-5">
            <div class="card" style="width: 28rem;">
                <div class="card-body">
                    <h5 class="text-center text-capitalize fw-bold my-2" style="font-family: 'Poppins', sans-serif;">
                        Update kelas</h5>
                    <form action="{{ route('kelasUpdate', $data['kelas']->id) }}" method="post">
                        @csrf
                        <div class="card-body">
                            {{-- nisn siswa --}}
                            <div class="mb-3">
                                <label class="text-capitalize" for="exampleSelectBorder">tingkatan kelas</label>
                                <select class="form-select" aria-label="Default select example" name="tingkatKelas">
                                    <option disabled value="{{$data['kelas']->Tingkat_kelas}}"></option>
                                    <option value="X">X</option>
                                    <option value="XI">XI</option>
                                    <option value="XII">XII</option>
                                  </select>
                            </div>
                            {{-- nama_kelas --}}
                            <div class="form-group">
                                <input type="text" class="form-control" id="exampleInputPassword1"
                                    placeholder="Masukan nama kelas" name="namaKelas" value="{{$data['kelas']->Nama_kelas}}">
                            </div>
                            {{-- nama siswa --}}
                            <div class="form-group">
                                <input type="text" class="form-control" id="exampleInputPassword1"
                                    placeholder="Masukan nama Walikelas" name="waliKelas" value="{{$data['kelas']->Walikelas}}">
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
    <script src="{{asset('bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('jquery-3.7.1.min.js')}}"></script>
</body>
</html>