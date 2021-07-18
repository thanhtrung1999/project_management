<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "students";

    protected $fillable = [
        'name', 'student_code', 'age', 'gender', 'date_of_birth', 'class', 'specialized_training', 'address'
    ];

    public function account()
    {
        return $this->morphOne(Account::class, 'accountable');
    }

    /**
     * The teachers that belong to the Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function teachers(): BelongsToMany
    {
        return $this->belongsToMany(Teacher::class, 'student_teacher', 'student_id', 'teacher_id');
    }

    /**
     * Get all of the projects for the Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projects(): HasMany
    {
        return $this->hasMany(Project::class, 'student_id', 'id');
    }

    /**
     * Get all of the documents for the Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function documents(): HasManyThrough
    {
        return $this->hasManyThrough(Document::class, Project::class, 'student_id', 'project_id', 'id', 'id');
    }
}
