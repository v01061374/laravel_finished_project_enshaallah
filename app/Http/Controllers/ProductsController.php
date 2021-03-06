<?php

namespace App\Http\Controllers;

use App\CustomClasses\Hasher;
use App\models\Product;
use App\models\ProductCategory;
use App\models\Size;
use App\models\Weight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
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
                if($request[$column]){
                    $request[$column] = Hasher::decode($request[$column]);
                }
            }
            return $request;
        }
        else{
            $request[$encoded_columns] = Hasher::decode($request[$encoded_columns]);
        }
    }
    private function getUploadedImagePath(Request $request){
        // TODO specify disk
        // TODO delete old image
        $img = $request->file('image');
        if($img){
            $path = $img->store('assets/images/products', 'public' );

            return $path;
        }
        else{
            return null;
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $products = Product::with('category')->get()->toArray();
        return view('dashboard.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $sizes =
        $this->generateEncodedSelectArray(
            Size::all(['id', 'title'])->toArray()
        )
        ;
        $weights =
            $this->generateEncodedSelectArray(
                Weight::all(['id', 'title'])->toArray()
            )
        ;
        $productCategories =
            $this->generateEncodedSelectArray(
                ProductCategory::all(['id', 'title'])->toArray()
            )
        ;

        return view('dashboard.products.cu', compact(['sizes', 'weights', 'productCategories']));
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
        // TODO add related materials
        $validator = Validator::make($request->all(),[
            'title' => 'required|unique:products|max:20',
            'avg_minute_prod_time' => 'required',
            'size_id' => 'required',
            'weight_id' => 'required',
            'category_id' => 'required'
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator->errors());
        }
        else{
            $request = $this->decodeRequest($request, ['size_id', 'weight_id', 'category_id']);
            $product = new Product();
            $product->fill($request->all(['title', 'avg_minute_prod_time', 'size_id', 'weight_id', 'category_id']));
            // TODO improve upload consequence
            $image = $this->getUploadedImagePath($request);
            if($image){
                $product->fill(['image'=>$image]);
            }
            $product->save();
            return redirect()
                ->route('products.index')
//                should be changed to index page
                ->with('message', 'Entry Inserted Successfully!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        // TODO show related materials
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id)->toArray();

        if($product){
            $sizes =
                $this->generateEncodedSelectArray(
                    Size::all(['id', 'title'])->toArray()
                )
            ;
            $weights =
                $this->generateEncodedSelectArray(
                    Weight::all(['id', 'title'])->toArray()
                )
            ;
            $productCategories =
                $this->generateEncodedSelectArray(
                    ProductCategory::all(['id', 'title'])->toArray()
                )
            ;

            $product['id'] = Hasher::encode($product['id']);
            return view('dashboard.products.cu', compact(['product', 'sizes', 'weights', 'productCategories']));
        }
        else{
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required|max:20|unique:products,title,'.$id,
            'avg_minute_prod_time' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'size_id' => 'required',
            'weight_id' => 'required',
            'category_id' => 'required'
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator->errors());
        }
        else{
            $old = Product::find($id);
            $request = $this->decodeRequest($request, ['size_id', 'weight_id', 'category_id']);
            $old->update($request->all());
            $image = $this->getUploadedImagePath($request);
            if($image){
                $old->update(['image'=>$image]);
            }
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
     * @param  \App\models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if($product->toArray()){
            $product->delete();
        }
        else{
            abort(404);
        }
    }
}
