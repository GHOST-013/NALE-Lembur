@extends('layouts.app')

@section('content')
    <div class="wrapper">
        <div class="main">
            <main class="content">
                <div class="container-fluid text-dark">
                    <h1 class="text-center">Tambah Data Lembur</h1>
                    <form action="{{ route('overtime-records.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="employee_id">Employee</label>
                            <select class="form-control" id="employee_id" name="employee_id" required>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="start_time">Start Time</label>
                            <input type="time" class="form-control" id="start_time" name="start_time" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="end_time">End Time</label>
                            <input type="time" class="form-control" id="end_time" name="end_time" required>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </main>
        </div>
    </div>
@endsection
