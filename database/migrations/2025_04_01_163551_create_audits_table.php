<?php

use App\Models\Audit;
use App\Models\Item;
use App\Models\Tracking;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('audits', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Tracking::class);
            $table->foreignIdFor(Item::class);
            $table->string('title');
            $table->string('product_control_no');
            $table->string('basket_no');
            $table->string('serial_no');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audits');
    }
};
