<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AddproductRequest;
use Intervention\Image\Laravel\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::check()){

            $product = Product::where("id_user",Auth::user()->id)->get()->toArray();
            $getArrImage = [];
            
            $x = 0;
            
            foreach($product as $value){

                $getArrImage[$value["id"]] = json_decode($value['images'], true);  
            }

            $productincart = session('cart', []); 
            $total = 0;
            if($productincart){
                foreach($productincart as $value){
                    $total = $total + $value['qty'];
                } 
            }

            return view('Frontend.product.my-product',compact(['product','getArrImage','total']));

        }else{

            return redirect('/member/login');

        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(Auth::check()){
            
            $category = Category::all()->toArray();
            $brand = Brand::all()->toArray();

            return view('Frontend.product.add-product',compact(['category','brand']));
            
        }else{

            return redirect('/member/login');

        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddproductRequest $request)
    {
        //Sử dụng function imagehandle để trả về array $imagename để lấy lưu vào database
        $imgname = $this->imagehandle($request);

        //Tạo instance từ class Product
        $product= new Product();

        //Lưu thui
        if( $this->savedata($product, $request, $imgname)){
            return redirect()->back()->with('success', 'Product added successfully!');
        }else{
            return redirect()->back()->withErrors('Add product error.');
        }

    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id)->toArray();
        
        $brand = Brand::find($product['id_brand']);
        $imgarr = json_decode($product['images'],true);
        
        //dd($imgarr);
        return view('Frontend.product.product-details',compact('product','brand','imgarr'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if(Auth::check()){
            $product = Product::find($id)->toArray();
            $category = Category::all()->toArray();
            $brand = Brand::all()->toArray();
            $getArrImage = json_decode($product['images'], true);  
            
            return view("Frontend.product.edit-product",compact('product','category','brand','getArrImage'));
        }else{

            return redirect('/member/login');

        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //Bước 1: Xử lý ảnh để lấy được cái array để lưu vào data
            //Lấy sản phẩm của User($id)
            $product = Product::find($id);

            //Lấy ảnh của sản phẩm trong database để chuyển sang array
            $getproduct = $product->toArray();
            $getArrImage = json_decode($getproduct['images'], true);  

            //Lấy ảnh được chọn để xóa thêm vào
            $imageToDelete = $request->imageToDelete;

            //Xóa ảnh trong database được chọn và trả về array những ảnh còn lại
            if($imageToDelete){
                foreach($imageToDelete as $image){
                    if(in_array($image, $getArrImage)){
                        unset($getArrImage[array_search($image, $getArrImage)]);  // Xóa phần tử
                    }
                }
            } 
            $getArrImage = array_values($getArrImage); //Ở đây đã có array còn lại sau khi xóa (hoặc không)

            //Giờ đếm coi có ảnh mới up lên không, nếu không thì $imgname = $getArrImage
            //nếu có thì ảnh mới up lên là bao nhiêu ảnh
            //Rồi nếu tổng ảnh <= 3 thì call back hàm hanlde img, sau đó hàm handle trể về một array, merge nó với
            //$getArrImage
            if($request->file('image')){
                $uploadedFileCount = count($request->file('image'));
                if((count($getArrImage)+$uploadedFileCount) <= 3){
                    $newupload = $this->imagehandle($request);
                    $imgname = array_merge($getArrImage,$newupload);
                }else{
                    return redirect()->back()->withErrors('Each product can only upload 3 photos in total.');
                }
            }else{
                $imgname = $getArrImage;
            }

        //Bước 2: Gọi function để lưu dữ liệu update vào database
            //Muốn lưu được như bên dưới thì cần có $product, $request và array $imgname
                //1.Product: $product = Product::find($id);
                //2.Request thì Laravel truyền vào.
                //3.$imgname ở đây là một cái array được merge từ array ảnh cũ còn lại và ảnh mới được up lên (nếu có)
            if( $this->savedata($product, $request, $imgname)){
                return redirect()->back()->with('success', 'Product added successfully!');
            }else{
                return redirect()->back()->withErrors('Add product error.');
            }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //echo "gì z";
        $product = Product::find($id);

        if($product){

            $product->delete();

            return redirect()->back()->with('success', __('Product deleted successfully.'));

        }else{

            return redirect()->back()->withErrors('Product not found.');

        } 
    }

    public function savedata(Product $product, Request $request, array $imagedata){

        $product->name = $request->name;
        $product->price = $request->price;
        $product->id_user = Auth::id();  // Auth::id() đơn giản hơn Auth::user()->id
        $product->id_category = $request->id_category;
        $product->id_brand = $request->id_brand;

        if ($request->filled('status')) {
            $product->status = $request->status;
            $product->sale = $request->sale;
        }

        $product->company = $request->company;
        $product->images = json_encode($imagedata);  // Chuyển mảng ảnh thành JSON
        $product->detail = $request->detail;
        return $product->save();

    }

    public function imagehandle(Request $request){

        //Tạo mảng trống để lấy tên ảnh mới up lên
        $imgname = [];

        //Nếu như có ảnh mới up lên thì sẽ thực hiện đoạn code này
        if($request->hasfile('image')){

           //Đếm số lượng ảnh mới up lên
            $files = $request->file('image');

            //Tạo thư mục nếu chưa có
            $id = Auth::id();
            $path = public_path('upload/product/' . $id);
            if (!is_dir($path)) {
                mkdir($path, 0755, true);
            } 
           //Lấy thời gian hiện tại rồi chuyển thành INT
            $time = now();  // Lấy thời gian hiện tại (Carbon object)
            $timeint = strtotime($time->toDateTimeString());  // Chuyển thành chuỗi và rồi thành timestamp
            foreach($files as $value){

                //dòng này để tạo một đối tượng từ facede Image, cái đối tượng đó mới sử dụng được những cái như resize
                $image = Image::read($value);

                $name_1 =  $timeint .'_'. $value->getClientOriginalName();
                $name_2 = "hinh85_" . $name_1;
                $name_3 = "hinh329_". $name_1;

                $path1 = $path . '/' . $name_1; 
                $path2 = $path . '/' . $name_2;
                $path3 = $path . '/' . $name_3;
                
                $image->save($path1);
                $image->resize(85, 85)->save($path2);
                $image->resize(329, 380)->save($path3); 

                $imgname[] = $name_1;
            } 
           
        }
        return $imgname;
    }

    
}