<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Brand;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::where('status', '!=', 0)
            ->orderBy('created_at', 'desc')
            ->select('id', 'name', 'image', 'slug', 'created_at', 'status')
            ->get();
        $count_all = Brand::count();
        $count_trash = Brand::where('status', '=', 0)->count();
        return response()->json(
            [
                'status' => true,
                'message' => 'Tải dữ liệu thành công',
                'data' => [
                    'brand' => $brands,
                    'count_all' => $count_all,
                    'count_trash' => $count_trash,
                ]
            ],
            200
        );
    }
    public function trash()
    {
        $brands = Brand::where('status', '!=', 1)
            ->orderBy('created_at', 'desc')
            ->select('id', 'name', 'image', 'slug', 'created_at', 'status')
            ->get();

        $count_all = Brand::count();
        $count_trash = Brand::where('status', '=', 0)->count();
        return response()->json(
            [
                'status' => true,
                'message' => 'Tải dữ liệu thành công',
                'data' => [
                    'brand' => $brands,
                    'count_all' => $count_all,
                    'count_trash' => $count_trash,
                ]
            ],
            200
        );
    }
    public function store(StoreBrandRequest $request)
    {
        $brand = new Brand();
        $brand->name = $request->name;
        $brand->slug = (strlen($request->slug) > 0) ? $request->slug : Str::of($request->name)->slug('-');
        //upload file
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $fileName = $brand->slug . '.' . $extension;
            $image->storeAs('public/images/brand', $fileName);
            $brand->image = $fileName;
        }

        //end upload file
        $brand->sort_order = 1;
        $brand->description = $request->description;
        $brand->created_at = date('Y-m-d H:i:s');
        $brand->created_by = Auth::id() ?? 1;
        $brand->status = $request->status;
        $brand->save();
        return response()->json(
            [
                'status' => true,
                'message' => 'Tải dữ liệu thành công',
                'data' => [
                    'brand' => $brand
                ]
            ],
            201
        );
    }

    public function show($id)
    {
        $brand = Brand::find($id);
        if ($brand == null) {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Lỗi kkhoong',
                    'data' => [
                        'brand' => null
                    ]
                ],
                404
            );
        }
        return response()->json(
            [
                'status' => true,
                'message' => 'Tải dữ liệu thành công',
                'data' => [
                    'brand' => $brand
                ]
            ],
            200
        );
    }

    public function update(UpdateBrandRequest $request, $id)
    {
        $brand = Brand::find($id);
        if ($brand == null) {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Lỗi kkhoong',
                    'data' => [
                        'brand' => null
                    ]
                ],
                404
            );
        }
        $brand->name = $request->name;
        $brand->slug = (strlen($request->slug) > 0) ? $request->slug : Str::of($request->name)->slug('-');
        //upload file
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $fileName = $brand->slug . '.' . $extension;
            $image->storeAs('public/images/brand', $fileName);
            $brand->image = $fileName;
        }

        //end upload file
        $brand->sort_order = 1;
        $brand->description = $request->description;
        $brand->updated_at = date('Y-m-d H:i:s');
        $brand->updated_by = Auth::id() ?? 1;
        $brand->status = $request->status;
        $brand->save();
        return response()->json(
            [
                'status' => true,
                'message' => 'Tải dữ liệu thành công',
                'data' => [
                    'brand' => $brand
                ]
            ],
            200
        );
    }

    public function destroy($id)
    {
        $brand = Brand::find($id);
        if ($brand == null) {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Lỗi kkhoong',
                    'data' => [
                        'brand' => null
                    ]
                ],
                404
            );
        }
        $brand->delete();
        return response()->json(
            [
                'status' => true,
                'message' => 'Xóa thành công'
            ],
            200
        );
    }
    public function status($id)
    {
        $brand = Brand::find($id);
        if ($brand == null) {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Lỗi kkhoong',
                    'data' => [
                        'brand' => null
                    ]
                ],
                404
            );
        }
        $brand->status = ($brand->status == 1) ? 2 : 1;
        $brand->updated_at = date('Y-m-d H:i:s');
        $brand->updated_by = Auth::id() ?? 1;
        $brand->save();
        return response()->json(
            [
                'status' => true,
                'message' => 'Xóa thành công',
                'brand' =>  $brand
            ],
            200
        );
    }
    public function delete($id)
    {
        $brand = Brand::find($id);
        if ($brand == null) {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Lỗi kkhoong',
                    'data' => [
                        'brand' => null
                    ]
                ],
                404
            );
        }
        $brand->status = 0;
        $brand->updated_at = date('Y-m-d H:i:s');
        $brand->updated_by = Auth::id() ?? 1;
        $brand->save();
        return response()->json(
            [
                'status' => true,
                'message' => 'Xóa thành công',
                'brand' =>  $brand
            ],
            200
        );
    }
    public function restore($id)
    {
        $brand = Brand::find($id);
        if ($brand == null) {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Lỗi kkhoong',
                    'data' => [
                        'brand' => null
                    ]
                ],
                404
            );
        }
        $brand->status = 2;
        $brand->updated_at = date('Y-m-d H:i:s');
        $brand->updated_by = Auth::id() ?? 1;
        $brand->save();
        return response()->json(
            [
                'status' => true,
                'message' => 'Xóa thành công',
                'brand' =>  $brand
            ],
            200
        );
    }
}
