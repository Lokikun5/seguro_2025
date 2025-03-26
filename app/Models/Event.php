<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasProfilePic;
use Carbon\Carbon;

class Event extends Model
{
    use HasFactory,HasProfilePic;

    protected $fillable = [
        'title',
        'meta_title',
        'meta_description',
        'profile_pic',
        'introduce',
        'description',
        'active',
        'slug',
        'start_date',
        'performance',
    ];

    // Accessor for start_date
    public function getStartDateAttribute($value)
    {
        Carbon::setLocale('fr');
        return Carbon::parse($value)->translatedFormat('d F Y');
    }

    // Method to get formatted date
    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = Carbon::parse($value)->format('Y-m-d');
    }

    public function media()
    {
        return $this->hasMany(Media::class, 'event_page_id');
    }
}
