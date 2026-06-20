@extends('layouts.app')

@section('page-header', 'Scan Keterlambatan Siswa')

@section('breadcrumb')
    <a href="{{ route('dash') }}" class="hover:text-slate-700 transition-colors">Beranda</a>
    <span class="mx-1.5 text-slate-300">/</span>
    <span class="text-slate-800 font-medium">Scan Keterlambatan</span>
@endsection

@section('content')
    <div class="max-w-2xl mx-auto space-y-6">
        {{-- QR Scanner Card --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <h3 class="text-base font-semibold text-slate-900 mb-4">Kamera QR</h3>
            <div class="flex flex-col items-center gap-4">
                <div class="relative w-full max-w-md">
                    <div id="reader" class="overflow-hidden rounded-lg"></div>
                    <div class="absolute inset-0 pointer-events-none">
                        <div class="absolute top-0 left-0 w-8 h-8 border-t-2 border-l-2 border-blue-500 rounded-tl"></div>
                        <div class="absolute top-0 right-0 w-8 h-8 border-t-2 border-r-2 border-blue-500 rounded-tr"></div>
                        <div class="absolute bottom-0 left-0 w-8 h-8 border-b-2 border-l-2 border-blue-500 rounded-bl"></div>
                        <div class="absolute bottom-0 right-0 w-8 h-8 border-b-2 border-r-2 border-blue-500 rounded-br"></div>
                    </div>
                </div>
                <form action="{{ route('scanacti') }}" method="post" id="form">
                    @csrf
                    <input type="hidden" name="nisn" id="result">
                </form>
            </div>
        </div>

        {{-- Results --}}
        <div class="space-y-3">
            @if (session()->has('berhasilDitambah') && session('siswa_nama'))
                <div class="p-5 rounded-xl border bg-green-50 border-green-200 slide-up">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-semibold text-green-800">{{ session('siswa_nama') }}</p>
                            <p class="text-sm text-green-700 mt-0.5">
                                NISN: {{ session('siswa_nisn') }}
                                @if(session('siswa_kelas'))
                                    <span class="text-green-400 mx-1">·</span> Kelas: {{ session('siswa_kelas') }}
                                @endif
                            </p>
                            <p class="text-xs text-green-600 mt-1.5 flex items-center gap-1.5">
                                <span>Tercatat terlambat — {{ \Carbon\Carbon::now()->translatedFormat('d M Y, H:i') }} WIB</span>
                            </p>
                        </div>
                        <button type="button" onclick="this.parentElement.parentElement.remove()" class="flex-shrink-0 text-green-400 hover:text-green-600 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                </div>
            @endif

            @if (session()->has('sudahScan') && session('siswa_nama'))
                <div class="p-5 rounded-xl border bg-amber-50 border-amber-200 fade-in">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-full bg-amber-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-semibold text-amber-800">{{ session('siswa_nama') }}</p>
                            <p class="text-sm text-amber-700 mt-0.5">Sudah tercatat terlambat hari ini.</p>
                        </div>
                        <button type="button" onclick="this.parentElement.parentElement.remove()" class="flex-shrink-0 text-amber-400 hover:text-amber-600 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                </div>
            @endif

            @if (session()->has('pesanNot'))
                <div class="p-5 rounded-xl border bg-red-50 border-red-200 shake" id="errorCard">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-semibold text-red-800">NISN tidak ditemukan</p>
                            <p class="text-sm text-red-700 mt-0.5">{{ session('pesanNot') }}</p>
                        </div>
                        <button type="button" onclick="this.parentElement.parentElement.remove()" class="flex-shrink-0 text-red-400 hover:text-red-600 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('styles')
<style>
    #reader {
        border: none !important;
    }
    #reader video {
        border-radius: 0.5rem;
    }
    #reader .html5-qrcode-element {
        font-family: inherit;
    }
    #reader__dashboard_section_csr button {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 0.5rem !important;
        padding: 0.5rem 1rem !important;
        padding-left: 0.75rem !important;
        background: #2563EB !important;
        color: #fff !important;
        font-weight: 500 !important;
        font-size: 0.875rem !important;
        border-radius: 0.5rem !important;
        border: none !important;
        cursor: pointer !important;
        line-height: 1.25rem !important;
        transition: background 0.15s ease !important;
    }
    #reader__dashboard_section_csr button:hover {
        background: #1D4ED8 !important;
    }
    #reader__dashboard_section_csr button i {
        display: none !important;
    }
    #reader__dashboard_section_csr button span {
        display: inline !important;
    }
    #reader__status_span {
        background: #EFF6FF !important;
        color: #2563EB !important;
        padding: 0.25rem 0.75rem !important;
        border-radius: 999px !important;
        font-size: 0.75rem !important;
        font-weight: 500 !important;
    }
    .shake {
        animation: shake 300ms ease;
    }
    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        20% { transform: translateX(-6px); }
        40% { transform: translateX(6px); }
        60% { transform: translateX(-4px); }
        80% { transform: translateX(4px); }
    }
</style>
@endpush

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
    let html5QrcodeScanner = new Html5QrcodeScanner("reader", { fps: 10, qrbox: { width: 280, height: 280 } }, false);
    html5QrcodeScanner.render(onScanSuccess, onScanFailure);

    function setScanButtonIcon() {
        var btn = document.querySelector('#reader__dashboard_section_csr button');
        if (btn && !btn.querySelector('.fa-hand-holding-mobile')) {
            btn.innerHTML = '<i class="fa-solid fa-hand-holding-mobile"></i> ' + btn.textContent.trim();
        }
    }
    var scanObserver = new MutationObserver(setScanButtonIcon);
    scanObserver.observe(document.body, { childList: true, subtree: true, attributes: false });
    setTimeout(setScanButtonIcon, 500);
</script>
@endpush
