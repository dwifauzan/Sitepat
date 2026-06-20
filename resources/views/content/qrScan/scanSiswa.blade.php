@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto">
        <h1 class="text-2xl font-bold text-slate-800 mb-6 text-center">Scan Siswa</h1>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <div class="flex flex-col items-center gap-4">
                <div class="w-full max-w-md" id="reader"></div>
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
                @if (session()->has('sudahScan'))
                    <x-alert variant="warning" :message="session('sudahScan')" />
                @endif
                @if (session()->has('berhasilDitambah'))
                    <x-alert variant="success" :message="session('berhasilDitambah')" />
                @endif
            </div>

            <div class="mt-4 text-center">
                <a href="{{ route('dash') }}" class="inline-flex items-center gap-2 px-4 py-2 text-primary-600 hover:text-primary-800 font-medium text-sm transition-colors">
                    <i class="fas fa-arrow-left"></i>
                    Kembali ke Dashboard
                </a>
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
    let html5QrcodeScanner = new Html5QrcodeScanner("reader", { fps: 10, qrbox: { width: 440, height: 400 } }, false);
    html5QrcodeScanner.render(onScanSuccess, onScanFailure);
</script>
@endpush
