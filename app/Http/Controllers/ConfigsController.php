<?php

namespace App\Http\Controllers;

use App\CustomClasses\Hasher;
use App\models\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ConfigsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $configs = Config::all()->toArray();
        return view('dashboard.configs.index', compact('configs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {

        return view('dashboard.configs.cu');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'option' => 'required',
            'value' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        } else {
            $config = new Config();
            $config->fill($request->all());
            $config->save();
            return redirect()
                ->route('configs.index')
                ->with('message', 'Entry Inserted Successfully!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\Config $config
     * @return \Illuminate\Http\Response
     */
    public function show(Config $config)
    {
        // TODO show related materials
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\Config $config
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $config = Config::findOrFail($id)->toArray();

        if ($config) {

            $config['id'] = Hasher::encode($config['id']);
            return view('dashboard.configs.cu', compact(['config']));
        } else {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\models\Config $config
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'option' => 'required',
            'value' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        } else {
            $old = Config::find($id);
            $old->update($request->all());
            $changes = $old->getChanges();
            unset($changes['updated_at']);
            if (count($changes)) {

                $old->save();
                return redirect()->back()->with('message', 'Update Successful!');

            } else {
                return redirect()->back()->with(['no-change' => 'No Changes Detected!']);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\Config $config
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $config = Config::findOrFail($id);
        if ($config->toArray()) {
            $config->delete();
        } else {
            abort(404);
        }
    }
}
