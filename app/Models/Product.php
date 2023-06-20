<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Casts\Attribute;


class Product extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = ['name','slug','price'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
            ]
        ];
    }

        public function price(): Attribute
    {
        return Attribute::make(
            get: fn (int $value) => $value / 100,
            set: fn (int $value) => $value * 100,
        );
    }

 /**
     * Get the user's name.
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ucfirst($value),
        );
    }
}
