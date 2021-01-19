<?php

namespace App\Models\Reports;

use App\Models\Agent;
use App\Models\Bookings\Booking;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Report
{
    const DEFAULT_TYPE = 'report';
    const DEFAULT_FILE_EXTENSION = '.xlsx';

    /**
     * @var \Illuminate\Database\Eloquent\Collection|Model[]
     */
    public $collection;

    /**
     * Report Type
     * @var
     */
    public $type;

    public $filename;

    public $exporter;

    public $agent;

    public $user;

    /**
     * Report constructor.
     *
     */
    public function __construct()
    {
        $this->collection = Collect();
        $this->type = $this->type();
        $this->filename = $this->filename();
        $this->user = \Auth::user();
    }

    /**
     * The filename for the export.
     *
     * @return string
     */
    public function filename(): string
    {
        return Str::random(6) . '_' . $this->type . $this->fileExtension();
    }

    /**
     * The file extension string.
     *
     * @return string
     */
    public function fileExtension(): string
    {
        return self::DEFAULT_FILE_EXTENSION;
    }

    /**
     * The report type string.
     *
     * @return string
     */
    public function type(): string
    {
        return self::DEFAULT_TYPE;
    }

    /**
     * Return array of collection.
     *
     * @return array
     */
    public function toArray(): array
    {
        return $this->collection->toArray();
    }

//    public function agent(Agent $agent)
//    {
//        $this->agent = $agent;
//
//        if ($this->agent) {
//            $filename = Carbon::now()->format('dmY') . '_' . $this->type . '_' . Str::slug(strtolower($this->agent->name));
//            $this->filename = $filename . $this->fileExtension();
//        }
//
//        return $this;
//    }



    public function collection()
    {
        return $this->collection;
    }

}
