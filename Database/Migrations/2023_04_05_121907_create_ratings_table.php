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
        Schema::create('app_performance_contract_ratings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('indicator_id');
            $table->enum('rating_type', ['MidYear', 'EndYear']);
            $table->float('self_rate')->nullable();
            $table->string('outcome')->nullable();
            $table->float('appraiser_rate')->nullable();
            $table->string('appraiser_comment')->nullable();
            $table->float('agreed_rate')->nullable();
            $table->foreign('indicator_id')->references('id')->on('app_performance_contract_indicators')->cascadeOnDelete();
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
        Schema::dropIfExists('app_performance_contract_ratings');
    }
};
