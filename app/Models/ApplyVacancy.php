<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplyVacancy extends Model
{
    protected $table = 'apply_vacancy';

    protected $fillable = [
        'vacancy_id', 'student_id', 'status', 'transcript', 'cv'
    ];

    public function vacancy() {
        return $this->belongsTo(Vacancy::class);
    }

    public function student() {
        return $this->belongsTo(Student::class);
    }
}