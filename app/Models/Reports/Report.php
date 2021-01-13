<?php

namespace App\Models\Reports;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Model;

class Report
{
    /**
     * @var \Illuminate\Database\Eloquent\Collection|Model[]
     */
    public $model;

    /**
     * @var \Illuminate\Database\Eloquent\Collection|Model[]
     */
    public $collection;

    public $exporter;

    /**
     * Report constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;

        $this->collection = Collect();
    }

    /**
     * Return array of collection.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->collection->toArray();
    }

    /**
     * Specify which relationships to load.
     *
     * @param $relations
     * @return $this
     */
    public function withRelations($relations)
    {
        $this->model = $this->model->load($relations);

        return $this;
    }

    /**
     * Return all models created between date range.
     *
     * @param $fromDate
     * @param $toDate
     * @return $this
     */
    public function createdBetween($fromDate, $toDate)
    {
        $this->collection->push(
            $this->model
                ->whereBetween('created_at', [$fromDate, $toDate])
                ->get());

        return $this;
    }

}
