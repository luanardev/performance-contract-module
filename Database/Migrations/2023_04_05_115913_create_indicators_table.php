<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_performance_contract_indicators', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('deliverable_id');
            $table->string('name')->nullable();
            $table->float('weight')->nullable();
            $table->foreign('deliverable_id')->references('id')->on('app_performance_contract_deliverables')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_performance_contract_indicators');
    }
};
