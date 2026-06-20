@extends('layouts.app')

@section('page-header', 'Tambah Siswa Baru')

@section('breadcrumb')
    <a href="{{ route('manage') }}" class="hover:text-slate-700 transition-colors">Kelola Data Siswa</a>
    <span class="mx-1.5 text-slate-300">/</span>
    <span class="text-slate-800 font-medium">Tambah Siswa Baru</span>
@endsection

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <form action="{{ route('action') }}" method="post" x-data="{ step: 1, totalSteps: 3 }">
                @csrf

                {{-- Step Indicators --}}
                <div class="flex items-center justify-center gap-4 mb-8">
                    <template x-for="(label, i) in ['Data Pribadi', 'Data Akademik', 'Data Kontak']" :key="i">
                        <div class="flex items-center gap-2">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold transition-colors"
                                    :class="step >= i + 1 ? 'bg-blue-600 text-white' : 'bg-slate-200 text-slate-500'"
                                    x-text="i + 1">
                                </div>
                                <span class="text-xs font-medium hidden sm:block"
                                    :class="step >= i + 1 ? 'text-blue-600' : 'text-slate-400'"
                                    x-text="label">
                                </span>
                            </div>
                            <template x-if="i < totalSteps - 1">
                                <div class="w-8 h-0.5" :class="step > i + 1 ? 'bg-blue-600' : 'bg-slate-200'"></div>
                            </template>
                        </div>
                    </template>
                </div>

                {{-- Step 1: Data Pribadi --}}
                <div x-show="step === 1" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-4">
                        <x-input name="nisn" label="NISN" placeholder="Masukan NISN" :required="true" maxlength="10" />
                        <x-input name="siswa" label="Nama Siswa" placeholder="Masukan Nama Siswa" :required="true" />
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-slate-700 mb-1">Jenis Kelamin <span class="text-red-500">*</span></label>
                            <select name="gender" class="block w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-100 text-sm">
                                <option value="laki-laki">Laki laki</option>
                                <option value="perempuan">Perempuan</option>
                            </select>
                            @error('gender')<p class="mt-1 text-xs text-red-600 flex items-center gap-1"><span>⚠</span> {{ $message }}</p>@enderror
                        </div>
                        <x-input name="alamat" label="Alamat" placeholder="Masukan Alamat" :required="true" />
                    </div>
                </div>

                {{-- Step 2: Data Akademik --}}
                <div x-show="step === 2" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-4">
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-slate-700 mb-1">Kelas <span class="text-red-500">*</span></label>
                            <select name="kelas" class="block w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-100 text-sm">
                                @foreach ($data['kelas'] as $item)
                                    <option value="{{ $item->id }}">{{ $item->Nama_kelas }}</option>
                                @endforeach
                            </select>
                            @error('kelas')<p class="mt-1 text-xs text-red-600 flex items-center gap-1"><span>⚠</span> {{ $message }}</p>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-slate-700 mb-1">Jurusan <span class="text-red-500">*</span></label>
                            <select name="jurusan" class="block w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-100 text-sm">
                                @foreach ($data['jurusan'] as $item)
                                    <option value="{{ $item->id }}">{{ $item->Nama_jurusan }}</option>
                                @endforeach
                            </select>
                            @error('jurusan')<p class="mt-1 text-xs text-red-600 flex items-center gap-1"><span>⚠</span> {{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>

                {{-- Step 3: Data Kontak --}}
                <div x-show="step === 3" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-4">
                        <x-input name="nohp" label="No Handphone" placeholder="Masukan No HP" maxlength="12" />
                        <x-input name="ayah" label="Nama Ayah" placeholder="Masukan Nama Ayah" />
                        <x-input name="ibu" label="Nama Ibu" placeholder="Masukan Nama Ibu" />
                        <x-input name="hpAyah" label="No HP Ayah" placeholder="Masukan No HP Ayah" maxlength="12" />
                        <x-input name="hpIbu" label="No HP Ibu" placeholder="Masukan No HP Ibu" maxlength="12" />
                    </div>
                </div>

                {{-- Navigation --}}
                <div class="mt-6 flex items-center justify-between">
                    <div>
                        <button type="button" x-show="step > 1" @click="step = 1" class="px-4 py-2 border border-slate-300 text-slate-700 hover:bg-slate-50 font-medium rounded-lg text-sm transition-colors duration-150">Batal</button>
                    </div>
                    <div class="flex gap-3">
                        <button type="button" x-show="step > 1" @click="step--" class="px-4 py-2 border border-blue-600 text-blue-600 hover:bg-blue-50 font-medium rounded-lg text-sm transition-colors duration-150">
                            <i class="fas fa-arrow-left mr-1"></i> Sebelumnya
                        </button>
                        <button type="button" x-show="step < totalSteps" @click="step++" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg text-sm transition-colors duration-150">
                            Selanjutnya <i class="fas fa-arrow-right ml-1"></i>
                        </button>
                        <button type="submit" x-show="step === totalSteps" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg text-sm transition-colors duration-150">
                            <i class="fas fa-check mr-1"></i> Simpan Siswa
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
