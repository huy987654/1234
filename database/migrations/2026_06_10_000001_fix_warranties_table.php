<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {


        Schema::create('warranties', function (Blueprint $table) {
            $table->string('warranty_no');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->string('warranty_status'); // 'Còn bảo hành' | 'Hết bảo hành' | 'Đang xử lý'
            $table->string('description')->nullable();
            $table->foreignId('order_detail_id')->constrained('order_details');

            // Composite primary key — Warranty là weak entity
            $table->primary(['warranty_no', 'order_detail_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('warranties');
    }
};
