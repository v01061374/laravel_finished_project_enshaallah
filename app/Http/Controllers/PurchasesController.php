<?php

namespace App\Http\Controllers;

use App\CustomClasses\Hasher;
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
                    $request[$column] = Hasher::decode($request[$column]);
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
        $purchases = Purchase::with('supplier')->get()->toArray();
        return view('dashboard.purchases.index', compact('purchases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $supplier =
            $this->generateEncodedSelectArray(
                Supplier::all(['id', 'title'])->toArray()
            )
        ;

        return view('dashboard.purchases.cu', compact('supplier'));
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
            'date' => 'required|date',
            'supplier_id' => 'required',

        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator->errors());
        }
        else{
            $request = $this->decodeRequest($request, 'supplier_id');
            $purchase = new Purchase();
            $purchase->fill($request->all());
            $purchase->save();
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
        // TODO show related purchases
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $purchase = Purchase::findOrFail($id)->toArray();

        if($purchase){
            $suppliers =
                $this->generateEncodedSelectArray(
                    Supplier::all(['id', 'title'])->toArray()
                )
            ;
            $purchase['id'] = Hasher::encode($purchase['id']);
            return view('dashboard.purchases.cu', compact(['purchase', 'suppliers']));
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
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator->errors());
        }
        else{
            $old = Purchase::find($id);
            $request = $this->decodeRequest($request, 'supplier_id');
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
