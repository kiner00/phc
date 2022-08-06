<?php

namespace App\Http\Livewire\Manufacturer;

use Livewire\Component;
use App\Models\ManufacturerAccount as ManufacturerAccounts;
use App\Models\Manufacturer;
use App\Models\User;

class ManufacturerAccount extends Component
{
    public $manufList;
    public $userList;
    public $manufacturer_id;
    public $user_id;

    public function resetFields()
    {
        $this->manufList = "";
        $this->manufacturer_id = "";
        $this->userList = "";
        $this->user_id = "";
    }
    public function addManufAccountForm()
    {
        $this->manufList = Manufacturer::all();
        $registeredAccounts = ManufacturerAccounts::all();
        $accounts = [];
        foreach($registeredAccounts as $registeredAccount){
            $accounts[] = $registeredAccount->user_id;
        }
        $this->userList = User::whereNotIn('id', $accounts)->where('role', 'manufacturer')->get();
    }

    public function store()
    {
        $validate = $this->validate([
            'user_id' => 'required',
            'manufacturer_id' => 'required',
        ]);
        
        ManufacturerAccounts::create($validate);
        session()->flash('message', 'Successfully Assigned User to Manufacturer');
        $this->resetFields();
        $this->emit('addedUserManufacturer');
    }

    public function render()
    {
        return view('livewire.manufacturer.manufacturer-account', [
            'manufacturerAccounts' => ManufacturerAccounts::latest()->paginate(10)
        ]);
    }
}
