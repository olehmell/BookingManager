<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentProduct extends Model
{
    use HasFactory;

    protected $table = 'agents_products';

    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class, 'id', 'product_id');
    }

    public function agent()
    {
        return $this->belongsTo(Agent::class, 'id', 'agent_id');
    }
}
