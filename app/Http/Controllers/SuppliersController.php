<?php

namespace App\Http\Controllers;

use App\CustomClasses\Hasher;
use App\models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SuppliersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected static $model = 'Suppliers';
    public function index()
    {
        $suppliers = Supplier::all()->toArray();
        return view('dashboard.suppliers.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.suppliers.cu');
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
            'title' => 'required|unique:suppliers|max:20',
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator->errors());
        }
        else{
            $supplier = new Supplier([
                'title' => $request['title'],
                'address' => (isset($request['address']))?$request['address']:''
            ]);
            $supplier->save();
            return redirect()
                ->route('suppliers.index')
//                should be changed to index page
                ->with('message', 'Entry Inserted Successfully!');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
//        $supplier = Supplier::findOrFail($id)->toArray();
//
//        if($supplier){
//            $supplier['id'] = Hasher::encode($supplier['id']);
//            return view('dashboard.suppliers.cu', compact('supplier'));
//        }
//        else{
//            redirect(404);
//        }
         // TODO show related products

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id)->toArray();

        if($supplier){
            $supplier['id'] = Hasher::encode($supplier['id']);
            return view('dashboard.suppliers.cu', compact('supplier'));
        }
        else{
            abort(404);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required|max:20|unique:suppliers,title,'.$id,
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator->errors());
        }
        else{
            $old = Supplier::find($id);
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
     * @param  \App\models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);
        if($supplier->toArray()){
            $supplier->delete();
        }
        else{
            abort(404);
        }
    }
}
