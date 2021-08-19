<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

class CreateSiparisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siparis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('sepet_id')->unsigned();
            $table->decimal('siparis_tutari');
            $table->string('durum')->nullable();
            $table->string('banka')->nullable();
            $table->bigInteger('taksit_sayisi')->nullable();
            $table->unique('sepet_id');
            
            $table->foreign('sepet_id')->references('id')->on('sepet');

            $table->softDeletes($column = 'deleted_at', $precision = 0)->nullable();
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
        Schema::dropIfExists('siparis');
    }
}
