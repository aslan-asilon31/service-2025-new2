<?php



namespace App\Helpers\FormHook\Traits;

use App\Models\MsStatus;
use App\Models\MsPegawai;
use App\Models\MsPelanggan;
use App\Models\MsCabang;
use App\Models\PegawaiAksesCabang;

trait aksesOpsi
{
    public function aksesStatusOption()
    {
        $statusList = MsStatus::orderBy('nomor', 'asc')->get();
        return collect($statusList)->map(function ($status) {
            return [
                'id' => $status->id,
                'name' => $status->nama,
            ];
        })->values()->toArray();
    }

    public function aksesPegawaiOption()
    {
        $pegawaiList = MsPegawai::orderBy('nomor', 'asc')->get();
        return collect($pegawaiList)
            ->map(function ($pegawai) {
                return [
                    'id' => $pegawai->id,
                    'name' => $pegawai->nama,
                ];
            })
            ->unique(function ($item) {
                return $item['id'];
            })
            ->values()
            ->toArray();
    }

    public function aksesPelangganOption()
    {
        $pelangganList = MsPelanggan::orderBy('nomor', 'asc')->get();
        return collect($pelangganList)
            ->map(function ($pelanggan) {
                return [
                    'id' => $pelanggan->id,
                    'name' => $pelanggan->nama,
                ];
            })
            ->unique(function ($item) {
                return $item['id'];
            })
            ->values()
            ->toArray();
    }

    public function aksesCabangOption()
    {
        $cabangList = MsCabang::orderBy('nomor', 'asc')->get();
        return collect($cabangList)->map(function ($cabang) {
            return [
                'id' => $cabang->id,
                'name' => $cabang->nama,
            ];
        })->values()->toArray();
    }

    public function aksesPegawaiLoginPunyaCabangId()
    {
        return PegawaiAksesCabang::with(['msPegawai', 'msCabang'])
            ->where('ms_pegawai_id', $this->pegawai->id)
            ->first();
    }
}
