<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Lecture;
use App\Models\CourseSchedule;



class Course extends Model
{
    /** @use HasFactory<\Database\Factories\CourseFactory> */
    use HasFactory;
    protected $table = 'course';
    
    protected $guarded = [];

    public function lecturers()
    {
        return $this->belongsToMany(Lecture::class, 'course_lecturer', 'course_id', 'lecture_id');
    }

    public function schedules()
    {
        return $this->hasMany(CourseSchedule::class, 'course_id');
    }

    
}