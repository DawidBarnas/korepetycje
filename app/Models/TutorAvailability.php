<?php

// app/Models/TutorAvailability.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TutorAvailability extends Model
{
    use HasFactory;

    protected $fillable = ['tutor_id', 'date', 'hour', 'user_id', 'is_available'];

    public function tutor()
    {
        return $this->belongsTo(User::class, 'tutor_id');
    }

    public function reservedBy()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
