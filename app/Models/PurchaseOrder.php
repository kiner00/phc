<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Manufacturer;
use App\Models\PurchaseOrderProduct;
use App\Models\Logistic;

class PurchaseOrder extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'purchase_order_number',
        'manufacturer_id',
        'date_of_purchase_order',
        'date_needed',
        'total_cost',
        'status',
        'remaining_balance'
    ];

    /**
     * manufacturer relationship
     */
    public function manufacturer()
    {
        return $this->hasOne(Manufacturer::class, 'id', 'manufacturer_id');
    }

    /**
     * purchase order product relationship
     */
    public function purchaseOrderProducts()
    {
        return $this->hasMany(PurchaseOrderProduct::class, 'purchase_order_id', 'id');
    }

    /**
     * purchase order payments
     */
    public function purchaseOrderPayments()
    {
        return $this->hasMany(PurchaseOrderPayment::class, 'purchase_order_id', 'id');
    }

    /**
     * Logistics
     */
    public function logistics()
    {
        return $this->hasMany(Logistic::class, 'purchase_order_id', 'id');
    }
}
