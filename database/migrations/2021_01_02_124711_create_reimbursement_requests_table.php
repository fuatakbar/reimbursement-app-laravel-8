<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReimbursementRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reimbursement_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('expense_proof');
            $table->text('description');
            $table->integer('amount_spent');
            $table->string('filed_date', 20);
            $table->string('filed_time', 20);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reimbursement_requests');
    }
}
