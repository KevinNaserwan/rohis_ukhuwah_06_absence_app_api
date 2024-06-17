<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
    use HasFactory;

    protected $table = 'absences';

    protected $fillable = [
        'student_id',
        'date',
        'status',
    ];

    /**
     * Get the user that owns the absence.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
