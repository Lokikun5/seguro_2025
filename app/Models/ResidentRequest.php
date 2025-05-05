<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ResidentRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'start_date',
        'end_date',
        'formules',
        'status',
    ];

    protected $casts = [
        'formules' => 'array',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

        public static function updateExpiredStatuses()
    {
        static::where('end_date', '<', Carbon::today())
            ->where('status', '!=', 'terminee')
            ->update(['status' => 'terminee']);
    }
}