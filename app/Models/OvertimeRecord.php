<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OvertimeRecord extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'employee_id',
        'tanggal',
        'start_time',
        'end_time',
        'amount',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}