<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'file_name',
        'type',
        'legende',
        'gallery_page',
        'event_page_id',
        'page_id',
        'resident_page_id',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_page_id');
    }

    public function page()
    {
        return $this->belongsTo(Page::class, 'page_id');
    }

    public function resident()
    {
        return $this->belongsTo(Resident::class, 'resident_page_id');
    }

    public function getFileUrlAttribute()
    {
        if ($this->type === 'photo') {
            return asset('storage/media/photos/' . $this->file_name);
        }

        if ($this->type === 'video' && $this->isYoutubeLink($this->file_name)) {
            return $this->getEmbedUrl($this->file_name);
        }

        return null;
    }

    private function isYoutubeLink($url)
    {
        return preg_match('/youtube\.com\/watch\?v=/', $url);
    }

    private function getEmbedUrl($url)
    {
        preg_match('/v=([^&]+)/', $url, $matches);
        return isset($matches[1]) ? 'https://www.youtube.com/embed/' . $matches[1] : $url;
    }

}
