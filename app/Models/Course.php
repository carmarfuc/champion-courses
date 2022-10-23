<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Course
 *
 * @property $id
 * @property $final_score
 * @property $subject_id
 * @property $student_id
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * @property Payment[] $payments
 * @property Subject $subject
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Course extends Model
{
    use SoftDeletes;

    static $rules = [
		'subject_id' => 'required|numeric',
		'student_id' => 'required|numeric',
        'final_score' => 'numeric|min:1|max:10|nullable',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['final_score','subject_id','student_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payments()
    {
        return $this->hasMany('App\Models\Payment', 'course_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function subject()
    {
        return $this->hasOne('App\Models\Subject', 'id', 'subject_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'student_id');
    }

    /**
     * @return String
     */
    public function getNameWithTeacherAttribute()
    {
        return $this->subject->name . ' - ' . $this->user->name;
    }

}
