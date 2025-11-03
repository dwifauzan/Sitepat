@extends('template.master')

@section('create')
    <section class="content content-wrapper">
        <div class="container-fluid">
            <div class="row d-flex justify-content-center">
                <div class="col-6 mt-4">

                    <div class="card rounded-3">
                        <h3 class="card-title text-capitalize text-center mt-3 fw-bold" style="font-family: 'Poppins', sans-serif; font-size: 2em;">Data Siswa Baru</h3>
                            {{-- <a href="{{ route('dash') }}"><button type="button" class="btn btn-primary">Back</button></a> --}}


                        <form action="{{ route('action') }}" method="post">
                            @csrf
                            <div class="card-body">
                                {{-- nisn siswa --}}
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        placeholder="Masukan nisn Siswa" name="nisn" autofocus maxlength="10" inputmode="numeric"
                                        oninput="validateInput(event)">
                                    @error('nisn')
                                        <span style="color: red;">*{{ $message }}*</span>
                                    @enderror
                                </div>
                                {{-- nama siswa --}}
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="exampleInputPassword1"
                                        placeholder="Masukan nama Siswa" name="siswa">
                                    @error('siswa')
                                        <span style="color: red;">*{{ $message }}*</span>
                                    @enderror
                                </div>
                                {{-- jenis kelamin --}}
                                <div class="mb-3">
                                    <label for="" class="text-capitalize">pilih gender</label>
                                        <select class="custom-select form-control-border" id="exampleSelectBorder"
                                            name="gender">
                                            <option value="laki-laki">Laki laki</option>
                                            <option value="perempuan">Perempuan</option>
                                            @error('gender')
                                                <span style="color: red;">*{{ $message }}*</span>
                                            @enderror
                                        </select>
                                </div>
                                {{-- relasi kelas --}}
                                <div class="mb-3">
                                    <label for="" class="text-capitalize">pilih kelas</label>
                                        <select class="custom-select form-control-border" id="exampleSelectBorder"
                                            name="kelas">
                                            @foreach ($data['kelas'] as $item)
                                                <option value="{{ $item->id }}">{{ $item->Nama_kelas }}</option>
                                            @endforeach
                                            @error('kelas')
                                                <span style="color: red;">*{{ $message }}*</span>
                                            @enderror
                                        </select>
                                </div>
                                {{-- relasi jurusan --}}
                                <div class="mb-3">
                                    <label for="" class="text-capitalize">pilih jurusan</label>
                                        <select class="custom-select form-control-border" id="exampleSelectBorder"
                                            name="jurusan">
                                            @foreach ($data['jurusan'] as $item)
                                                <option value="{{ $item->id }}">{{ $item->Nama_jurusan }}</option>
                                            @endforeach
                                            @error('jurusan')
                                                <span style="color: red;">*{{ $message }}*</span>
                                            @enderror
                                        </select>
                                </div>
                                {{-- alamat --}}
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="exampleInputPassword1"
                                        placeholder="Masukan alamat Siswa" name="alamat">
                                    @error('alamat')
                                        <span style="color: red;">*{{ $message }}*</span>
                                    @enderror
                                </div>
                                {{-- no handphone --}}
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="exampleInputPassword1"
                                        placeholder="Masukan No Hp Siswa" name="nohp" oninput="validateInput(event)"
                                        maxlength="12">
                                    @error('nohp')
                                        <span style="color: red;">*{{ $message }}*</span>
                                    @enderror
                                </div>
                                {{-- nama ayah --}}
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="exampleInputPassword1"
                                        placeholder="Masukan Nama ayah" name="ayah">
                                    @error('ayah')
                                        <span style="color: red;">*{{ $message }}*</span>
                                    @enderror
                                </div>
                                {{-- ibu siswa --}}
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="exampleInputPassword1"
                                        placeholder="Masukan Nama ibu" name="ibu">
                                    @error('ibu')
                                        <span style="color: red;">*{{ $message }}*</span>
                                    @enderror
                                </div>
                                {{-- no handphone ayah --}}
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="exampleInputPassword1"
                                        placeholder="Masukan No Hp ayah" name="hpAyah" oninput="validateInput(event)"
                                        maxlength="12">
                                    @error('hpAyah')
                                        <span style="color: red;">*{{ $message }}*</span>
                                    @enderror
                                </div>
                                {{-- no handphone ibu --}}
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="exampleInputPassword1"
                                        placeholder="Masukan No Hp ibu" name="hpIbu" oninput="validateInput(event)"
                                        maxlength="12">
                                    @error('hpIbu')
                                        <span style="color: red;">*{{ $message }}*</span>
                                    @enderror
                                </div>

                                {{-- button --}}
                                <button type="submit" class="btn btn-block rounded-4 shadow" style="background-color:#BB393E; font-family: 'Poppins', sans-serif; color: white;">Submit</button>
                        </form>
                    </div>
                @endsection
            </div>
        </div>
    </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const nextButtons = document.querySelectorAll('.next-step');
            const prevButtons = document.querySelectorAll('.prev-step');
            const steps = document.querySelectorAll('.step');
            let currentStep = 0;

            function showStep(stepIndex) {
                steps.forEach((step, index) => {
                    step.style.display = index === stepIndex ? 'block' : 'none';
                });
            }

            nextButtons.forEach(button => {
                button.addEventListener('click', () => {
                    if (currentStep < steps.length - 1) {
                        currentStep++;
                        showStep(currentStep);
                    }
                });
            });

            prevButtons.forEach(button => {
                button.addEventListener('click', () => {
                    if (currentStep > 0) {
                        currentStep--;
                        showStep(currentStep);
                    }
                });
            });

            // Initialize the first step
            showStep(currentStep);
        });
    </script>
</section>
{{-- @endif --}}
