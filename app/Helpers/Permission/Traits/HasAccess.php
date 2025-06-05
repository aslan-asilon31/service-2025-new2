<?php



namespace App\Helpers\Permission\Traits;

use Illuminate\Support\Facades\DB;

trait HasAccess
{
    public function aksesCabang()
    {

        $user = auth('pegawai')->user();
        $this->id = $user->id;
        return DB::table('pegawai_akses_cabang as pac')
            ->join('ms_cabang as mc', 'pac.ms_cabang_id', '=', 'mc.id')
            ->where('pac.ms_pegawai_id', $this->id)
            ->select('mc.*')
            ->get();
    }

    public function aksesGudang()
    {
        $cabangIds = $this->aksesCabang()->pluck('id')->toArray();

        return DB::table('ms_gudang')
            ->whereIn('ms_cabang_id', $cabangIds)
            ->get();
    }

    public function aksesRak()
    {
        $gudangIds = $this->aksesGudang()->pluck('id')->toArray();

        return DB::table('ms_rak')
            ->whereIn('ms_gudang_id', $gudangIds)
            ->get();
    }
}
