<?php

namespace App\Models\Bookings;

use App\Models\Agent;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Booking extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * The attributes to be cast.
     *
     * @var string[]
     */
    protected $casts = [
        'customer' => 'array',
        'price' => 'array',
        'vehicle' => 'array',
        'flight' => 'array',
    ];

    /**
     * The attributes to be cast as dates.
     *
     * @var string[]
     */
    protected $dates = ['arrival_date', 'return_date', 'created_at', 'updated_at'];

    /**
     * The agent relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    /**
     * The product relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    /**
     * Retrieve bookings by agent_id.
     *
     * @param $query
     * @param $agent
     * @return mixed
     */
    public function scopeByAgentId($query, $agent)
    {
        return $query->where('agent_id', $agent);
    }

    /**
     * Retrieve bookings by product_id.
     *
     * @param $query
     * @param $product
     * @return mixed
     */
    public function scopeByProduct($query, $product)
    {
        return $query->where('product_id', $product);
    }

    /**
     * Retrieve a booking by booking_ref.
     *
     * @param $query
     * @param $reference
     * @return mixed
     */
    public function scopeByReference($query, $reference)
    {
        return $query->where('booking_ref', $reference);
    }

    /**
     * Collection of bookings arriving between date range.
     *
     * @param $query
     * @param $from
     * @param $to
     * @return mixed
     */
    public function scopeArrivingBetween($query, $from, $to)
    {
        return $query->whereBetween('arrival_date', [$from, $to]);
    }

    /**
     * Collection of bookings returning between date range.
     *
     * @param $query
     * @param $from
     * @param $to
     * @return mixed
     */
    public function scopeReturningBetween($query, $from, $to)
    {
        return $query->whereBetween('return_date', [$from, $to]);
    }

//    public function getArrivalDateAttribute($value)
//    {
//        return Carbon::parse($value)->format($this->dateFormat());
//    }
//
//    public function getReturnDateAttribute($value)
//    {
//        return Carbon::parse($value)->format($this->dateFormat());
//    }

    /**
     * The date format to be used.
     *
     * @return string
     */
    protected function dateFormat(): string
    {
        return 'd/m/Y H:i';
    }

    /**
     * Set the arrival date attribute.
     *
     * @param $value
     */
    public function setArrivalDateAttribute($value)
    {
        if ($value instanceof Carbon) {
            $this->attributes['arrival_date'] = $value;
        } elseif ($value) {
            $this->attributes['arrival_date'] = Carbon::create()->setTimestamp($value)->utc();
        }
    }

    /**
     * The arrival time for the booking.
     *
     * @return mixed
     */
    public function getArrivalTimeAttribute()
   {
       return $this->arrival_date->format('H:i');
   }

    /**
     * The return time for booking.
     *
     * @return mixed
     */
    public function getReturnTimeAttribute()
   {
       return $this->return_date->format('H:i');
   }

    /**
     * The duration of the booking in days including the first day.
     *
     * @return int
     */
    public function getDurationAttribute()
   {
       return $this->return_date->diffInDays($this->arrival_date) + 1;
   }

    /**
     * Set the return date for the booking.
     *
     * @param $value
     */
    public function setReturnDateAttribute($value)
    {
        if ($value instanceof Carbon) {
            $this->attributes['return_date'] = $value;
        } elseif ($value) {
            $this->attributes['return_date'] = Carbon::create()->setTimestamp($value);
        }
    }

    public function getBookingRefAttribute($attribute)
    {
        return Str::upper($attribute);
    }
}
