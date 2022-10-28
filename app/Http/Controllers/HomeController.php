<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Subject;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        return view('home', $this->getVars(Auth::user()->role, Auth::id()));
    }



    private function getVars($role, $id){

        switch ($role) {
            case 'ADMINISTRATOR':
                $students = User::where('role', 'STUDENT')->get()->count();
                $teachers = User::where('role', 'TEACHER')->get()->count();
                $studentsInCourses = Course::groupBy('student_id')->select('student_id')->get()->count();
                $subjectCourses = Course::groupBy('subject_id')->select('subject_id')->get()->count();
                $paymentsPaid = Payment::whereNotNull('payment_date')->get()->count();
                $pendingPayments = Payment::whereNull('payment_date')->get()->count();
                $remunerationsPaid = Payment::whereNotNull('teacher_remuneration_payment_date')->get()->count();
                $pendingRemunerations = Payment::whereNull('teacher_remuneration_payment_date')->get()->count();
                $usersActive = User::get()->count();
                $subjectsActive = Subject::where('status', 'ACTIVE')->get()->count();

                $rst = compact(
                    'students',
                    'teachers',
                    'studentsInCourses',
                    'paymentsPaid',
                    'pendingPayments',
                    'pendingRemunerations',
                    'remunerationsPaid',
                    'usersActive',
                    'subjectCourses',
                    'subjectsActive',
                );
                break;

            case 'TEACHER':
                $subjectsInProgress = DB::select("SELECT COUNT(DISTINCT c.subject_id) AS subProgress
                                                    FROM courses c
                                                        INNER JOIN subjects s on c.subject_id = s.id
                                                    WHERE s.teacher_id = $id
                                                        AND CURRENT_DATE() BETWEEN s.start_date AND s.finish_date
                                                        AND c.deleted_at IS NULL
                                                        AND s.deleted_at IS NULL")[0]->subProgress;

                $currentStudents = Course::join('users', 'courses.student_id', '=', 'users.id')
                    ->join('subjects', 'courses.subject_id', '=', 'subjects.id')
                    ->where('teacher_id', $id)
                    ->where('start_date', '<=', now())
                    ->where('finish_date', '>=', now())
                    ->where('status', 'ACTIVE')
                    ->get()->count();

                $remunerationCurrentMonth = DB::select("SELECT IFNULL(SUM(p.teacher_remuneration), 0) as rem
                                                        FROM courses c
                                                            INNER JOIN payments p on c.id = p.course_id
                                                            INNER JOIN subjects s on c.subject_id = s.id
                                                        WHERE s.teacher_id = $id
                                                            AND YEAR(p.expiration_date) = YEAR(CURRENT_DATE())
                                                            AND MONTH(p.expiration_date) = MONTH(CURRENT_DATE())
                                                            AND c.deleted_at IS NULL
                                                            AND s.deleted_at IS NULL
                                                            AND p.deleted_at IS NULL")[0]->rem;

                $remunerationBalance = DB::select("SELECT IFNULL(SUM(p.teacher_remuneration), 0) as bal
                                                    FROM courses c
                                                        INNER JOIN payments p on c.id = p.course_id
                                                        INNER JOIN subjects s on c.subject_id = s.id
                                                    WHERE s.teacher_id = $id
                                                        AND p.expiration_date < CURRENT_DATE()
                                                        AND p.teacher_remuneration_payment_date IS NULL
                                                        AND c.deleted_at IS NULL
                                                        AND s.deleted_at IS NULL
                                                        AND p.deleted_at IS NULL")[0]->bal;

                $rst = compact(
                    'currentStudents',
                    'subjectsInProgress',
                    'remunerationCurrentMonth',
                    'remunerationBalance',
                );
                break;

            case 'STUDENT':
                $dueDateNext = Payment::join('courses', 'courses.id', '=', 'payments.course_id')
                    ->where('courses.student_id', $id)
                    ->whereNull('payments.payment_date')
                    ->orderBy('payments.payment_date', 'ASC')
                    ->first();

                $dueDateNext = isset($dueDateNext->expiration_date) ? $dueDateNext->expiration_date : 'No';

                $currentMonthDebt = DB::select("SELECT IFNULL(SUM(p.amount), 0) AS debt
                                                FROM courses c
                                                    INNER JOIN payments p ON c.id = p.course_id
                                                    INNER JOIN subjects s ON c.subject_id = s.id
                                                WHERE c.student_id = $id
                                                    AND YEAR(p.expiration_date) = YEAR(CURRENT_DATE())
                                                    AND MONTH(p.expiration_date) = MONTH(CURRENT_DATE())
                                                    AND p.payment_date IS NULL
                                                    AND c.deleted_at IS NULL
                                                    AND s.deleted_at IS NULL
                                                    AND p.deleted_at IS NULL")[0]->debt;

                $totalDebt = DB::select("SELECT IFNULL(SUM(p.amount), 0) AS debt
                                            FROM courses c
                                                INNER JOIN payments p ON c.id = p.course_id
                                                INNER JOIN subjects s ON c.subject_id = s.id
                                            WHERE c.student_id = $id
                                                AND p.payment_date IS NULL
                                                AND c.deleted_at IS NULL
                                                AND s.deleted_at IS NULL
                                                AND p.deleted_at IS NULL")[0]->debt;

                $subjectsInProgress = Course::join('subjects', 'courses.subject_id', '=', 'subjects.id')
                    ->where('student_id', $id)
                    ->where('start_date', '<=', now())
                    ->where('finish_date', '>=', now())
                    ->where('status', 'ACTIVE')
                    ->get()->count();

                $rst = compact(
                    'currentMonthDebt',
                    'subjectsInProgress',
                    'dueDateNext',
                    'totalDebt',
                );
                break;

            default:
                $rst = null;
                break;
        }

        return $rst;
    }
}
