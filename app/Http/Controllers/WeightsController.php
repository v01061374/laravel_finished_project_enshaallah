<?php

namespace App\Http\Controllers;

use App\CustomClasses\Hasher;
use App\models\Weight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WeightsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $weights = Weight::all()->toArray();
        return view('dashboard.weights.index', compact('weights'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.weights.cu');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required|unique:weights|max:20',
            'max_gr_weight' => 'required|unique:weights|max:10'
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator->errors());
        }
        else{
            $weight = new Weight([
                'title' => $request['title'],
                'max_gr_weight' => $request['max_gr_weight']
            ]);
            $weight->save();
            return redirect()
                ->route('weights.index')
//                should be changed to index page
                ->with('message', 'Entry Inserted Successfully!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\Weight  $weight
     * @return \Illuminate\Http\Response
     */
    public function show(Weight $weight)
    {
        // TODO show related products
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\Weight  $weight
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $weight = Weight::findOrFail($id)->toArray();

        if($weight){
            $weight['id'] = Hasher::encode($weight['id']);
            return view('dashboard.weights.cu', compact('weight'));
        }
        else{
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\Weight  $weight
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required|max:20|unique:weights,title,'.$id,
            'max_gr_weight' => 'required|max:10|unique:weights,max_gr_weight,'.$id
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator->errors());
        }
        else{
            $old = Weight::find($id);
            if($old['title']!=$request['title']||$request['max_gr_weight']!=$old['max_gr_weight']){
                $old->update(['title' => $request['title'], 'max_gr_weight' => $request['max_gr_weight']]);
                $old->save();
                return redirect()->back()->with('message', 'Update Successful!');

            }
            else{
                return redirect()->back()->with(['no-change'=>'No Changes Detected!']);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\Weight  $weight
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $weight = Weight::findOrFail($id);
        if($weight->toArray()){
            $weight->delete();
        }
        else{
            abort(404);
        }
    }
}
