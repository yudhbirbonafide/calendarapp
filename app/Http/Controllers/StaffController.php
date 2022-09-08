<?php
 
namespace App\Http\Controllers;
 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Session;
use Hash;
 
class StaffController extends Controller{
    
    public function staff(Request $request){
        $result=User::where(["role"=>2])->orderBy('id', 'desc')->paginate(10);
        $heading="Users";
        return view('admin.staff.list',['result'=>$result,'heading'=>$heading]);
    }
    public function staff_edit(Request $request,$id=null){        
        if ($request->isMethod('post')) {
            $lastInsertedId="";
            $msg="";
            $user_data=[
                'name' => $request['name'],
                'email' => $request['email'],
                'status' => $request['status'],
                'assigned_color' => $request['assigned_color'],
            ];
            if(!empty($request->id)){                
                User::where('id', $request->id)->update($user_data);
                $lastInsertedId=true;
                $msg="updated";
            }else{
                $user_data['password']=Hash::make($request['password']);
                $result= User::create($user_data);
                $lastInsertedId=$result->id;
                $msg="created";
            }
            if (!empty($lastInsertedId)) {
                return redirect()->route('admin_staffs')->with('success','Record has been '.$msg.' successfully.');
            }else{
                return back()->with('error','Not an Authorize user.');
            }
        }
        $result="";
        $heading="Users";
        if(!empty($id)){
            $result = User::find($id);
        }
        return view('admin.staff.edit',['user'=>$result,'heading'=>$heading]);
    }
    public function staff_delete(Request $request,$id=null){ 
        User::where('id', $id)->delete();
        return redirect()->route('admin_staffs')->with('success','Record has been deleted successfully.');
    }   
    
}