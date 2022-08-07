<?php

namespace App\Http\Livewire\Order;

use Livewire\Component;
use App\Models\Product;
use App\Models\Platform;
use App\Models\Order as Orders;
use App\Models\OrderProduct;
use App\Models\OrderFulfillment;
use Auth;
use Livewire\WithPagination;

use Illuminate\Support\Facades\DB;

class Order extends Component
{
    use WithPagination;

    public $products;
    public $platforms;
    public $searchTerm;

    #PRODUCT INPUT
    public $productInputs=[];
    public $productCounts=1;
    public $modalAddPoProducts;

    #FORM
    public $ids;
    public $platform_id;
    public $order_number;
    public $full_name;
    public $complete_address;
    public $mobile_number;
    public $product_id = [];
    public $product_quantity = [];
    public $product_price = [];

    #view
    public $viewOrderNumber;
    public $viewPlatform;
    public $viewFullName;
    public $viewMobileNumber;
    public $viewCompleteAddress;
    public $viewProcessedBy;
    public $viewProducts = [];
    public $viewGrandTotal;
    public $viewFulfillment;

    public function resetFields()
    {
        $this->ids = "";
        $this->platform_id = "";
        $this->order_number = "";
        $this->full_name = "";
        $this->complete_address = "";
        $this->mobile_number = "";
        $this->product_id = [];
        $this->product_quantity = [];
        $this->product_price = [];

        $this->productInputs = [];
        $this->productCounts = 1;

        $this->viewOrderNumber = "";
        $this->viewPlatform = "";
        $this->viewFullName = "";
        $this->viewMobileNumber = "";
        $this->viewCompleteAddress = "";
        $this->viewProcessedBy = "";
        $this->viewProducts = [];
        $this->viewGrandTotal = "";
        $this->viewFulfillment = "";

        $this->searchTerm = "";
        
    }

    public function addProductModal($i)
    {
        $i = $i + 1;
        $this->productCounts = $i;
        $this->modalAddPoProducts = Product::all();
        array_push($this->productInputs,$i);
    }

    public function deleteProductModal($i)
    {
        unset($this->productInputs[$i]);
    }

    public function addOrderModal()
    {
        $this->platforms = Platform::all();
    }

    public function store()
    {
        $validate = $this->validate([
            'platform_id' => 'required',
            'order_number' => 'required',
            'full_name' => 'required',
            'complete_address' => 'required',
            'mobile_number' => 'required',
            'product_id.0' => 'required',
            'product_quantity.0' => 'required',
            'product_price.0' => 'required',
            'product_id.*' => 'required',
            'product_quantity.*' => 'required',
            'product_price.*' => 'required',
        ],
        [
            'product_id.0.required' => 'Product is required',
            'product_quantity.0.required' => 'Quantity field is required',
            'product_price.0.required' => 'Price field is required',
            'product_id.*.required' => 'Product field is required',
            'product_quantity.*.required' => 'Quantity field is required',
            'product_price.*.required' => 'Price field is required',
        ]);

        DB::transaction(function () use ($validate) {
            $order = new Orders;
            $order->platform_id = $this->platform_id;
            $order->order_number = $this->order_number;
            $order->full_name = $this->full_name;
            $order->complete_address = $this->complete_address;
            $order->mobile_number = $this->mobile_number;
            $order->processed_by = Auth::user()->id;
            $order->save();

            $total = 0;
            foreach ($validate['product_id'] as $key => $value) {
                OrderProduct::create([
                    'order_id' => $order->id,
                    'product_id' => $value,
                    'price' => $this->product_price[$key],
                    'quantity' => $this->product_quantity[$key],
                    'total' => $this->product_price[$key] * $this->product_quantity[$key]
                ]);

                $total = $total + ($this->product_price[$key] * $this->product_quantity[$key]);
            }

            $order->total = $total;
            $order->save();
        });

        session()->flash('message', 'Successfully Create Customer Order.');
        $this->resetFields();
        $this->emit('addedOrder');
    }

    public function viewOrder($id)
    {
        $order = Orders::find($id);
        $this->viewPlatform = $order->platform->platform;
        $this->viewOrderNumber = $order->order_number;
        $this->viewFullName = $order->full_name;
        $this->viewMobileNumber = $order->mobile_number;
        $this->viewCompleteAddress = $order->complete_address;
        $this->viewProcessedBy = $order->processedBy->name;
        $this->viewProducts = $order->orderProduct;
        $this->viewGrandTotal = $order->total;
        $this->viewFulfillment = $order->orderFulfillment ? $order->orderFulfillment->status : "Pending";
    }

    public function arrangeShipmentModal($id)
    {
        $this->ids = $id;
        $order = Orders::find($id);
        $this->viewOrderNumber = $order->order_number;
        $this->viewFullName = $order->full_name;
    }

