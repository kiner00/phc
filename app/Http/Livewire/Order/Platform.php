<?php

namespace App\Http\Livewire\Order;

use Livewire\Component;
use App\Models\Platform as Platforms;

class Platform extends Component
{
    #FORM
    public $ids;
    public $platform;

    public function resetFields()
    {
        $this->platform = "";
        $this->ids = "";
    }

    public function store()
    {
        $validate = $this->validate([
            'platform' => 'required',
        ]);

        Platforms::create($validate);
        session()->flash('message', 'Successfully Created Platform');
        $this->resetFields();
        $this->emit('addedPlatform');
    }

    public function edit($id)
    {
        $platform = Platforms::find($id);
        $this->ids = $id;
        $this->platform = $platform->platform;
    }

    public function update()
    {
        $validate = $this->validate([
            'platform' => 'required',
        ]);

        if($this->ids){
            $platform = Platforms::find($this->ids);
            $platform->update($validate);
        }

        session()->flash('message', 'Platform Successfully Updated');
        $this->resetFields();
        $this->emit('updatedPlatform');
    }

    public function modalDelete($id)
    {
        $user = Platforms::where('id', $id)->first();
        $this->ids = $user->id;
    }

    public function delete()
    {
        if($this->ids){
            Platforms::find($this->ids)->delete();
            session()->flash('message', 'Platform Successfully Deleted');
            $this->resetFields();
            $this->emit('deletedPlatform');
        }
    }

    public function render()
    {
        return view('livewire.order.platform', [
            'platforms' => Platforms::all()
        ]);
    }
}
