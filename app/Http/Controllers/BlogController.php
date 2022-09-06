<?php
 
namespace App\Http\Controllers;
 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Blog;
use File;
 
class BlogController extends Controller{
    
    public function blogs(Request $request){
        $result=Blog::paginate(10);
        $heading="Blogs";
        return view('admin.blog.list',['result'=>$result,'heading'=>$heading]);
    }
    public function blogs_edit(Request $request,$id=null){        
        if ($request->isMethod('post')) {
            // dd($request->all());
            $file_upload="";
            if ($request->hasFile('image')) {
                $file_upload=$this->fileUpload($request);
            }
            $blog_info=[
                'image'=>(!empty($file_upload))?$file_upload:$request->old_image,
                'title'=>$request->title,
                'blog_desc'=>$request->blog_desc,
            ];

            $lastInsertedId="";
            $msg="";
            if(!empty($request->id)){
                Blog::where('id', $request->id)->update($blog_info);
                $lastInsertedId=true;
                $msg="updated";
            }else{
                $result= Blog::create($blog_info);
                $lastInsertedId=$result->id;
                $msg="created";
            }
            if (!empty($lastInsertedId)) {
                return redirect()->route('admin_blogs')->with('success','Record has been '.$msg.' successfully.');
            }else{
                return back()->with('error','Not an Authorize user.');
            }
        }
        $blog="";       
        $heading="Blogs";
        if(!empty($id)){
            $blog = Blog::find($id);
        }
        return view('admin.blog.edit',['blog'=>$blog,'heading'=>$heading]);
    }
    public function blogs_delete(Request $request,$id=null){ 
        Blog::where('id', $id)->delete();
        return redirect()->route('admin_blogs')->with('success','Record has been deleted successfully.');
    }

    public function fileUpload(Request $request) {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5048',
        ]);    
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();   
            $storage_path='uploads/blogs/';         
            $destinationPath = public_path().'/'.$storage_path;
            File::makeDirectory($destinationPath, $mode = 0777, true, true);
            $image->move($destinationPath, $name);
            return $storage_path.$name;
        }
    }
    public function blog_post(Request $request,$id){
        $result=Blog::where(['id'=>$id])->first();
        $heading="Blogs";
        return view('blog.post',['result'=>$result,'heading'=>$heading]);
    }


}