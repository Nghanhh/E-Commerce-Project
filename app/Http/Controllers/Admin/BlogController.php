<?php

namespace App\Http\Controllers\Admin;

Use App\Models\Blog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CreateblogRequest;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blog = Blog::paginate(4);
        return view('Admin.blog.table-blog', compact('blog'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.blog.create-blogs');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(/* CreateblogRequest $request */ Request $request)
    {
        $data = $request->all(); 
        
        $file = $request->image;
        
        if(!empty($file)){
            $data['image'] = $file->getClientOriginalName();
        } 

        if (Blog::create($data)) {
            if(!empty($file)){
                $file->move('upload/user/blog', $file->getClientOriginalName());
            }
            return redirect()->back()->with('success', __('Create blog success.'));
        } else {
            return redirect()->back()->withErrors('Create blog error.');
        } 
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $blog = Blog::find($id)->toArray();
         return view('Admin.blog.edit-blogs', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $blog = Blog::findOrFail($id);
        $data = $request->all();
        $file = $request->image;
        
        if(!empty($file)){
            $data['image'] = $file->getClientOriginalName();
        }
       
        if ($blog->update($data)) {
            if(!empty($file)){
                $file->move('upload/user/blog', $file->getClientOriginalName());
            }
            return redirect()->back()->with('success', __('Edit blog success.'));
        } else {
            return redirect()->back()->withErrors('Edit blog error.');
        } 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(Blog::where('id',$id)->delete()){
            return redirect()->back()->with('success', 'Blog deleted successfully.');
        }else{
            return redirect()->back()->withErrors('Blog not found.');
        }
    }
}
