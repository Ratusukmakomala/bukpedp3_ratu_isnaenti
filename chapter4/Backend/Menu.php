<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'name',
        'desc',
        'price',
        'image'
    ];

    public function image():Attribute
    {
        return Attribute::make(
            get: fn($value) => (empty($value)) ? null : asset('/storage/img/menu/'.$value)
        );
    }
}
