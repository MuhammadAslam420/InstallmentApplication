<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('batch_no')->after('id')->nullable();
            $table->unsignedBigInteger('stock_detail_id')->after('batch_no')->nullable();
            $table->unsignedBigInteger('package_id')->after('stock_detail_id')->nullable();
            $table->string('material_engine_no')->after('package_id')->nullable();
            $table->string('registration_no')->after('material_engine_no')->nullable();
            $table->double('payment_paid')->default(0);
            $table->double('remaining_payment')->default(0);
            $table->foreign('stock_detail_id')->references('id')->on('stock_details');
            $table->foreign('package_id')->references('id')->on('packages');
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
            $table->string('batch_no')->after('id')->nullable();
            $table->unsignedBigInteger('stock_detail_id')->after('batch_no')->nullable();
            $table->unsignedBigInteger('package_id')->after('stock_detail_id')->nullable();
            $table->string('material_engine_no')->after('package_id')->nullable();
            $table->string('registration_no')->after('material_engine_no')->nullable();
            $table->double('payment_paid')->default(0);
            $table->double('remaining_payment')->default(0);
            $table->foreign('stock_detail_id')->references('id')->on('stock_details');
            $table->foreign('package_id')->references('id')->on('packages');
        });
    }
};
