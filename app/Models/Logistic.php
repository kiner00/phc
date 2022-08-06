<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logistic extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'purchase_order_id',
        'product_id',
        'quantity'
    ];

    /**
     * Belongs to purchase order
     */
    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class, 'purchase_order_id', 'id');
    }

    /**
     * Belongs to product
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    /**
     * Belongs to product
     */
    public function purchaseOrderProduct()
    {
        return $this->hasOne(PurchaseOrderProduct::class, 'product_id', 'product_id', 'purchase_order_id', 'purchase_order_id');
    }
}
