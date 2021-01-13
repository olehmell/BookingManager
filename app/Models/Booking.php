<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'customer' => 'array',
        'price' => 'array',
        'vehicle' => 'array',
        'flight' => 'array',
    ];
    protected $dates = ['arrival_date', 'return_date', 'created_at', 'updated_at'];

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function scopeByAgentId($query, $agent)
    {
        return $query->where('agent_id', $agent);
    }

    public function scopeByProduct($query, $product)
    {
        return $query->where('product_id', $product);
    }

    public function scopeByReference($query, $reference)
    {
        return $query->where('booking_ref', $reference);
    }

    public function scopeArrivingBetween($query, $from, $to)
    {
        return $query->whereBetween('arrival_date', [$from, $to]);
    }

    public function scopeReturningBetween($query, $from, $to)
    {
        return $query->whereBetween('return_date', [$from, $to]);
    }

    public function getArrivalDateAttribute($value)
    {
        return Carbon::parse($value)->format($this->dateFormat());
    }

    public function getReturnDateAttribute($value)
    {
        return Carbon::parse($value)->format($this->dateFormat());
    }

    protected function dateFormat()
    {
        return 'd/m/Y H:i';
    }

    public function setArrivalDateAttribute($value)
    {
        if ($value instanceof Carbon) {
            $this->attributes['arrival_date'] = $value;
        } elseif ($value) {
            $this->attributes['arrival_date'] = Carbon::createFromFormat('d/m/Y H:i', $value);
        }
    }

    public function setReturnDateAttribute($value)
    {
        if ($value instanceof Carbon) {
            $this->attributes['return_date'] = $value;
        } elseif ($value) {
            $this->attributes['return_date'] = Carbon::createFromFormat('d/m/Y H:i', $value);
        }
    }
}
