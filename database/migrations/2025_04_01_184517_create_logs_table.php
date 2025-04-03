<?php

use App\Models\Audit;
use App\Models\Log;
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
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('audit_log', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Audit::class, 'audit_id')->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Log::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
        Schema::dropIfExists('audit_log');
    }
};
