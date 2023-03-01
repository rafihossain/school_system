<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class SettingController extends Controller
{
    function __construct(){
        $this->middleware('role:super admin|admin|manager|parent|student|teacher|staff');
    }

    //system_setting_list
    public function system_setting_list(){
        $setting_basic = DB::table('setting_basics')->first();
        // dd($setting_basic);

        $system_system = DB::table('system_systems')->first();
        // $system_theme = DB::table('system_themes')->first();


        $paypal = DB::table('payment_settings')->where('payment_status', 1)->first();
        $stripe = DB::table('payment_settings')->where('payment_status', 2)->first();
        $razorpay = DB::table('payment_settings')->where('payment_status', 3)->first();
        $paystack = DB::table('payment_settings')->where('payment_status', 4)->first();

        // dd($paypal);


        return view('backend.system-setting.system_setting', [
            'setting_basic' => $setting_basic,
            'system_system' => $system_system,
            'paypal' => $paypal,
            'stripe' => $stripe,
            'razorpay' => $razorpay,
            'paystack' => $paystack,
        ]);
    }

    protected function faviconImageUpload($faviconImage){
        $image = Image::make($faviconImage);
        $fileType = $faviconImage->getClientOriginalExtension();
        $imageName = 'favicon_' . time() . '_' . rand(10000, 999999) . '.' . $fileType;
        $directory = 'images/settings/basic/';
        $imageUrl = $directory . $imageName;
        $image->save($imageUrl);

        return $imageName;
    }
    protected function logoImageUpload($logoImage){
        $image = Image::make($logoImage);
        $fileType = $logoImage->getClientOriginalExtension();
        $imageName = 'logo_' . time() . '_' . rand(10000, 999999) . '.' . $fileType;
        $directory = 'images/settings/basic/';
        $imageUrl = $directory . $imageName;
        $image->save($imageUrl);

        return $imageName;
    }
    protected function darklogoImageUpload($darkImage){
        $image = Image::make($darkImage);
        $fileType = $darkImage->getClientOriginalExtension();
        $imageName = 'dark_logo_' . time() . '_' . rand(10000, 999999) . '.' . $fileType;
        $directory = 'images/settings/basic/';
        $imageUrl = $directory . $imageName;
        $image->save($imageUrl);

        return $imageName;
    }

    public function basic_form_serialize(Request $request){
        // dd($_POST);
        // $request->validate([
        //     'department_name' => 'required|unique:departments,department_name',
        //     'description' => 'required',
        //     'department_image' => 'file|max:2048|dimensions:max_width=1024,max_height=1024',
        // ]);

        $basic = DB::table('setting_basics')->find($request->id);
        // dd($basic);


        $faviconImage = $request->file('favicon');
        $faviconUrl = '';
        if($faviconImage){
            $faviconUrl = $this->faviconImageUpload($faviconImage);
        }else{
            $faviconUrl = $basic->favicon;
        }

        $logoImage = $request->file('logo');
        $logoUrl = '';
        if($logoImage){
            // dd('test');
            $logoUrl = $this->logoImageUpload($logoImage);
        }else{
            $logoUrl = $basic->logo;
        }
            // dd($logoUrl);

        $darkLogoImage = $request->file('dark_mode_logo');
        $darkLogoUrl = '';
        if($darkLogoImage){
            $darkLogoUrl = $this->darklogoImageUpload($darkLogoImage);
        }else{
            $darkLogoUrl = $basic->dark_mode_logo;
        }


        DB::table('setting_basics')->where('id',$request->id)->update([
            'name' => $request->name,
            'short_name' => $request->short_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'adddress' => $request->adddress,
            'favicon' => $faviconUrl,
            'logo' => $logoUrl,
            'dark_mode_logo' => $darkLogoUrl,
        ]);

        return redirect()->route('backend.system-setting-list')->with('success', 'Info has been added successfully !!');
    }

    public function system_form_serialize(Request $request){
        DB::table('system_systems')->where('id',$request->id)->update([
            'time_diff' => $request->time_diff,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);
        return redirect()->route('backend.system-setting-list')->with('success', 'Info has been added successfully !!');
    }

    public function paypal_payment_form(Request $request){
        DB::table('payment_settings')->where('payment_status',$request->status)->update([
            'live_mode' => $request->live_mode,
            'publisher_key' => $request->paypal_key,
            'secret_key' => $request->paypal_secret,
            'payment_status' => 1,
        ]);
        return redirect()->route('backend.system-setting-list')->with('success', 'Paypal setting Updated !!');
    }

    public function stripe_payment_form(Request $request){
        DB::table('payment_settings')->where('payment_status',$request->status)->update([
            'publisher_key' => $request->stripe_key,
            'secret_key' => $request->stripe_secret,
            'payment_status' => 2,
        ]);
        return redirect()->route('backend.system-setting-list')->with('success', 'Stripe setting Updated !!');
    }

    public function razorpay_payment_form(Request $request){
        DB::table('payment_settings')->where('payment_status',$request->status)->update([
            'publisher_key' => $request->razorpay_key,
            'secret_key' => $request->razorpay_secret,
            'payment_status' => 3,
        ]);
        return redirect()->route('backend.system-setting-list')->with('success', 'Razorpay setting Updated !!');
    }

    public function paystack_payment_form(Request $request){
        // dd($_POST);

        DB::table('payment_settings')->where('payment_status',$request->status)->update([
            'publisher_key' => $request->paystack_key,
            'secret_key' => $request->paystack_secret,
            'merchant_email' => $request->paystack_email,
            'payment_status' => 4,
        ]);
        return redirect()->route('backend.system-setting-list')->with('success', 'Paystack setting Updated !!');
    }

    // public function theme_form_serialize(Request $request){

    //     DB::table('system_themes')->where('id',$request->id)->update([
    //         'sidebar_bgcolor' => $request->sidebar_bgcolor,
    //         'navigation_bgcolor' => $request->navigation_bgcolor,
    //         'sidebar_txtcolor' => $request->sidebar_txtcolor,
    //         'navigation_txtcolor' => $request->navigation_txtcolor,
    //         'left_nav_position' => $request->left_nav_position,
    //         'top_nav_position' => $request->top_nav_position,
    //         'box_layout' => $request->box_layout,
    //         'full_width_layout' => $request->full_width_layout
    //     ]);

    //     return redirect()->route('backend.system-setting-list')->with('success', 'Info has been added successfully !!');

    // }
}
