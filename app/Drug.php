<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Drug extends Model
{
    protected $fillable = ['name'];

    public function batches()
    {
        return $this->hasMany(DrugBatch::class)->latest('quantity');
    }

    public function delete()
    {
        $this->batches()->delete();

        parent::delete();
    }

    public function addBatch($data)
    {
        return  $this->batches()->create($data);
    }

    public static function withQuantities()
    {
        return static::withCount('batches')->get();
    }

    public function scopeHasBatches($builder)
    {
        return $builder->with(['batches'=>function ($query) {
            return $query->where('quantity', '>', '0');
        }]);
    }
}
