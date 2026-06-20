@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto">
        <h1 class="text-2xl font-bold text-slate-800 mb-6 text-center">QR Scan</h1>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <div class="flex flex-col items-center gap-4">
                <div class="w-full max-w-md">
                    <div id="reader"></div>
                </div>
                <form action="{{ route('scanacti') }}" method="post" id="form">
                    @csrf
                    <input type="hidden" name="nisn" id="result">
                    <button type="submit" style="display: none">submit</button>
                </form>
            </div>

            <div class="mt-4 space-y-2">
                @if (session()->has('pesanNot'))
                    <x-alert variant="danger" :message="session('pesanNot')" />
                @endif
                @if (session()->has('gagal'))
                    <x-alert variant="warning" :message="session('gagal')" />
                @endif
                @if (session()->has('gagal2'))
                    <x-alert variant="warning" :message="session('gagal2')" />
                @endif
                @if (session()->has('berhasil'))
                    <x-alert variant="success" :message="session('berhasil')" />
                @endif
                @if (session()->has('berhasil2'))
                    <x-alert variant="success" :message="session('berhasil2')" />
                @endif
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<script>
    function onScanSuccess(decodedText, decodedResult) {
        $("#result").val(decodedText);
        $("#form").submit();
    }
    function onScanFailure(error) {
        console.warn(`Code scan error = ${error}`);
    }
    let html5QrcodeScanner = new Html5QrcodeScanner("reader", { fps: 10, qrbox: { width: 250, height: 250 } }, false);
    html5QrcodeScanner.render(onScanSuccess, onScanFailure);
</script>
@endpush
