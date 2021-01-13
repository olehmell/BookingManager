<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function products()
    {
        return $this->hasMany(AgentProduct::class, 'agent_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'agent_id');
    }

    public function revenue()
    {
        return $this->bookings->sum('price.total');
    }

    public function revenueByProduct($product)
    {
        return $this->bookings->where('product_id', $product)->sum('price.total');
    }

    public function profit()
    {
        return $this->revenue() - $this->supplierCost();
    }

    public function supplierCost()
    {
        return $this->bookings->sum('price.list_price') - $this->bookings->sum('price.supplier_cost');

    }
}
