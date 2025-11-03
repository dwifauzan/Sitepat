<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Account baru</title>
    <link rel="stylesheet" href="{{asset('bootstrap.min.css')}}">    
</head>
<body>
    <div class="container">
        <div class="d-flex justify-content-center ms-auto mt-5">
            <div class="card" style="width: 28rem;">
                <div class="card-body">
                    <h5 class="text-center text-capitalize fw-bold my-2" style="font-family: 'Poppins', sans-serif;">
                        Account Baru</h5>
                    <form action="{{ route('dashCreateAction') }}" method="post">
                        @csrf
                        <div class="card-body">
                            {{-- username --}}
                            <div class="form-group">
                                <input type="text" class="form-control" id="exampleInputPassword1"
                                    placeholder="Masukan username" name="name">
                            </div>
                            {{-- nama  --}}
                            <div class="form-group">
                                <input type="text" class="form-control" id="exampleInputPassword1"
                                    placeholder="Masukan email" name="email">
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" id="exampleInputPassword1"
                                    placeholder="Masukan password" name="password">
                            </div>
                            {{-- role --}}
                            <div class="mb-3">
                                <label class="text-capitalize" for="exampleSelectBorder"></label>
                                <select class="form-select" aria-label="Default select example" name="role">
                                    @foreach ($data as $item)
                                        <option value="{{$item->id}}">{{$item->nama_role}}</option>
                                    @endforeach
                                </select>
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