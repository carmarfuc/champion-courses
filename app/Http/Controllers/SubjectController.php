<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubjectRequest;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

/**
 * Class SubjectController
 * @package App\Http\Controllers
 */
class SubjectController extends Controller
{
    public function isMaxCourse(Request $request, Subject $subject = null){

        $AND_where = $subject ? "AND s.id <> $subject->id" : '';

        $sqlDateList = "SELECT s.start_date, s.finish_date
                FROM subjects s
                WHERE s.teacher_id = 1
                    AND s.finish_date >= NOW()
                    AND s.deleted_at IS NULL
                    $AND_where;";

        $dateList =  DB::select($sqlDateList);

        $sqlSetting = "SELECT se.value
                        FROM settings se
                        WHERE se.name = 'MAXIMUM_COURSES_PER_TEACHER_WEEKLY'";

        try {
            $maxCourses =  intval(DB::select($sqlSetting)[0]->value);
        } catch (\Throwable $th) {
            $maxCourses =  0;
        }

        if(sizeof($dateList) > 0){
            if ($maxCourses > 1){
                $firstWeek=date('W',strtotime($request->start_date));
                $lastWeek=date('W',strtotime($request->finish_date));
                $arrayBase = array_keys(array_fill(($lastWeek<$firstWeek?$lastWeek:$firstWeek),abs($lastWeek-$firstWeek),'0'));

                foreach($dateList as $item){
                    $firstWeek=date('W',strtotime($item->start_date));
                    $lastWeek=date('W',strtotime($item->finish_date));
                    $arrayAux = array_keys(array_fill(($lastWeek<$firstWeek?$lastWeek:$firstWeek),abs($lastWeek-$firstWeek),'0'));

                    $arrayBase = array_merge($arrayBase,$arrayAux);
                }

                $arrayResult = array_count_values($arrayBase);
                rsort($arrayResult);

                $rst = ($arrayResult[0] > $maxCourses) ? true : false;
            }

            else{
                $rst = false;
            }
        }
        else{
            $rst = false;
        }
        return $rst;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::paginate();

        return view('subject.index', compact('subjects'))
            ->with('i', (request()->input('page', 1) - 1) * $subjects->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subject = new Subject();
        $teachers = User::pluck('name', 'id');
        return view('subject.create', compact('subject', 'teachers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if($this->isMaxCourse($request)){
            return back()->with('error', 'The date range entered exceeds the number of subjects per week allowed per teacher')
                    ->withInput();
        }

        $request->request->add(['slug' => Str::slug($request->name, '_')]);

        request()->validate(Subject::$rules);

        $subject = Subject::create($request->all());

        return redirect()->route('subjects.index')
            ->with('success', 'Subject created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subject = Subject::find($id);

        return view('subject.show', compact('subject'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subject = Subject::find($id);
        $teachers = User::pluck('name', 'id');
        return view('subject.edit', compact('subject', 'teachers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Subject $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
        $request->request->add(['slug' => Str::slug($request->name, '_')]);

        $rules = Subject::$rules;
        $rules['slug'] = $rules['slug'] . ',slug,' . $subject->id;

        if($this->isMaxCourse($request, $subject)){
            return back()->with('error', 'The date range entered exceeds the number of subjects per week allowed per teacher')
                    ->withInput();
        }

        request()->validate($rules);

        $subject->update($request->all());

        return redirect()->route('subjects.index')
            ->with('success', 'Subject updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $subject = Subject::find($id)->delete();

        return redirect()->route('subjects.index')
            ->with('success', 'Subject deleted successfully');
    }
}
