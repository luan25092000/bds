<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'city_id', 
        'district_id', 
        'ward_id', 
        'room_count', 
        'is_invalid',
        'floor_count',
        'area',
        'project_id',
        'category_id',
        'manager_id',
        'description',
        'room_price',
        'water_price',
        'electricity_price',
        'status',
        'name'
    ];
    protected $table = "products";

    public function image() {
        return $this->morphMany(Media::class, 'imageable');
    }
}
