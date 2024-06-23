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
                    <h1 class="text-center">Data Lembur</h1>
                    <a href="{{ route('overtime-records.create') }}" class="btn btn-primary mb-3">Tambah Data Lembur</a>
                    <table class="table table-bordered" id="tableData">
                        <thead>
                            <tr>
                                <th>Employee</th>
                                <th>Tanggal</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Amount</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="overtime-table-body">
                            <!-- Data will be inserted here by AJAX -->
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function fetchOvertimeRecords() {
                fetch('{{ route('overtime-records.index') }}', {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        let tableBody = document.querySelector('#overtime-table-body');
                        tableBody.innerHTML = ''; // Clear existing data
                        data.forEach(record => {
                            let row = document.createElement('tr');
                            row.innerHTML = `
                            <td>${record.employee.name}</td>
                            <td>${record.tanggal}</td>
                            <td>${record.start_time}</td>
                            <td>${record.end_time}</td>
                            <td>${record.amount}</td>
                            <td style='display:flex'>
                                <a href="{{ url('overtime-records') }}/${record.id}/edit" class="btn btn-warning">Edit</a>
                                <form action="{{ url('overtime-records') }}/${record.id}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Konfirmasi Batal Lembur?')">Batalkan</button>
                                </form>
                            </td>
                        `;
                            tableBody.appendChild(row);
                        });
                    })
                    .catch(error => console.error('Error fetching overtime records:', error));
            }
            setInterval(fetchOvertimeRecords, 7000);
            fetchOvertimeRecords(); // data di refresh setiap 7 detik
        });
        $(document).ready(function() {
            $("#tableData").DataTable({});
        });
    </script>
@endsection
