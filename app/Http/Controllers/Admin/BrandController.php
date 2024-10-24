<?php

namespace App\Http\Controllers\Admin;

Use App\Models\Brand;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brand = Brand::all()->toArray();
        return view("Admin.product.table-brand",compact('brand'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("Admin.product.add-brand");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $brand = new Brand;
        $brand->name = $request->name;
        if($brand->save()){
            return redirect()->back()->with('success', 'Add brand successfully.');
        }else{
            return redirect()->back()->withErrors('Add brand fail.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(Brand::where('id',$id)->delete()){
            return redirect()->back()->with('success', 'Brand deleted successfully.');
        }else{
            return redirect()->back()->withErrors('Brand not found.');
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    
}
