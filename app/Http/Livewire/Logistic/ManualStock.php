<?php

namespace App\Http\Livewire\Logistic;

use Livewire\Component;
use App\Models\ManualStock as ManualStocks;
use App\Models\Product;
use Livewire\WithPagination;
use Auth;
use Illuminate\Support\Facades\DB;

class ManualStock extends Component
{
    use WithPagination;

    public $products;
    public $ids;

    #FORM
    public $product_id;
    public $quantity;
    public $operation;

    public function resetFields()
    {
        $this->product_id = "";
        $this->quantity = "";
        $this->products = "";
        $this->operation = "";
        $this->ids = "";
    }
    
    public function render()
    {
        return view('livewire.logistic.manual-stock', [
            'manualStocks' => ManualStocks::paginate(10)
        ]);
    }

    public function manualAddStockModal()
    {
        $this->products = Product::all();
    }

    public function store()
    {
        $validate = $this->validate([
            'product_id' => 'required',
            'quantity' => 'required',
            'operation' => 'required',
        ]);
        $validate['user_id'] = Auth::user()->id;
        DB::transaction(function () use ($validate) {
            ManualStocks::create($validate);
            $product = Product::find($this->product_id);
            if($validate['operation'] == 'add'){
                $product->stocks = $product->stocks + $this->quantity;
            }else{
                $product->stocks = $product->stocks - $this->quantity;
            }

            $product->save();
        });
        
        session()->flash('message', 'Successfully Created Manual Stocks');
        $this->resetFields();
        $this->emit('addedManual');
    }

    public function edit($id)
    {
        $this->ids = $id;
        $this->manualAddStockModal();
        $manualStock = ManualStocks::find($id);
        $this->product_id = $manualStock->product_id;
        $this->quantity = $manualStock->quantity;
        $this->operation = $manualStock->operation;
    }

    public function update()
    {
        $validate = $this->validate([
            'product_id' => 'required',
            'quantity' => 'required',
            'operation' => 'required',
        ]);

        if($this->ids){
            DB::transaction(function () use ($validate) {
                $manualStock = ManualStocks::find($this->ids);
                //rollback quantity
                $product = Product::find($this->product_id);
                if($manualStock->operation == 'add'){
                    $product->stocks = $product->stocks - $manualStock->quantity;
                }else{
                    $product->stocks = $product->stocks + $manualStock->quantity;
                }
                $product->save();
                //rollback quantity end

                $manualStock->update([
                    'product_id' => $this->product_id,
                    'quantity' => $this->quantity,
                    'operation' => $this->operation
                ]);

                if($validate['operation'] == 'add'){
                    $product->stocks = $product->stocks + $this->quantity;
                }else{
                    $product->stocks = $product->stocks - $this->quantity;
                }

                $product->save();
            });
            
            session()->flash('message', 'Successfully Updated Manual Stocks');
            $this->resetFields();
            $this->emit('updatedManual');
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
                $manualStock = ManualStocks::find($this->ids);
                //rollback quantity
                $product = Product::find($manualStock->product_id);
                if($manualStock->operation == 'add'){
                    $product->stocks = $product->stocks - $manualStock->quantity;
                }else{
                    $product->stocks = $product->stocks + $manualStock->quantity;
                }
                $product->save();
                //rollback quantity end

                $manualStock->delete();
            });

            session()->flash('message', 'Successfully Deleted Manual Stocks');
            $this->resetFields();
            $this->emit('deletedManual');
        }
    }
}
