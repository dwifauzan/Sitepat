@extends('layouts.app')

@section('page-header', 'Beranda')

@section('content')
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
        <h2 class="text-xl font-bold text-slate-900 mb-2">Selamat datang, <span class="text-blue-600">{{ auth()->user()->name }}</span></h2>
        <p class="text-slate-600">Selamat datang di komunitas kami! Kami hadir untuk membantu Anda sukses dalam peran Anda.</p>
        @if (isset($data) && $data)
            <div class="mt-4 text-sm text-slate-400">{{ $data }}</div>
        @endif
    </div>
@endsection
