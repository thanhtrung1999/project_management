<?php

namespace App\Repositories;

use App\Models\Teacher;

class TeacherRepository extends BaseRepository
{
    public function model()
    {
        return Teacher::class;
    }
}
