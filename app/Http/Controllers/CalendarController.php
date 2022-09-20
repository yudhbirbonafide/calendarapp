<?php

namespace App\Http\Controllers;

use App\Models\LeaveEvent;
use App\Models\RestrictedDates;

use Illuminate\Http\Request;
Use Auth;

class CalendarController extends Controller
{
    
    public function calender_setup(){
        $levents=LeaveEvent::join('users', 'tbl_leave_events.user_id', '=', 'users.id')->select('tbl_leave_events.*','users.assigned_color') ->get()->toArray();
        $final_array=[];
        if(!empty($levents)){
            foreach ($levents as $key => $value) {
                $data=[
                    "title"     => (!empty($value['event_title']))?$value['event_title']:"",
                    "start"     => (!empty($value['start_date']))?date('Y-m-d H:i:s',strtotime($value['start_date'])):"",
                    "end"       => (!empty($value['end_date']))?date('Y-m-d H:i:s',strtotime($value['end_date'])):"",
                    "color"     => (!empty($value['assigned_color']))?$value['assigned_color']:"#0d6efd",
                    "status"    =>  (!empty($value['status']))?'Approved':"Pending",
                    "event_id"    =>  (!empty($value['id']))?$value['id']:"0",
                ];
                $final_array[]=$data;
            }
        }
        return view('admin.calendar.index',['levents'=>json_encode($final_array)]);
    }
    public function fetch_event_info(Request $request){
        if(!empty($request->event_id)){
            $single_events=LeaveEvent::where(['id'=>$request->event_id])->first()->toArray();
            $evnt_dta= view('admin.calendar.fetch_event_info',['single_events'=>$single_events])->render();
            $m_final_data=['success'=>true,"html"=>$evnt_dta];
            return response()->json($m_final_data);
        }else{
            $m_final_data=['success'=>false,"html"=>""];
            return response()->json($m_final_data);
        }
    }
    public function save_event_info(Request $request){
        // dd($request->all());
        $input=$request->all();
        if ($request->isMethod('post')) {
            $event=[                
                'event_title'=>$input['event_title'],
                'start_date'=>(!empty($input['from_date']))?date('Y-m-d H:i:s',strtotime($input['from_date'])):date('Y-m-d H:i:s'),
                'end_date'=>(!empty($input['to_date']))?date('Y-m-d H:i:s',strtotime($input['to_date'])):date('Y-m-d H:i:s'),
                'leave_type'=>$input['leave_type'],
                'description'=>$input['description'],
                'status'=>$input['status'],
            ];
            $event=LeaveEvent::where(['id'=>$input['event_id']])->update($event);
            $event_flag=true;
            if($event_flag){
                if($input['status']==1){
                    $details=LeaveEvent::join('users', 'tbl_leave_events.user_id', '=', 'users.id')->select('users.*')->where(["tbl_leave_events.id"=>$input['event_id']])->first()->toArray();
                    if(!empty($details)){
                        \Mail::to($details['email'])->send(new \App\Mail\ApprovalEmail($details));
                    }
                }
                $m_final_data=['success'=>true];
            }else{
                $m_final_data=['success'=>false];
            }
            return response()->json($m_final_data);
        }
    }
    public function save_restricted_dated_info(Request $request){        
        $input=$request->all();
        if ($request->isMethod('post')) {
            $restricted_dated=(!empty($input['restricted_dated']))?explode('~',$input['restricted_dated']):"";
            if(!empty($restricted_dated) && is_array($restricted_dated)){
                $restricted_dated=$this->dateRange($restricted_dated[0],$restricted_dated[1]);
                // dd($restricted_dated);
                $restricted_dated=array_map('trim', $restricted_dated);
                $restricted_dated=json_encode($restricted_dated);
                // dd($restricted_dated);
                $restricted_info=[                
                    'restricted_dated'=>$restricted_dated,
                    'year'       =>date('Y'),
                ];
                $result=RestrictedDates::create($restricted_info);
                if($result->id){
                    $m_final_data=['success'=>true];
                }else{
                    $m_final_data=['success'=>false];
                }
            }else{
                $m_final_data=['success'=>false];
            }
            return response()->json($m_final_data);
        }
    }
    function dateRange( $first, $last, $step = '+1 day', $format = 'Y-m-d' ) {
        $dates = array();
        $current = strtotime( $first );
        $last = strtotime( $last );    
        while( $current <= $last ) {    
            $dates[] = date( $format, $current );
            $current = strtotime( $step, $current );
        }
    
        return $dates;
    }
}
