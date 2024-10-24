<?php

namespace App\Http\Controllers\Admin;

Use App\Models\Country;
use App\Http\Requests\CountryRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $country = Country::all()->toArray();
        return view('Admin.country.table-countries', compact('country'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.country.add-countries');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CountryRequest $request)
    {
        $country = new Country;
        $country->name = $request->name;
        if($country->save()){
            return redirect()->back()->with('success', 'Add country successfully.');
        }else{
            return redirect()->back()->withErrors('Add country fail.');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(Country::where('id',$id)->delete()){
            return redirect()->back()->with('success', 'Country deleted successfully.');
        }else{
            return redirect()->back()->withErrors('Country not found.');
        }
    }
}
