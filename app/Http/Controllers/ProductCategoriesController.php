<?php

namespace App\Http\Controllers;

use App\CustomClasses\Hasher;
use App\models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productCategories = ProductCategory::all()->toArray();
        return view('dashboard.productCategories.index', compact('productCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.productCategories.cu');
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
            'title' => 'required|unique:product_categories|max:20',
            'commission_percent' => 'required|unique:product_categories|max:10'
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator->errors());
        }
        else{
            $productCategory = new ProductCategory([
                'title' => $request['title'],
                'commission_percent' => $request['commission_percent']
            ]);
            $productCategory->save();
            return redirect()
                ->route('productCategories.index')
//                should be changed to index page
                ->with('message', 'Entry Inserted Successfully!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ProductCategory $productCategory)
    {
        // TODO show related products
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $productCategory = ProductCategory::findOrFail($id)->toArray();

        if($productCategory){
            $productCategory['id'] = Hasher::encode($productCategory['id']);
            return view('dashboard.productCategories.cu', compact('productCategory'));
        }
        else{
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required|max:20|unique:product_categories,title,'.$id,
            'commission_percent' => 'required|max:10|unique:product_categories,commission_percent,'.$id
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator->errors());
        }
        else{
            $old = ProductCategory::find($id);
            if($old['title']!=$request['title']||$request['commission_percent']!=$old['commission_percent']){
                $old->update(['title' => $request['title'], 'commission_percent' => $request['commission_percent']]);
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
     * @param  \App\models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $productCategory = ProductCategory::findOrFail($id);
        if($productCategory->toArray()){
            $productCategory->delete();
        }
        else{
            abort(404);
        }
    }
}
