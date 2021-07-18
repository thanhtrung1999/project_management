<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "teachers";

    protected $fillable = [
        'name', 'age', 'gender', 'date_of_birth', 'address'
    ];

    public function account()
    {
        return $this->morphOne(Account::class, 'accountable');
    }

    /**
     * The students that belong to the Teacher
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'student_teacher', 'teacher_id', 'student_id');
    }

    /**
     * Get all of the projects for the Teacher
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projects(): HasMany
    {
        return $this->hasMany(Project::class, 'teacher_id', 'id');
    }

    /**
     * Get all of the documents for the Teacher
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function documents(): HasManyThrough
    {
        return $this->hasManyThrough(Document::class, Project::class, 'teacher_id', 'project_id', 'id', 'id');
    }
}
