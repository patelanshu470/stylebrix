<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\OrderedProduct;
use App\Models\ProductReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class ReviewController extends Controller
{
    public function addReview(Request $request){
        $rules = [
            'product_id' => 'required',
            'description' => 'required',
            'rating' => 'required',
        ];
        $customMessages = [
            'product_id.required' => 'Oroduct-Id is required.',
            'description.required' => 'Description is required.',
            'rating.required' => 'Rating is required.',
        ];
        $validator = Validator::make($request->all(), $rules, $customMessages);
        if ($validator->fails()) {
            Session::flash('errors', $validator->errors());
            return redirect()->back()->withInput();
        }
        #check if user had ordered this product or not

        $invalidProduct=OrderedProduct::join('orders','orders.id','=','ordered_products.order_id')->where([['ordered_products.product_id','=',$request->product_id],['ordered_products.user_id','=',Auth()->user()->id],['orders.order_status','=','delivered']])->get()->first();
      
        if(!$invalidProduct){
            return back()->with('error','You cannot give Review to this product.');
        }

          #dublicate check
          $dublicate_check=ProductReview::where([['product_id','=',$request->product_id],['user_id','=',Auth()->user()->id]])->get()->first();
          if($dublicate_check){
              return back()->with('error','You had already review this product.');
          }


        #dublicate check
        $dublicate_check=ProductReview::where([['product_id','=',$request->product_id],['user_id','=',Auth()->user()->id]])->get()->first();
        if($dublicate_check){
            return back()->with('error','You had already review this product.');
        }   
        $data=new ProductReview();
        if ($request->file('review_image')) {
            $uploadFile = $request->file('review_image');
            $file_name = $uploadFile->hashName();
            $path = $uploadFile->move('public/images/review/', $file_name);
            $data->image = $file_name;
        }
        $data->rating=$request->rating;
        $data->product_id=$request->product_id;
        $data->user_id=auth()->user()->id;
        $data->description=$request->description;
        $data->status='0';
        $data->save();
        return back()->with('success','Your review is in pending,it will be display as soon as it gets approved.');
    }
    public function updateReview(Request $request){
        $rules = [
            'product_id' => 'required',
            'description' => 'required',
            'rating' => 'required',
        ];
        $customMessages = [
            'product_id.required' => 'Oroduct-Id is required.',
            'description.required' => 'Description is required.',
            'rating.required' => 'Rating is required.',
        ];
        $validator = Validator::make($request->all(), $rules, $customMessages);
        if ($validator->fails()) {
            Session::flash('errors', $validator->errors());
            return redirect()->back()->withInput();
        }
        $data=ProductReview::where([['product_id','=',$request->product_id],['user_id','=',Auth()->user()->id]])->get()->first();
        if ($request->file('review_image')) {
            $uploadFile = $request->file('review_image');
            $file_name = $uploadFile->hashName();
            $path = $uploadFile->move('public/images/review/', $file_name);
            $data->image = $file_name;
        }
        $data->rating=$request->rating;
        $data->user_id=auth()->user()->id;
        $data->description=$request->description;
        $data->status='0';
        $data->save();
        return back()->with('success','Your review is in pending,it will be display as soon as it gets approved.');
    }

}
