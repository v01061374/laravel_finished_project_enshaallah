<?php

namespace App\Http\Controllers;

use App\CustomClasses\Hasher;
use App\models\Product;
use App\models\Receipt;
use App\models\Sell;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SellsController extends Controller
{
    private function generateEncodedSelectArray(Array $array, $dataIndex){
        $out = [];
        foreach ($array as $item){
            $out[Hasher::encode($item['id'])] = $item[$dataIndex];
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
        $sells = Sell::with(['product', 'receipt'])->get()->toArray();
        return view('dashboard.sells.index', compact('sells'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $products =
            $this->generateEncodedSelectArray(
                Product::all(['id', 'title'])->toArray()
            , 'title'
            )
        ;
        $receipts = $this->generateEncodedSelectArray(
            Receipt::all(['id', 'payment_date'])->toArray()
        , 'payment_date'
        )
        ;


        return view('dashboard.sells.cu', compact(['products', 'receipts']));
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
            'order_date' => 'required|date',
            'order_number' => 'required',
            'prod_id' => 'required',
            'unit_price' => 'required',
            'qty' => 'required',
            'is_final' => 'required',
            'is_returned' => 'required'
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator->errors());
        }
        else{
            $request = $this->decodeRequest($request, ['prod_id', 'receipt_id']);
            $sell = new Sell();
            $sell->fill($request->all());
            $sell->save();
            return redirect()
                ->route('sells.index')
//                should be changed to index page
                ->with('message', 'Entry Inserted Successfully!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\Sell  $sell
     * @return \Illuminate\Http\Response
     */
    public function show(Sell $sell)
    {
        // TODO show related purchases
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\Sell  $sell
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $sell = Sell::findOrFail($id)->toArray();

        if($sell){
            $products =
                $this->generateEncodedSelectArray(
                    Product::all(['id', 'title'])->toArray()
                    , 'title')
            ;
            $receipts = $this->generateEncodedSelectArray(
                Receipt::all(['id', 'payment_date'])->toArray()
            ,'payment_date');

//            dd($receipts);
            $sell['id'] = Hasher::encode($sell['id']);
            return view('dashboard.sells.cu', compact(['sell', 'products', 'receipts']));
        }
        else{
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\Sell  $sell
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'order_date' => 'required|date',
            'order_number' => 'required',
            'prod_id' => 'required',
            'unit_price' => 'required',
            'qty' => 'required',
            'is_final' => 'required',
            'is_returned' => 'required'
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator->errors());
        }
        else{
            $old = Sell::find($id);
            $request = $this->decodeRequest($request, ['prod_id', 'receipt_id']);
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
     * @param  \App\models\Sell  $sell
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sell = Sell::findOrFail($id);
        if($sell->toArray()){
            $sell->delete();
        }
        else{
            abort(404);
        }
    }
}
