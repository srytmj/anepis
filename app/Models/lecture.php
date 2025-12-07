<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Course;

class Lecture extends Model
{
    /** @use HasFactory<\Database\Factories\LectureFactory> */
    use HasFactory;

    protected $table = 'lecture';

    protected $guarded = [];

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_lecturer', 'lecture_id', 'course_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'foreignid');
    }
}