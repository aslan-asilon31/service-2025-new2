<?php

namespace App\Livewire\Partials;

use Livewire\Component;
use App\Models\SalesOrder;

class Sidebar extends Component
{

    public $salesOrderStatusPending;
    public $salesOrderStatusSettlement;
    public $salesOrderStatusExpired;
    public $salesOrderFraudStatusIdentify;
    public $salesOrderFraudStatusAccept;
    public $salesOrderIsActivateYes;
    public $salesOrderIsActivateNo;

    public function render()
    {
        return view('livewire.partials.sidebar');
    }

    public function mount()
    {
        // $this->salesOrderStatusPending = SalesOrder::where('status','pending')->get();

        // $this->salesOrderStatusSettlement = SalesOrder::where('status','settlement')->get();
        // $this->salesOrderStatusExpired = SalesOrder::where('status','expired')->get();

        // $this->salesOrderFraudStatusIdentify = SalesOrder::where('fraud_status','identifying')->get();
        // $this->salesOrderFraudStatusAccept = SalesOrder::where('fraud_status','accept')->get();

        // $this->salesOrderIsActivateYes = SalesOrder::where('is_activated',1)->get();
        // $this->salesOrderIsActivateNo = SalesOrder::where('is_activated',0)->get();
    }
}
