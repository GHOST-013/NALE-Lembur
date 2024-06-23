@extends('layouts.app')

@section('content')
    <div class="wrapper">
        <div class="main">
            <main class="content">
                <div class="container-fluid text-dark">
                    <h1 class="text-center">Tambah Karyawan</h1>
                    <form action="{{ route('employees.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="nik">NIK*</label>
                            <input type="text" class="form-control" id="nik" name="nik" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="name">Nama*</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="position">Jabatan*</label>
                            <input type="text" class="form-control" id="position" name="position" required>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </main>
        </div>
    </div>
@endsection
