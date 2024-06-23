@extends('layouts.app')

@section('content')
    <div class="wrapper">
        <div class="main">
            <main class="content">
                <div class="container-fluid text-dark">
                    <h1 class="text-center">Edit Karyawan</h1>
                    <form action="{{ route('employees.update', $employee->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label for="nik">NIK*</label>
                            <input type="text" class="form-control" id="nik" name="nik"
                                value="{{ $employee->nik }}" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="name">Nama*</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ $employee->name }}" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="position">Jabatan*</label>
                            <input type="text" class="form-control" id="position" name="position"
                                value="{{ $employee->position }}" required>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </main>
        </div>
    </div>
@endsection
