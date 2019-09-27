<?php

namespace App\Http\Controllers;

use App\CustomClasses\Hasher;
use App\models\DigiStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DigiStocksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $digiStocks = DigiStock::all()->toArray();
        return view('dashboard.digiStocks.index', compact('digiStocks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.digiStocks.cu');
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
            $digiStock = new DigiStock([
                'title' => $request['title']
            ]);
            $digiStock->save();
            return redirect()
                ->route('digiStocks.index')
//                should be changed to index page
                ->with('message', 'Entry Inserted Successfully!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\DigiStock  $digiStock
     * @return \Illuminate\Http\Response
     */
    public function show(DigiStock $digiStock)
    {
        // TODO show related materials
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\DigiStock  $digiStock
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $digiStock = DigiStock::findOrFail($id)->toArray();

        if($digiStock){
            $digiStock['id'] = Hasher::encode($digiStock['id']);
            return view('dashboard.digiStocks.cu', compact('digiStock'));
        }
        else{
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\DigiStock  $digiStock
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
            $old = DigiStock::find($id);
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
     * @param  \App\models\DigiStock  $digiStock
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $digiStock = DigiStock::findOrFail($id);
        if($digiStock->toArray()){
            $digiStock->delete();
        }
        else{
            abort(404);
        }
    }
}
