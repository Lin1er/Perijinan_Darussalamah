<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('ijins', function (Blueprint $table) {
            $table->softDeletes(); // menambahkan kolom deleted_at
        });
    }

    public function down()
    {
        Schema::table('ijins', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
