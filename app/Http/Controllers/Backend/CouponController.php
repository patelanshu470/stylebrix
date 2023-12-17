<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CouponController extends Controller
{
    public function coupon()
    {
        $datas = Coupon::all();
        return view('backend.coupon.coupon', compact('datas'));
    }
    public function couponStore(Request $request)
    {

        $data = new Coupon();
        if ($request->file('image')) {
            $uploadFile = $request->file('image');
            $file_name = $uploadFile->hashName();
            $path = $uploadFile->move('public/images/coupon/', $file_name);
            $data['image'] = $file_name;
        }
        $data->header_text = $request->header_text;
        $data->discount = $request->discount;
        $data->coupon_code = $request->coupon_code;
        $data->expiry_date = $request->expiry_date;
        $data->status = '1';
        $is_feature = ($request->is_feature) ? $request->is_feature : '0';
        if ($is_feature == '1') {
            Coupon::where('is_feature', '1')->update(['is_feature' => '0']);
        }
        $data->is_feature = ($request->is_feature) ? $request->is_feature : '0';
        $data->save();
        return redirect()->route('coupon')->with('success', "Coupon is created successfully.");
    }
    public function couponUpdate(Request $request, $id)
    {

        $data = Coupon::find($id);
        if ($request->file('image')) {
            $uploadFile = $request->file('image');
            $file_name = $uploadFile->hashName();
            $path = $uploadFile->move('public/images/coupon/', $file_name);
            $data['image'] = $file_name;
        }
        $data->header_text = $request->header_text;
        $data->discount = $request->discount;
        $data->coupon_code = $request->coupon_code;
        $data->expiry_date = $request->expiry_date;
        $is_feature = ($request->is_feature) ? $request->is_feature : '0';
        if ($is_feature == '1') {
            Coupon::where('id', '!=', $id)->update(['is_feature' => '0']);
        }
        $data->is_feature = ($request->is_feature) ? $request->is_feature : '0';

        $data->save();
        return redirect()->route('coupon')->with('success', "Coupon is updated successfully.");
    }
    public function couponCheck(Request $request)
    {
        $datas['data'] = null;
        if ($request->id) {
            $datas['data'] = Coupon::where([["coupon_code", 'like', $request->code], ['id', '<>', $request->id]])->get()->first();
        } else {
            $datas['data'] = Coupon::where([["coupon_code", 'like', $request->code]])->get()->first();
        }
        return response()->json($datas);
    }
    public function couponStatus(Request $request)
    {
        $data = Coupon::find($request->id);
        $data->status = $request->status;
        $data->save();
        return response()->json([
            'success' => 'Coupon status has been updated successfully!'
        ]);
    }
    public function couponDelete($id)
    {
        $data = Coupon::findOrFail($id);
        if ($data->image) {
            $imagePath = 'public/images/coupon/' . $data->image;
            unlink($imagePath);
        }
        $data->delete();
        return back()->with('success', "Coupon is delete successfully.");
    }
    public function couponSend($id)
    {
        $coupon = Coupon::find($id);
        $users = User::where([['type','user']])->select('email', 'name')->get();
        if ($users->count() > 0) {
            foreach ($users as $user) {
        $data = [
            'tomail' => $user->email,
            'tonamemail' => $user->name,
            'couponCode' => $coupon->coupon_code,
            'off' => $coupon->discount,
        ];
        Mail::send('backend.email.coupon_email', $data, function ($message) use ($data) {
            $message->to($data['tomail'], $data['tonamemail'])->subject('Special Coupon Offer for you only.');
            $message->from(getenv('MAIL_FROM_ADDRESS'), config('MAIL_USERNAME'));
        });
            }
        }
        return back()->with('success','Emails are send successfully.');
    }
}
