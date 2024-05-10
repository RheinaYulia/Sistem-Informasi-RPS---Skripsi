<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class VwRpsMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $view = "create or replace view vw_rps as
select 	m.rps_id, m.kurikulum_mk_id,m.kaprodi_id, d.mk_nama, k.prodi_id, k.tahun
from 	m_rps m
join d_kaprodi k on k.kaprodi_id = m.kaprodi_id
join d_kurikulum_mk p on p.kurikulum_mk_id = m.kurikulum_mk_id 
join m_mk d on d.mk_id = p.mk_id"
;

        DB::statement($view);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
