@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto">
        <h1 class="text-2xl font-bold text-slate-800 mb-6 text-center">Perbarui Akun</h1>
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <form action="{{ route('dashUpdateAction', $data['user']->id) }}" method="post">
                @csrf
                <x-input name="name" label="Username" :value="$data['user']->name" placeholder="Masukan username" />
                <x-input name="email" label="Email" :value="$data['user']->email" placeholder="Masukan email" />
                <div class="mb-3">
                    <label class="block text-sm font-medium text-slate-700 mb-1">Role</label>
                    <select name="role" class="block w-full rounded-lg border-slate-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 text-sm">
                        <option disabled>Pilihan sebelumnya {{ $data['user']->Role->nama_role }}</option>
                        @foreach ($data['role'] as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_role }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="w-full py-2.5 px-4 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition-colors text-sm">Simpan</button>
            </form>
        </div>
    </div>
@endsection
