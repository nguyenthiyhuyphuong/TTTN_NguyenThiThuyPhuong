<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBrandRequest;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BannerController extends Controller
{
    public function index()
    {
        $banner = Banner::where('status', '!=', 0)
            ->select('id', 'name', 'link', 'status', 'image', 'position')
            ->orderBy('created_at')
            ->get();
        $count_all = Banner::count();
        $count_trash = Banner::where('status', '=', 0)->count();
        return view("backend.banner.index", compact('banner', 'count_all', 'count_trash'));
    }

    public function trash()
    {
        $banner = Banner::where('status', '!=', 0)
            ->select('id', 'name', 'link', 'status', 'image','position')
            ->orderBy('created_at')
            ->get();
            $count_all = Banner::count();
            $count_trash = Banner::where('status', '=', 0)->count();
            return view("backend.banner.trash", compact('banner', 'count_all', 'count_trash'));
    }
    public function create()
    {
        return view("backend.banner.trash");
    }
    public function store(StoreBrandRequest $request)
    {
        $banner = new Banner();
        $banner->name=$request->name;
        $banner->link=$request->link;
        $banner->position=$request->position;
        $banner->description=$request->description;
        $banner->status=$request->status;
        //upload file
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $fileName = $banner->slug . '.' . $extension;
            $image->storeAs('public/images/banner', $fileName);
            $banner->image = $fileName;
        }

        //end upload file
        $banner->created_at = date('Y-m-d H:i:s');
        $banner->created_by = Auth::id() ?? 1;
        $banner->save();
        toastr()->success('Thêm thành công!', 'Thông báo');
        return redirect()->route('banner.index');
    }
    public function show($id)
    {
        $banner = Banner::find($id);
        if ($banner == null) {
            toastr()->error('Không tông tại mẫu tin!', 'Thông báo');
            return redirect()->route('banner.index');
        }
        return view('backend.banner.show', compact('banner'));
    }
    public function edit($id)
    {
        $banner = Banner::find($id);
        if ($banner == null) {
            toastr()->error('Không tông tại mẫu tin!', 'Thông báo');
            return redirect()->route('banner.index');
        }
        return view('backend.banner.edit', compact('banner', 'parent_id_html'));
    }
    public function update(Request $request, $id)
    {
        $banner = Banner::find($id);
        if ($banner == null) {
            toastr()->error('Không tông tại mẫu tin!', 'Thông báo');
            return redirect()->route('banner.index');
        }
        $banner->name=$request->name;
        $banner->link=$request->link;
        $banner->position=$request->position;
        $banner->description=$request->description;
        $banner->status=$request->status;
        //upload file
        if ($request->hasFile('image')) {
            //Xóa hình cũ
            // if(Storage::disk('public')->exists('images/banner/'.$banner->image)){
            //     Storage::disk('public')->exists('images/banner/'.$banner->image);
            // }
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $fileName = $banner->slug . '.' . $extension;
            $image->storeAs('public/images/banner', $fileName);
            $banner->image = $fileName;
        }
        //end upload file
        $banner->updated_at = date('Y-m-d H:i:s');
        $banner->updated_by = Auth::id() ?? 1;
        $banner->save();
        toastr()->success('Cập nhật thành công!', 'Thông báo');
        return redirect()->route('banner.index');
    }
    public function status($id)
    {
        $banner = Banner::find($id);
        if ($banner == null) {
            toastr()->error('Không tông tại mẫu tin!', 'Thông báo');
            return redirect()->route('banner.index');
        }
        $banner->status = ($banner->status == 1) ? 2 : 1;
        $banner->updated_at = date('Y-m-d H:i:s');
        $banner->updated_by = Auth::id() ?? 1;
        $banner->save();
        toastr()->success('Thay đổi trạng thái thành công!', 'Thông báo');
        return redirect()->route('banner.index');
    }
    public function delete($id)
    {
        $banner = Banner::find($id);
        if ($banner == null) {
            toastr()->error('Không tông tại mẫu tin!', 'Thông báo');
            return redirect()->route('banner.index');
        }
        $banner->status = 0;
        $banner->updated_at = date('Y-m-d H:i:s');
        $banner->updated_by = Auth::id() ?? 1;
        $banner->save();
        toastr()->success('Xóa vào thùng rác thành công!', 'Thông báo');
        return redirect()->route('banner.index');
    }
    public function restore($id)
    {
        $banner = Banner::find($id);
        if ($banner == null) {
            toastr()->error('Không tông tại mẫu tin!', 'Thông báo');
            return redirect()->route('banner.trash');
        }
        $banner->status = 2;
        $banner->updated_at = date('Y-m-d H:i:s');
        $banner->updated_by = Auth::id() ?? 1;
        $banner->save();
        toastr()->success('Khôi phục thành công!', 'Thông báo');
        return redirect()->route('banner.trash');
    }
    public function destroy($id)
    {
        $banner = Banner::where([['id','=',$id],['status', '!=', 0]])->first();
        if ($banner == null) {
            toastr()->error('Không tông tại mẫu tin!', 'Thông báo');
            return redirect()->route('banner.trash');
        }
        $banner->delete();
        toastr()->success('Xóa khỏi CSDL thành công!', 'Thông báo');
        return redirect()->route('banner.trash');
    }
}
