<?php

namespace App\Http\Livewire\Manufacturer;

use Livewire\Component;
use App\Models\Manufacturer as Manufacturers;
use Livewire\WithPagination;
use Auth;

class Manufacturer extends Component
{
    use WithPagination;

    public $searchTerm;
    public $ids;
    public $name;

    public function resetFields()
    {
        $this->ids = "";
        $this->name = "";
    }

    public function store()
    {
        $validate = $this->validate([
            'name' => 'required',
        ]);

        Manufacturers::create($validate);
        session()->flash('message', 'Successfully Created Manufacturer');
        $this->resetFields();
        $this->emit('addedManufacturer');
    }

    public function edit($id)
    {
        $manufacturer = Manufacturers::where('id', $id)->first();
        $this->ids = $manufacturer->id;
        $this->name = $manufacturer->name;
    }

    public function update()
    {
        $validate = $this->validate([
            'name' => 'required',
            // 'image' => 'image|max:1024'
        ]);

        if($this->ids){
            $user = Manufacturers::find($this->ids);
            $user->update([
                'name' => $this->name,
            ]);
        }

        session()->flash('message', 'Manufacturer Successfully Updated');
        $this->resetFields();
        $this->emit('updatedManufacturer');
    }

    public function modalDelete($id)
    {
        $user = Manufacturers::where('id', $id)->first();
        $this->ids = $user->id;
    }

    public function delete()
    {
        if($this->ids){
            Manufacturers::find($this->ids)->delete();
            session()->flash('message', 'Manufacturer Successfully Deleted');
            $this->resetFields();
            $this->emit('deletedManufacturer');
        }
    }

    public function render()
    {
        $searchTerm = '%'.$this->searchTerm.'%';
        $user = Auth::user();
        if($user->role == 'admin'){
            $manufacturers = Manufacturers::where('name', 'LIKE', $searchTerm)->paginate(10);
        }elseif($user->role == 'manufacturer'){
            $manufacturerAccount = ManufacturerAccount::where('user_id', $user->id)->first();
            $manufacturers = Manufacturers::where('name', 'LIKE', $searchTerm)->where('id', $manufacturerAccount->manufacturer_id)->paginate(10);
        }
        return view('livewire.manufacturer.manufacturer', [
            'manufacturers' => $manufacturers
        ]);
    }
}
