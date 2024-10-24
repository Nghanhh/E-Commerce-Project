<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::check()){
            $cart = session('cart', []);

            $returnarr = $this->total(0,$cart);
            //var_dump ($returnarr);
            $productincart = $cart;
            $getArrImage = $returnarr[2];
            $total = $returnarr[0];
            $totalprice = $returnarr[1];
            return view('Frontend.cart.cart',compact('productincart','getArrImage','total','totalprice'));
        }else{

            return redirect('/member/login');

        }
    }

    /**
     * Add quantity of an item.
     */

    public function addAjax(Request $request)
    {
        $cart = session('cart', []); 
        $cart[$request->id]['qty'] ++;
        session(['cart' => $cart]);  
        $returnarr = $this->total(1,$cart);
        //var_dump ($cart);
        return response()->json([
            'total' => $returnarr[0], 
            'totalprice' => $returnarr[1] 
        ]);
    }

    /**
     * Reduce quantity of an item.
     */

    public function downAjax(Request $request)
    {
        $cart = session('cart', []);
        //dd($$request->qty);
        if($request->qty == 0){
            unset($cart[$request->id]);
            session(['cart' => $cart]); 
        }else{
            $cart[$request->id]['qty'] = $request->qty;
            session(['cart' => $cart]); 
        }

        $returnarr = $this->total(1,$cart);

        return response()->json(['total' => $returnarr[0],'totalprice' => $returnarr[1]]); 
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
     /**
     * Delete an item.
     */

     public function deleteAjax(Request $request)
     {
        $cart = session('cart', []);
        unset($cart[$request->id]);
        session(['cart' => $cart]); 
 
        $total = 0;
        foreach($cart as $value){
            $total = $total + $value['qty'];
        } 
 
         return response()->json(['total' => $total]); 
     }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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

    public function cartAjax(Request $request){

        //Lấy tất cả thông tin sản phẩm theo id
        $productInfo = Product::findOrFail($request->id)->toArray();
       //dd($productInfo);

       //Lấy session 'cart' nếu có, nếu không thì khởi tạo mảng trống
       $cart = session('cart', []);
       //dd($cart);

        //Check coi có tồn tại của sản phẩm thêm vào chưa chưa
        if (isset($cart[$request->id])) {
            // Nếu đã có, tăng quantity lên 1
            $cart[$request->id]['qty'] += 1;
            //echo($cart[$request->id]['qty']);

        } else {
            // Nếu chưa có, thêm sản phẩm mới với qty = 1
            $productInfo['qty'] = 1;
            $cart[$request->id] = $productInfo;
        } 

        // Cập nhật lại session 'cart'
        session(['cart' => $cart]); 
        
        $total = 0;
        foreach($cart as $value)
        {
            $total = $total + $value['qty'];
        }
        //echo ($total);
        /* echo("<pre>");
        var_dump($cart);
        echo("</pre>"); */
        return response()->json([ 'total' => $total ]);
    }
}
