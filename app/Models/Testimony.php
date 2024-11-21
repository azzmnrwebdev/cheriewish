<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Testimony extends Model
{
    use HasFactory;

    protected $table = 'testimonies';
    protected $fillable = [
        'product_id',
        'name',
        'description',
        'stars',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
