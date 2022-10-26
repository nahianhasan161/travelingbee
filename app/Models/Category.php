<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
        'updated'  => 'date:d-m-Y',
    ];

    public function places()
    {
        return $this->hasMany(Place::class);
    }
}
