@extends('template.master')
@section('scanSiswa')
<div class="container">
        <div class="row d-flex justify-content-center ms-auto mt-5">
            <div class="card" style="width: 38rem;">
                {{-- <img src="..." class="card-img-top" alt="..."> --}}
                <div id="reader"></div>
                <div class="card-body">
                    <h5 class="card-title text-center">Scan Your QR </h5>
                    <br>
                    <form action="{{ route('scanacti') }}" method="post" id="form">
                        <div class="col-4">
                            <input type="hidden" name="nisn" id="result">
                            <button type="submit" style="display: none">submit</button>
                        </div>
                        @csrf
                        {{-- <input type="hidden" name="nama" id="nama"> --}}
                    </form>
                    {{-- validasi nisn tidak terdaftar --}}
                    @if (session()->has('pesanNot'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('pesanNot') }}
                        </div>
                    @endif
                    @if (session()->has('sudahScan'))
                        <div class="alert alert-warning" role="alert">
                            {{ session('sudahScan') }}
                        </div>
                    @endif
                    @if (session()->has('berhasilDitambah'))
                        <div class="alert alert-success" role="alert">
                            {{ session('berhasilDitambah') }}
                        </div>
                    @endif

                    <button type="button" class="btn btn-primary"><a href="{{route('dash')}}" style="color: white;" class="text-capitalize">kembali</a></button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6 d-flex justify-content-center mx-auto pt-5">
        <div class="card bg-white shadow rounded-3 py-2 px-1 border-0">
            {{-- <video class="col-lg" id="preview"></video> --}}

        </div>
    </div>

    {{-- asset js bootstrap & jquery --}}
    <script src="{{ asset('bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('jquery-3.7.1.min.js') }}"></script>
    {{-- script qr scan --}}
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script>
        function onScanSuccess(decodedText, decodedResult) {
            // handle the scanned code as you like, for example:
            // console.log(`Code matched = ${decodedText}`, decodedResult);
            $("#result").val(decodedText)

            $("#form").submit()
        }

        function onScanFailure(error) {
            // handle scan failure, usually better to ignore and keep scanning.
            // for example:
            console.warn(`Code scan error = ${error}`);
        }

        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", {
                fps: 10,
                qrbox: {
                    width: 440,
                    height: 400
                }
            },
            /* verbose= */
            false);
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    </script>

@endsection
