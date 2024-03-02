<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create( 'candidate_details', function ( Blueprint $table ) {
            $table->id();
            $table->foreignId( 'user_id' )->constrained( 'users' )->onUpdate( 'cascade' )->onDelete( 'cascade' );
            $table->string( 'img_url' )->nullable();
            $table->string( 'name' )->nullable();
            $table->string( 'email' )->unique();
            $table->string( 'phone' )->nullable();
            $table->string( 'address' )->nullable();
            $table->json( 'skills' )->nullable();
            $table->integer( 'current_salary' )->nullable();
            $table->integer( 'expected_salary' )->nullable();
            $table->timestamp( 'created_at' )->useCurrent();
            $table->timestamp( 'updated_at' )->useCurrent()->useCurrentOnUpdate();
        } );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists( 'candidate_details' );
    }
};