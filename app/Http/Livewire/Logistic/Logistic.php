<?php

namespace App\Http\Livewire\Logistic;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Logistic as Logistics;
use App\Models\Product;
use App\Models\PurchaseOrderProduct;
use App\Models\PurchaseOrder;
use App\Models\ManufacturerAccount;
use Illuminate\Support\Facades\DB;
use Auth;

class Logistic extends Component
{
    use WithPagination;

    public $searchTerm;
    public $purchaseOrderProducts;
    public $purchaseOrdersModal;
    public $purchaseOrderProductRemaining = 0;
    
    #FORM
    public $ids;
    public $purchase_order_id;
    public $product_id;
    public $quantity;

    public function resetFields()
    {
        $this->purchase_order_id = "";
        $this->product_id = "";
        $this->quantity = "";
        $this->purchaseOrderProducts = "";
        $this->purchaseOrdersModal = "";
        $this->searchTerm = "";
        $this->purchaseOrderProductRemaining = 0;
    }

    public function purchaseOrderModal()
    {
        $poProducts = PurchaseOrderProduct::where('remaining', '>=', 0)->get();
        foreach($poProducts as $product){
            $products[] = $product->purchase_order_id;
        }
        $this->purchaseOrdersModal = PurchaseOrder::whereIn('id', array_unique($products))->get();
    }

    public function purchaseOrderEditModal()
    {
        $poProducts = PurchaseOrderProduct::where('remaining', '>=', 0)->get();
        foreach($poProducts as $product){
            $products[] = $product->purchase_order_id;
        }
        $this->purchaseOrdersModal = PurchaseOrder::whereIn('id', array_unique($products))->get();
    }

    public function updatedPurchaseOrderId($value)
    {
        $this->purchaseOrderProducts = PurchaseOrderProduct::where('purchase_order_id', $value)->get();
    }

    public function updatedProductId($value)
    {
        $this->purchaseOrderProductRemaining = PurchaseOrderProduct::where('product_id', $value)->where('purchase_order_id', $this->purchase_order_id)->first();
    }

    public function store()
    {
        $validate = $this->validate([
            'purchase_order_id' => 'required',
            'product_id' => 'required',
            'quantity' => 'required|lte:'.$this->purchaseOrderProductRemaining->remaining,
        ]);

        DB::transaction(function () use ($validate) {
            Logistics::create($validate);
            $poProduct = PurchaseOrderProduct::where('product_id', $this->product_id)->where('purchase_order_id', $this->purchase_order_id)->first();
            $poProduct->remaining = $poProduct->remaining - $this->quantity;
            $poProduct->delivered = $this->quantity;
            $poProduct->save();

            $product = Product::find($this->product_id);
            $product->stocks = $product->stocks + $this->quantity;
            $product->save();
        });
        session()->flash('message', 'Successfully Created Delivered Product');
        $this->resetFields();
        $this->emit('addedDelivered');
    }

    public function edit($id)
    {
        $logistic = Logistics::where('id', $id)->first();
        $this->ids = $logistic->id;
        $this->purchase_order_id = $logistic->purchase_order_id;
        $this->product_id = $logistic->product_id;
        $this->quantity = $logistic->quantity;

        $poProducts = PurchaseOrderProduct::where('remaining', '>=', 0)->orWhere('purchase_order_id', $logistic->purchase_order_id)->get();
        foreach($poProducts as $product){
            $products[] = $product->purchase_order_id;
        }
        $this->purchaseOrdersModal = PurchaseOrder::whereIn('id', array_unique($products))->get();
    }

    public function modalDelete($id)
    {
        $logistic = Logistics::where('id', $id)->first();
        $this->ids = $logistic->id;
    }

    public function delete()
    {
        if($this->ids){
            DB::transaction(function () {
                $logistic = Logistics::find($this->ids)->first();
                $purchaseOrderProduct = $logistic->purchaseOrderProduct;
                $purchaseOrderProduct->delivered = $purchaseOrderProduct->delivered - $logistic->quantity;
                $purchaseOrderProduct->remaining = $purchaseOrderProduct->remaining + $logistic->quantity;
                $purchaseOrderProduct->save();
                $logistic->delete();
            });
            
            session()->flash('message', 'Delivered Product Successfully Deleted');
            $this->resetFields();
            $this->emit('deletedDelivered');
        }
    }
    
    public function render()
    {
        $searchTerm = '%'.$this->searchTerm.'%';
        $user = Auth::user();
        if($user->role == 'admin'){
            $logistics = Logistics::where('purchase_order_id', 'LIKE', $searchTerm)->paginate(10);
        }elseif($user->role == 'manufacturer'){
            $manufacturerAccount = ManufacturerAccount::where('user_id', $user->id)->first();
            $purchaseOrders = PurchaseOrder::where('manufacturer_id', $manufacturerAccount->manufacturer_id)->get();
            foreach($purchaseOrders as $purchaseOrder){
                $data[] = $purchaseOrder->id;
            }
            $logistics = Logistics::where('purchase_order_id', 'LIKE', $searchTerm)->whereIn('purchase_order_id', $data)->paginate(10);
        }
        return view('livewire.logistic.logistic', [
            'logistics' => $logistics
        ]);
    }
}
