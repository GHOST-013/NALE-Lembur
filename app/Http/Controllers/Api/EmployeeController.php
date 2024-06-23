<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|unique:employees',
            'name' => 'required',
            'position' => 'required',
        ]);

        Employee::create($request->all());
        return redirect()->route('employees.index')->with('success', 'Karyawan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nik' => 'required|unique:employees,nik,' . $id,
            'name' => 'required',
            'position' => 'required',
        ]);

        $employee = Employee::findOrFail($id);
        $employee->update($request->all());
        return redirect()->route('employees.index')->with('success', 'Karyawan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Employee::destroy($id);
        return redirect()->route('employees.index')->with('success', 'Karyawan berhasil dihapus.');
    }
}