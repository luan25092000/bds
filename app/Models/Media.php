<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['image_src', 'imageable_id', 'imageable_type'];
    protected $table = "medias";

    /**
     * Get the parent imageable model (article, product).
     */
    public function imageable() {
        return $this->morphTo();
    }
}
