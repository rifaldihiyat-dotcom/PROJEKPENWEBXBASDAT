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
        if (! Schema::hasTable('buah')) {
            return;
        }

        Schema::table('buah', function (Blueprint $table) {
            if (! Schema::hasColumn('buah', 'stok')) {
                $table->integer('stok')->default(0)->after('id_supplier');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (! Schema::hasTable('buah')) {
            return;
        }

        Schema::table('buah', function (Blueprint $table) {
            if (Schema::hasColumn('buah', 'stok')) {
                $table->dropColumn('stok');
            }
        });
    }
};
