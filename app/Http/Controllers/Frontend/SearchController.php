<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Category;
use App\Models\Brand;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    /**
     * Search the specified resource in storage.
     */
    public function searchname(Request $request)
    {
        $searchterm = $request->search;
        $match = Product::where('name','like', '%'.$searchterm.'%')->orderBy('id', 'desc')->paginate(6);
        $getArrImage = [];
        foreach($match as $value){

            $getArrImage[$value->id] = json_decode($value->images, true);   
        }

        //dd ($match);
        return view("Frontend.product.search",compact('match','getArrImage','searchterm'));
    }

    /**
     * Search with mutilple conditons.
     */
    public function shopadvanced()
    {
        $total = null;
        if(Auth::check()){
            $cart = session('cart', []);
            if($cart){
                $returnarr = $this->total(0,$cart);
                $total = $returnarr[0];
            }
        }
        $product = Product::orderBy('id','desc')->paginate(6);
        $data = Product::orderBy('id', 'desc')->get();
        $imgarr = [];
        foreach($data as $value){
            $imgarrs = json_decode($value->images, true);  
            $imgarr[$value->id] = $imgarrs[0];
        } 

        $category = Category::all()->toArray();
        $brand = Brand::all()->toArray();

        return view('Frontend.product.shopadvanced',compact('product','imgarr','total','category', 'brand'));
    }

    /**
     * Search advanced.
     */
    public function searchadvanced(Request $request)
    {
        $query = Product::query();

        if($name = $request->name){
            $query->where('name','like', '%'.$name.'%');
        }

        if($price = $request->price){

            [$min, $max] = explode('-', $price); // Tách thành 100 và 200
            $query->whereBetween('price', [(int)$min, (int)$max]);
        } 

        if($category_id = $request->category){
            $query->where('id_category', $category_id);
        } 

        if($brand_id = $request->brand){
            $query->where('id_brand', $brand_id);
        } 

        if($brand_id = $request->brand){
            $query->where('id_brand', $brand_id);
        } 

        if($status = $request->status){
            $query->where('status', $status);
        } 
        //gắn khóa ngoại

        //$product = $query->get();
        $product = $query->orderBy('id','desc')->paginate(4)->withQueryString();
        $getArrImage = [];
        foreach($product as $value){

            $getArrImage[$value->id] = json_decode($value->images, true);   
        }

        //dd ($getArrImage);
        //echo "hello";
        return view('Frontend.product.resultadvanced',compact('product','getArrImage'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function ajaxSearch(Request $request)
    {
        //var_dump ($request->value); => lấy được data rồi
        $query = Product::query();
        // Kiểm tra nếu có khoảng giá, nếu không thì trả về tất cả d
        if ($request->has('value')) {
            $query->whereBetween('price', [$request->value[0], $request->value[1]]);
        }
        $forimg = $query->get();
        $getArrImage = [];
        foreach($forimg as $value){

            $getArrImage[$value->id] = json_decode($value->images, true);   
        }

        //dd($getArrImage);
        // Phân trang với 3 sản phẩm mỗi trang
        $match = $query->orderBy('id', 'desc')->paginate(3);

        return response()->json(['info' => $match, 'imgArr' => $getArrImage]);
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function total($x, $cart){

        //Tính tổng số ảnh
        $getArrImage = [];
        $totalprice = 0;
        $counttotal = 0;
        foreach($cart as $value){
            if($x==0){
                $getArrImage[$value["id"]] = json_decode($value['images'], true);  
            }
            $totalprice = $totalprice + ($value['qty'] * $value['price']);
            $counttotal = $counttotal + $value['qty'];
        } 
        return $x == 0 ? [$counttotal, $totalprice, $getArrImage] : [$counttotal, $totalprice];
    }
}
