<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

/**
 * Class PaymentController
 * @package App\Http\Controllers
 */
class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($filter = null)
    {
        switch ($filter) {
            case 'pending_payments':
                if (Auth::user()->role == 'ADMINISTRATOR')
                    $payments = Payment::whereNull('payment_date')
                        ->orderBy('teacher_remuneration_payment_date', 'ASC')
                        ->orderBy('payment_date', 'ASC')
                        ->orderBy('expiration_date', 'ASC');
                elseif (Auth::user()->role == 'TEACHER'){
                    $payments = Payment::join('courses', 'payments.course_id', '=','courses.id')
                        ->join('subjects', 'courses.subject_id', '=','subjects.id')
                        ->whereNull('payment_date')
                        ->where('subjects.teacher_id', Auth::id())
                        ->orderBy('teacher_remuneration_payment_date', 'ASC')
                        ->orderBy('payment_date', 'ASC')
                        ->orderBy('expiration_date', 'ASC');
                }
                elseif (Auth::user()->role == 'STUDENT'){
                    $payments = Payment::join('courses', 'payments.course_id', '=','courses.id')
                        ->whereNull('payment_date')
                        ->where('courses.student_id', Auth::id())
                        ->orderBy('teacher_remuneration_payment_date', 'ASC')
                        ->orderBy('payment_date', 'ASC')
                        ->orderBy('expiration_date', 'ASC');
                }
                $title = 'Pending Payments';
                break;

            case 'payments_paid':
                if (Auth::user()->role == 'ADMINISTRATOR'){
                    $payments = Payment::whereNotNull('payment_date')
                        ->orderBy('teacher_remuneration_payment_date', 'ASC')
                        ->orderBy('payment_date', 'ASC')
                        ->orderBy('expiration_date', 'ASC');
                }
                elseif (Auth::user()->role == 'TEACHER'){
                    $payments = Payment::join('courses', 'payments.course_id', '=','courses.id')
                        ->join('subjects', 'courses.subject_id', '=','subjects.id')
                        ->whereNotNull('payment_date')
                        ->where('subjects.teacher_id', Auth::id())
                        ->orderBy('expiration_date', 'ASC')
                        ->orderBy('teacher_remuneration_payment_date', 'ASC')
                        ->orderBy('payment_date', 'ASC')
                        ->orderBy('expiration_date', 'ASC');
                }
                elseif (Auth::user()->role == 'STUDENT'){
                    $payments = Payment::join('courses', 'payments.course_id', '=','courses.id')
                        ->whereNotNull('payment_date')
                        ->where('courses.student_id', Auth::id())
                        ->orderBy('teacher_remuneration_payment_date', 'ASC')
                        ->orderBy('payment_date', 'ASC')
                        ->orderBy('expiration_date', 'ASC');
                }
                $title = 'Payments Paid';
                break;

            case 'pending_remunerations':
                if (Auth::user()->role == 'ADMINISTRATOR'){
                    $payments = Payment::whereNull('teacher_remuneration_payment_date')
                        ->orderBy('teacher_remuneration_payment_date', 'ASC')
                        ->orderBy('payment_date', 'ASC')
                        ->orderBy('expiration_date', 'ASC');

                }
                elseif (Auth::user()->role == 'TEACHER'){
                    $payments = Payment::join('courses', 'payments.course_id', '=','courses.id')
                        ->join('subjects', 'courses.subject_id', '=','subjects.id')
                        ->whereNull('teacher_remuneration_payment_date')
                        ->where('subjects.teacher_id', Auth::id())
                        ->orderBy('teacher_remuneration_payment_date', 'ASC')
                        ->orderBy('payment_date', 'ASC')
                        ->orderBy('expiration_date', 'ASC');

                }
                elseif (Auth::user()->role == 'STUDENT'){
                    $payments = Payment::join('courses', 'payments.course_id', '=','courses.id')
                        ->whereNull('teacher_remuneration_payment_date')
                        ->where('courses.student_id', Auth::id())
                        ->orderBy('teacher_remuneration_payment_date', 'ASC')
                        ->orderBy('payment_date', 'ASC')
                        ->orderBy('expiration_date', 'ASC');

                }
                $title = 'Pending Remunerations';
                break;

            case 'remunerations_paid':
                if (Auth::user()->role == 'ADMINISTRATOR'){
                    $payments = Payment::whereNotNull('teacher_remuneration_payment_date')
                        ->orderBy('teacher_remuneration_payment_date', 'ASC')
                        ->orderBy('payment_date', 'ASC')
                        ->orderBy('expiration_date', 'ASC');;
                }
                elseif (Auth::user()->role == 'TEACHER'){
                    $payments = Payment::join('courses', 'payments.course_id', '=','courses.id')
                        ->join('subjects', 'courses.subject_id', '=','subjects.id')
                        ->where('subjects.teacher_id', Auth::id())
                        ->whereNotNull('teacher_remuneration_payment_date')
                        ->orderBy('teacher_remuneration_payment_date', 'ASC')
                        ->orderBy('payment_date', 'ASC')
                        ->orderBy('expiration_date', 'ASC');;
                }
                elseif (Auth::user()->role == 'STUDENT'){
                    $payments = Payment::join('courses', 'payments.course_id', '=','courses.id')
                        ->where('courses.student_id', Auth::id())
                        ->whereNotNull('teacher_remuneration_payment_date')
                        ->orderBy('teacher_remuneration_payment_date', 'ASC')
                        ->orderBy('payment_date', 'ASC')
                        ->orderBy('expiration_date', 'ASC');;
                }
                $title = 'Remunerations Paid';
                break;

            default:
                if (Auth::user()->role == 'ADMINISTRATOR'){
                    $payments = Payment::orderBy('teacher_remuneration_payment_date', 'ASC')
                        ->orderBy('payment_date', 'ASC')
                        ->orderBy('expiration_date', 'ASC');
                }
                elseif (Auth::user()->role == 'TEACHER'){
                    $payments = Payment::join('courses', 'payments.course_id', '=','courses.id')
                        ->join('subjects', 'courses.subject_id', '=','subjects.id')
                        ->where('subjects.teacher_id', Auth::id())
                        ->orderBy('teacher_remuneration_payment_date', 'ASC')
                        ->orderBy('payment_date', 'ASC')
                        ->orderBy('expiration_date', 'ASC');
                }
                elseif (Auth::user()->role == 'STUDENT'){
                    $payments = Payment::join('courses', 'payments.course_id', '=','courses.id')
                        ->where('courses.student_id', Auth::id())
                        ->orderBy('payment_date', 'ASC')
                        ->orderBy('expiration_date', 'ASC');
                }
                $title = 'Payments';
        }

        $payments = $payments->paginate();

        if (Auth::user()->role == 'ADMINISTRATOR'){
            $pendingPayments = Payment::whereNull('payment_date')->get()->count();
            $paymentsPaid = Payment::whereNotNull('payment_date')->get()->count();
            $pendingRemunerations = Payment::whereNull('teacher_remuneration_payment_date')->get()->count();
            $remunerationsPaid = Payment::whereNotNull('teacher_remuneration_payment_date')->get()->count();
            $paymentsAll = Payment::get()->count();
        }
        elseif (Auth::user()->role == 'TEACHER'){
            $pendingPayments = Payment::join('courses', 'payments.course_id', '=','courses.id')
                ->join('subjects', 'courses.subject_id', '=','subjects.id')
                ->where('subjects.teacher_id', Auth::id())
                ->whereNull('payment_date')->get()->count();
            $paymentsPaid = Payment::join('courses', 'payments.course_id', '=','courses.id')
                ->join('subjects', 'courses.subject_id', '=','subjects.id')
                ->where('subjects.teacher_id', Auth::id())
                ->whereNotNull('payment_date')->get()->count();
            $pendingRemunerations = Payment::join('courses', 'payments.course_id', '=','courses.id')
                ->join('subjects', 'courses.subject_id', '=','subjects.id')
                ->where('subjects.teacher_id', Auth::id())
                ->whereNull('teacher_remuneration_payment_date')->get()->count();
            $remunerationsPaid = Payment::join('courses', 'payments.course_id', '=','courses.id')
                ->join('subjects', 'courses.subject_id', '=','subjects.id')
                ->where('subjects.teacher_id', Auth::id())
                ->whereNotNull('teacher_remuneration_payment_date')->get()->count();
            $paymentsAll = Payment::join('courses', 'payments.course_id', '=','courses.id')
                ->join('subjects', 'courses.subject_id', '=','subjects.id')
                ->where('subjects.teacher_id', Auth::id())
                ->get()->count();
        }
        elseif (Auth::user()->role == 'STUDENT'){
            $pendingPayments = Payment::join('courses', 'payments.course_id', '=','courses.id')
                ->where('courses.student_id', Auth::id())
                ->whereNull('payment_date')->get()->count();
            $paymentsPaid = Payment::join('courses', 'payments.course_id', '=','courses.id')
                ->where('courses.student_id', Auth::id())
                ->whereNotNull('payment_date')->get()->count();
            $pendingRemunerations = Payment::join('courses', 'payments.course_id', '=','courses.id')
                ->where('courses.student_id', Auth::id())
                ->whereNull('teacher_remuneration_payment_date')->get()->count();
            $remunerationsPaid = Payment::join('courses', 'payments.course_id', '=','courses.id')
                ->where('courses.student_id', Auth::id())
                ->whereNotNull('teacher_remuneration_payment_date')->get()->count();
            $paymentsAll = Payment::join('courses', 'payments.course_id', '=','courses.id')
                ->where('courses.student_id', Auth::id())
                ->get()->count();
        }

        return view('payment.index', compact('payments', 'title', 'pendingPayments', 'paymentsPaid', 'pendingRemunerations', 'remunerationsPaid', 'paymentsAll'))
            ->with('i', (request()->input('page', 1) - 1) * $payments->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $payment = new Payment();
        $courses = Course::join('subjects', 'courses.subject_id', '=', 'subjects.id')
                        ->join('users AS teachers', 'subjects.teacher_id', '=', 'teachers.id')
                        ->join('users AS students', 'courses.student_id', '=', 'students.id')
                        ->selectRaw("courses.id, CONCAT(students.name, ' IN ', subjects.name, ' BY ', teachers.name, ' (', subjects.start_date, ' | ', subjects.finish_date, ')') AS name")
                        ->get()->pluck('name', 'id');

        return view('payment.create', compact('payment', 'courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->teacher_remuneration_payment_date && !$request->payment_date){
            return back()->with('error', "If there is a data in the field teacher remuneration payment date, there must be a data in the field payment date.")
                ->withInput();
        }

        request()->validate(Payment::$rules);

        $payment = Payment::create($request->all());

        return redirect()->route('payments.index')
            ->with('success', 'Payment created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $payment = Payment::find($id);

        return view('payment.show', compact('payment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $payment = Payment::find($id);
        $courses = Course::join('subjects', 'courses.subject_id', '=', 'subjects.id')
                        ->join('users AS teachers', 'subjects.teacher_id', '=', 'teachers.id')
                        ->join('users AS students', 'courses.student_id', '=', 'students.id')
                        ->selectRaw("courses.id, CONCAT(students.name, ' IN ', subjects.name, ' BY ', teachers.name, ' (', subjects.start_date, ' | ', subjects.finish_date, ')') AS name")
                        ->withTrashed()
                        ->get()->pluck('name', 'id');

        return view('payment.edit', compact('payment', 'courses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Payment $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        if($request->teacher_remuneration_payment_date && !$request->payment_date){
            return back()->with('error', "If there is a data in the field teacher remuneration payment date, there must be a data in the field payment date.")
                ->withInput();
        }

        request()->validate(Payment::$rules);

        $payment->update($request->all());

        return redirect()->route('payments.index')
            ->with('success', 'Payment updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $payment = Payment::find($id)->delete();

        return redirect()->route('payments.index')
            ->with('success', 'Payment deleted successfully');
    }
}
