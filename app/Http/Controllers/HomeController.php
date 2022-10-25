<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Subject;
use App\Models\Payment;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $students = User::where('role', 'STUDENT')->get()->count();

        $teachers = User::where('role', 'TEACHER')->get()->count();

        $studentsInCourses = Course::groupBy('student_id')->select('student_id')->get()->count();

        $paymentsPaid = Payment::whereNotNull('payment_date')->get()->count();

        $pendingPayments = Payment::whereNull('payment_date')->get()->count();

        $remunerationsPaid = Payment::whereNotNull('teacher_remuneration_payment_date')->get()->count();

        $pendingRemunerations = Payment::whereNull('teacher_remuneration_payment_date')->get()->count();

        $usersActive = User::get()->count();

        return view('home', compact(
                'students',
                'teachers',
                'studentsInCourses',
                'paymentsPaid',
                'pendingPayments',
                'pendingRemunerations',
                'remunerationsPaid',
                'usersActive',
            )
        );
    }
}
