<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('overtime_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->onDelete('cascade');
            $table->date('tanggal');
            $table->time('start_time');
            $table->time('end_time');
            $table->decimal('amount', 10, 2);
        });
    }

    public function down()
    {
        Schema::dropIfExists('overtime_records');
    }
};