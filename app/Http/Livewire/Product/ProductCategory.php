<?php

namespace App\Http\Livewire\Product;

use Livewire\Component;
use App\Models\ProductCategory as ProductCategories;

class ProductCategory extends Component
{
    public $ids;
    public $name;

    public function resetFields()
    {
        $this->ids = "";
        $this->name = "";
    }

    public function edit($id)
    {
        $prodCat = ProductCategories::where('id', $id)->first();
        $this->ids = $prodCat->id;
        $this->name = $prodCat->name;
    }

    public function update()
    {
        $validate = $this->validate([
            'name' => 'required',
        ]);

        if($this->ids){
            $user = ProductCategories::find($this->ids);
            $user->update([
                'name' => $this->name,
            ]);
        }

        session()->flash('message', 'Product Category Successfully Updated');
        $this->resetFields();
        $this->emit('updatedProductCategory');
    }

    public function store()
    {
        $validate = $this->validate([
            'name' => 'required',
        ]);

        ProductCategories::create($validate);
        session()->flash('message', 'Successfully Created Product Category');
        $this->resetFields();
        $this->emit('addedProductCategory');
    }

    public function modalDelete($id)
    {
        $prodCat = ProductCategories::where('id', $id)->first();
        $this->ids = $prodCat->id;
    }

    public function delete()
    {
        if($this->ids){
            ProductCategories::find($this->ids)->delete();
            session()->flash('message', 'Product Category Successfully Deleted');
            $this->resetFields();
            $this->emit('deletedProductCategory');
        }
    }

    public function render()
    {
        return view('livewire.product.product-category', [
            'productCategories' => ProductCategories::all()
        ]);
    }
}
