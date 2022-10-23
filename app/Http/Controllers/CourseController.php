<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Subject;
use App\Models\User;
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
                        WHERE s.status = 'ACTIVE' AND s.deleted_at IS NULL;")
                        )->pluck('name', 'id');

        $students = User::pluck('name', 'id');
        return view('course.create', compact('course','subjects', 'students'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subject = Subject::find($request->subject_id);

        //Validate the teacher can't be a student of the subject he teaches.
        if($request->student_id == $subject->teacher_id){
            return redirect()->route('courses.create')
            ->with('error', "The teacher can't be a student of the subject he teaches.")
            ->withInput();
        }

        request()->validate(Course::$rules);

        $course = Course::create($request->all());

        return redirect()->route('courses.index')
            ->with('success', 'Course created successfully.');
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
        $subject = Subject::find($request->subject_id);

        //Validate the teacher can't be a student of the subject he teaches.
        if($request->student_id == $subject->teacher_id){
            return redirect()->route('courses.create')
            ->with('error', "The teacher can't be a student of the subject he teaches.")
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
