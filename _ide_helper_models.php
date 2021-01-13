<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Agent
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Booking[] $bookings
 * @property-read int|null $bookings_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AgentProduct[] $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder|Agent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Agent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Agent query()
 * @method static \Illuminate\Database\Eloquent\Builder|Agent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Agent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Agent whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Agent whereUpdatedAt($value)
 */
	class Agent extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\AgentProduct
 *
 * @property int $id
 * @property string $name
 * @property int $agent_id
 * @property int $product_id
 * @property string $agent_product_code
 * @property int $commission
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Agent $agent
 * @property-read \App\Models\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|AgentProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AgentProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AgentProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|AgentProduct whereAgentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AgentProduct whereAgentProductCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AgentProduct whereCommission($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AgentProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AgentProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AgentProduct whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AgentProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AgentProduct whereUpdatedAt($value)
 */
	class AgentProduct extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Booking
 *
 * @property int $id
 * @property int $agent_id
 * @property int $product_id
 * @property string $booking_ref
 * @property \Illuminate\Support\Carbon $arrival_date
 * @property \Illuminate\Support\Carbon|null $return_date
 * @property array $customer
 * @property array|null $vehicle
 * @property array|null $flight
 * @property array $price
 * @property mixed|null $notes
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Agent $agent
 * @property-read \App\Models\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|Booking arrivingBetween($from, $to)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking byAgentId($agent)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking byProduct($product)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking byReference($reference)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Booking newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Booking query()
 * @method static \Illuminate\Database\Eloquent\Builder|Booking returningBetween($from, $to)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereAgentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereArrivalDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereBookingRef($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereCustomer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereFlight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereReturnDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereVehicle($value)
 */
	class Booking extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\BookingImport
 *
 * @property int $id
 * @property string $filename
 * @property string $original_file_name
 * @property string $path
 * @property int|null $field_mapping_id
 * @property int|null $row_count
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ImportMapping|null $mapper
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder|BookingImport newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BookingImport newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BookingImport query()
 * @method static \Illuminate\Database\Eloquent\Builder|BookingImport whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookingImport whereFieldMappingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookingImport whereFilename($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookingImport whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookingImport whereOriginalFileName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookingImport wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookingImport whereRowCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookingImport whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookingImport whereUpdatedAt($value)
 */
	class BookingImport extends \Eloquent implements \Spatie\MediaLibrary\HasMedia {}
}

namespace App\Models{
/**
 * App\Models\ImportMapping
 *
 * @property int $id
 * @property string $name
 * @property array|null $fields
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ImportMapping newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ImportMapping newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ImportMapping query()
 * @method static \Illuminate\Database\Eloquent\Builder|ImportMapping whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImportMapping whereFields($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImportMapping whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImportMapping whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImportMapping whereUpdatedAt($value)
 */
	class ImportMapping extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Product
 *
 * @property int $id
 * @property string $name
 * @property string|null $product_code
 * @property int $type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereProductCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 */
	class Product extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ProductType
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ProductType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductType query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductType whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductType whereUpdatedAt($value)
 */
	class ProductType extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

