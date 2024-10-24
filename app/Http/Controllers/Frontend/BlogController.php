<?php

namespace App\Http\Controllers\Frontend;

Use App\Models\Blog;
Use App\Models\Rate;
Use App\Models\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blog = Blog::orderBy('id', 'desc')->paginate(3);
        return view('Frontend.blog.blog', compact('blog'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $blog = Blog::find($id)->toArray();
        $rate = Rate::where('id_blog', $id)->get()->toArray();

        $comment = Comment::where('id_blog', $id)->orderBy('id', 'desc')->get()->toArray();
        $count = count($rate);
        $sum = 0;

        if($count > 0){

        for ($i = 0; $i < $count; $i++){
            $sum = $sum + $rate["$i"]["rate"];
        }
        $average = round($sum/$count);

        }else{
            $average = 0;
        }
        

        /* echo "<pre>";
        var_dump ($average);
        echo "</pre>";  */
        return view('Frontend.blog.blog-detail',compact('blog','average','count','comment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function commentAjax(Request $request)
    {
        //dd($request->all());

        $id_user = Auth::user()->id;
        $avatar = Auth::user()->avatar;
        $name = Auth::user()->name;

        $comment = new Comment();
            $comment->comment = $request->comment;;
            $comment->id_blog = $request->id_blog;
            $comment->id_user = $id_user;
            $comment->avatar = $avatar;
            $comment->user_name = $name;
            $comment->level = $request->level;
 
        //dd($comment);  =>ok
        $comment->save();
        
        
        return response()->json(['commentinfo' => $comment]); 
    }

    public function rateAjax(Request $request){
        //dd($request->all()); ok truyền thông tin qua rồi, giờ insert thông tin vào table thôi
        //có điểm vs id block, id user thì lấy qua auth->user, 
        $id_user = Auth::user()->id;
        $whorated = Rate::where('id_blog',$request->id_blog)->pluck('id_user')->toArray();
        //echo "<pre>";
        
        if (in_array($id_user, $whorated)) {

            return response()->json(['x' => 0]);

        } else {
            $point = $request->rate;
            $rate = new Rate();
                $rate->rate = $point;
                $rate->id_blog = $request->id_blog;
                $rate->id_user = $id_user;

                $rate->save();
                return response()->json(['x' => 1]);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
