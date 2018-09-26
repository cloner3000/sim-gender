<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTenagakerjaPengangguranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenagakerja_pengangguran', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_kecamatan');
            $table->integer('jumlah')->default(0);
            $table->integer('persentase')->default(0);
            $table->integer('tpt_persentase')->default(0);
            $table->timestamps();
            $table->softdeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tenagakerja_pengangguran');
    }
}
