<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\City;
use App\Models\District;
use App\Models\Ward;
use App\Models\Media;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::join('categories', 'products.category_id', '=', 'categories.id')
        ->join('projects', 'products.project_id', '=', 'projects.id')
        ->join('users', 'products.manager_id', '=', 'users.id')
        ->get(['products.*', 'users.name AS manager_name', 'projects.name AS project_name', 'categories.name AS category_name']);
        return view('admin.products.list', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $projects = Project::all();
        $managers = User::where('role', 1)->get();
        $cities = City::all();
        return view('admin.products.add', compact('categories' , 'projects', 'managers', 'cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->has('thumbnail')) {
            $product = Product::create([
                'category_id'  => $request->category_id,
                'project_id'  => $request->project_id,
                'manager_id' => $request->manager_id,
                'name' => $request->name,
                'description' => $request->content,
                'area' => $request->area,
                'room_count' => $request->room_count,
                'floor_count' => $request->floor_count,
                'city_id' => $request->city_id,
                'district_id' => $request->district_id,
                'ward_id' => $request->ward_id,
                'room_price' => $request->room_price,
                'electricity_price' => $request->electricity_price,
                'water_price' => $request->water_price,
                'is_invalid' => $request->is_invalid
            ]);
            foreach($request->thumbnail as $image) {
                $name = $image->getClientOriginalName();
                $image->storeAs('/public/images/products', $name);
                $product->image()->create(["image_src" => "storage/images/products/". $name]);
            }
            return redirect()->route('product.list')->withInput()->with("success", "Lưu thành công");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $projects = Project::all();
        $managers = User::where('role', 1)->get();
        $product = Product::find($id);
        $cities = City::all();
        $districts = District::all();
        $wards = Ward::all();
        return view('admin.products.edit', compact('categories' , 'projects', 'managers', 'product', 'cities', 'districts', 'wards'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->category_id  = $request->category_id;
        $product->project_id  = $request->project_id;
        $product->manager_id = $request->manager_id;
        $product->name = $request->name;
        $product->description = $request->content;
        $product->area = $request->area;
        $product->room_count = $request->room_count;
        $product->floor_count = $request->floor_count;
        $product->city_id = $request->city_id;
        $product->district_id = $request->district_id;
        $product->ward_id = $request->ward_id;
        $product->room_price = $request->room_price;
        $product->electricity_price = $request->electricity_price;
        $product->water_price = $request->water_price;
        $product->is_invalid = $request->is_invalid;
        $delete_images_src = [];
        if($request->has('thumbnail_src')) {
            foreach($product->image as $product_thumbnail_src) {
                $is_delete = true;
                foreach($request->thumbnail_src as $request_thumbnail_src) {
                    if(trim($product_thumbnail_src->image_src) == trim($request_thumbnail_src)) {
                        $is_delete = false;
                        break;
                    }
                }
                if($is_delete) {
                    array_push($delete_images_src, $product_thumbnail_src->image_src);
                }
            }
        } else {
            foreach($product->image as $product_thumbnail_src) {
                array_push($delete_images_src, $product_thumbnail_src->image_src);
            }
        }
        Media::whereIn("image_src", $delete_images_src)->delete();
        foreach($delete_images_src as $product_thumbnail_src) {
            Storage::delete("images/products/$product_thumbnail_src");
        }
        if($request->has('thumbnail')) {
            foreach($request->thumbnail as $image) {
                $name = $image->getClientOriginalName();
                $image->storeAs('/public/images/products', $name);
                $product->image()->create(["image_src" => "storage/images/products/". $name]);
            }
        }
        $product->save();
        return redirect()->route('product.list')->with("success","Sửa thành công");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('product.list')->with("success","Xóa thành công");
    }

    public function ajaxDistrict(Request $request)
    {
        $districts = District::where('matp', $request->city_id)->get();
        return response()->json([
            'status' => 200,
            'data' => view('admin.products.includes.district', compact('districts'))->render()
        ]);
    }

    public function ajaxWard(Request $request)
    {
        $wards = Ward::where('maqh', $request->district_id)->get();
        return response()->json([
            'status' => 200,
            'data' => view('admin.products.includes.ward', compact('wards'))->render()
        ]);
    }

    public function disable($id)
    {
        Product::where('id', $id)->update(['status' => 0]);
        return redirect()->route('product.list')->with("success","Ẩn thành công");
    }

    public function enable($id)
    {
        Product::where('id', $id)->update(['status' => 1]);
        return redirect()->route('product.list')->with("success","Hiện thành công");
    }
}
