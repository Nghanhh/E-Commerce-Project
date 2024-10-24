<?php

namespace App\Http\Controllers\Admin;

Use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::all()->toArray();
        return view("Admin.product.table-category", compact('category'));
        //var_dump ($category);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("Admin.product.add-category");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = new Category;
        $category->name = $request->name;
        if($category->save()){
            return redirect()->back()->with('success', 'Add category successfully.');
        }else{
            return redirect()->back()->withErrors('Add category fail.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(Category::where('id',$id)->delete()){
            return redirect()->back()->with('success', 'Category deleted successfully.');
        }else{
            return redirect()->back()->withErrors('Category not found.');
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
