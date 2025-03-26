<?php
namespace App\Models\Traits;

trait HasProfilePic
{
    public function getProfilePicAttribute($value)
    {
        if (is_null($value) || $value == '') {
            return asset('images/residents/seguro-default.webp');
        } else {
            return asset('images/residents/' . $value);
        }
    }
}