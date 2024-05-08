<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DRpsPengembang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('d_rps_pengembang', function (Blueprint $table) {
            $table->id('rps_pengembang_id');
            $table->unsignedBigInteger('rps_id')->index();
            $table->unsignedBigInteger('dosen_id')->index();
            $table->dateTime('created_at')->nullable()->useCurrent();
            $table->integer('created_by')->nullable()->index();
            $table->dateTime('updated_at')->nullable();
            $table->integer('updated_by')->nullable()->index();
            $table->dateTime('deleted_at')->nullable()->index();
            $table->integer('deleted_by')->nullable()->index();

            $table->foreign('rps_id')->references('rps_id')->on('m_rps');
            $table->foreign('dosen_id')->references('dosen_id')->on('d_dosen');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('d_rps_pengembang');
    }


//     public function up()
//     {
//         DB::unprepared('
//             CREATE TRIGGER triger_dosen AFTER UPDATE ON d_dosen
//             FOR EACH ROW
//             BEGIN
//                 UPDATE s_user
//                 SET group_id = NEW.group_id
//                 WHERE user_id = NEW.user_id;
//             END
//         ');
//     }

//     /**
//      * Reverse the migrations.
//      *
//      * @return void
//      */
//     public function down()
//     {
//         DB::unprepared('DROP TRIGGER IF EXISTS triger_dosen');
//     }
// }

}
