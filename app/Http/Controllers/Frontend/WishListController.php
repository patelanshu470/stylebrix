<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class WishListController extends Controller
{
    public function wishList(){
        $wishlists=Wishlist::where('user_id',Auth()->user()->id)->get();
        return view('frontend.wishlist.wishlist',compact('wishlists'));
    }
    public function addToWishList(Request $request){
        if ($request->ajax()) {
            if (!Auth::check()) {
                Session::put('wishlist_data', ['product_id' => $request->product_id]);
                Session::save();
            }
            if (Auth::check()) {
                $user_id = Auth::user()->id;
                $product_id = $request->product_id;
                $product = Product::find($product_id);

                $cartData = Wishlist::where([['product_id', '=', $product_id], ['user_id', '=', $user_id]])->first();

                if ($cartData) {
                    return response()->json([
                        'result' => 'fail',
                        'message' => 'Product is already in Wishlist.',
                    ]);
                } else {
                    $cartData = new Wishlist();
                    $cartData->product_id = $product_id;
                    $cartData->user_id = $user_id;
                    $result = $cartData->save();
                }
                if ($result) {
                    $cart_total = Wishlist::where('user_id', $user_id)->count();
                    return response()->json([
                        'result' => 'success',
                        'message' => 'Product added to wish successfully!',
                        'cart_total' => $cart_total,
                    ]);
                } else {
                    return response()->json([
                        'result' => 'fail',
                        'message' => 'Failed to add the product to Wishlist.',
                    ]);
                }
            } else {
                return response()->json([], 401);
            }
        } else {
            return response()->json([], 400);
        } 
    }
    public function deleteWishList(Request $request){
        $data = Wishlist::findOrFail($request->id);
        $data->delete();
        $wishlist_total = Wishlist::where('user_id', Auth()->user()->id)->count();
        return response()->json([
            'result' => 'success',
            'wishlist_total' => $wishlist_total,
        ]);
    }
}

