<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplyVacancy extends Model
{
    protected $table = 'apply_vacancy';

    protected $guarded = [];

    public function vacancy() {
        return $this->belongsTo(Vacancy::class);
    }

    public function student() {
        return $this->belongsTo(Student::class);
    }
}