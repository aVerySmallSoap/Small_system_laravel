<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
            $table->unsignedBigInteger('user_id');
            $table->string('title')->index('idx_header_title');
            $table->timestamp('created_At');
            $table->foreign('user_id', 'fk_headers_user_id')
                ->references('id')->on('users');
        });
        Schema::create('notes', function (Blueprint $table) {
            $table->integer('header_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('note_sequence');
            $table->longText('message');
            $table->boolean('note_isFinished');
            $table->foreign('header_id', 'fk_notes_header_id')
                ->references('header_id')
                ->on('headers');
            $table->foreign('user_id', 'fk_notes_user_id')
                ->references('id')
                ->on('users');
        });
        Schema::create('archived_notes', function (Blueprint $table){
            $table->integer('header_id');
            $table->longText('message');
            $table->boolean('note_isFinished');
            $table->timestamp('archived_At');
        });
        DB::statement("
            CREATE TRIGGER `notes_BEFORE_DELETE` BEFORE DELETE ON `notes`
            FOR EACH ROW
            BEGIN
	            insert into archived_notes (`header_id`,`message`, `note_isFinished`, `archived_At`) values (
		        old.header_id, old.message, old.note_isFinished, current_timestamp()
                );
            END"
        );
        DB::statement("
            CREATE TRIGGER `notes_BEFORE_UPDATE` BEFORE UPDATE ON `notes`
            FOR EACH ROW
            BEGIN
	            insert into archived_notes (`header_id`,`message`, `note_isFinished`,`archived_At`) values (
		        old.header_id, old.message, old.note_isFinished, current_timestamp()
                );
            END"
        );
        DB::statement(
            'CREATE PROCEDURE `getAttachedNotes`(IN header_id int)
            begin
	        select * from notes where notes.header_id = header_id;
            end'
        );
        DB::statement('
            CREATE PROCEDURE `paginate_archive`(IN v_limit int, IN v_offset int)
            BEGIN
                select * from archived_notes limit v_limit offset v_offset;
            END
        ');
        DB::statement('
            CREATE VIEW `number_of_archived` AS
            select count(*) from archived_notes as notes;
        ');
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
