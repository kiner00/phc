<?php

namespace App\Http\Livewire\PurchaseOrder;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PurchaseOrder as PurchaseOrders;
use App\Models\PurchaseOrderProduct;
use App\Models\Manufacturer;
use App\Models\Product;
use App\Models\ManufacturerAccount;
use Illuminate\Support\Facades\DB;
use Auth;

class PurchaseOrder extends Component
{
    use WithPagination;

    public $searchTerm;
    public $modalAddPoManufacturers = [];
    public $modalAddPoProducts = [];
    public $ids;
    
    #FORM
    public $purchase_order_number;
    public $manufacturer_id;
    public $date_of_purchase_order;
    public $date_needed;
    public $product_id;
    public $product_quantity;

    #PRODUCT INPUT
    public $productInputs=[];
    public $productCounts=1;

    #MAKE PAYMENT
    public $totalCost = 0;
    public $remainingBalance = 0;

    public function resetFields()
    {
        $this->ids = "";
        $this->purchase_order_number = "";
        $this->manufacturer_id = "";
        $this->date_of_purchase_order = "";
        $this->date_needed = "";
        $this->product_id;
        $this->product_quantity;

        $this->modalAddPoManufacturers=[];
        $this->productInputs = [];
        $this->productCounts = 1;
        $this->totalCost = 0;
        $this->remainingBalance = 0;
    }

    public function addProductModal($i)
    {
        $this->purchase_order_number = $this->purchase_order_number;
        $this->manufacturer_id = $this->manufacturer_id;
        $this->date_of_purchase_order = $this->date_of_purchase_order;
        $this->date_needed = $this->date_needed;
        $i = $i + 1;
        $this->productCounts = $i;
        array_push($this->productInputs,$i);
    }

    public function deleteProductModal($i)
    {
        unset($this->productInputs[$i]);
    }

    public function addPoModal()
    {
        $this->modalAddPoManufacturers = Manufacturer::all();
    }

    public function updatedManufacturerId($value)
    {
        $this->modalAddPoProducts = "";
        $this->modalAddPoProducts = Product::where('manufacturer_id', $value)->get();
    }

    public function store()
    {
        $validatedDate = $this->validate([
                'purchase_order_number' => 'required',
                'manufacturer_id' => 'required',
                'date_of_purchase_order' => 'required',
                'date_needed' => 'required',
                'product_id.0' => 'required',
                'product_quantity.0' => 'required',
                'product_id.*' => 'required',
                'product_quantity.*' => 'required',
            ],
            [
                'product_id.0.required' => 'Product is required',
                'product_quantity.0.required' => 'Quantity field is required',
                'product_id.*.required' => 'Product field is required',
                'product_quantity.*.required' => 'Quantity field is required',
            ]
        );

        
        DB::transaction(function () use ($validatedDate) {
            $totalCost = 0;
            $purchaseOrder = new PurchaseOrders;
            $purchaseOrder->purchase_order_number = $this->purchase_order_number;
            $purchaseOrder->manufacturer_id = $this->manufacturer_id;
            $purchaseOrder->date_of_purchase_order = $this->date_of_purchase_order;
            $purchaseOrder->date_needed = $this->date_needed;
            $purchaseOrder->total_cost = $totalCost;
            $purchaseOrder->status = "Pending";
            $purchaseOrder->remaining_balance = $totalCost;
            $purchaseOrder->save();

            $remainingBalance = 0;
            foreach ($validatedDate['product_id'] as $key => $value) {
                PurchaseOrderProduct::create([
                    'purchase_order_id' => $purchaseOrder->id,
                    'product_id' => $value, 
                    'quantity' => $this->product_quantity[$key],
                    'delivered' => 0,
                    'remaining' => $this->product_quantity[$key]
                ]);
                $product = Product::find($this->product_id[$key]);
                $totalCost = $product->base_price * $this->product_quantity[$key];
                $remainingBalance = $remainingBalance + $totalCost;
            }
            $purchaseOrder->total_cost = $remainingBalance;
            $purchaseOrder->remaining_balance = $remainingBalance;
            
            $purchaseOrder->save();
        });
        

        session()->flash('message', 'Successfully Create Purchase Order.');
        $this->resetFields();
        $this->emit('addedPurchaseOrder');
    }

