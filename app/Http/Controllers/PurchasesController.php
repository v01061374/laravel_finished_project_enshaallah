<?php

namespace App\Http\Controllers;

use App\CustomClasses\Hasher;
use App\models\Product;
use App\models\Purchase;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PurchasesController extends Controller
{
    // TODO transfer hash functions to Hasher class
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
                    if(is_array($request[$column])){
                        $decoded = $request[$column];
                        foreach ($request[$column] as $index => $value){
                            $decoded[$index] = Hasher::decode($value);
                        }
                        $request[$column] = $decoded;
                    }
                    else{
                        $request[$column] = Hasher::decode($request[$column]);
                    }
                }
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
        $data = Purchase::with(['supplier', 'products'])->get();
        $purchases = [];
        $total_prices = 0;
        foreach ($data as $index => $purchase){
            $purchases[$index]['id'] = $purchase['id'];
            $purchases[$index]['date'] = $purchase['date'];
            $purchases[$index]['supplier'] = $purchase['supplier'];
            $purchases[$index]['side_costs'] = $purchase['side_costs'];

            foreach ($purchase['products'] as $product){
                $total_prices = $total_prices+($product->pivot->qty*$product->pivot->unit_price);
            }
            // TODO for materials and tools

            $purchases[$index]['total_price'] = $total_prices;

        }


        return view('dashboard.purchases.index', compact('purchases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $suppliers =
            $this->generateEncodedSelectArray(
                Supplier::all(['id', 'title'])->toArray()
            )
        ;
        $products =
            $this->generateEncodedSelectArray(
                Product::all(['id', 'title'])->toArray()
            )
        ;

        return view('dashboard.purchases.cu', compact(['suppliers', 'products']));
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
        // TODO add related products
        $validator = Validator::make($request->all(),[
            'date' => 'required|date',
            'supplier_id' => 'required',
            'product_id' => 'required' // TODO check error output


        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator->errors());
        }
        else{
            $request = $this->decodeRequest($request, ['supplier_id', 'product_id']);
            $purchase = new Purchase();
            $purchase->fill($request->only(['date', 'supplier_id', 'side_costs']));

            $purchase->save();
            foreach ($request['product_id'] as $index => $product){
                $purchase->products()->attach($product, [
                    'unit_price' => $request['price'][$index], 'qty' => $request['qty'][$index]
                ]);
            }

            //////////////////should add materials and tools
            return redirect()
                ->route('purchases.index')
//                should be changed to index page
                ->with('message', 'Entry Inserted Successfully!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        // TODO show related products
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $purchase = Purchase::with('products')->findOrFail($id);


        if($purchase){
            $suppliers =
                $this->generateEncodedSelectArray(
                    Supplier::all(['id', 'title'])->toArray()
                )

            ;
            $products =
                $this->generateEncodedSelectArray(
                    Product::all(['id', 'title'])->toArray()
                )
            ;

            $purchase['id'] = Hasher::encode($purchase['id']);
            $p_id = Hasher::encode($id);
            // don't know why id is BULLSHIT in purchase

            return view('dashboard.purchases.cu', compact(['purchase', 'suppliers', 'products', 'p_id']));

        }
        else{
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'date' => 'required|date',
            'supplier_id' => 'required',
            'product_id' => 'required',
            'qty' => 'required',
            'price' => 'required'
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator->errors());
        }
        else{
            $old = Purchase::with(['supplier', 'products'])->find($id);
            // TODO find out how to get this from edit function

            $request = $this->decodeRequest($request, ['supplier_id', 'product_id']);
            $old->update($request->only(['date', 'supplier_id', 'side_costs']));
            $changes = $old->getChanges();
            unset($changes['updated_at']);
            $qtys = $request['qty'];
            $prices = $request['price'];
            foreach ($request['product_id'] as $index => $product_id){
                $related_products = $old['products'];
                $related_product = $related_products->find($product_id);
                if($related_product){
                    if($related_product->pivot->qty!=$qtys[$index] || $related_product->pivot->unit_price != $prices[$index]){
                        $changes['product_id'][] = $product_id;
                        $old->products()->updateExistingPivot($product_id, ['qty' => $qtys[$index], 'unit_price' => $prices[$index]]);
                    }
                }
                else{
                    $changes['product_id'][] = $product_id;
                    $old->products()->attach($product_id, [
                    'unit_price' => $request['price'][$index], 'qty' => $request['qty'][$index]
                    ]);
                }
            }
            foreach ($old['products'] as $old_product){

                if(array_search($old_product['id'], $request['product_id'])===false){

                    $changes['product_id'][] = $old_product['id'];
                    $old->products()->detach($old_product['id']);
                }
            }
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
     * @param  \App\models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $purchase = Purchase::findOrFail($id);
        if($purchase->toArray()){
            $purchase->delete();
        }
        else{
            abort(404);
        }
    }
}
