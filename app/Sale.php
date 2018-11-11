<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sale extends Model
{
    protected $fillable = ['sold_at', 'client_name'];

    public static function process($data)
    {
        return  DB::transaction(function () use ($data) {
            $sale = static::create(['sold_at'=>$data['date']]);
            $sale->processCart($data['cart']);

            return $sale;
        });
    }

    public function drugs()
    {
        return $this->hasMany(DrugSale::class);
    }

    /**
     * Hook into the booting process of the model.
     */
    public static function boot()
    {
        parent::boot();
        static::creating(function ($sale) {
            $sale->invoice_number = 'invoice-'.time();
        });
    }

    public function processCart($cart)
    {
        collect($cart)->each(function ($data) {
            DrugSale::process($this->id, $data);
        });
    }

    public static function summaryData()
    {
        return static::addTotals(static::query());
    }

    public static function addTotals($builder)
    {
        return $builder->with('drugs')->get()->map(function ($sale) {
            $sale['total'] = $sale->drugs->sum(function ($drug) {
                return $drug->quantity * $drug->unit_price;
            });
            unset($sale['drugs']);

            return $sale;
        });
    }
}
