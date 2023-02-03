<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Calender;
use App\Models\ClassModal;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    function __construct(){
        $this->middleware('role:super admin|admin|manager|parent|student|teacher|staff');
    }
    //announcement
    public function manage_message(){
        // dd(11);
        $classes = ClassModal::get();
        // dd($classes);

        return view('backend.announcement.add_announcement', [
            'classes' => $classes
        ]);
    }

    public function save_notification(Request $request){
        
        $request->validate([
            'title' => 'required',
            'message' => 'required',
            'class_id' => 'required',
        ]);

        if($request->now != ''){
            $schedule = date('Y-m-d');
        }
        if($request->future_date != ''){
            $schedule = $request->future_date;
        }
        
        $announcement = new Announcement();
        $announcement->class_id = $request->class_id;
        $announcement->title = $request->title;
        $announcement->message = $request->message;
        $announcement->schedule = $schedule;
        $announcement->save();
        
        return redirect()->route('backend.manage-message')->with('success', 'Send notification successfully !!');

    }

    public function manage_calender(){
        return view('backend.announcement.manage_calender');
    }

    protected function show_event_data($calenders){
        $events = [];
        foreach($calenders as $key => $event)
        {
            $events[] = [
                'id'=> $event->id,
                'title'=> $event->event_title,
                'start'=>$event->start_date,
                'end'=>$event->end_date,
            ];
        }
        return $events;
    }

    public function show_events_list(){
        $calenders = Calender::get();
        $events = $this->show_event_data($calenders);
        return response()->json($events);
    }

    public function save_calender_event(Request $request){
        $request->validate([
            'event_title' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        Calender::create([
            'event_title' => $request->event_title,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        $calenders = Calender::get();
        $events = $this->show_event_data($calenders);
        return response()->json($events);
    }

    public function update_calender_event(Request $request){
        $request->validate([
            'event_title' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        // dd($_POST);

        Calender::find($request->id)->update([
            'event_title' => $request->event_title,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        $calenders = Calender::get();
        $events = $this->show_event_data($calenders);
        return response()->json($events);
    }

    public function delete_calender_event(Request $request){
        // dd($request->event_id);
        Calender::find($request->event_id)->delete();
        $calenders = Calender::get();
        $events = $this->show_event_data($calenders);
        return response()->json($events);
    }
}
