<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OvertimeRecord;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OvertimeRecordController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $overtimeRecords = OvertimeRecord::with('employee')->get();
            return response()->json($overtimeRecords);
        }

        $overtimeRecords = OvertimeRecord::with('employee')->get();
        return view('overtime_records.index', compact('overtimeRecords'));
    }


    public function create()
    {
        $employees = Employee::all();
        return view('overtime_records.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'tanggal' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        // Cek tumpang tindih
        $overlap = OvertimeRecord::where('employee_id', $request->employee_id)
            ->where('tanggal', $request->tanggal)
            ->where(function ($query) use ($request) {
                $query->whereBetween('start_time', [$request->start_time, $request->end_time])
                    ->orWhereBetween('end_time', [$request->start_time, $request->end_time]);
            })
            ->exists();

        if ($overlap) {
            return back()->withErrors(['error' => 'Data lembur pada karyawan tersebut dengan tanggal yang sama sudah ada!']);
        }

        $data = $request->all();
        $start_time = strtotime($data['start_time']);
        $end_time = strtotime($data['end_time']);
        $data['amount'] = ($end_time - $start_time) / 60 * 1000;

        OvertimeRecord::create($data);

        return redirect()->route('overtime-records.index')->with('success', 'Data lembur berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $record = OvertimeRecord::findOrFail($id);
        $employees = Employee::all();
        return view('overtime_records.edit', compact('record', 'employees'));
    }

    public function update(Request $request, $id)
    {
        Log::info('Update method called');

        try {
            $request->validate([
                'employee_id' => 'required|exists:employees,id',
                'tanggal' => 'required|date',
                'start_time' => 'required|date_format:H:i',
                'end_time' => 'required|date_format:H:i|after:start_time',
                'amount' => 'required|numeric',
            ]);
            Log::info('Validation passed');
        } catch (\Exception $e) {
            Log::error('Validation error: ' . $e->getMessage());
        }

        // Cek tumpang tindih
        $overlap = OvertimeRecord::where('employee_id', $request->employee_id)
            ->where('tanggal', $request->tanggal)
            ->where(function ($query) use ($request, $id) {
                $query->whereBetween('start_time', [$request->start_time, $request->end_time])
                    ->orWhereBetween('end_time', [$request->start_time, $request->end_time]);
            })
            ->where('id', '!=', $id)
            ->exists();

        if ($overlap) {
            return back()->withErrors(['error' => 'Data lembur tumpang tindih dengan data sebelumnya.']);
        }

        try {
            $record = OvertimeRecord::findOrFail($id);
            $data = $request->all();
            Log::info('Data received: ', $data);
            $record->update($data);
            Log::info('Record updated');
        } catch (\Exception $e) {
            Log::error('Error updating record: ' . $e->getMessage());
        }

        return redirect()->route('overtime-records.index')->with('success', 'Data lembur berhasil diperbarui.');
    }


    public function destroy($id)
    {
        OvertimeRecord::destroy($id);
        return redirect()->route('overtime-records.index')->with('success', 'Data lembur berhasil dihapus.');
    }
}