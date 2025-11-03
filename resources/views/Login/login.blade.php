<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login | LATELINK</title>
    {{-- css bootstrap --}}
    <link rel="stylesheet" href="{{ asset('bootstrap.min.css') }}">
</head>

<body>
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center m-auto mt-5" id="row">
            
            <div class="col-md-4 card border border-2 p-5 rounded-3 shadow-lg">
                <img class="card-img-top" src="https://img.freepik.com/free-vector/hand-drawn-life-coaching-illustration_23-2150279251.jpg?t=st=1714370219~exp=1714373819~hmac=fa2c36cdd6c99f0e988f4316fd87d4dafff6ca0fca765a320ab3406ec1fa70b1&w=996" alt="">
                <h1 class="text-uppercase fw-bold text-center fs-2 pt-3">go LATELINK</h1>
                <form action="{{ route('loginAction') }}" method="post" class="mt-5">
                    {{-- token --}}
                    @csrf

                    <div class="form-group d-flex flex-column gap-2">
                        <label class="text-capitalize" for="">username :</label>
                        <input class="form-control" type="text" placeholder="Masukan Username"
                        autofocus name="name">
                    </div>

                    {{-- email --}}
                    {{-- <label class="text-capitalize" for="">role username anda :</label>
                    <input class="form-control" type="text" placeholder="email"
                        aria-label="default input example" autofocus name="email"> --}}

                    {{-- password --}}
                    <div class="form-group d-flex flex-column gap-2">
                        <label class="text-capitalize" for="">password :</label>
                        <input class="form-control" type="password" placeholder="Masukan Password" name="password">
                    </div>

                    {{-- button submit --}}
                    <button type="submit" class="btn btn-success mt-3 rounded px-3">Submit</button>
                </form>
                @if (session()->has('pesan'))
                    {{ session('pesan') }}
                @endif
            </div>
        </div>
    </div>


    {{-- script js --}}
    <script src="{{ asset('bootstrap.bundle.min.js') }}"></script>
    {{-- jquery --}}
    <script src="{{ asset('jquery-3.7.1.min.js') }}"></script>
</body>

</html>
