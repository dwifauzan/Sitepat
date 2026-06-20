@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto">
        <h1 class="text-2xl font-bold text-slate-800 mb-6 text-center">Akun Baru</h1>
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <form action="{{ route('dashCreateAction') }}" method="post">
                @csrf
                <x-input name="name" label="Username" placeholder="Masukan username" />
                <x-input name="email" label="Email" placeholder="Masukan email" />
                <x-input name="password" label="Password" type="password" placeholder="Masukan password" />
                <div class="mb-4">
                    <label class="block text-sm font-medium text-slate-700 mb-1">Role</label>
                    <select name="role" class="block w-full rounded-lg border-slate-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 text-sm">
                        @foreach ($data as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_role }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="w-full py-2.5 px-4 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition-colors text-sm">Simpan</button>
            </form>
        </div>
    </div>
@endsection
