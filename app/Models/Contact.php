<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'category_id',
        'mobile',
        'email',
        'facebook',
        'instagram',
        'youtube',
        'address',
        'dob',
        'picture',
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
