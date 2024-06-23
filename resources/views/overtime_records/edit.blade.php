@extends('layouts.app')

@section('content')
    <div class="wrapper">
        <div class="main">
            <main class="content">
                <div class="container-fluid text-dark">
                    <h1 class="text-center">Edit Data Lembur</h1>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('overtime-records.update', $record->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label for="employee_id">Employee</label>
                            <select class="form-control" id="employee_id" name="employee_id" required>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}"
                                        {{ $employee->id == $record->employee_id ? 'selected' : '' }}>{{ $employee->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal"
                                value="{{ $record->tanggal }}" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="start_time">Start Time</label>
                            <input type="time" class="form-control" id="start_time" name="start_time"
                                value="{{ \Carbon\Carbon::parse($record->start_time)->format('H:i') }}" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="end_time">End Time</label>
                            <input type="time" class="form-control" id="end_time" name="end_time"
                                value="{{ \Carbon\Carbon::parse($record->end_time)->format('H:i') }}" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="amount">Amount</label>
                            <input type="number" class="form-control" id="amount" name="amount"
                                value="{{ $record->amount }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </main>
        </div>
    </div>
@endsection
