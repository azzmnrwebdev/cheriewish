<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PhoneNumber extends Model
{
    use HasFactory;

    protected $table = 'phone_numbers';
    protected $fillable = [
        'company_id',
        'phone_number',
    ];
}
