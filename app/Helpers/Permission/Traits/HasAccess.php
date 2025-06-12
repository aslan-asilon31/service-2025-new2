<?php



namespace App\Helpers\Permission\Traits;

use Illuminate\Support\Facades\DB;

trait HasAccess
{
    public function aksesCabang()
    {
        return DB::table('pegawai_akses_cabang as pac')
            ->join('ms_cabang as mc', 'pac.ms_cabang_id', '=', 'mc.id')
            ->where('pac.ms_pegawai_id', auth('pegawai')->user()->id)
            ->select('mc.*')
            ->get();
    }

    public function aksesGudang()
    {
        return DB::table('ms_gudang')
            ->whereIn('ms_cabang_id', $this->aksesCabang()->pluck('id')->toArray())
            ->get();
    }

    public function aksesRak()
    {
        return DB::table('ms_rak')
            ->whereIn('ms_gudang_id', $this->aksesGudang()->pluck('id')->toArray())
            ->get();
    }

    public function aksesPermissionPolicy($halaman, $msCabangId, $status, $method)
    {
        if ($method == 'simpan') {
            $result = \Illuminate\Support\Facades\Gate::authorize('simpan', [
                \App\Models\Permission::class,
                $halaman,
                $msCabangId,
                $status,
            ]);
        } elseif ($method == 'update') {
            $result = \Illuminate\Support\Facades\Gate::authorize('update', [
                \App\Models\Permission::class,
                $halaman,
                $msCabangId,
                $status,
            ]);
        } else {
            $result = [];
        }
        return $result;
    }
}
