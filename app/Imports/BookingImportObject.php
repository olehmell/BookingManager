<?php


namespace App\Imports;


use App\Models\Bookings\Product;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class BookingImportObject
{
    /**
     * The booking reference.
     * @var
     */
    public $booking_ref;

    /**
     * The arrival date and time.
     * @var
     */
    public $arrival_date;

    /**
     * The return date and time.
     * @var
     */
    public $return_date;

    /**
     * The product id.
     * @var
     */
    public $product_id;

    /**
     * The agent id.
     * @var
     */
    public $agent_id;

    /**
     * The customer data.
     * @var
     */
    public $customer;

    /**
     * The vehicle data.
     * @var
     */
    public $vehicle;

    /**
     * The flight data.
     * @var
     */
    public $flight;

    /**
     * The price data.
     * @var
     */
    public $price;

    /**
     * The booking status.
     * @var
     */
    public $status;

    /**
     * The import data.
     * @var Collection
     */
    private $data;

    /**
     * The field mappings.
     * @var
     */
    protected $mappings;

    /**
     * BookingImportObject constructor.
     *
     * @param $data
     * @throws \Exception
     */
    public function __construct($data)
    {
        $this->data = collect($data)->whereNotNull();

        if ($this->mappings) {
            $this->execute();
        }
    }

    /**
     * Use mappings with the import.
     *
     * @param $mappings
     * @return $this
     * @throws \Exception
     */
    public function withMappings($mappings): BookingImportObject
    {
        $this->mappings = collect($mappings)->map(function ($item) {
            if (is_array($item)) {

                return collect($item)->map(function ($i) {

                    return strtolower($i);
                });
            } else {

                return strtolower($item);
            }
        });

        return $this->execute();
    }

    /**
     * Process the import data to create a BookingImportObject.
     *
     * @return $this
     * @throws \Exception
     */
    protected function execute(): BookingImportObject
    {
        $this->prepareData();

        foreach ($this->mappings as $key => $field) {
            $explode = explode(',', $field);

            if (!is_object($field) && count($explode) > 1) {
                $str = '';

                foreach ($explode as $k => $val) {
                    $str .= $this->data[(string)trim($val)] . ' ';

                    $this->$key = rtrim($str);
                }
            } elseif (is_object($field)) {

                foreach ($field as $k => $item) {

                    $this->$key[$k] = $this->data[(string)$item] ?? '';
                }
            } elseif (isset($this->data[(string)$field])) {

                $this->$key = $this->data[(string)$field];
            } else {

                $this->$key = (string)$field ?? $this->$key;
            }
        }

        $this->formatter();

        return $this;
    }

    /**
     * Perform the formatting and casting of properties.
     */
    protected function formatter()
    {
        foreach ($this->getProperties() as $property) {
            $name = $property->name;

            if (is_string($this->$name) && strtotime((string)$this->$name)) {
                $this->$name = Carbon::parse((string)$this->$name)->format('d/m/Y H:i');
            }

            if (is_array($this->$name)) {
                $this->$name = collect($this->$name);
            }
        }
    }

    /**
     * Get properties of BookingImportObject class.
     *
     * @return \ReflectionProperty[]
     */
    protected function getProperties()
    {
        return (new \ReflectionClass(self::class))->getProperties(\ReflectionProperty::IS_PUBLIC);
    }

    /**
     * Prepare the data and ensure valid product_id and agent_id are present. Without this
     * we run the risk to breaking the import and generating an exception. If none is found then
     * a default product_id and agent_id is used which is set by the ImportMapping object.
     * @throws \Exception
     */
    protected function prepareData()
    {
        if (!isset($this->data['product_id'])) {
            // Need to add in a way to map products to agents and then check for a 'product' field
            // to use to search the database for a valid product mapping.

            if (!isset($this->mappings['product_id'])) {
                throw new \Exception('A valid product_id must be provided to import a booking.');
            }

            $this->data['product_id'] = $this->mappings['product_id'];
        }

        if (!isset($this->data['agent_id'])) {

            if (!isset($this->mappings['agent_id'])) {
                throw new \Exception('A valid agent_id must be provided to import a booking.');
            }
            $this->data['agent_id'] = $this->mappings['agent_id'];
        }
    }

    public function toArray()
    {
        $collection = collect();

        foreach ($this->getProperties() as $property) {
            $name = $property->name;

            $collection->put($name, $this->$name);
        }
        return $collection;
    }


}
