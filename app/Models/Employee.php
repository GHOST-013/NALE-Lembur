<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'nik',
        'name',
        'position',
    ];

    public function overtimeRecords()
    {
        return $this->hasMany(OvertimeRecord::class);
    }
}