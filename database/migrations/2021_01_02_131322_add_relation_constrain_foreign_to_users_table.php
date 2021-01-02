<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationConstrainForeignToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('role')->constrained('roles')->onDelete('cascade');
            $table->foreignId('division')->constrained('divisions')->onDelete('cascade');
            $table->foreignId('bank_account')->constrained('bank_accounts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role']);
            $table->dropForeign(['division']);
            $table->dropForeign(['bank_account']);
        });
    }
}
