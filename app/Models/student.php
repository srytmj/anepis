<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class student extends Model
{
    /** @use HasFactory<\Database\Factories\StudentFactory> */
    use HasFactory;

    protected $table = 'student';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'foreignid');
    }

// Relasi ke jadwal yang dia input
    public function schedules()
    {
        return $this->hasMany(StudentSchedule::class, 'student_id');
    }

    public function applications()
    {
        return $this->hasMany(ApplyVacancy::class, 'student_id');
    }

}
