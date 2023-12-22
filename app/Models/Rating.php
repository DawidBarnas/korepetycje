<?php

namespace App\Models;

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'tutor_id',
        'user_id',
        'rating',
        'comment',
    ];

    public static $rules = [
        'comment' => 'nullable|string|max:255',
    ];

    public function tutor()
    {
        return $this->belongsTo(User::class, 'tutor_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
