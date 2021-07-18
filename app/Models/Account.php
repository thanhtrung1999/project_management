<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Account extends Authenticatable
{
    use HasFactory;
    use SoftDeletes;
    use Notifiable;

    protected $table = "accounts";
    protected $guarded = "accounts";

    protected $fillable = [
        'email',
        'phone_number',
        'password',
        'accountable_id',
        'accountable_type',
    ];

    protected $hidden = ['password'];

    const ADMIN_ROLE = 'admin';
    const TEACHER_ROLE = 'teacher';
    const STUDENT_ROLE = 'student';

    const INVALID_ROLE = ['admin', 'teacher', 'student'];

    public function accountable()
    {
        return $this->morphTo();
    }
}
