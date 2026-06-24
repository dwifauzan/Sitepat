@extends('layouts.app')

@section('page-header', 'Kelola Data Siswa')

@section('breadcrumb')
    <a href="{{ route('dash') }}" class="hover:text-slate-700 transition-colors">Beranda</a>
    <span class="mx-1.5 text-slate-300">/</span>
    <span class="text-slate-800 font-medium">Kelola Data Siswa</span>
@endsection

@section('page-action')
    <x-modal title="Tambah Data Siswa" size="xl">
        <x-slot:trigger>
            <button type="button" class="inline-flex items-center gap-2 px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg text-sm transition-colors duration-150">
                <i class="fas fa-plus"></i>
                Tambah Siswa
            </button>
        </x-slot:trigger>
        <form action="{{ route('action') }}" method="post" x-data="{ step: 1, totalSteps: 3 }">
            @csrf
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
                    </div>
                    <x-input name="alamat" label="Alamat" placeholder="Masukan Alamat" :required="true" />
                </div>
            </div>

            <div x-show="step === 2" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-4">
                    <div class="mb-3">
                        <label class="block text-sm font-medium text-slate-700 mb-1">Kelas <span class="text-red-500">*</span></label>
                        <select name="kelas" class="block w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-100 text-sm">
                            @foreach ($data['kelas'] as $item)
                                <option value="{{ $item->id }}">{{ $item->Nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="block text-sm font-medium text-slate-700 mb-1">Jurusan <span class="text-red-500">*</span></label>
                        <select name="jurusan" class="block w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-100 text-sm">
                            @foreach ($data['jurusan'] as $item)
                                <option value="{{ $item->id }}">{{ $item->Nama_jurusan }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div x-show="step === 3" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-4">
                    <x-input name="nohp" label="No Handphone" placeholder="Masukan No HP" maxlength="12" />
                    <x-input name="ayah" label="Nama Ayah" placeholder="Masukan Nama Ayah" />
                    <x-input name="ibu" label="Nama Ibu" placeholder="Masukan Nama Ibu" />
                    <x-input name="hpAyah" label="No HP Ayah" placeholder="Masukan No HP Ayah" maxlength="12" />
                    <x-input name="hpIbu" label="No HP Ibu" placeholder="Masukan No HP Ibu" maxlength="12" />
                </div>
            </div>

            <div class="mt-6 flex items-center justify-between">
                <div>
                    <button type="button" @click="open = false" class="px-4 py-2 border border-slate-300 text-slate-700 hover:bg-slate-50 font-medium rounded-lg text-sm transition-colors duration-150">Batal</button>
                </div>
                <div class="flex gap-3">
                    <button type="button" x-show="step > 1" @click="step--" class="px-4 py-2 border border-blue-600 text-blue-600 hover:bg-blue-50 font-medium rounded-lg text-sm transition-colors duration-150">
                        <i class="fas fa-arrow-left mr-1"></i> Sebelumnya
                    </button>
                    <button type="button" x-show="step < totalSteps" @click="step++" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg text-sm transition-colors duration-150">
                        Selanjutnya <i class="fas fa-arrow-right ml-1"></i>
                    </button>
                    <button type="submit" x-show="step === totalSteps" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg text-sm transition-colors duration-150">
                        <i class="fas fa-check mr-1"></i> Simpan Data
                    </button>
                </div>
            </div>
        </form>
    </x-modal>
@endsection

@section('content')
    <div class="overflow-hidden rounded-2xl border-2 border-slate-200 shadow-lg bg-white">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200" id="tableSiswa">
                <thead class="bg-gradient-to-r from-slate-50 to-slate-100">
                    <tr>
                        <th class="px-6 py-5 text-left text-xs font-bold text-slate-700 uppercase tracking-wider w-16 border-b-2 border-slate-200">No</th>
                        <th class="px-6 py-5 text-left text-xs font-bold text-slate-700 uppercase tracking-wider border-b-2 border-slate-200">NISN</th>
                        <th class="px-6 py-5 text-left text-xs font-bold text-slate-700 uppercase tracking-wider border-b-2 border-slate-200">Nama Siswa</th>
                        <th class="px-6 py-5 text-left text-xs font-bold text-slate-700 uppercase tracking-wider border-b-2 border-slate-200">Kelas</th>
                        <th class="px-6 py-5 text-left text-xs font-bold text-slate-700 uppercase tracking-wider border-b-2 border-slate-200">Jurusan</th>
                        <th class="px-6 py-5 text-center text-xs font-bold text-slate-700 uppercase tracking-wider w-32 border-b-2 border-slate-200">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-100">
                    @foreach ($data['dataRelasi'] as $item)
                        <tr class="hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 transition-all duration-200 group">
                            <td class="px-6 py-6 text-sm text-slate-500 font-medium">
                                <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-gradient-to-br from-slate-100 to-slate-200 text-slate-600 group-hover:from-blue-100 group-hover:to-blue-200 group-hover:text-blue-700 transition-all duration-200 font-bold">
                                    {{ $loop->iteration }}
                                </div>
                            </td>
                            <td class="px-6 py-6 text-sm font-mono font-bold text-slate-800">
                                <div class="bg-slate-50 rounded-lg px-3 py-2 border border-slate-200">
                                    {{ $item->Nisn }}
                                </div>
                            </td>
                            <td class="px-6 py-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br {{ $item->Jenis_kelamin == 'L' ? 'from-blue-100 to-blue-200' : 'from-pink-100 to-pink-200' }} flex items-center justify-center flex-shrink-0 shadow-sm">
                                        <i class="fas {{ $item->Jenis_kelamin == 'L' ? 'fa-user text-blue-600' : 'fa-user text-pink-600' }} text-lg"></i>
                                    </div>
                                    <div>
                                        <p class="text-base font-bold text-slate-900 mb-1">{{ $item->Nama_siswa }}</p>
                                        <p class="text-sm text-slate-500 font-medium">{{ $item->Jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-6">
                                <span class="inline-flex items-center px-3 py-2 rounded-xl text-sm font-bold shadow-sm bg-gradient-to-r from-green-100 to-emerald-100 text-green-700 border border-green-200">
                                    {{ $item->kelas->Nama_kelas }}
                                </span>
                            </td>
                            <td class="px-6 py-6 text-sm font-semibold text-slate-700">{{ $item->jurusan->Nama_jurusan }}</td>
                            <td class="px-6 py-6 text-sm">
                                <div class="flex items-center justify-center gap-3">
                                    <button onclick="showStudentDetails({{ $item->id }}, '{{ $item->Nama_siswa }}', '{{ $item->Nisn }}', '{{ $item->Jenis_kelamin }}', '{{ $item->kelas->Nama_kelas }}', '{{ $item->jurusan->Nama_jurusan }}', '{{ addslashes($item->Alamat) }}', '{{ $item->No_Handphone }}')" 
                                            class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-blue-600 hover:bg-blue-500 hover:text-white bg-blue-50 transition-all duration-200 text-sm font-semibold shadow-sm hover:shadow-md transform hover:scale-105" 
                                            title="Lihat Detail">
                                        <i class="fas fa-info-circle"></i>
                                        <span>Detail</span>
                                    </button>
                                    <a href="{{ route('qrCode', $item->id) }}" 
                                       class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-green-600 hover:bg-green-500 hover:text-white bg-green-50 transition-all duration-200 text-sm font-semibold shadow-sm hover:shadow-md transform hover:scale-105" 
                                       title="Lihat QR Code">
                                        <i class="fas fa-qrcode"></i>
                                        <span>QR</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Student Details Modal -->
    <div id="studentModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 transition-opacity duration-300">
        <div class="flex items-center justify-center min-h-screen px-4 py-8">
            <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto transform transition-all duration-300 scale-95" id="modalContent">
                <!-- Modal Header -->
                <div class="bg-gradient-to-r from-blue-600 to-indigo-600 p-6 rounded-t-2xl">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-white bg-opacity-20 flex items-center justify-center">
                                <i class="fas fa-user-graduate text-white text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-white" id="modalStudentName">Detail Siswa</h3>
                                <p class="text-blue-100 text-sm" id="modalStudentNisn">NISN: -</p>
                            </div>
                        </div>
                        <button onclick="closeModal()" class="text-white hover:bg-white hover:bg-opacity-20 rounded-lg p-2 transition-colors duration-200">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                </div>

                <!-- Modal Body -->
                <div class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Personal Information -->
                        <div class="space-y-4">
                            <h4 class="text-lg font-bold text-slate-800 border-b-2 border-blue-100 pb-2 mb-4">
                                <i class="fas fa-user text-blue-600 mr-2"></i>
                                Informasi Pribadi
                            </h4>
                            
                            <div class="bg-slate-50 rounded-xl p-4 border border-slate-200">
                                <label class="block text-sm font-semibold text-slate-600 mb-1">Nama Lengkap</label>
                                <p class="text-base font-bold text-slate-900" id="modalFullName">-</p>
                            </div>

                            <div class="bg-slate-50 rounded-xl p-4 border border-slate-200">
                                <label class="block text-sm font-semibold text-slate-600 mb-1">NISN</label>
                                <p class="text-base font-mono font-bold text-slate-900 bg-white rounded-lg px-3 py-2 border" id="modalNisn">-</p>
                            </div>

                            <div class="bg-slate-50 rounded-xl p-4 border border-slate-200">
                                <label class="block text-sm font-semibold text-slate-600 mb-1">Jenis Kelamin</label>
                                <div id="modalGender" class="inline-flex items-center px-3 py-2 rounded-lg text-sm font-semibold bg-blue-100 text-blue-700">-</div>
                            </div>

                            <div class="bg-slate-50 rounded-xl p-4 border border-slate-200">
                                <label class="block text-sm font-semibold text-slate-600 mb-1">No. Handphone</label>
                                <p class="text-base font-semibold text-slate-900" id="modalPhone">-</p>
                            </div>
                        </div>

                        <!-- Academic Information -->
                        <div class="space-y-4">
                            <h4 class="text-lg font-bold text-slate-800 border-b-2 border-green-100 pb-2 mb-4">
                                <i class="fas fa-graduation-cap text-green-600 mr-2"></i>
                                Informasi Akademik
                            </h4>

                            <div class="bg-green-50 rounded-xl p-4 border border-green-200">
                                <label class="block text-sm font-semibold text-green-700 mb-1">Kelas</label>
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-lg bg-green-100 flex items-center justify-center">
                                        <i class="fas fa-chalkboard text-green-600"></i>
                                    </div>
                                    <p class="text-lg font-bold text-green-800" id="modalClass">-</p>
                                </div>
                            </div>

                            <div class="bg-green-50 rounded-xl p-4 border border-green-200">
                                <label class="block text-sm font-semibold text-green-700 mb-1">Jurusan</label>
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-lg bg-green-100 flex items-center justify-center">
                                        <i class="fas fa-book text-green-600"></i>
                                    </div>
                                    <p class="text-lg font-bold text-green-800" id="modalMajor">-</p>
                                </div>
                            </div>

                            <!-- Address -->
                            <div class="bg-orange-50 rounded-xl p-4 border border-orange-200 md:col-span-2">
                                <label class="block text-sm font-semibold text-orange-700 mb-2">
                                    <i class="fas fa-map-marker-alt text-orange-600 mr-1"></i>
                                    Alamat Lengkap
                                </label>
                                <p class="text-base text-orange-800 leading-relaxed" id="modalAddress">-</p>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-8 flex items-center justify-end gap-3 pt-6 border-t border-slate-200">
                        <button onclick="closeModal()" class="px-6 py-3 border-2 border-slate-300 text-slate-700 hover:bg-slate-50 font-semibold rounded-xl text-sm transition-all duration-200">
                            <i class="fas fa-times mr-2"></i>Tutup
                        </button>
                        <a id="modalQrLink" href="#" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-semibold rounded-xl text-sm transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105">
                            <i class="fas fa-qrcode"></i>
                            Lihat QR Code
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@include('components.data-table-styles')

@push('scripts')
<script>
    $(function() {
        $('#tableSiswa').DataTable({
            responsive: true,
            pageLength: 25,
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                infoEmpty: "Menampilkan 0 data",
                infoFiltered: "(difilter dari _MAX_ total data)",
                zeroRecords: "Tidak ada data ditemukan",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "›",
                    previous: "‹"
                }
            }
        });
    });

    // Student Details Modal Functions
    function showStudentDetails(id, name, nisn, gender, kelas, jurusan, alamat, phone) {
        // Populate modal data
        document.getElementById('modalStudentName').textContent = name;
        document.getElementById('modalStudentNisn').textContent = 'NISN: ' + nisn;
        document.getElementById('modalFullName').textContent = name;
        document.getElementById('modalNisn').textContent = nisn;
        document.getElementById('modalClass').textContent = kelas;
        document.getElementById('modalMajor').textContent = jurusan;
        document.getElementById('modalAddress').textContent = alamat || 'Tidak ada data alamat';
        document.getElementById('modalPhone').textContent = phone || 'Tidak ada data';
        
        // Set gender with appropriate styling
        const genderElement = document.getElementById('modalGender');
        if (gender === 'L') {
            genderElement.textContent = 'Laki-laki';
            genderElement.className = 'inline-flex items-center px-3 py-2 rounded-lg text-sm font-semibold bg-blue-100 text-blue-700';
        } else {
            genderElement.textContent = 'Perempuan';
            genderElement.className = 'inline-flex items-center px-3 py-2 rounded-lg text-sm font-semibold bg-pink-100 text-pink-700';
        }
        
        // Set QR link
        document.getElementById('modalQrLink').href = '/qrcode/' + id;
        
        // Show modal with animation
        const modal = document.getElementById('studentModal');
        const modalContent = document.getElementById('modalContent');
        
        modal.classList.remove('hidden');
        
        // Trigger animation
        setTimeout(() => {
            modal.classList.add('opacity-100');
            modalContent.classList.remove('scale-95');
            modalContent.classList.add('scale-100');
        }, 10);
        
        // Prevent body scroll
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        const modal = document.getElementById('studentModal');
        const modalContent = document.getElementById('modalContent');
        
        // Start exit animation
        modal.classList.remove('opacity-100');
        modalContent.classList.remove('scale-100');
        modalContent.classList.add('scale-95');
        
        // Hide modal after animation
        setTimeout(() => {
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }, 300);
    }

    // Close modal when clicking outside
    document.getElementById('studentModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal();
        }
    });
</script>
@endpush
