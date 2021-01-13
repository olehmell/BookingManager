<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class BookingImport extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    const STORAGE_DISK = 'imports';

    protected $guarded = [];

    protected $with = ['media'];

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('imports')
            ->useDisk('imports');
    }

    public function mapper()
    {
        return $this->belongsTo(ImportMapping::class, 'field_mapping_id', 'id');
    }

    public function mappableFields()
    {
        return [
            'product_id' => '',
            'booking_ref' => '',
            'agent_id' => '',
            'customer' => [
                'name' => '',
                'email' => '',
                'mobile' => ''
            ],
            'vehicle' => [
                'make' => '',
                'model' => '',
                'colour' => '',
                'registration' => ''
            ],
            'arrival' => '',
            'return' => '',
            'flight' => [
                'flight_out' => '',
                'flight_in' => '',
                'terminal_out' => '',
                'terminal_in' => ''
            ],
            'price' => [
                'price_paid' => '',
                'list_price' => '',
                'supplier_cost' => ''
            ],
            'status' => ''
        ];
    }
}
