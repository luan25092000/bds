<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','address','status','manager_id', 'view'];
    protected $table = "projects";

    public function image() {
        return $this->morphMany(Media::class, 'imageable');
    }
}
