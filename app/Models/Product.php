<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Manufacturer;
use App\Models\User;
use App\Models\ProductCategory;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'manufacturer_id',
        'product_category_id',
        'created_by',
        'base_price',
        'stocks'
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
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    /**
     * product category relationship
     */
    public function productCategory()
    {
        return $this->hasOne(ProductCategory::class, 'id', 'product_category_id');
    }
}
