<?php

// TutorSubject.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TutorSubject extends Model
{
    protected $table = 'tutor_subjects';

    protected $fillable = ['tutor_id', 'subject_id'];

    public function tutor()
    {
        return $this->belongsTo(User::class, 'tutor_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}

