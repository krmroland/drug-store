<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DrugSale extends Model
{
    protected $fillable = ['sale_id', 'drug_id', 'quantity', 'batch_number'];

    public static function process($sale_id, $data)
    {
        return static::create([
            'sale_id'=>$sale_id,
            'drug_id'=>$data['id'],
            'quantity'=>$data['quantity'],
            'batch_number'=>$data['batchNumber'],
        ]);
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function ($drugSale) {
            DrugBatch::sale($drugSale);
        });
    }

    public function drug()
    {
        return $this->belongsTo(Drug::class);
    }

    public function batch()
    {
        return $this->hasOne(DrugBatch::class, 'number', 'batch_number');
    }
}
