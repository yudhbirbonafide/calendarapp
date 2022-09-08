<?php

namespace App\Http\Controllers;

use App\Models\LeaveEvent;

use Illuminate\Http\Request;
Use Auth;

class CalendarController extends Controller
{
    
    public function calender_setup(){
        $levents=LeaveEvent::all()->toArray();
        $final_array=[];
        if(!empty($levents)){
            foreach ($levents as $key => $value) {
                $data=[
                    "title"     => (!empty($value['event_title']))?$value['event_title']:"",
                    "start"     => (!empty($value['start_date']))?date('Y-m-d H:i:s',strtotime($value['start_date'])):"",
                    "end"       => (!empty($value['end_date']))?date('Y-m-d H:i:s',strtotime($value['end_date'])):"",
                    "color"     => (!empty($value['status']))?'#257e4a':"#0d6efd",
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
                $m_final_data=['success'=>true];
            }else{
                $m_final_data=['success'=>false];
            }
            return response()->json($m_final_data);
        }
    }
}
