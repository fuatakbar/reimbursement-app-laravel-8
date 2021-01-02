<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationForeignConstraintToReimbursementRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reimbursement_requests', function (Blueprint $table) {
            $table->foreignId('reimbursement_id')->constrained('reimbursements')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reimbursement_requests', function (Blueprint $table) {
            $table->dropForeign(['reimbursement_id']);
        });
    }
}
