<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubjectRequest;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

/**
 * Class SubjectController
 * @package App\Http\Controllers
 */
class SubjectController extends Controller
{
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
    public function store(StoreSubjectRequest $request)
    {
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
