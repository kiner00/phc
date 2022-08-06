<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class Employee extends Component
{
    use WithPagination, WithFileUploads;

    public $name;
    public $email;
    public $role;
    public $password;
    public $password_confirmation;
    public $image;

    public function resetFields()
    {
        $this->name = "";
        $this->email = "";
        $this->role = "";
        $this->password = "";
        $this->password_confirmation = "";
        $this->image = "";
    }

    public function store()
    {
        $validate = $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'role' => 'required',
            'password' => 'required|confirmed',
            'image' => 'image|max:1024'
        ]);

        $validate['image'] = $this->image->store('profile_pic');
        User::create($validate);
        session()->flash('message', 'Successfully Created User');
        $this->resetFields();
        $this->emit('addUser');
    }
    public function render()
    {
        return view('livewire.employee');
    }
}
