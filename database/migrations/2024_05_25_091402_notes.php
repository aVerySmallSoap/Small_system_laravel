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
        Schema::create('headers', function (Blueprint $table) {
            $table->integer('header_id')->primary()->autoIncrement();
            $table->string('title')->index('idx_header_title');
            $table->timestamp('created_At');
        });

        Schema::create('notes', function (Blueprint $table) {
            $table->integer('header_id');
            $table->integer('note_sequence');
            $table->longText('message');
            $table->boolean('note_isFinished');
            $table->foreign('header_id', 'fk_notes_header_id')
                ->references('header_id')
                ->on('headers');
        });

        Schema::create('update_history', function (Blueprint $table){
            $table->integer('header_id');
            $table->longText('message');
            $table->boolean('note_isFinished');
            $table->timestamp('updated_At');
        });
        Schema::create('archived_notes', function (Blueprint $table){
            $table->integer('header_id');
            $table->longText('message');
            $table->boolean('note_isFinished');
            $table->timestamp('archived_At');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('archived_notes');
        Schema::dropIfExists('update_history');
        Schema::dropIfExists('notes');
        Schema::dropIfExists('header');
    }
};
