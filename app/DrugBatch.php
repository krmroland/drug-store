<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DrugBatch extends Model
{
    protected $guarded = [];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($batch) {
            $batch->number = 'batch-'.time();
        });
    }
}
