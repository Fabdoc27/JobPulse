<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create( 'education_histories', function ( Blueprint $table ) {
            $table->id();
            $table->foreignId( 'candidate_id' )->constrained( 'candidate_details' )->onUpdate( 'cascade' )->onDelete( 'cascade' );
            $table->string( 'degree' )->nullable();
            $table->string( 'institution' )->nullable();
            $table->decimal( 'score', 3, 2 )->nullable();
            $table->date( 'start_date' )->nullable();
            $table->date( 'end_date' )->nullable();
            $table->timestamp( 'created_at' )->useCurrent();
            $table->timestamp( 'updated_at' )->useCurrent()->useCurrentOnUpdate();
        } );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists( 'education_histories' );
    }
};