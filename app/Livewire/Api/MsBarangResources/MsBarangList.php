<?php

namespace App\Livewire\Api\MsBarangResources;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class MsBarangList extends Component
{

    public function mount()
    {
        dd('stop');
        $data = $this->fetchByHttp();
        dd($data);
    }

    public function fetchByHttp()
    {
        $response = Http::get('https://fakestoreapi.com/products');
        return $response;
    }


    public function render()
    {
        return view('livewire.api.ms-barang-resources.ms-barang-list');
    }
}
