<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\AnnouncementNotify;
use App\Models\Student;
use App\Models\User;

class NotificationsController extends Controller
{
    public function send_mail()
    {

        $todayDate = date('Y-m-d');
        $announcements = Announcement::where(['schedule' => $todayDate, 'status' => 0])->get();
        //dd($announcements);


        /*=============================================================
                    Get Tenant/ Owner / Employee 
        ===============================================================*/

        foreach ($announcements as $key => $announcement) {

            if ($announcement->status == 0) {
                $students = Student::where('class_id', $announcement->class_id)->get();
                
                // $user = [];
                foreach($students as $student){
                    $user = User::find($student->user_id);

                    $msgnotify = new AnnouncementNotify();
                    $msgnotify->student_name = $user->name;
                    $msgnotify->student_email = $user->email;
                    $msgnotify->student_phone = $user->mobile;
                    $msgnotify->mail_subject = $announcement->title;
                    $msgnotify->mail_message = $announcement->message;
                    $msgnotify->mail_status = 1;
                    $msgnotify->save();

                    $announce = Announcement::find($announcement->id);
                    $announce->status = 1;
                    $announce->save();

                }
                // dd($user);
            }else{
                dd('Record not found!');
            }

            
        }

        echo "success";
    }
}