    public function storeOrderFulfillment()
    {
        if($this->ids){
            $order = Orders::find($this->ids);
            DB::transaction(function () use ($order) {
                OrderFulfillment::create([
                    'order_id' => $order->id,
                    'status' => 'fulfilled',
                    'fulfilled_by' => Auth::user()->id
                ]);

                foreach($order->orderProduct as $orderProduct){
                    $product = $orderProduct->product;
                    $product->stocks = $product->stocks - $orderProduct->quantity;
                    $product->save();
                }
            });
        }

        session()->flash('message', 'Successfully ready to ship customer order.');
        $this->resetFields();
        $this->emit('addedOrderFulfillment');
    }

    public function returnOrderFulfillment()
    {
        if($this->ids){
            $order = Orders::find($this->ids);
            DB::transaction(function () use ($order) {
                foreach($order->orderProduct as $orderProduct){
                    $product = $orderProduct->product;
                    $product->stocks = $product->stocks + $orderProduct->quantity;
                    $product->save();
                }

                OrderFulfillment::where('order_id',$this->ids)->delete();
            });
            
        }

        session()->flash('message', 'Successfully return customer order.');
        $this->resetFields();
        $this->emit('returnedOrderFulfillment');
    }

    public function edit($id)
    {
        $this->resetFields();
        $this->addOrderModal();
        $this->ids = $id;
        $order = Orders::find($id);
        $this->platform_id = $order->platform_id;
        $this->order_number = $order->order_number;
        $this->full_name = $order->full_name;
        $this->complete_address = $order->complete_address;
        $this->mobile_number =  $order->mobile_number;

        foreach ($order->orderProduct as $key => $value) {
            $this->addProductModal($key+1);
            $this->product_id[$key] = $value['product_id'];
            $this->product_price[$key] = $value['price'];
            $this->product_quantity[$key] = $value['quantity'];
        }
    }

    public function update()
    {
        $validate = $this->validate([
            'platform_id' => 'required',
            'order_number' => 'required',
            'full_name' => 'required',
            'complete_address' => 'required',
            'mobile_number' => 'required',
            'product_id.0' => 'required',
            'product_quantity.0' => 'required',
            'product_price.0' => 'required',
            'product_id.*' => 'required',
            'product_quantity.*' => 'required',
            'product_price.*' => 'required',
        ],
        [
            'product_id.0.required' => 'Product is required',
            'product_quantity.0.required' => 'Quantity field is required',
            'product_price.0.required' => 'Price field is required',
            'product_id.*.required' => 'Product field is required',
            'product_quantity.*.required' => 'Quantity field is required',
            'product_price.*.required' => 'Price field is required',
        ]);

        if($this->ids){
            
            DB::transaction(function () use ($validate) {
                $order = Orders::find($this->ids);
                $order->platform_id = $this->platform_id;
                $order->order_number = $this->order_number;
                $order->full_name = $this->full_name;
                $order->complete_address = $this->complete_address;
                $order->mobile_number = $this->mobile_number;
                // $order->save();
                
                $total = 0;
                $order->orderProduct()->delete();
                foreach ($validate['product_id'] as $key => $value) {
                    OrderProduct::create([
                        'order_id' => $order->id,
                        'product_id' => $value,
                        'price' => $this->product_price[$key],
                        'quantity' => $this->product_quantity[$key],
                        'total' => $this->product_price[$key] * $this->product_quantity[$key]
                    ]);
    
                    $total = $total + ($this->product_price[$key] * $this->product_quantity[$key]);
                }
    
                $order->total = $total;
                $order->save();
            });
    
            session()->flash('message', 'Successfully Update Customer Order.');
            $this->resetFields();
            $this->emit('updatedOrder');
        }else{
            
        }
    }

    public function modalDelete($id)
    {
        $this->ids = $id;
    }

    public function delete()
    {
        if($this->ids){
            DB::transaction(function () {
                $order = Orders::find($this->ids);
                $order->orderProduct()->delete();
                $order->orderFulfillment()->delete();
                $order->delete();
            });
            session()->flash('message', 'Order Successfully Deleted');
            $this->resetFields();
            $this->emit('deletedOrder');
        }
    }

    public function render()
    {
        $searchTerm = '%'.$this->searchTerm.'%';
        if(Auth::user()->role == 'admin' || Auth::user()->role == 'logistic'){
            $orders = Orders::where('order_number', 'LIKE', $searchTerm)
                    ->orWhere('full_name', 'LIKE', $searchTerm)
                    ->orWhere('complete_address', 'LIKE', $searchTerm)
                    ->orWhere('mobile_number', 'LIKE', $searchTerm)
                    ->orWhere('total', 'LIKE', $searchTerm)
                    ->paginate(10);
        }else{
            $orders = Orders::where('order_number', 'LIKE', $searchTerm)
                    ->where('processed_by', Auth::user()->id)
                    ->orWhere('full_name', 'LIKE', $searchTerm)
                    ->orWhere('complete_address', 'LIKE', $searchTerm)
                    ->orWhere('mobile_number', 'LIKE', $searchTerm)
                    ->orWhere('total', 'LIKE', $searchTerm)
                    ->paginate(10);
        }
        
        return view('livewire.order.order', [
            'orders' => $orders
        ]);
    }
}
