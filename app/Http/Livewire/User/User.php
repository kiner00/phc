<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\User as Users;
use App\Models\ManufacturerAccount;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class User extends Component
{
    use WithPagination, WithFileUploads;

    public $ids;
    public $name;
    public $email;
    public $role;
    public $password;
    public $password_confirmation;
    public $image;
    public $searchTerm;

    public function resetFields()
    {
        $this->ids = "";
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
            'image' => 'required|image|max:1024'
        ]);

        $validate['image'] = $this->image->store('profile_pic');
        $validate['password'] = Hash::make($this->password);
        Users::create($validate);
        session()->flash('message', 'Successfully Created User');
        $this->resetFields();
        $this->emit('addedUser');
    }

    public function edit($id)
    {
        $user = Users::where('id', $id)->first();
        $this->ids = $user->id;
        $this->email = $user->email;
        $this->name = $user->name;
        $this->role = $user->role;
        $this->image = $user->image;
    }

    public function update()
    {
        $validate = $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'role' => 'required',
            // 'image' => 'image|max:1024'
        ]);

        if($this->ids){
            $user = Users::find($this->ids);
            $user->update([
                'name' => $this->name,
                'email' => $this->email,
                'role' => $this->role,
                'image' => $this->image
            ]);
        }

        session()->flash('message', 'User Successfully Updated');
        $this->resetFields();
        $this->emit('updatedUser');
    }

    public function modalDelete($id)
    {
        $user = Users::where('id', $id)->first();
        $this->ids = $user->id;
    }

    public function delete()
    {
        if($this->ids){
            DB::transaction(function () {
                ManufacturerAccount::where('user_id', $this->ids)->delete();
                Users::find($this->ids)->delete();
            });
            
            session()->flash('message', 'User Successfully Deleted');
            $this->resetFields();
            $this->emit('deletedUser');
        }
    }

    public function render()
    {
        $searchTerm = '%'.$this->searchTerm.'%';
        return view('livewire.user.user', [
            'users' => Users::where('name', 'LIKE', $searchTerm)
                        ->orWhere('email', 'LIKE', $searchTerm)
                        ->orWhere('role', 'LIKE', $searchTerm)
                        ->paginate(10)
        ]);
    }
}
