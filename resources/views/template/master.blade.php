@include('template.header')

@yield('homedash')
@yield('manage')
@yield('dashboard')
{{-- data siswa --}}
@yield('create')
{{-- jurusan --}}
@yield('jurusan')
{{-- kelas --}}
@yield('kelas')
{{-- qr code --}}
@yield('qrCode')
@yield('scanSiswa')
@yield('lateTable')

@include('template.footer')