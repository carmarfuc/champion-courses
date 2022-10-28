<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * Class SettingController
 * @package App\Http\Controllers
 */
class SettingController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role == 'ADMINISTRATOR'){
            $settings = Setting::paginate();

            return view('setting.index', compact('settings'))
                ->with('i', (request()->input('page', 1) - 1) * $settings->perPage());
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
        $setting = new Setting();
        return view('setting.create', compact('setting'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->request->add(['name' => strtoupper(Str::slug($request->name, '_'))]);

        request()->validate(Setting::$rules);

        $setting = Setting::create($request->all());

        return redirect()->route('settings.index')
            ->with('success', 'Setting created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $setting = Setting::find($id);

        return view('setting.show', compact('setting'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $setting = Setting::find($id);

        return view('setting.edit', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Setting $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {

        $request->request->add(['name' => strtoupper(Str::slug($request->name, '_'))]);

        $rules = Setting::$rules;
        $rules['name'] = $rules['name'] . ',name,' . $setting->id;

        request()->validate($rules);

        $setting->update($request->all());

        return redirect()->route('settings.index')
            ->with('success', 'Setting updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $setting = Setting::find($id)->delete();

        return redirect()->route('settings.index')
            ->with('success', 'Setting deleted successfully');
    }
}
