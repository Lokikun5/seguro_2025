<?php
namespace App\Models\Traits;

trait HasProfilePic
{
    public function getProfilePicAttribute($value)
    {
        if (is_null($value) || $value === '') {
            return asset('images/residents/seguro-default.webp');
        }

        // Si le chemin commence déjà par 'storage/', on l'utilise tel quel
        if (str_starts_with($value, 'storage/')) {
            return asset($value);
        }

        // Sinon on suppose que c'est encore une ancienne image dans images/residents
        return asset('images/residents/' . $value);
    }
}