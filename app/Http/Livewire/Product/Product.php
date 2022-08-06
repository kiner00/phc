<?php

namespace App\Http\Livewire\Product;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product as Products;
use App\Models\Manufacturer;
use App\Models\ProductCategory;
use Auth;

class Product extends Component
{
    use WithPagination;

    public $searchTerm;
    public $manufacturers;
    public $productCategories;
    #forms
    public $ids;
    public $name;
    public $manufacturer_id;
    public $product_category_id;
    public $base_price;

    public function resetFields()
    {
        $this->ids = "";
        $this->name = "";
    }

    public function createProductModal()
    {
        $this->manufacturers = Manufacturer::all();
        $this->productCategories = ProductCategory::all();
    }

    public function store()
    {
        $validate = $this->validate([
            'name' => 'required',
            'manufacturer_id' => 'required',
            'product_category_id' => 'required',
            'base_price' => 'required|numeric',
        ]);
        $validate['created_by'] = Auth::user()->id;
        $validate['stocks'] = 0;
        Products::create($validate);
        session()->flash('message', 'Successfully Created Product');
        $this->resetFields();
        $this->emit('addedProduct');
    }

    public function edit($id)
    {
        $product = Products::where('id', $id)->first();
        $this->ids = $product->id;
        $this->name = $product->name;
        $this->manufacturer_id = $product->manufacturer_id;
        $this->product_category_id = $product->product_category_id;
        $this->base_price = $product->base_price;
    }

    public function update()
    {
        $validate = $this->validate([
            'name' => 'required',
            'manufacturer_id' => 'required',
            'product_category_id' => 'required',
            'base_price' => 'required|numeric',
        ]);

        if($this->ids){
            $product = Products::find($this->ids);
            $product->update([
                'name' => $this->name,
                'manufacturer_id' => $this->manufacturer_id,
                'product_category_id' => $this->product_category_id,
                'base_price' => $this->base_price
            ]);
        }

        session()->flash('message', 'Product Successfully Updated');
        $this->resetFields();
        $this->emit('updatedProduct');
    }

    public function modalDelete($id)
    {
        $product = Products::where('id', $id)->first();
        $this->ids = $product->id;
    }

    public function delete()
    {
        if($this->ids){
            Products::find($this->ids)->delete();
            session()->flash('message', 'Product Successfully Deleted');
            $this->resetFields();
            $this->emit('deletedProduct');
        }
    }

    public function render()
    {
        $searchTerm = '%'.$this->searchTerm.'%';

        return view('livewire.product.product', [
            'products' => Products::where('name', 'LIKE', $searchTerm)->paginate(10)
        ]);
    }
}
