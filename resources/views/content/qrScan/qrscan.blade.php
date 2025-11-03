<!-- @extends('template.master')

@section('scanSiswa')
    <div class="content-wrapper">
        <div class="col-4">
            <div id="reader" width="600px"></div>
        </div>
        <div class="col-4">
            <input type="text" name="nisn" id="result">
        </div>
        <div class="col-lg-6 d-flex justify-content-center mx-auto pt-5">
            <div class="card bg-white shadow rounded-3 py-2 px-1 border-0">
                {{-- <video class="col-lg" id="preview"></video> --}}
                <form action="{{ route('scanacti') }}" method="post" id="form">
                    @csrf
                    {{-- <input type="hidden" name="nama" id="nama"> --}}
                </form>
                {{-- validasi nisn tidak terdaftar --}}
                @if (session()->has('pesanNot'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('pesanNot') }}
                    </div>
                @endif
                {{-- validasi nisn 2 kali scan --}}
                @if (session()->has('gagal'))
                    <div class="alert alert-warning" role="alert">
                        {{ session('gagal') }}
                    </div>
                @endif
                {{-- validasi nisn esok hari --}}
                @if (session()->has('gagal2'))
                    <div class="alert alert-warning" role="alert">
                        {{ session('gagal2') }}
                    </div>
                @endif
                {{-- validasi nisn berhasil ditambahkan --}}
                @if (session()->has('berhasil'))
                    <div class="alert alert-secondary" role="alert">
                        {{ session('berhasil') }}
                    </div>
                @endif
                {{-- validasi nisn berhasil ditambahkan esok hari --}}
                @if (session()->has('berhasil2'))
                    <div class="alert alert-secondary" role="alert">
                        {{ session('berhasil2') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('scriptQrScan')
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<script>
    function onScanSuccess(decodedText, decodedResult) {
        // handle the scanned code as you like, for example:
        // console.log(`Code matched = ${decodedText}`, decodedResult);
        ${"#result"}.val(decodedText)
      }
      
      function onScanFailure(error) {
        // handle scan failure, usually better to ignore and keep scanning.
        // for example:
        console.warn(`Code scan error = ${error}`);
      }
      
      let html5QrcodeScanner = new Html5QrcodeScanner(
        "reader",
        { fps: 10, qrbox: {width: 250, height: 250} },
        /* verbose= */ false);
      html5QrcodeScanner.render(onScanSuccess, onScanFailure);
</script>
@endpush -->
