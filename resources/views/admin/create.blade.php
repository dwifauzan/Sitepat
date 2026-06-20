@extends('layouts.app')

@section('page-header', 'Tambah Pengguna')

@section('breadcrumb')
    <a href="{{ route('dash') }}" class="hover:text-slate-700 transition-colors">Beranda</a>
    <span class="mx-1.5 text-slate-300">/</span>
    <span class="text-slate-800 font-medium">Tambah Pengguna</span>
@endsection

@section('content')
    <div class="max-w-md mx-auto">
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <form action="{{ route('dashCreateAction') }}" method="post">
                @csrf
                <x-input name="name" label="Username" placeholder="Masukan username" />
                <x-input name="email" label="Email" placeholder="Masukan email" />
                <x-input name="password" label="Password" type="password" placeholder="Masukan password" />
                <div class="mb-3">
                    <label class="block text-sm font-medium text-slate-700 mb-1">Role</label>
                    <select name="role" class="block w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-100 text-sm">
                        @foreach ($data as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_role }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="w-full py-2.5 px-4 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-150 text-sm">Simpan</button>
            </form>
        </div>
    </div>
@endsection
