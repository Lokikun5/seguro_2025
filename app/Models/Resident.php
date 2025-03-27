<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Resident extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'nationality',
        'performance',
        'introduce',
        'description',
        'profile_pic',
        'linkedin_slug',
        'instagram_slug',
        'active',
        'meta_title',
        'meta_description',
        'resident_slug'
    ];

    // Auto-génération du slug
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->resident_slug = Str::slug($model->first_name . ' ' . $model->last_name);
        });

        static::updating(function ($model) {
            $model->resident_slug = Str::slug($model->first_name . ' ' . $model->last_name);
        });
    }

    public function media()
    {
        return $this->hasMany(Media::class, 'resident_page_id');
    }

    // ✅ Accesseur pour récupérer l'URL complète de la photo (avec fallback)
    public function getProfilePicUrlAttribute()
    {
        if ($this->profile_pic && file_exists(public_path($this->profile_pic))) {
            return asset($this->profile_pic);
        }

        return asset('images/residents/seguro-default.webp');
    }
}