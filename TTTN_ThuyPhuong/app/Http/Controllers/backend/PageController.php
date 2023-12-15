<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index()
    {
        $page = Post::where([['status', '!=', 0], ['type', '=', 'page']])
            // ->select('id', 'title', 'slug', 'status', 'description')
            ->orderBy('created_at')
            ->get();
        $count_all = Post::where('type', '=', 'page')->count();
        $count_trash = Post::where([['status', '=', 0], ['type', '=', 'page']])->count();
        return view('backend.page.index', compact('page', 'count_all', 'count_trash'));
    }
    public function trash()
    {
        $page = Post::where([['status', '=', 0], ['type', '=', 'page']])
            ->select('id', 'title', 'slug', 'status', 'description')
            ->orderBy('created_at')
            ->get();
        $count_all = Post::where('type', '=', 'page')->count();
        $count_trash = Post::where([['status', '=', 0], ['type', '=', 'page']])->count();
        return view('backend.page.trash', compact('page', 'count_all', 'count_trash'));
    }
    public function create()
    {
        return view('backend.page.create');
    }
    public function store(Request $request)
    {
        $page = new Post();
        $page->title = $request->title;
        $page->slug = (strlen($request->slug) > 0) ? $request->slug : Str::of($request->name)->slug('-');
        $page->type = 'page';
        $page->description = $request->description;
        $page->detail = $request->detail;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $fileName = $page->slug . '.' . $extension;
            $image->storeAs('public/images/brand', $fileName);
            $page->image = $fileName;
        }
        //end upload file
        $page->created_at = date('Y-m-d H:i:s');
        $page->created_by = Auth::id() ?? 1;
        $page->status = $request->status;
        $page->save();
        toastr()->success('Thêm thành công!', 'Thông báo');
        return redirect()->route('page.index');
    }

    public function show($id)
    {
        $page = Post::where([['id', '=', $id], ['type', '=', 'page']])->first();
        if ($page == NULL) {
            toastr()->error('Không tồn tại mẫu tin!', 'Thông báo');
            return redirect()->route('page.index');
        }
        return view('backend.page.show', compact('page'));
    }

    public function edit($id)
    {
        $page = Post::find($id);
        if ($page == NULL) {
            toastr()->error('Không tồn tại mẫu tin!', 'Thông báo');
            return redirect()->route('page.index');
        }
        return view('backend.page.edit', compact('page'));
    }

    public function update(Request $request, $id)
    {
        $page = Post::where([['id', '=', $id], ['type', '=', 'page']])->first();
        if ($page == NULL) {
            toastr()->error('Không tồn tại mẫu tin!', 'Thông báo');
            return redirect()->route('page.index');
        }
        $page->title = $request->title;
        $page->slug = (strlen($request->slug) > 0) ? $request->slug : Str::of($request->name)->slug('-');
        $page->description = $request->description;
        $page->detail = $request->detail;
        //up load file
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $fileName = $page->slug . '.' . $extension;
            $image->storeAs('public/images/page', $fileName);
            $page->image = $fileName;
        }
        //endupload
        $page->updated_at = date('Y-m-d H:i:s');
        $page->updated_by = Auth::id() ?? 1;
        $page->status = $request->status;
        $page->save();
        toastr()->success('Thêm thành công!', 'Thông báo');
        return redirect()->route('page.index');
    }

    
    public function status($id)
    {
        $page = Post::where([['id', '=', $id], ['type', '=', 'page']])->first();
        if ($page == NULL) {
            toastr()->error('Không tông tại mẫu tin!', 'Thông báo');
            return redirect()->route('page.index');
        }
        $page->status = ($page->status == 1) ? 2 : 1;
        $page->updated_at = date('Y-m-d H:i:s');
        $page->updated_by = Auth::id() ?? 1;
        $page->save();
        toastr()->success('Thay đổi trạng thái thành công!', 'Thông báo');
        return redirect()->route('page.index');
    }
    public function delete($id)
    {
        $page = Post::where(['id', '=', $id], ['type', '=', 'post'])->first();
        if ($page == NULL) {
            toastr()->error('Không tông tại mẫu tin!', 'Thông báo');
            return redirect()->route('page.index');
        }
        $page->status = 0;
        $page->updated_at = date('Y-m-d H:i:s');
        $page->updated_by = Auth::id() ?? 1;
        $page->save();
        toastr()->success('Xóa vào thùng rác thành công!', 'Thông báo');
        return redirect()->route('page.index');
    }
    public function restore($id)
    {
        $page = Post::where([['id', '=', $id], ['type', '=', 'post']])->first();
        if ($page == NULL) {
            toastr()->error('Không tông tại mẫu tin!', 'Thông báo');
            return redirect()->route('page.trash');
        }
        $page->status =2;
        $page->updated_at = date('Y-m-d H:i:s');
        $page->updated_by = Auth::id() ?? 1;
        $page->save();
        toastr()->success('Khôi phục thành công!', 'Thông báo');
        return redirect()->route('page.trash');
    }
    public function destroy($id)
    {
        $page = Post::where([['id', '=', $id], ['type', '=', 'post'],['status','=',0]])->first();
        if ($page == NULL) {
            toastr()->error('Không tông tại mẫu tin!', 'Thông báo');
            return redirect()->route('page.trash');
        }
        $page->delete();
        toastr()->success('Xóa khỏi CSDL thành công!', 'Thông báo');
        return redirect()->route('page.trash');
    }
}
