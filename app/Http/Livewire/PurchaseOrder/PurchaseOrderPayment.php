<?php

namespace App\Http\Livewire\PurchaseOrder;

use Livewire\Component;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderPayment as PurchaseOrderPayments;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class PurchaseOrderPayment extends Component
{
    use WithPagination;

    public $ids;
    public $searchTerm;
    public $poWithBalances;
    public $remainingBalance = [];

    #FORM
    public $purchase_order_id;
    public $date_of_payment;
    public $payment;

    public function resetFields()
    {
        $this->purchase_order_id = "";
        $this->date_of_payment = "";
        $this->payment = "";
        $this->remainingBalance = "";
        $this->searchTerm = "";
        $this->poWithBalances = [];
    }

    public function render()
    {
        $searchTerm = '%'.$this->searchTerm.'%';
        return view('livewire.purchase-order.purchase-order-payment', [
            'purchaseOrderPayments' => PurchaseOrderPayments::paginate(10)
        ]);
    }

    public function addPoPaymentModal()
    {
        $this->resetFields();
        $this->poWithBalances = PurchaseOrder::where('remaining_balance', '>', 0)->get();
    }

    public function updatedPurchaseOrderId($value)
    {
        $this->remainingBalance = [];
        $this->remainingBalance = PurchaseOrder::findOrFail($value);
        $this->remainingBalance = $this->remainingBalance->remaining_balance;
    }

    public function store()
    {
        $validate = $this->validate([
            'purchase_order_id' => 'required',
            'date_of_payment' => 'required',
            'payment' => 'required|lte:'.$this->remainingBalance,
        ]);

        DB::transaction(function () use ($validate) {
            PurchaseOrderPayments::create($validate);
            $purchaseOrder = PurchaseOrder::find($this->purchase_order_id);
            $purchaseOrder->remaining_balance = $purchaseOrder->remaining_balance - $this->payment;
            $purchaseOrder->save();
        });
        
        session()->flash('message', 'Successfully Create Purchase Order Payment.');
        $this->resetFields();
        $this->emit('addedPurchaseOrderPayment');
    }

    public function edit($id)
    {
        $this->resetFields();
        $this->addPoPaymentModal();
        $purchaseOrderPayments = PurchaseOrderPayments::where('id', $id)->first();
        $this->ids = $purchaseOrderPayments->id;
        $this->purchase_order_id = $purchaseOrderPayments->purchase_order_id;
        $this->date_of_payment = $purchaseOrderPayments->date_of_payment;
        $this->payment = $purchaseOrderPayments->payment;

        $this->remainingBalance = PurchaseOrder::findOrFail($purchaseOrderPayments->purchase_order_id);
        $this->remainingBalance = $this->remainingBalance->remaining_balance;
    }

    public function update()
    {
        $validate = $this->validate([
            'purchase_order_id' => 'required',
            'date_of_payment' => 'required',
            'payment' => 'required|lte:'.$this->remainingBalance,
        ]);

        DB::transaction(function () use ($validate) {
            $purchaseOrderPayment = PurchaseOrderPayments::find($this->ids);
            $purchaseOrderPayment->purchase_order_id = $this->purchase_order_id;
            $purchaseOrderPayment->date_of_payment = $this->date_of_payment;
            $purchaseOrderPayment->payment = $this->payment;
            $purchaseOrderPayment->save();

            #find all purchase order number
            $purchaseOrderPayments = PurchaseOrderPayments::where('purchase_order_id', $purchaseOrderPayment->purchase_order_id)->get();

            $payment = 0;
            foreach($purchaseOrderPayments as $purchaseOrderPayment){
                $payment = $payment + $purchaseOrderPayment->payment;
            }

            $purchaseOrder = PurchaseOrder::find($purchaseOrderPayment->purchase_order_id);
            $purchaseOrder->remaining_balance = $purchaseOrder->total_cost - $payment;
            $purchaseOrder->save();
        });

        session()->flash('message', 'Successfully Update Purchase Order Payment.');
        $this->resetFields();
        $this->emit('updatedPurchaseOrderPayment');
    }

    public function modalDelete($id)
    {
        $purchaseOrder = PurchaseOrderPayments::where('id', $id)->first();
        $this->ids = $purchaseOrder->id;
    }

    public function delete()
    {
        if($this->ids){
            DB::transaction(function (){
                $poPayment = PurchaseOrderPayments::find($this->ids);
                $poPaymentPoId = $poPayment->purchase_order_id;
                $poPayment->delete();

                #find all purchase order number
                $purchaseOrderPayments = PurchaseOrderPayments::where('purchase_order_id', $poPaymentPoId)->get();

                $payment = 0;
                foreach($purchaseOrderPayments as $purchaseOrderPayment){
                    $payment = $payment + $purchaseOrderPayment->payment;
                }

                $purchaseOrder = PurchaseOrder::find($poPaymentPoId);
                $purchaseOrder->remaining_balance = $purchaseOrder->total_cost - $payment;
                $purchaseOrder->save();
                
            });
            
            session()->flash('message', 'Purchase Order Payment Successfully Deleted');
            $this->resetFields();
            $this->emit('deletedPurchaseOrderPayment');
        }
    }
}
