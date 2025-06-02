<?php

namespace App\Livewire\SpTandaTerimaServiceResources;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class SpTandaTerimaServiceList extends Component
{

    use \App\Helpers\Permission\Traits\WithPermission;

    public function mount()
    {

        dd([
            'auth_user' => Auth::user(),
            'auth_guard_web' => Auth::guard('web')->user(),
            'session_id' => session()->getId(),
            'all_session' => session()->all(),
        ]);

        $this->permission('tanda_terima_service-lihat');
    }

    public function render()
    {
        return view('livewire.sp-tanda-terima-service-resources.sp-tanda-terima-service-list');
    }
}
