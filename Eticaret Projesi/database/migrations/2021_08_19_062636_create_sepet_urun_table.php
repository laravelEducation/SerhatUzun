<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSepetUrunTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sepet_urun', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('sepet_id')->unsigned();
            $table->bigInteger('urun_id')->unsigned();
            $table->bigInteger('adet');
            $table->decimal('fiyat',5,2);
            $table->string('durum');
            $table->softDeletes($column = 'deleted_at', $precision = 0)->nullable();
            $table->timestamps();

            $table->foreign('sepet_id')->references('id')->on('sepet');
            $table->foreign('urun_id')->references('id')->on('urun');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sepet_urun');
    }
}
