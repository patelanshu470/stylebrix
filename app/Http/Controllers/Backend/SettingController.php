<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    #profile-setting
    public function profileSetting(Request $request){
        return view('backend.setting.profile_setting');
    }
    public function profileSettingUpdate(Request $request){
        $data=User::find(auth()->user()->id);
        if ($request->file('image')) {
            $uploadFile = $request->file('image');
            $file_name = $uploadFile->hashName();
            $path = $uploadFile->move('public/images/profile/', $file_name);
            $data->profile_image = $file_name;
        }
        $data->name=$request->name;
        $data->email=$request->email;
        $data->save();
        return back()->with('success','Profile setting update successfully');
    }

    public function passwordSetting(){
        return view('backend.setting.password_setting');
    }
    public function passwprdSettingupdate(Request $request){
        $rules = [
            'old_password' => 'required',
            'new_password' => 'required',
        ];
        $customMessages = [
            'old_password.required' => 'Old Password is required.',
            'new_password.required' => 'New Password is required.',
        ];
        $validator = Validator::make($request->all(), $rules, $customMessages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return redirect()->back()->withErrors(['old_password' => 'Old password is incorrect.'])->withInput();

        }


        if(Hash::check($request->old_password, auth()->user()->password)){
            $data=User::find(auth()->user()->id);
            $data->password=Hash::make($request->new_password);
            $data->save();
            return redirect()->back()->with('success',"Password Updated Successfully");
        }else{
            return redirect()->back()->with('error',"Password not matched");
        }

    }

}
