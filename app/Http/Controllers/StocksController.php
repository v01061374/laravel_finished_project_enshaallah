<?php

namespace App\Http\Controllers;

use App\CustomClasses\Hasher;
use App\models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StocksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stocks = Stock::all()->toArray();
        return view('dashboard.stocks.index', compact('stocks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.stocks.cu');
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
            $stock = new Stock([
                'title' => $request['title']
            ]);
            $stock->save();
            return redirect()
                ->route('stocks.index')
//                should be changed to index page
                ->with('message', 'Entry Inserted Successfully!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function show(Stock $stock)
    {
        // TODO show related materials
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $stock = Stock::findOrFail($id)->toArray();

        if($stock){
            $stock['id'] = Hasher::encode($stock['id']);
            return view('dashboard.stocks.cu', compact('stock'));
        }
        else{
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\Stock  $stock
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
            $old = Stock::find($id);
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
     * @param  \App\models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $stock = Stock::findOrFail($id);
        if($stock->toArray()){
            $stock->delete();
        }
        else{
            abort(404);
        }
    }
}
