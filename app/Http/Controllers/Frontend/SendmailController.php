<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Mail\MailNotify;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
//Import facade Mail từ Laravel để sử dụng các hàm tiện ích liên quan đến gửi email.
//Facade Mail đại diện cho service gửi mail trong Laravel và cho phép gọi các phương
//thức gửi email như send(), to(), hoặc queue().

class SendmailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cart = session('cart', []);
        $returnarr = $this->total(0,$cart);
        $getArrImage = $returnarr[2];
        $total = $returnarr[0];
        $totalprice = $returnarr[1];
        
        $country = Country::all()->toArray();
        
        if(Auth::check() && $cart){
            $userEmail = Auth::user()->email; // Lấy email của người dùng đã đăng nhập
            $data = [
                'subject' => 'Here is your shopping cart information, please check and confirm.',
                'body'    => $cart,
                'total'   => [$total, $totalprice]
            ];
            //dd ($data);
                try {
                    Mail::to($userEmail)->send(new MailNotify($data));
                    // Trả về view với thông báo thành công
                    return view('Frontend.sendmail.checkout', compact(
                        'country', 'cart', 'getArrImage', 'total', 'totalprice'
                    ))->with('message', 'Great! Check your mailbox.');
                    
                }catch (Exception $th){
                    // Trả về view với thông báo lỗi
                    return view('Frontend.sendmail.checkout', compact(
                        'country', 'cart', 'getArrImage', 'total', 'totalprice'
                    ))->with('error', 'Sorry, something went wrong.');
                } 
            
        }else{
            return view('Frontend.sendmail.checkout',compact('country','cart','getArrImage','total','totalprice'));
        }
    }

    /**
     * Calculate the total quantity and amount of products.
     */
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
     * Send mail.
     */
    public function mail()
    {
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
}