    public function edit($id)
    {
        $this->resetFields();
        $purchaseOrder = PurchaseOrders::where('id', $id)->first();
        $this->ids = $purchaseOrder->id;
        $this->purchase_order_number = $purchaseOrder->purchase_order_number;
        $this->modalAddPoManufacturers = Manufacturer::all();
        $this->manufacturer_id = $purchaseOrder->manufacturer_id;
        $this->date_of_purchase_order = $purchaseOrder->date_of_purchase_order;
        $this->date_needed = $purchaseOrder->date_of_purchase_order;

        $this->updatedManufacturerId($this->manufacturer_id);
        $poProducts = PurchaseOrderProduct::where('purchase_order_id', $id)->get();

        foreach($poProducts as $key=>$poProducts){
            $this->productCounts = $key+1;
            $this->productInputs=[];
            array_push($this->productInputs,$key+1);
            $this->product_id[$key] = $poProducts->product_id;
            $this->product_quantity[$key] = $poProducts->quantity;
        }
    }

    public function editPaymentModal($id)
    {
        $this->resetFields();
        $purchaseOrder = PurchaseOrders::where('id', $id)->first();
        $this->totalCost = $purchaseOrder->totalCost;
        $this->remainingBalance = $purchaseOrder->remaining_balance;
    }

    public function update()
    {
        $validatedDate = $this->validate([
            'purchase_order_number' => 'required',
            'manufacturer_id' => 'required',
            'date_of_purchase_order' => 'required',
            'date_needed' => 'required',
            'product_id.0' => 'required',
            'product_quantity.0' => 'required',
            'product_id.*' => 'required',
            'product_quantity.*' => 'required',
        ],
        [
            'product_id.0.required' => 'Product is required',
            'product_quantity.0.required' => 'Quantity field is required',
            'product_id.*.required' => 'Product field is required',
            'product_quantity.*.required' => 'Quantity field is required',
        ]);

        DB::transaction(function () use ($validatedDate) {
            $totalCost = 0;
            $purchaseOrder = PurchaseOrders::find($this->ids);
            $purchaseOrder->purchase_order_number = $this->purchase_order_number;
            $purchaseOrder->manufacturer_id = $this->manufacturer_id;
            $purchaseOrder->date_of_purchase_order = $this->date_of_purchase_order;
            $purchaseOrder->date_needed = $this->date_needed;
            $purchaseOrder->total_cost = $totalCost;
            $purchaseOrder->status = "Pending";
            $purchaseOrder->remaining_balance = $totalCost;

            $purchaseOrder->save();
            $purchaseOrder->purchaseOrderProducts()->delete();

            $remainingBalance = 0;
            foreach ($validatedDate['product_id'] as $key => $value) {
                PurchaseOrderProduct::create([
                    'purchase_order_id' => $purchaseOrder->id,
                    'product_id' => $value, 
                    'quantity' => $this->product_quantity[$key],
                    'delivered' => 0,
                    'remaining' => $this->product_quantity[$key]
                ]);
                $product = Product::find($this->product_id[$key]);
                $totalCost = $product->base_price * $this->product_quantity[$key];
                $remainingBalance = $remainingBalance + $totalCost;
            }
            $purchaseOrder->total_cost = $totalCost;
            $purchaseOrder->remaining_balance = $remainingBalance;
            $purchaseOrder->save();
        });
        

        session()->flash('message', 'Successfully Update Purchase Order.');
        $this->resetFields();
        $this->emit('updatedPurchaseOrder');
    }

    public function modalDelete($id)
    {
        $purchaseOrder = PurchaseOrders::where('id', $id)->first();
        $this->ids = $purchaseOrder->id;
    }

    public function delete()
    {
        if($this->ids){
            DB::transaction(function (){
                $purchaseOrder = PurchaseOrders::find($this->ids);
                $purchaseOrder->purchaseOrderProducts()->delete();
                $purchaseOrder->delete();
            });
            
            session()->flash('message', 'Purchase Order Successfully Deleted');
            $this->resetFields();
            $this->emit('deletedPurchaseOrder');
        }
    }

    public function render()
    {
        $searchTerm = '%'.$this->searchTerm.'%';
        $user = Auth::user();
        if($user->role == 'admin' || $user->role == 'accounting'){
            $purchaseOrder = PurchaseOrders::where('purchase_order_number', 'LIKE', $searchTerm)->paginate(10);
        }elseif($user->role == 'manufacturer'){
            $manufacturerAccount = ManufacturerAccount::where('user_id', $user->id)->first();
            $purchaseOrder = PurchaseOrders::where('purchase_order_number', 'LIKE', $searchTerm)->where('manufacturer_id', $manufacturerAccount->manufacturer_id)->paginate(10);
        }
        return view('livewire.purchase-order.purchase-order', [
            'purchaseOrders' => $purchaseOrder
        ]);
    }
}
