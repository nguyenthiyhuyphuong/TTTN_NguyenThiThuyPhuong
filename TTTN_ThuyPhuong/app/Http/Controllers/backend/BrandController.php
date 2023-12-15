<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Brand;

class BrandController extends Controller
{
    //Index
    public function index()
    {
        $brands = Brand::where('status', '!=', 0)
            ->orderBy('created_at', 'desc')
            ->select('id', 'name', 'image', 'slug', 'created_at', 'status')
            ->get();
        $count_all = Brand::count();
        $count_trash = Brand::where('status', '=', 0)->count();
        return view("backend.brand.index", compact('brands', 'count_all', 'count_trash'));
    }

    //Store
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
        toastr()->success('Thêm thành công!', 'Thông báo');
        return redirect()->route('brand.index');
    }
    public function edit($id)
    {
        $brand = Brand::find($id);
        if ($brand == null) {
            toastr()->error('Không tồn tại mẫu tin!', 'Thông báo');
            return redirect()->route('brand.index');
        }
        return view('backend.brand.edit', compact('brand'));
    }

    //update
    public function update(UpdateBrandRequest $request, $id)
    {
        $brand = Brand::find($id);
        if ($brand == null) {
            toastr()->error('Không tông tại mẫu tin!', 'Thông báo');
            return redirect()->route('brand.index');
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
        toastr()->success('Cập nhật thành công!', 'Thông báo');
        return redirect()->route('brand.index');
    }
    //Status
    public function status($id)
    {
        $brand = Brand::find($id);
        if ($brand == null) {
            toastr()->error('Không tông tại mẫu tin!', 'Thông báo');
            return redirect()->route('brand.index');
        }
        $brand->status = ($brand->status == 1) ? 2 : 1;
        $brand->updated_at = date('Y-m-d H:i:s');
        $brand->updated_by = Auth::id() ?? 1;
        $brand->save();
        toastr()->success('Thay đổi trạng thái thành công!', 'Thông báo');
        return redirect()->route('brand.index');
    }

    //Delete
    public function delete($id)
    {
        $brand = Brand::find($id);
        if ($brand == null) {
            toastr()->error('Không tông tại mẫu tin!', 'Thông báo');
            return redirect()->route('brand.index');
        }
        $brand->status = 0;
        $brand->updated_at = date('Y-m-d H:i:s');
        $brand->updated_by = Auth::id() ?? 1;
        $brand->save();
        toastr()->success('Xóa vào thùng rác thành công!', 'Thông báo');
        return redirect()->route('brand.index');
    }

    //restore
    public function restore($id)
    {
        $brand = Brand::find($id);
        if ($brand == null) {
            toastr()->error('Không tông tại mẫu tin!', 'Thông báo');
            return redirect()->route('brand.trash');
        }
        $brand->status = 2;
        $brand->updated_at = date('Y-m-d H:i:s');
        $brand->updated_by = Auth::id() ?? 1;
        $brand->save();
        toastr()->success('Khôi phục thành công!', 'Thông báo');
        return redirect()->route('brand.trash');
    }

    //Show
    public function show($id)
    {
        $brand = Brand::find($id);
        if ($brand == null) {
            toastr()->error('Không tông tại mẫu tin!', 'Thông báo');
            return redirect()->route('brand.index');
        }
        return view('backend.brand.show', compact('brand'));
    }

    //Desroy
    public function destroy($id)
    {
        $brand = Brand::find($id);
        if ($brand == null) {
            toastr()->error('Không tông tại mẫu tin!', 'Thông báo');
            return redirect()->route('brand.trash');
        }
        $brand->delete();
        toastr()->success('Xóa khỏi CSDL thành công!', 'Thông báo');
        return redirect()->route('brand.trash');
    }

    //Trash
    public function trash()
    {
        $brands = Brand::where('status', '=', 0)
            ->orderBy('created_at', 'desc')
            ->select('id', 'name', 'image', 'slug', 'created_at', 'status')
            ->get();

        $count_all = Brand::count();
        $count_trash = Brand::where('status', '=', 0)->count();
        return view("backend.brand.trash", compact('brands', 'count_all', 'count_trash'));
    }
}
