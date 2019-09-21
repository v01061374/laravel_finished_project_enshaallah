<?php

namespace App\Http\Controllers;

use App\CustomClasses\Hasher;
use App\models\Material;
use App\models\MaterialCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MaterialsController extends Controller
{
    private function generateEncodedSelectArray(Array $array){
        $out = [];
        foreach ($array as $item){
            $out[Hasher::encode($item['id'])] = $item['title'];
        }
        return $out;
    }
    private function decodeRequest(Request $request, $encoded_columns){
        if(is_array($encoded_columns)){
            foreach ($encoded_columns as $column){
                $request[$column] = Hasher::decode($request[$column]);
            }
            return $request;
        }
        else
            $request[$encoded_columns] = Hasher::decode($request[$encoded_columns]);
        return $request;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $materials = Material::with('category')->get()->toArray();
        return view('dashboard.materials.index', compact('materials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $materialCategories =
            $this->generateEncodedSelectArray(
                MaterialCategory::all(['id', 'title'])->toArray()
            )
        ;

        return view('dashboard.materials.cu', compact('materialCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // TODO add type validation to all models
        // TODO add related purchases
        $validator = Validator::make($request->all(),[
            'title' => 'required|unique:materials|max:20',
            'category_id' => 'required'
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator->errors());
        }
        else{
            $request = $this->decodeRequest($request, 'category_id');
            $material = new Material();
            $material->fill($request->all());
            $material->save();
            return redirect()
                ->route('materials.index')
//                should be changed to index page
                ->with('message', 'Entry Inserted Successfully!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function show(Material $material)
    {
        // TODO show related purchases
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $material = Material::findOrFail($id)->toArray();

        if($material){
            $materialCategories =
                $this->generateEncodedSelectArray(
                    MaterialCategory::all(['id', 'title'])->toArray()
                )
            ;
            $material['id'] = Hasher::encode($material['id']);
            return view('dashboard.materials.cu', compact(['material', 'materialCategories']));
        }
        else{
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required|max:20|unique:materials,title,'.$id,
            'category_id' => 'required'
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator->errors());
        }
        else{
            $old = Material::find($id);
            $request = $this->decodeRequest($request, 'category_id');
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
     * @param  \App\models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $material = Material::findOrFail($id);
        if($material->toArray()){
            $material->delete();
        }
        else{
            abort(404);
        }
    }
}
