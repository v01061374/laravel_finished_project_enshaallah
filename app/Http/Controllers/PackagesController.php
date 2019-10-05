<?php

namespace App\Http\Controllers;

use App\CustomClasses\Hasher;
use App\models\Digistock;
use App\models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PackagesController extends Controller
{
    private function generateEncodedSelectArray(Array $array)
    {
        $out = [];
        foreach ($array as $item) {
            $out[Hasher::encode($item['id'])] = $item['title'];
        }
        return $out;
    }

    private function decodeRequest(Request $request, $encoded_columns)
    {
        if (is_array($encoded_columns)) {
            foreach ($encoded_columns as $column) {
                if ($request[$column]) {
                    $request[$column] = Hasher::decode($request[$column]);
                }
            }
            return $request;
        } else {
            $request[$encoded_columns] = Hasher::decode($request[$encoded_columns]);
        }
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $packages = Package::with('digi_stock')->get()->toArray();
        return view('dashboard.packages.index', compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $digiStocks =
            $this->generateEncodedSelectArray(
                Digistock::all(['id', 'title'])->toArray()
            );

        return view('dashboard.packages.cu', compact(['digiStocks']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // TODO add type validation to all models
        // TODO add related products
        // TODO products number should be decreased from stocks balance
        $validator = Validator::make($request->all(), [
            'acceptance_date' => 'date',
            'expectation_date' => 'required|date',
            'stock_id' => 'required',
            'elapsed_time' => 'required',
            'cost' => 'required',
            'package_number' => 'required|unique:packages'
            // TODO Add default value to cost
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        } else {
            $request = $this->decodeRequest($request, ['stock_id']);
            $package = new Package();
            $package->fill($request->all());
            $package->save();
            return redirect()
                ->route('packages.index')
//                should be changed to index page
                ->with('message', 'Entry Inserted Successfully!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\Package $package
     * @return \Illuminate\Http\Response
     */
    public function show(Package $package)
    {
        // TODO show related products
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\Package $package
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $package = Package::findOrFail($id)->toArray();

        if ($package) {
            $digiStocks =
                $this->generateEncodedSelectArray(
                    Digistock::all(['id', 'title'])->toArray()
                );

            $package['id'] = Hasher::encode($package['id']);
            return view('dashboard.packages.cu', compact(['digiStocks','package']));
        } else {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\models\Package $package
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'acceptance_date' => 'date',
            'expectation_date' => 'required|date',
            'stock_id' => 'required',
            'elapsed_time' => 'required',
            'cost' => 'required',
            'package_number' => 'required|unique:packages,package_number,'.$id
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        } else {
            $old = Package::find($id);
            $request = $this->decodeRequest($request, ['stock_id']);
            $old->update($request->all());
            $changes = $old->getChanges();
            unset($changes['updated_at']);
            if (count($changes)) {

                $old->save();
                return redirect()->back()->with('message', 'Update Successful!');

            } else {
                return redirect()->back()->with(['no-change' => 'No Changes Detected!']);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\Package $package
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $package = Package::findOrFail($id);
        if ($package->toArray()) {
            $package->delete();
        } else {
            abort(404);
        }
    }
}
