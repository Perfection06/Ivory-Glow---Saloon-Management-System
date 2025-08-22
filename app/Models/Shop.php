<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'address',
        'phone',
        'email',
        'opening_hours',
        'facebook_url',
        'instagram_url',
        'twitter_url',
        'map_embed_url'
    ];
}