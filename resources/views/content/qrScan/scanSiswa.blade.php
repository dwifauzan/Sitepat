@extends('layouts.app')

@section('page-header', 'Scan Keterlambatan')

@section('breadcrumb')
    <a href="{{ route('dash') }}" class="hover:text-slate-700 transition-colors">Beranda</a>
    <span class="mx-1.5 text-slate-300">/</span>
    <span class="text-slate-800 font-medium">Scan Keterlambatan</span>
@endsection

@section('content')
    <div class="max-w-lg mx-auto space-y-4">
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="p-4 sm:p-5">
                <div class="flex items-center justify-between mb-3">
                    <h3 class="text-sm font-semibold text-slate-900">Pindai QR Siswa</h3>
                    <span id="scanStatus" class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-500">
                        <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                        Kamera
                    </span>
                </div>
                <div class="relative">
                    <div id="reader" class="overflow-hidden rounded-lg bg-slate-900"></div>
                    <div class="absolute inset-0 pointer-events-none flex items-center justify-center" id="scanOverlay">
                        <div class="relative w-64 h-64 sm:w-72 sm:h-72">
                            <div class="absolute top-0 left-0 w-8 h-8 border-t-2 border-l-2 border-blue-400 rounded-tl"></div>
                            <div class="absolute top-0 right-0 w-8 h-8 border-t-2 border-r-2 border-blue-400 rounded-tr"></div>
                            <div class="absolute bottom-0 left-0 w-8 h-8 border-b-2 border-l-2 border-blue-400 rounded-bl"></div>
                            <div class="absolute bottom-0 right-0 w-8 h-8 border-b-2 border-r-2 border-blue-400 rounded-br"></div>
                            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-0.5 h-8 bg-blue-400/50 rounded-full animate-pulse" id="scanLine"></div>
                        </div>
                    </div>
                </div>
                <p class="text-xs text-slate-400 text-center mt-3">Arahkan QR code ke dalam bingkai kamera</p>
            </div>
            <form action="{{ route('scanacti') }}" method="post" id="form">
                @csrf
                <input type="hidden" name="nisn" id="result">
            </form>
        </div>

        <div class="space-y-3" id="resultContainer">
            @if (session()->has('berhasilDitambah') && session('siswa_nama'))
                <div class="p-4 rounded-xl bg-green-50 border border-green-200 slide-up">
                    <div class="flex items-start gap-3">
                        <div class="w-9 h-9 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <svg class="w-4.5 h-4.5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-semibold text-green-800 text-sm">{{ session('siswa_nama') }}</p>
                            <p class="text-xs text-green-700 mt-0.5">
                                NISN: {{ session('siswa_nisn') }}
                                @if(session('siswa_kelas'))
                                    <span class="text-green-400 mx-1">·</span> {{ session('siswa_kelas') }}
                                @endif
                            </p>
                            <p class="text-xs text-green-600 mt-1.5 flex items-center gap-1.5">
                                <span>Tercatat terlambat — {{ \Carbon\Carbon::now()->translatedFormat('d M Y, H:i') }} WIB</span>
                            </p>
                        </div>
                        <button type="button" onclick="this.closest('[id^=resultContainer] > div').remove()" class="flex-shrink-0 text-green-400 hover:text-green-600 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                </div>
            @endif

            @if (session()->has('sudahScan') && session('siswa_nama'))
                <div class="p-4 rounded-xl bg-amber-50 border border-amber-200 fade-in">
                    <div class="flex items-start gap-3">
                        <div class="w-9 h-9 rounded-full bg-amber-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <svg class="w-4.5 h-4.5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-semibold text-amber-800 text-sm">{{ session('siswa_nama') }}</p>
                            <p class="text-xs text-amber-700 mt-0.5">Sudah tercatat terlambat hari ini.</p>
                        </div>
                        <button type="button" onclick="this.closest('[id^=resultContainer] > div').remove()" class="flex-shrink-0 text-amber-400 hover:text-amber-600 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                </div>
            @endif

            @if (session()->has('pesanNot'))
                <div class="p-4 rounded-xl bg-red-50 border border-red-200 shake" id="errorCard">
                    <div class="flex items-start gap-3">
                        <div class="w-9 h-9 rounded-full bg-red-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <svg class="w-4.5 h-4.5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-semibold text-red-800 text-sm">NISN tidak ditemukan</p>
                            <p class="text-xs text-red-700 mt-0.5">{{ session('pesanNot') }}</p>
                        </div>
                        <button type="button" onclick="this.closest('[id^=resultContainer] > div').remove()" class="flex-shrink-0 text-red-400 hover:text-red-600 transition-colors">
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
        border-radius: 0.5rem;
        overflow: hidden;
    }
    #reader video {
        border-radius: 0;
        display: block;
        width: 100%;
    }
    #reader .html5-qrcode-element {
        font-family: inherit;
    }
    #reader__dashboard_section {
        padding: 0 !important;
    }
    #reader__dashboard_section_csr {
        margin: 0 !important;
        text-align: center;
    }
    #reader__dashboard_section_csr button {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 0.5rem !important;
        margin: 0.75rem auto !important;
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
    #reader__dashboard_section_csr button::before {
        content: '\f0c6';
        font-family: 'Font Awesome 6 Free';
        font-weight: 900;
        font-size: 0.875rem;
    }
    #reader__status_span {
        background: #EFF6FF !important;
        color: #2563EB !important;
        padding: 0.25rem 0.75rem !important;
        border-radius: 999px !important;
        font-size: 0.75rem !important;
        font-weight: 500 !important;
    }
    #reader__camera_selection {
        border: 1px solid #CBD5E1 !important;
        border-radius: 0.5rem !important;
        padding: 0.375rem 0.75rem !important;
        font-size: 0.8rem !important;
        color: #1E293B !important;
        background: #fff !important;
        outline: none !important;
        width: auto !important;
        max-width: 100% !important;
    }
    #reader__camera_selection:focus {
        border-color: #2563EB !important;
        ring: 2px solid #EFF6FF !important;
    }
    #reader__dashboard_section_swaplink {
        color: #2563EB !important;
        font-size: 0.8rem !important;
        text-decoration: underline !important;
        cursor: pointer !important;
        margin: 0.25rem 0 !important;
        display: inline-block !important;
    }
    #reader__dashboard_section_swaplink:hover {
        color: #1D4ED8 !important;
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
    function onScanFailure(error) {}
    let html5QrcodeScanner = new Html5QrcodeScanner("reader", { fps: 10, qrbox: { width: 280, height: 280 } }, false);
    html5QrcodeScanner.render(onScanSuccess, onScanFailure);

    let statusCheck = setInterval(function() {
        let statusSpan = document.querySelector('#reader__status_span');
        let statusBadge = document.querySelector('#scanStatus');
        if (statusSpan && statusBadge) {
            let text = statusSpan.textContent.trim().toLowerCase();
            let dot = statusBadge.querySelector('span');
            if (text.includes('scanning') || text.includes('active') || text.includes('started')) {
                dot.className = 'w-1.5 h-1.5 rounded-full bg-green-500';
                statusBadge.className = 'inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-green-50 text-green-700';
            } else if (text.includes('off') || text.includes('idle') || text.includes('stop')) {
                dot.className = 'w-1.5 h-1.5 rounded-full bg-slate-400';
                statusBadge.className = 'inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-500';
            }
        }
        let scanOverlay = document.getElementById('scanOverlay');
        let readerVideo = document.querySelector('#reader video');
        if (scanOverlay && readerVideo && readerVideo.readyState >= 2) {
            scanOverlay.style.display = 'flex';
        }
    }, 500);
</script>
@endpush
