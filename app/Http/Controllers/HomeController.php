<?php

namespace App\Http\Controllers;
use App\Models\LeaveEvent;
use App\Models\RestrictedDates;
use Illuminate\Http\Request;
Use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $restricted_dated=RestrictedDates::select(['restricted_dated'])->get()->toArray();
        $levents=LeaveEvent::where(['user_id'=>Auth::user()->id])->get()->toArray();
        $final_array=[];
        if(!empty($levents)){
            foreach ($levents as $key => $value) {
                $data=[
                    "title"     => (!empty($value['event_title']))?$value['event_title']:"",
                    "start"     => (!empty($value['start_date']))?date('Y-m-d H:i:s',strtotime($value['start_date'])):"",
                    "end"       => (!empty($value['end_date']))?date('Y-m-d H:i:s',strtotime($value['end_date'])):"",
                    "color"     => (!empty($value['status']))?'#257e4a':"#0d6efd",
                    "status"    =>  (!empty($value['status']))?'Approved':"Pending",
                ];
                $final_array[]=$data;
            }
        }
        $restricted_dated=array_column($restricted_dated,'restricted_dated');
        $final_restricted_array=[];
        if(!empty($restricted_dated)){
            foreach ($restricted_dated as $key => $value) {
                $res_data=json_decode($value,1);
                $final_restricted_array=array_merge($final_restricted_array,$res_data);
            }
        }
        return view('staff_dashboard',['levents'=>json_encode($final_array),"restricted_dated"=>$final_restricted_array]);
    }
    public function save_event(Request $request){
        // dd($request->all());
        $input=$request->all();
        if ($request->isMethod('post')) {
            $event=[
                'user_id'=>Auth::user()->id,
                'event_title'=>$input['event_title'],
                'start_date'=>(!empty($input['from_date']))?date('Y-m-d H:i:s',strtotime($input['from_date'])):date('Y-m-d H:i:s'),
                'end_date'=>(!empty($input['to_date']))?date('Y-m-d H:i:s',strtotime($input['to_date'])):date('Y-m-d H:i:s'),
                'leave_type'=>$input['leave_type'],
                'description'=>$input['description'],
            ];
            $event=LeaveEvent::create($event);
            if($event->id){
                $m_final_data=['success'=>true];
            }else{
                $m_final_data=['success'=>false];
            }
            return response()->json($m_final_data);
        }
    }
}
