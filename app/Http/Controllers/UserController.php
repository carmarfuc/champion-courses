<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($filter = null)
    {

        if (Auth::user()->role == 'ADMINISTRATOR'){
            //List
            $users = $filter ? User::where('role', strtoupper($filter))->paginate() : User::paginate();

            //Title
            $title = $filter ? ucfirst($filter). 's' : "Users";

            //Indicators
            $students = User::where('role', 'STUDENT')->get()->count();
            $teachers = User::where('role', 'TEACHER')->get()->count();
            $admins = User::where('role', 'ADMINISTRATOR')->get()->count();
            $usersActive = User::get()->count();

            return view('user.index', compact('users', 'title', 'students', 'teachers', 'admins', 'usersActive'))
                ->with('i', (request()->input('page', 1) - 1) * $users->perPage());
        }
        elseif (Auth::user()->role == 'TEACHER'){
            //List
            $users = User::join('courses', 'courses.student_id', '=', 'users.id')
                ->join('subjects', 'courses.subject_id', '=', 'subjects.id')
                ->where('teacher_id', Auth::id())
                ->where('role', 'STUDENT')
                ->select('users.*')->paginate();

            //Title
            $title = "My students";

            return view('user.index', compact('users', 'title'))
                ->with('i', (request()->input('page', 1) - 1) * $users->perPage());
        }
        else{
            return abort('404');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User();
        return view('user.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        request()->validate(User::$rules);

        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;

        $user->save();

        return redirect()->route('users.index')
            ->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        $rules = User::$rules;
        $rules['email'] = $rules['email'] . ',email,' . $user->id;


        //Only if you don't reset the password
        if (!$request->password){
            unset($rules['password']);
            unset($rules['password_confirm']);
        }

        if(!$request->role){
            unset($rules['role']);
        }

        request()->validate($rules);

        $user->name = $request->name;
        $user->email = $request->email;

        //Only if you reset the password
        if ($request->password){
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {

        $user = User::find($id)->delete();

        dd($user);

        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');

    }
}
