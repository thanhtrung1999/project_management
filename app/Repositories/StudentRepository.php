<?php

namespace App\Repositories;

use App\Models\Student;

class TeacherRepository extends BaseRepository
{
    public function model()
    {
        return Student::class;
    }
}
