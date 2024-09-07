<?php

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
        Schema::create('company_plugins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('company_details')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('plugin_id')->constrained('plugins')->onUpdate('cascade')->onDelete('cascade');
            $table->enum('status', ['active', 'inactive'])->default('inactive');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_plugins');
    }
};
