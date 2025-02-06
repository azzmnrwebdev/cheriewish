<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory;

    protected $table = 'companies';
    protected $fillable = [
        'logo',
        'name',
        'email',
        'phone_number',
        'shopee',
        'facebook',
        'instagram',
        'tiktok',
        'twitter',
        'address',
        'short_description',
        'description',
    ];
}
