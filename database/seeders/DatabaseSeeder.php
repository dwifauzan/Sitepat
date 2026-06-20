<?php

namespace Database\Seeders;

use App\Models\admin;
use App\Models\datasiswa;
use App\Models\jurusan;
use App\Models\kelas;
use App\Models\keterlambatan;
use App\Models\role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Roles
        role::create(['nama_role' => 'admin']);
        role::create(['nama_role' => 'superadmin']);
        role::create(['nama_role' => 'operator']);

        // Users
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin22'),
            'role_id' => 1
        ]);

        User::create([
            'name' => 'operator',
            'email' => 'operator@gmail.com',
            'password' => bcrypt('operator22'),
            'role_id' => 3
        ]);

        // Kelas (Classes)
        $kelasData = [
            ['Tingkat_kelas' => 'X', 'Nama_kelas' => 'X-1', 'Walikelas' => 'Drs. Supriyono'],
            ['Tingkat_kelas' => 'X', 'Nama_kelas' => 'X-2', 'Walikelas' => 'Rina Wijaya, S.Pd.'],
            ['Tingkat_kelas' => 'X', 'Nama_kelas' => 'X-3', 'Walikelas' => 'Agus Santoso, S.Pd.'],
            ['Tingkat_kelas' => 'XI', 'Nama_kelas' => 'XI-1', 'Walikelas' => 'Dra. Siti Rahmawati'],
            ['Tingkat_kelas' => 'XI', 'Nama_kelas' => 'XI-2', 'Walikelas' => 'Hendra Gunawan, S.Pd.'],
            ['Tingkat_kelas' => 'XI', 'Nama_kelas' => 'XI-3', 'Walikelas' => 'Dewi Lestari, S.Pd.'],
            ['Tingkat_kelas' => 'XII', 'Nama_kelas' => 'XII-1', 'Walikelas' => 'Prof. Dr. Bambang Hartono'],
            ['Tingkat_kelas' => 'XII', 'Nama_kelas' => 'XII-2', 'Walikelas' => 'Fitriani, S.Pd., M.Pd.'],
            ['Tingkat_kelas' => 'XII', 'Nama_kelas' => 'XII-3', 'Walikelas' => 'Eko Prasetyo, S.Pd.'],
        ];
        foreach ($kelasData as $k) {
            kelas::create($k);
        }

        // Jurusan (Majors)
        $jurusanData = [
            ['Nama_jurusan' => 'Rekayasa Perangkat Lunak', 'Nama_kaproli' => 'Yudi Firmansyah, S.Kom., M.Kom.'],
            ['Nama_jurusan' => 'Multimedia', 'Nama_kaproli' => 'Ayu Permatasari, S.Sn., M.Ds.'],
            ['Nama_jurusan' => 'Teknik Komputer dan Jaringan', 'Nama_kaproli' => 'Ahmad Fauzi, S.T., M.T.'],
            ['Nama_jurusan' => 'Akuntansi dan Keuangan Lembaga', 'Nama_kaproli' => 'Sri Wahyuni, S.E., M.Ak.'],
            ['Nama_jurusan' => 'Bisnis Daring dan Pemasaran', 'Nama_kaproli' => 'Rudi Hartono, S.E., M.M.'],
        ];
        foreach ($jurusanData as $j) {
            jurusan::create($j);
        }

        // Datasiswa (Students)
        $siswaData = [
            ['Nisn' => 1001001, 'Nama_siswa' => 'Ahmad Rizki Pratama', 'Jenis_kelamin' => 'laki laki', 'kelas_id' => 1, 'jurusan_id' => 1, 'Alamat' => 'Jl. Merdeka No. 10, Bondowoso', 'No_Handphone' => 81234567890, 'Nama_Ortu_Ayah' => 'H. Supardi', 'Nama_Ortu_Ibu' => 'Hj. Siti Aminah', 'No_Handphone_Ayah' => 81123456789, 'No_Handphone_Ibu' => 81234567891],
            ['Nisn' => 1001002, 'Nama_siswa' => 'Bunga Citra Lestari', 'Jenis_kelamin' => 'perempuan', 'kelas_id' => 1, 'jurusan_id' => 1, 'Alamat' => 'Jl. Diponegoro No. 25, Bondowoso', 'No_Handphone' => 81345678901, 'Nama_Ortu_Ayah' => 'Drs. Heru Susanto', 'Nama_Ortu_Ibu' => 'Dra. Indah Purnamasari', 'No_Handphone_Ayah' => 81456789012, 'No_Handphone_Ibu' => 81567890123],
            ['Nisn' => 1001003, 'Nama_siswa' => 'Candra Dewa Kusuma', 'Jenis_kelamin' => 'laki laki', 'kelas_id' => 1, 'jurusan_id' => 1, 'Alamat' => 'Jl. Ahmad Yani No. 5, Bondowoso', 'No_Handphone' => 81678901234, 'Nama_Ortu_Ayah' => 'Bambang Kusumo', 'Nama_Ortu_Ibu' => 'Ratna Dewi', 'No_Handphone_Ayah' => 81789012345, 'No_Handphone_Ibu' => 81890123456],
            ['Nisn' => 1001004, 'Nama_siswa' => 'Dian Permata Sari', 'Jenis_kelamin' => 'perempuan', 'kelas_id' => 2, 'jurusan_id' => 2, 'Alamat' => 'Jl. Sudirman No. 12, Bondowoso', 'No_Handphone' => 81901234567, 'Nama_Ortu_Ayah' => 'Agus Wijaya', 'Nama_Ortu_Ibu' => 'Nurhayati', 'No_Handphone_Ayah' => 82012345678, 'No_Handphone_Ibu' => 82123456789],
            ['Nisn' => 1001005, 'Nama_siswa' => 'Eko Putra Nugroho', 'Jenis_kelamin' => 'laki laki', 'kelas_id' => 2, 'jurusan_id' => 2, 'Alamat' => 'Jl. Gajah Mada No. 8, Bondowoso', 'No_Handphone' => 82234567890, 'Nama_Ortu_Ayah' => 'Slamet Riyadi', 'Nama_Ortu_Ibu' => 'Sumiyati', 'No_Handphone_Ayah' => 82345678901, 'No_Handphone_Ibu' => 82456789012],
            ['Nisn' => 1001006, 'Nama_siswa' => 'Fitri Handayani', 'Jenis_kelamin' => 'perempuan', 'kelas_id' => 2, 'jurusan_id' => 2, 'Alamat' => 'Jl. Pahlawan No. 17, Bondowoso', 'No_Handphone' => 82567890123, 'Nama_Ortu_Ayah' => 'Sukardi', 'Nama_Ortu_Ibu' => 'Kartini', 'No_Handphone_Ayah' => 82678901234, 'No_Handphone_Ibu' => 82789012345],
            ['Nisn' => 1001007, 'Nama_siswa' => 'Gilang Pratama Ardiansyah', 'Jenis_kelamin' => 'laki laki', 'kelas_id' => 3, 'jurusan_id' => 3, 'Alamat' => 'Jl. Imam Bonjol No. 3, Bondowoso', 'No_Handphone' => 82890123456, 'Nama_Ortu_Ayah' => 'Haryanto', 'Nama_Ortu_Ibu' => 'Sri Mulyani', 'No_Handphone_Ayah' => 82901234567, 'No_Handphone_Ibu' => 83012345678],
            ['Nisn' => 1001008, 'Nama_siswa' => 'Hani Nur Azizah', 'Jenis_kelamin' => 'perempuan', 'kelas_id' => 3, 'jurusan_id' => 3, 'Alamat' => 'Jl. Veteran No. 20, Bondowoso', 'No_Handphone' => 83123456789, 'Nama_Ortu_Ayah' => 'M. Ali Imron', 'Nama_Ortu_Ibu' => 'Zainab', 'No_Handphone_Ayah' => 83234567890, 'No_Handphone_Ibu' => 83345678901],
            ['Nisn' => 1002001, 'Nama_siswa' => 'Indra Lesmana', 'Jenis_kelamin' => 'laki laki', 'kelas_id' => 4, 'jurusan_id' => 1, 'Alamat' => 'Jl. Suropati No. 7, Bondowoso', 'No_Handphone' => 83456789012, 'Nama_Ortu_Ayah' => 'Edi Susanto', 'Nama_Ortu_Ibu' => 'Tatik Suryani', 'No_Handphone_Ayah' => 83567890123, 'No_Handphone_Ibu' => 83678901234],
            ['Nisn' => 1002002, 'Nama_siswa' => 'Joko Widodo Putra', 'Jenis_kelamin' => 'laki laki', 'kelas_id' => 4, 'jurusan_id' => 1, 'Alamat' => 'Jl. KH. Wahid Hasyim No. 15, Bondowoso', 'No_Handphone' => 83789012345, 'Nama_Ortu_Ayah' => 'Suyono', 'Nama_Ortu_Ibu' => 'Sulastri', 'No_Handphone_Ayah' => 83890123456, 'No_Handphone_Ibu' => 83901234567],
            ['Nisn' => 1002003, 'Nama_siswa' => 'Kartika Sari Dewi', 'Jenis_kelamin' => 'perempuan', 'kelas_id' => 5, 'jurusan_id' => 4, 'Alamat' => 'Jl. Hasanuddin No. 22, Bondowoso', 'No_Handphone' => 84012345678, 'Nama_Ortu_Ayah' => 'Sutrisno', 'Nama_Ortu_Ibu' => 'Endang Pujiastuti', 'No_Handphone_Ayah' => 84123456789, 'No_Handphone_Ibu' => 84234567890],
            ['Nisn' => 1002004, 'Nama_siswa' => 'Lukman Hakim', 'Jenis_kelamin' => 'laki laki', 'kelas_id' => 5, 'jurusan_id' => 4, 'Alamat' => 'Jl. Pattimura No. 9, Bondowoso', 'No_Handphone' => 84345678901, 'Nama_Ortu_Ayah' => 'Zainal Arifin', 'Nama_Ortu_Ibu' => 'Fatimah', 'No_Handphone_Ayah' => 84456789012, 'No_Handphone_Ibu' => 84567890123],
            ['Nisn' => 1002005, 'Nama_siswa' => 'Mega Wati', 'Jenis_kelamin' => 'perempuan', 'kelas_id' => 6, 'jurusan_id' => 5, 'Alamat' => 'Jl. Teuku Umar No. 14, Bondowoso', 'No_Handphone' => 84678901234, 'Nama_Ortu_Ayah' => 'Suharto', 'Nama_Ortu_Ibu' => 'Wahyuningsih', 'No_Handphone_Ayah' => 84789012345, 'No_Handphone_Ibu' => 84890123456],
            ['Nisn' => 1002006, 'Nama_siswa' => 'Nanda Pratama', 'Jenis_kelamin' => 'laki laki', 'kelas_id' => 6, 'jurusan_id' => 5, 'Alamat' => 'Jl. WR. Supratman No. 30, Bondowoso', 'No_Handphone' => 84901234567, 'Nama_Ortu_Ayah' => 'Mulyono', 'Nama_Ortu_Ibu' => 'Puji Lestari', 'No_Handphone_Ayah' => 85012345678, 'No_Handphone_Ibu' => 85123456789],
            ['Nisn' => 1003001, 'Nama_siswa' => 'Oktavia Rahmawati', 'Jenis_kelamin' => 'perempuan', 'kelas_id' => 7, 'jurusan_id' => 1, 'Alamat' => 'Jl. Diponegoro No. 45, Bondowoso', 'No_Handphone' => 85234567890, 'Nama_Ortu_Ayah' => 'Suprapto', 'Nama_Ortu_Ibu' => 'Rukmini', 'No_Handphone_Ayah' => 85345678901, 'No_Handphone_Ibu' => 85456789012],
            ['Nisn' => 1003002, 'Nama_siswa' => 'Prayoga Budi Santoso', 'Jenis_kelamin' => 'laki laki', 'kelas_id' => 7, 'jurusan_id' => 1, 'Alamat' => 'Jl. Merdeka No. 33, Bondowoso', 'No_Handphone' => 85567890123, 'Nama_Ortu_Ayah' => 'Margono', 'Nama_Ortu_Ibu' => 'Sutarni', 'No_Handphone_Ayah' => 85678901234, 'No_Handphone_Ibu' => 85789012345],
            ['Nisn' => 1003003, 'Nama_siswa' => 'Rina Melati', 'Jenis_kelamin' => 'perempuan', 'kelas_id' => 8, 'jurusan_id' => 2, 'Alamat' => 'Jl. Ahmad Yani No. 50, Bondowoso', 'No_Handphone' => 85890123456, 'Nama_Ortu_Ayah' => 'Teguh Santoso', 'Nama_Ortu_Ibu' => 'Sri Rahayu', 'No_Handphone_Ayah' => 85901234567, 'No_Handphone_Ibu' => 86012345678],
            ['Nisn' => 1003004, 'Nama_siswa' => 'Satria Yudha Pratama', 'Jenis_kelamin' => 'laki laki', 'kelas_id' => 8, 'jurusan_id' => 2, 'Alamat' => 'Jl. Gajah Mada No. 11, Bondowoso', 'No_Handphone' => 86123456789, 'Nama_Ortu_Ayah' => 'Purnomo', 'Nama_Ortu_Ibu' => 'Yuliani', 'No_Handphone_Ayah' => 86234567890, 'No_Handphone_Ibu' => 86345678901],
            ['Nisn' => 1003005, 'Nama_siswa' => 'Tri Wahyuni', 'Jenis_kelamin' => 'perempuan', 'kelas_id' => 9, 'jurusan_id' => 4, 'Alamat' => 'Jl. Sudirman No. 28, Bondowoso', 'No_Handphone' => 86456789012, 'Nama_Ortu_Ayah' => 'Dwi Hartono', 'Nama_Ortu_Ibu' => 'Ani Sulastri', 'No_Handphone_Ayah' => 86567890123, 'No_Handphone_Ibu' => 86678901234],
        ];
        foreach ($siswaData as $s) {
            datasiswa::create($s);
        }

        // Keterlambatans (Tardiness Records)
        $telatData = [
            ['Nisn_siswa' => 1001001, 'Tanggal' => '2024-01-08', 'jurusan_id' => 1, 'kelas_id' => 1, 'Telat' => 1],
            ['Nisn_siswa' => 1001001, 'Tanggal' => '2024-01-10', 'jurusan_id' => 1, 'kelas_id' => 1, 'Telat' => 1],
            ['Nisn_siswa' => 1001003, 'Tanggal' => '2024-01-09', 'jurusan_id' => 1, 'kelas_id' => 1, 'Telat' => 2],
            ['Nisn_siswa' => 1001004, 'Tanggal' => '2024-01-08', 'jurusan_id' => 2, 'kelas_id' => 2, 'Telat' => 1],
            ['Nisn_siswa' => 1001006, 'Tanggal' => '2024-01-10', 'jurusan_id' => 2, 'kelas_id' => 2, 'Telat' => 1],
            ['Nisn_siswa' => 1001006, 'Tanggal' => '2024-01-12', 'jurusan_id' => 2, 'kelas_id' => 2, 'Telat' => 1],
            ['Nisn_siswa' => 1001007, 'Tanggal' => '2024-01-09', 'jurusan_id' => 3, 'kelas_id' => 3, 'Telat' => 3],
            ['Nisn_siswa' => 1002001, 'Tanggal' => '2024-01-11', 'jurusan_id' => 1, 'kelas_id' => 4, 'Telat' => 1],
            ['Nisn_siswa' => 1002002, 'Tanggal' => '2024-01-08', 'jurusan_id' => 1, 'kelas_id' => 4, 'Telat' => 2],
            ['Nisn_siswa' => 1002002, 'Tanggal' => '2024-01-15', 'jurusan_id' => 1, 'kelas_id' => 4, 'Telat' => 1],
            ['Nisn_siswa' => 1002004, 'Tanggal' => '2024-01-10', 'jurusan_id' => 4, 'kelas_id' => 5, 'Telat' => 1],
            ['Nisn_siswa' => 1002006, 'Tanggal' => '2024-01-12', 'jurusan_id' => 5, 'kelas_id' => 6, 'Telat' => 1],
            ['Nisn_siswa' => 1003002, 'Tanggal' => '2024-01-09', 'jurusan_id' => 1, 'kelas_id' => 7, 'Telat' => 2],
            ['Nisn_siswa' => 1003004, 'Tanggal' => '2024-01-11', 'jurusan_id' => 2, 'kelas_id' => 8, 'Telat' => 1],
            ['Nisn_siswa' => 1003005, 'Tanggal' => '2024-01-08', 'jurusan_id' => 4, 'kelas_id' => 9, 'Telat' => 1],
            ['Nisn_siswa' => 1003005, 'Tanggal' => '2024-01-10', 'jurusan_id' => 4, 'kelas_id' => 9, 'Telat' => 1],
            ['Nisn_siswa' => 1003005, 'Tanggal' => '2024-01-14', 'jurusan_id' => 4, 'kelas_id' => 9, 'Telat' => 2],
        ];
        foreach ($telatData as $t) {
            keterlambatan::create($t);
        }
    }
}
