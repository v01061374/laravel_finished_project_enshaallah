<?php

namespace App\Http\Controllers;

use App\CustomClasses\Hasher;
use App\models\Receipt;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReceiptsController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $receipts = Receipt::all()->toArray();
        return view('dashboard.receipts.index', compact('receipts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        return view('dashboard.receipts.cu');
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
        // TODO add related receipts
        $validator = Validator::make($request->all(),[
            'payment_date' => 'required|date'
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator->errors());
        }
        else{
            $receipt = new Receipt();
            $receipt->fill($request->all());
            $receipt->save();
            return redirect()
                ->route('receipts.index')
//                should be changed to index page
                ->with('message', 'Entry Inserted Successfully!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function show(Receipt $receipt)
    {
        // TODO show related receipts
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $receipt = Receipt::findOrFail($id)->toArray();

        if($receipt){
            $receipt['id'] = Hasher::encode($receipt['id']);
            return view('dashboard.receipts.cu', compact(['receipt']));
        }
        else{
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'payment_date' => 'required|date'
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator->errors());
        }
        else{
            $old = Receipt::find($id);
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
     * @param  \App\models\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $receipt = Receipt::findOrFail($id);
        if($receipt->toArray()){
            $receipt->delete();
        }
        else{
            abort(404);
        }
    }
}
