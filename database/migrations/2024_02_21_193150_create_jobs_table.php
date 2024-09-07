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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('company_details')->onUpdate('cascade')->onDelete('cascade');
            $table->string('title');
            $table->string('category');
            $table->text('description');
            $table->enum('location', ['on-site', 'remote'])->default('on-site');
            $table->json('skills');
            $table->integer('salary');
            $table->enum('status', ['active', 'inactive'])->default('inactive');
            $table->integer('applied')->default('0');
            $table->date('deadline');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
