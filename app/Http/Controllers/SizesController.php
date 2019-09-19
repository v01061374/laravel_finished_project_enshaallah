<?php

namespace App\Http\Controllers;

use App\CustomClasses\Hasher;
use App\models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SizesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected static $model = 'Size';
    public function index()
    {
        $sizes = Size::all()->toArray();
        return view('dashboard.sizes.index', compact('sizes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.sizes.cu');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
           'title'=>  'required|unique:sizes|max:20',
            'max_cm_height' => 'max:10',
            'max_cm_width' => 'max:10',
            'max_cm_length' => 'max:10',
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator->errors());
        }
        else{
            $size = new Size([
                'title' => $request['title'],
                'max_cm_height' => (isset($request['max_cm_height']))?$request['max_cm_height']:'',
                'max_cm_width' => (isset($request['max_cm_width']))?$request['max_cm_width']:'',
                'max_cm_length' => (isset($request['max_cm_length']))?$request['max_cm_length']:'',

            ]);
            $size->save();
            return redirect()
                ->route('sizes.index')
//                should be changed to index page
                ->with('message', 'Entry Inserted Successfully!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function show(Size $size)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $size = Size::findOrFail($id)->toArray();

        if($size){
            $size['id'] = Hasher::encode($size['id']);
            return view('dashboard.sizes.cu', compact('size'));
        }
        else{
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required|max:20|unique:sizes,title,'.$id,
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator->errors());
        }
        else{
            $old = Size::find($id);
            if(
                $old['title']!=$request['title']
                ||(isset($request['max_cm_height'])&&$request['max_cm_height']!=$old['max_cm_height'])
                ||(isset($request['max_cm_width'])&&$request['max_cm_width']!=$old['max_cm_width'])
                ||(isset($request['max_cm_length'])&&$request['max_cm_length']!=$old['max_cm_length'])
                ){
                $old->update([
                    'title' => $request['title']
                    ,'max_cm_height' => $request['max_cm_height']
                    ,'max_cm_width' => $request['max_cm_width']
                    ,'max_cm_length' => $request['max_cm_length']]
                );
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
     * @param  \App\models\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $size = Size::findOrFail($id);
        if($size->toArray()){
            $size->delete();
        }
        else{
            abort(404);
        }
    }
}
