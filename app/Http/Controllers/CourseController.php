<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Subject;
use App\Models\User;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class CourseController
 * @package App\Http\Controllers
 */
class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::paginate();

        return view('course.index', compact('courses'))
            ->with('i', (request()->input('page', 1) - 1) * $courses->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $course = new Course();

        $subjects = collect(
            DB::select("SELECT s.id, CONCAT(s.name, ' by ', u.name, ' (', s.start_date, ' | ', s.finish_date, ')') AS name
                        FROM subjects s
                            INNER JOIN users u ON s.teacher_id = u.id
                        WHERE s.start_date >= NOW() AND s.status = 'ACTIVE' AND s.deleted_at IS NULL;")
                        )->pluck('name', 'id');

        $students = User::pluck('name', 'id');
        return view('course.create', compact('course','subjects', 'students'));
    }

    /**
     * Validate duplicated for student.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  unsignedBigInteger $id
     * @return boolean
     */
    private function isDuplicateForStudent(Request $request, $id = null){

        if($id){
            $duplicated = Course::where([
                ['subject_id', $request->subject_id],
                ['student_id', $request->student_id],
            ])->get()->count();
        }
        else{
            $duplicated = Course::where([
                ['subject_id', $request->subject_id],
                ['student_id', $request->student_id],
                ['id', '!=', $id],
            ])->get()->count();
        }

        return ($duplicated > 0) ? true : false;
    }

    /**
     * Validate the teacher can't be a student of the subject he teaches.
     *
     * @param  \Illuminate\Http\Request $request
     * @return boolean
     */
    private function isStudentTeacher($request){

        $subject = Subject::find($request->subject_id);

        return ($request->student_id == $subject->teacher_id) ? true : false;

    }

    /**
     * Validates the number of overlapping periods.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  unsignedBigInteger $id
     * @return boolean
     */
    private function isAnInvalidPeriod($request, $id = null){


        try {
            $configuredOverlays = intval(Setting::where('name','MAXIMUM_CONCURRENT_COURSES_PER_STUDENT')->first()->value);
        } catch (\Throwable $th) {
            $configuredOverlays = 0;
        }

        if($configuredOverlays > 0){
            $AND_where = $id ? "AND id <> $id" : "";

            $subject = Subject::find($request->subject_id);

            $numberOverlays = DB::select("SELECT COUNT(*) AS numberOverlays
                                        FROM courses c
                                            INNER JOIN subjects s ON c.subject_id = s.id
                                        WHERE c.student_id = $request->student_id
                                            AND s.start_date <= '$subject->finish_date'
                                            AND s.finish_date >= '$subject->start_date'
                                            AND c.deleted_at IS NULL
                                            $AND_where;"
                                        )[0]->numberOverlays;

            $rst = ($numberOverlays >= $configuredOverlays) ? true : false;
        }
        else{
            $rst = false;
        }

         return $rst;
    }

    /**
     * Get SQL insert payments.
     *
     * @param  unsignedBigInteger $subject_id
     * @param  unsignedBigInteger $course_id
     * @return String
     */
    private function getSQLPaymentsInserts($subject_id, $course_id){
        try {
            $paymentDueDay = Setting::where('name','PAYMENT_DUE_DATE_NUMBER')->first()->value;
            $paymentDueDay = ($paymentDueDay > 28) ? "10" : str_pad($paymentDueDay, 2, "0", STR_PAD_LEFT);
        } catch (\Throwable $th) {
            $paymentDueDay = "10";
        }

        try {
            $teacherRemunerationPercentage = intval(Setting::where('name','TEACHER_REMUNERATION_PERCENTAGE')->first()->value)/100;
        } catch (\Throwable $th) {
            $teacherRemunerationPercentage = 0;
        }

        $subject = Subject::find($subject_id)
                            ->selectRaw('ROUND(TIMESTAMPDIFF(DAY, start_date, finish_date)/30) AS months, start_date, monthly_price')
                            ->first();

        $sql = "INSERT INTO payments (expiration_date, amount, teacher_remuneration, course_id) VALUES ";

        for ($i=0; $i < intval($subject->months) ; $i++) {

            $startDate = date('Y-m-d', strtotime("+$i months", strtotime($subject->start_date)));

            $year = date("Y",strtotime($startDate));
            $month = date("m",strtotime($startDate));
            $day = $paymentDueDay;

            $expirationDate = "$year-$month-$day";
            $monthlyPrice = $subject->monthly_price;
            $teacherRemuneration = $monthlyPrice * $teacherRemunerationPercentage;

            $sql.= "('$expirationDate', $subject->monthly_price, $teacherRemuneration, $course_id), ";
        }

        $sql = substr_replace($sql, "", -2) . ";";

        return $sql;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if($this->isAnInvalidPeriod($request)){
            return back()->with('error', "The maximum number of concurrent courses for this student has been exceeded.")
            ->withInput();
        }

        if($this->isDuplicateForStudent($request)){
            return back()->with('error', "Course already exists for this student.")
            ->withInput();
        }

        if($this->isStudentTeacher($request)){
            return back()->with('error',"The teacher can't be a student of the subject he teaches.")
            ->withInput();
        }

        request()->validate(Course::$rules);

        $data = $request->all();

        try {
            //DB::connection()->pdo->beginTransaction();

            $course_id = Course::create($data)->id;

            $sqlCreatePayments = $this->getSQLPaymentsInserts($data['subject_id'], $course_id);

            DB::insert($sqlCreatePayments);

            //DB::connection()->pdo->commit();

            return redirect()->route('courses.index')
            ->with('success', 'Course created successfully.');

        } catch (\PDOException $e) {
            // Woopsy
            //DB::connection()->pdo->rollBack();

            return back()->with('error',"An error occurred while trying to save the records.")
                    ->withInput();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = Course::find($id);

        return view('course.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $course = Course::find($id);

        $subjects = collect(
            DB::select("SELECT s.id, CONCAT(s.name, ' by ', u.name, ' (', s.start_date, ' | ', s.finish_date, ')') AS name
                        FROM subjects s
                            INNER JOIN users u ON s.teacher_id = u.id
                        WHERE s.status = 'ACTIVE' AND s.deleted_at IS NULL;")
                        )->pluck('name', 'id');

        $students = User::pluck('name', 'id');
        return view('course.edit', compact('course','subjects', 'students'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Course $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        if($this->isAnInvalidPeriod($request, $course->id)){
            return back()->with('error', "The maximum number of concurrent courses for this student has been exceeded.")
                ->withInput();
        }

        if($this->isDuplicateForStudent($request, $course->id)){
            return back()->with('error', "Course already exists for this student")
                ->withInput();
        }

        if($this->isStudentTeacher($request)){
            return back()->with('error',"The teacher can't be a student of the subject he teaches.")
                ->withInput();
        }

        request()->validate(Course::$rules);

        $course->update($request->all());

        return redirect()->route('courses.index')
            ->with('success', 'Course updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $course = Course::find($id)->delete();

        return redirect()->route('courses.index')
            ->with('success', 'Course deleted successfully');
    }
}
