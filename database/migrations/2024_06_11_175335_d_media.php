<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DMedia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    Schema::create('d_media', function (Blueprint $table) {
        $table->id('media_id');
        $table->tinyInteger('jenis_media')->default(0);
        $table->string('nama_media', 100)->nullable();
        $table->dateTime('created_at')->nullable()->useCurrent();
        $table->integer('created_by')->nullable()->index();
        $table->dateTime('updated_at')->nullable();
        $table->integer('updated_by')->nullable()->index();
        $table->dateTime('deleted_at')->nullable()->index();
        $table->integer('deleted_by')->nullable()->index();
    });
}

/**
 * Reverse the migrations.
 *
 * @return void
 */
public function down()
{
    Schema::dropIfExists('d_media');
}

}
