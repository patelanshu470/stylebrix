<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Gallary;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function productIndex()
    {
        // return $datas = Product::with('galleries')->get();
        $datas = Product::all();
        return view('backend.product.product_index', compact('datas'));
    }
    public function productAdd()
    {
        $category = Category::where('status', 1)->get();
        return view('backend.product.product_add', compact('category'));
    }
    public function productStore(Request $request)
    {
        $data = new Product();
        $data->name = $request->name;
        $data->color = $request->color;
        $data->slug = $request->slug;
        $data->size = $request->size;
        $data->cat_id = $request->cat_id;
        $data->sub_cat_id = $request->sub_cat_id;
        $data->cost_price = $request->cost_price;
        $data->discount = $request->discount;
        $data->sell_price = $request->sell_price;
        $data->final_sell_price = $request->final_sell_price;
        $data->quantity = $request->quantity;
        $data->status = $request->status;
        $data->description = $request->description;
        $data->is_varient = $request->is_varient;
        $data->set_to_all = $request->set_to_all;
        $data->varient_ids = ($request->varient_ids) ?  json_encode($request->varient_ids) : null;


        if ($request->file('thumbnail')) {
            $uploadFile = $request->file('thumbnail');
            $file_name = $uploadFile->hashName();
            $path = $uploadFile->move('public/images/product/', $file_name);
            $data['thumbnail'] = $file_name;
        }
        if ($request->file('color_image')) {
            $uploadFile = $request->file('color_image');
            $file_name = $uploadFile->hashName();
            $path = $uploadFile->move('public/images/product/', $file_name);
            $data['color_image'] = $file_name;
        }
        $data->save();

        #set to all
        if ($request->set_to_all and $request->varient_ids) {
            for ($i = 0; $i < count($request->varient_ids); $i++) {
                $allIds = $request->varient_ids;
                array_push($allIds, $data->id);
                $productId = $allIds[$i];
                $productData = Product::find($productId);
                $updatedIds = array_filter($allIds, function ($id) use ($productId) {
                    return $id != $productId;
                });
                $productData->varient_ids = count($updatedIds) > 0 ? json_encode(array_values($updatedIds)) : null;
                $productData->set_to_all = '1';
                $productData->is_varient = '1';

                $productData->save();
            }
        }
        #gallary
        if ($request->gallary and $data) {
            foreach ($request->gallary as $img) {
                $attachment = new Gallary();
                $uploadFile = $img;
                $file_name = $uploadFile->hashName();
                $path = $uploadFile->move(public_path('public/images/product'), $file_name);
                $attachment['image'] = $file_name;
                $attachment->product_id = $data->id;
                $attachment->save();
            }
        }
        return redirect()->route('product')->with('success', "Product created successfully");
    }
    public function productEdit($id)
    {
        $data = Product::with('galleries')->find($id);
        $category = Category::where('status', 1)->get();
        $subCategory = SubCategory::where([['status', '=', 1], ['cat_id', '=', $data->cat_id]])->get();
        $product = Product::where([['cat_id', '=', $data->cat_id], ['sub_cat_id', '=', $data->sub_cat_id], ['id', '<>', $id]])->get();

        $varients = [];
        if ($data->varient_ids) {
            $varients = json_decode($data->varient_ids);
        }


        return view('backend.product.product_edit', compact('data', 'category', 'subCategory', 'product', 'varients'));
    }

    public function productUpdate(Request $request, $id)
    {
        $data = Product::find($id);
        $data->name = $request->name;
        $data->color = $request->color;
        $data->slug = $request->slug;
        $data->size = $request->size;
        $data->cat_id = $request->cat_id;
        $data->sub_cat_id = $request->sub_cat_id;
        $data->cost_price = $request->cost_price;
        $data->discount = $request->discount;
        $data->sell_price = $request->sell_price;
        $data->final_sell_price = $request->final_sell_price;
        $data->quantity = $request->quantity;
        $data->status = $request->status;
        $data->description = $request->description;
        $data->is_varient = $request->is_varient;
        $data->varient_ids = ($request->varient_ids) ?  json_encode($request->varient_ids) : null;
        $data->set_to_all = $request->set_to_all;


        if ($request->set_to_all and $request->varient_ids) {
            for ($i = 0; $i < count($request->varient_ids); $i++) {

                $allIds = $request->varient_ids;
                array_push($allIds, $id);

                $productId = $allIds[$i];
                $productData = Product::find($productId);
                // Remove the product's own ID from the array
                $updatedIds = array_filter($allIds, function ($id) use ($productId) {
                    return $id != $productId;
                });
                // Update the product's varient_ids with the updated array
                $productData->varient_ids = count($updatedIds) > 0 ? json_encode(array_values($updatedIds)) : null;
                $productData->set_to_all = '1';
                $productData->is_varient = '1';

                $productData->save();
            }
        }



        if ($request->file('thumbnail')) {
            $uploadFile = $request->file('thumbnail');
            $file_name = $uploadFile->hashName();
            $path = $uploadFile->move('public/images/product/', $file_name);
            $data['thumbnail'] = $file_name;
        }
        if ($request->file('color_image')) {
            $uploadFile = $request->file('color_image');
            $file_name = $uploadFile->hashName();
            $path = $uploadFile->move('public/images/product/', $file_name);
            $data['color_image'] = $file_name;
        }
        $data->save();
        if ($request->gallary and $data) {
            foreach ($request->gallary as $img) {
                $attachment = new Gallary();
                $uploadFile = $img;
                $file_name = $uploadFile->hashName();
                $path = $uploadFile->move(public_path('public/images/product'), $file_name);
                $attachment['image'] = $file_name;
                $attachment->product_id = $data->id;
                $attachment->save();
            }
        }
        return redirect()->route('product')->with('success', "Product updated successfully");
    }
    public function productSubCat(Request $request)
    {
        $data['subcat'] = SubCategory::where([["cat_id", '=', $request->catId], ["status", '=', 1]])->get();
        return response()->json($data);
    }
    public function productVarient(Request $request)
    {
        $data['subcat'] = Product::where([["cat_id", '=', $request->catId], ["sub_cat_id", '=', $request->subCatId]])->get();
        return response()->json($data);
    }
    public function productSlugValidation(Request $request)
    {
        $datas['data'] = null;
        if ($request->id) {
            $datas['data'] = Product::where([["slug", 'like', $request->slug], ['id', '<>', $request->id]])->get()->first();
        } else {
            $datas['data'] = Product::where([["slug", 'like', $request->slug]])->get()->first();
        }
        return response()->json($datas);
    }
    public function productImgDelete($id)
    {
        $gallary = Gallary::findOrFail($id);
        if ($gallary->image) {
            $imagePath = 'public/images/product/' . $gallary->image;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        $gallary->delete();
        return back()->with('success', "Image is delete successfully.");
    }

    public function productDelete($id)
    {
        $data = Product::with('galleries')->findOrFail($id);
        if (count($data->galleries) > 0) {
            foreach ($data->galleries as $img) {
                $imagePath = 'public/images/product/' . $img->image;
                unlink($imagePath);
            }
        }
        $data->delete();
        return back()->with('success', "Product is delete successfully.");
    }
    public function productStatus(Request $request)
    {
        $data = Product::find($request->id);
        $data->status = $request->status;
        $data->save();
        return response()->json([
            'success' => 'Product status has been updated successfully!'
        ]);
    }
}
