<?php

namespace App\Helpers\FormHook\Traits;


use Illuminate\Support\Collection;

use App\Livewire\Pages\Admin\Sales\SalesOrderResources\Forms\SalesOrderForm;
use App\Livewire\Pages\Admin\Sales\SalesOrderResources\Forms\SalesOrderDetailForm;

trait WithTandaTerimaService
{

    public int $detailIndex;

    #[\Livewire\Attributes\Locked]
    public string $readonly = '';

    #[\Livewire\Attributes\Locked]
    public bool $isReadonly = false;

    #[\Livewire\Attributes\Locked]
    public bool $isDisabled = false;

    #[\Livewire\Attributes\Locked]
    public array $options = [];

    #[\Livewire\Attributes\Locked]
    protected $headerModel = \App\Models\TrTandaTerimaServiceHeader::class;
    protected $detailModel = \App\Models\TrTandaTerimaServiceDetail::class;

    public array $validatedForm = [];
    public array $validatedFormDetail = [];
    public bool $modalDetail = false;
    // public array $details = [];
    public  $detailId = null;
    public array $headers = [];


    public Collection $customersSearchable;
    public Collection $employeesSearchable;
    public Collection $productsSearchable;

    public function bukaModal()
    {
        $this->detailForm->reset();
        return $this->modalDetail = true;
    }

    public function tutupModal()
    {
        return $this->modalDetail = false;
        $this->detailForm->reset();
    }
}
