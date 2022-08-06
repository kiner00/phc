<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'platform_id',
        'order_number',
        'full_name',
        'complete_address',
        'mobile_number',
        'total',
        'processed_by',
        'fulfilled_by',
    ];

    /**
     * Order Product relationship
     */
    public function orderProduct()
    {
        return $this->hasMany(OrderProduct::class, 'order_id', 'id');
    }

    /**
     * Order Fulfillment relationship
     */
    public function orderFulfillment()
    {
        return $this->hasOne(OrderFulfillment::class, 'order_id', 'id');
    }

    /**
     * Platform relationship
     */
    public function platform()
    {
        return $this->hasOne(Platform::class, 'id', 'platform_id');
    }

    /**
     * Processed relationship
     */
    public function processedBy()
    {
        return $this->hasOne(User::class, 'id','processed_by');
    }
}
