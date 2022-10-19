<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Subject
 *
 * @property $id
 * @property $name
 * @property $slug
 * @property $description
 * @property $monthly_price
 * @property $start_date
 * @property $finish_date
 * @property $active
 * @property $teacher_id
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * @property Course[] $courses
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Subject extends Model
{
    use SoftDeletes;

    static $rules = [
		'name' => 'required|min:3|max:150',
		'slug' => 'required|unique:subjects|max:255',
		'monthly_price' => 'required|numeric',
		'start_date' => 'required|date',
		'finish_date' => 'required|date',
		'teacher_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','slug','description','monthly_price','start_date','finish_date','active','teacher_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function courses()
    {
        return $this->hasMany('App\Models\Course', 'subject_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'teacher_id');
    }


}
