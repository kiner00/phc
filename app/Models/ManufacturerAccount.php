<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Manufacturer;
use App\Models\User;

class ManufacturerAccount extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'manufacturer_id'
    ];

    /**
     * manufacturer relationship
     */
    public function manufacturer()
    {
        return $this->hasOne(Manufacturer::class, 'id', 'manufacturer_id');
    }

    /**
     * user relationship
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
