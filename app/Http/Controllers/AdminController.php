<?php
 
namespace App\Http\Controllers;
 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Session;
 
class AdminController extends Controller{
    
    public function index(Request $request){
        if (Auth::user() && Auth::user()->role==1) {
            return redirect()->route('admin_dashboard'); 
        }
        if ($request->isMethod('post')) {
            $email=$request->email;
            $password=$request->password;
            if (Auth::attempt(['email' => $email, 'password' => $password, 'role' => 1])) {
                return redirect()->route('admin_dashboard');
            }else{
                return back()->with('error','Not an Authorize user.');
            }
        }
        return view('admin.login');
    }
    public function dashboard(){
        return view('admin.dashboard');
    }
    public function logout(){
        Session::flush();        
        Auth::logout();
        return redirect()->route('admin_login');
    }
}