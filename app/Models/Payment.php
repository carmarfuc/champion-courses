<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Payment
 *
 * @property $id
 * @property $expiration_date
 * @property $payment_date
 * @property $status
 * @property $amount
 * @property $teacher_remuneration
 * @property $course_id
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * @property Course $course
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Payment extends Model
{
    use SoftDeletes;

    static $rules = [
		'expiration_date' => 'required|date',
        'payment_date' => 'nullable|date',
		'amount' => 'required|regex:/^\d+(\.\d{1,2})?$/',
		'teacher_remuneration' => 'required|regex:/^\d+(\.\d{1,2})?$/',
		'course_id' => 'required|numeric',
        'teacher_remuneration_payment_date' => 'nullable|date',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['expiration_date','payment_date','teacher_remuneration_payment_date','amount','teacher_remuneration','course_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function course()
    {
        return $this->hasOne('App\Models\Course', 'id', 'course_id')->withTrashed();
    }


}
