<?php

namespace App;

use Illuminate\Support\Carbon;

class Report
{
    public function __construct($from, $to)
    {
        $this->from = $from;
        $this->to = $to;
    }

    public static function generate($range)
    {
        [$from, $to] = collect(explode('to', $range))->map(function ($date) {
            return  new Carbon(trim($date));
        })->toArray();

        return  ( new static($from, $to))->getData();
    }

    public function getData()
    {
        $builder = Sale::whereBetween('sold_at', [$this->from, $this->to]);

        return Sale::addTotals($builder);
    }
}
