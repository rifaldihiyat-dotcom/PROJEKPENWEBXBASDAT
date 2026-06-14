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
        Schema::create('buah_supplier', function (Blueprint $table) {
            $table->integer('id_buah');
            $table->integer('id_supplier');
            $table->foreign('id_buah')->references('id_buah')->on('buah')->onDelete('cascade');
            $table->foreign('id_supplier')->references('id_supplier')->on('supplier')->onDelete('cascade');
            $table->primary(['id_buah', 'id_supplier']);
        });

        Schema::table('buah', function (Blueprint $table) {
            $table->dropForeign('buah_ibfk_2');
            $table->dropColumn('id_supplier');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('buah', function (Blueprint $table) {
            $table->unsignedBigInteger('id_supplier')->nullable();
        });

        Schema::dropIfExists('buah_supplier');
    }
};
