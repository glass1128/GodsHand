<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonorsComments extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_name',
        'organisations_name',
        'organisations_id',
        'content',
    ];
}
