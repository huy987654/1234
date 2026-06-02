<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement('ALTER TABLE orders MODIFY total_amount DECIMAL(12, 2) NOT NULL');
        DB::statement('ALTER TABLE order_details MODIFY unit_price DECIMAL(12, 2) NOT NULL');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE order_details MODIFY unit_price DECIMAL(8, 2) NOT NULL');
        DB::statement('ALTER TABLE orders MODIFY total_amount DECIMAL(10, 2) NOT NULL');
    }
};
