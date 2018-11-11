<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DrugBatch extends Model
{
    protected $guarded = [];

    /**
     * Hook into the booting process of the model.
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($batch) {
            $batch->number = 'batch-'.time();
        });
    }

    public static function sale($drugSale)
    {
        $batch = static::where([
            'number'=>$drugSale->batch_number,
        ])->firstOrFail();

        $drugSale->unit_price = $batch->unit_price;

        $batch->quantity -= $drugSale->quantity;

        $batch->save();
    }
}
