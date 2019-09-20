<?php

namespace App\Http\Controllers;

use App\CustomClasses\Hasher;
use App\models\MaterialCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MaterialCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $materialCategories = MaterialCategory::all()->toArray();
        return view('dashboard.materialCategories.index', compact('materialCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.materialCategories.cu');
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
            'title' => 'required|unique:material_categories|max:20'
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator->errors());
        }
        else{
            $materialCategory = new MaterialCategory([
                'title' => $request['title']
            ]);
            $materialCategory->save();
            return redirect()
                ->route('materialCategories.index')
//                should be changed to index page
                ->with('message', 'Entry Inserted Successfully!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\MaterialCategory  $materialCategory
     * @return \Illuminate\Http\Response
     */
    public function show(MaterialCategory $materialCategory)
    {
        // TODO show related materials
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\MaterialCategory  $materialCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $materialCategory = MaterialCategory::findOrFail($id)->toArray();

        if($materialCategory){
            $materialCategory['id'] = Hasher::encode($materialCategory['id']);
            return view('dashboard.materialCategories.cu', compact('materialCategory'));
        }
        else{
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\MaterialCategory  $materialCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required|max:20|unique:material_categories,title,'.$id
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator->errors());
        }
        else{
            $old = MaterialCategory::find($id);
            $old->update($request->all());
            $changes = $old->getChanges();
            unset($changes['updated_at']);
            if(count($changes)){
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
     * @param  \App\models\MaterialCategory  $materialCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $materialCategory = MaterialCategory::findOrFail($id);
        if($materialCategory->toArray()){
            $materialCategory->delete();
        }
        else{
            abort(404);
        }
    }
}
