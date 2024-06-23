@extends('layouts.app')

@section('content')
    <div class="wrapper">
        <div class="main">
            <main class="content">
                <style>
                    .container-fluid {
                        color: black !important
                    }
                </style>
                <div class="container-fluid">
                    <h1 class="text-center">Data Karyawan</h1>
                    <a href="{{ route('employees.create') }}" class="btn btn-primary mb-3">Tambah Karyawan</a>
                    <table class="table table-bordered" id="tableData" style="color: black !important">
                        <thead>
                            <tr>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employees as $employee)
                                <tr>
                                    <td>{{ $employee->nik }}</td>
                                    <td>{{ $employee->name }}</td>
                                    <td>{{ $employee->position }}</td>
                                    <td>
                                        <a href="{{ route('employees.edit', $employee->id) }}"
                                            class="btn btn-warning">Edit</a>
                                        <form action="{{ route('employees.destroy', $employee->id) }}" method="POST"
                                            style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $("#tableData").DataTable({});
        });
    </script>
@endsection
