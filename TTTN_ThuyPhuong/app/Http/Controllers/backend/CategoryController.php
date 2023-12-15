<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

class CategoryController extends Controller
{
    //Index
    public function index()
    {
        $categorys = Category::where('status', '!=', 0)
            ->orderBy('created_at', 'desc')
            ->select('id', 'name', 'image', 'slug', 'created_at', 'status')
            ->get();
        $parent_id_html = "";
        foreach ($categorys as $item) {
            $parent_id_html = "<option value='" . $item->id . "'>" . $item->name . "</option>";
        }
        $count_all = Category::count();
        $count_trash = Category::where('status', '=', 0)->count();
        return view("backend.category.index", compact('categorys', 'count_all', 'count_trash', 'parent_id_html'));
    }

    //Store
    public function store(StoreCategoryRequest $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->slug = (strlen($request->slug) > 0) ? $request->slug : Str::of($request->name)->slug('-');
        //upload file
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $fileName = $category->slug . '.' . $extension;
            $image->storeAs('public/images/category', $fileName);
            $category->image = $fileName;
        }

        //end upload file
        $category->sort_order = 1;
        $category->parent_id = $request->parent_id;
        $category->description = $request->description;
        $category->created_at = date('Y-m-d H:i:s');
        $category->created_by = Auth::id() ?? 1;
        $category->status = $request->status;
        $category->save();
        toastr()->success('Thêm thành công!', 'Thông báo');
        return redirect()->route('category.index');
    }
    public function edit($id)
    {
        $categorys = Category::where('status', '!=', 0)
            ->orderBy('created_at', 'desc')
            ->select('id', 'name', 'image', 'slug', 'created_at', 'status')
            ->get();
        $category = Category::find($id);
        if ($category == null) {
            toastr()->error('Không tông tại mẫu tin!', 'Thông báo');
            return redirect()->route('category.index');
        }
        $parent_id_html = "";
        foreach ($categorys as $item) {
            if ($item->id == $category->parent_id) {
                $parent_id_html = "<option value='".$item->id."'>" .$item->name."</option>";
            }else{
                $parent_id_html = "<option value='".$item->id."'>" .$item->name."</option>";
            }
        }
        return view('backend.category.edit', compact('category', 'parent_id_html'));
    }

    //update
    public function update(UpdateCategoryRequest $request, $id)
    {
        $category = Category::find($id);
        if ($category == null) {
            toastr()->error('Không tông tại mẫu tin!', 'Thông báo');
            return redirect()->route('category.index');
        }
        $category->name = $request->name;
        $category->slug = (strlen($request->slug) > 0) ? $request->slug : Str::of($request->name)->slug('-');
        //upload file
        if ($request->hasFile('image')) {
            //Xóa hình cũ
            // if(Storage::disk('public')->exists('images/category/'.$category->image)){
            //     Storage::disk('public')->exists('images/category/'.$category->image);
            // }
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $fileName = $category->slug . '.' . $extension;
            $image->storeAs('public/images/category', $fileName);
            $category->image = $fileName;
        }

        //end upload file
        $category->sort_order = 1;
        $category->parent_id = $request->parent_id;
        $category->description = $request->description;
        $category->updated_at = date('Y-m-d H:i:s');
        $category->updated_by = Auth::id() ?? 1;
        $category->status = $request->status;
        $category->save();
        toastr()->success('Cập nhật thành công!', 'Thông báo');
        return redirect()->route('category.index');
    }
    //Status
    public function status($id)
    {
        $category = Category::find($id);
        if ($category == null) {
            toastr()->error('Không tông tại mẫu tin!', 'Thông báo');
            return redirect()->route('category.index');
        }
        $category->status = ($category->status == 1) ? 2 : 1;
        $category->updated_at = date('Y-m-d H:i:s');
        $category->updated_by = Auth::id() ?? 1;
        $category->save();
        toastr()->success('Thay đổi trạng thái thành công!', 'Thông báo');
        return redirect()->route('category.index');
    }

    //Delete
    public function delete($id)
    {
        $category = Category::find($id);
        if ($category == null) {
            toastr()->error('Không tông tại mẫu tin!', 'Thông báo');
            return redirect()->route('category.index');
        }
        $category->status = 0;
        $category->updated_at = date('Y-m-d H:i:s');
        $category->updated_by = Auth::id() ?? 1;
        $category->save();
        toastr()->success('Xóa vào thùng rác thành công!', 'Thông báo');
        return redirect()->route('category.index');
    }

    //restore
    public function restore($id)
    {
        $category = Category::find($id);
        if ($category == null) {
            toastr()->error('Không tông tại mẫu tin!', 'Thông báo');
            return redirect()->route('category.trash');
        }
        $category->status = 2;
        $category->updated_at = date('Y-m-d H:i:s');
        $category->updated_by = Auth::id() ?? 1;
        $category->save();
        toastr()->success('Khôi phục thành công!', 'Thông báo');
        return redirect()->route('category.trash');
    }

    //Show
    public function show($id)
    {
        $category = Category::find($id);
        if ($category == null) {
            toastr()->error('Không tông tại mẫu tin!', 'Thông báo');
            return redirect()->route('category.index');
        }
        return view('backend.category.show', compact('category'));
    }

    //Desroy
    public function destroy($id)
    {
        $category = Category::find($id);
        if ($category == null) {
            toastr()->error('Không tông tại mẫu tin!', 'Thông báo');
            return redirect()->route('category.trash');
        }
        $category->delete();
        toastr()->success('Xóa khỏi CSDL thành công!', 'Thông báo');
        return redirect()->route('category.trash');
    }

    //Trash
    public function trash()
    {
        $categorys = Category::where('status', '=', 0)
            ->orderBy('created_at', 'desc')
            ->select('id', 'name', 'image', 'slug', 'created_at', 'status')
            ->get();

        $count_all = Category::count();
        $count_trash = Category::where('status', '=', 0)->count();
        return view("backend.category.trash", compact('categorys', 'count_all', 'count_trash'));
    }
}
