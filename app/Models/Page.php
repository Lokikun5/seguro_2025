<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasProfilePic;

class Page extends Model
{
    use HasFactory,HasProfilePic;

    protected $fillable = [
        'title',
        'meta_title',
        'meta_description',
        'profile_pic',
        'introduce',
        'description',
        'type',
        'active',
        'slug',
    ];

    public function media()
    {
        return $this->hasMany(Media::class, 'page_id');
    }
}
