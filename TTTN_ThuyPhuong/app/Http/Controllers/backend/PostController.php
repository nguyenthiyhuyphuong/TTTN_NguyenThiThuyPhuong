<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Topic;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $post = Post::where([['status', '!=', 0], ['type', '=', 'post']])
            ->orderBy('created_at')
            ->get();
        $count_all = Post::count();
        $count_trash = Post::where('status', '=', 0)->count();
        return view('backend.post.index', compact('post', 'count_all', 'count_trash'));
    }

    //CREATE
    public function create()
    {
        $list_post = Post::where('status', '!=', 0)->get();
        $list_topic = Topic::where('status', '!=', 0)
            ->select('name', 'id', 'status')
            ->get();
        $http_topic_id = '';
        foreach ($list_topic as $item) {
            $http_topic_id .= '<option value="' . $item->id . '">' . $item->name . '</option>';
        }
        toastr()->success('Thêm thành công', 'Thông báo');
        return view('backend.post.create', compact('http_topic_id', 'list_post','list_topic'));
    }

    //STORE
    public function store(StorePostRequest $request)
    {
        $list_post = new Post;
        $list_post->slug = (strlen($request->slug) > 0) ? $request->slug : Str::of($request->name)->slug('-');
        $list_post->type = 'post';
        $list_post->detail = $request->detail;
        $list_post->title = $request->title;
        $list_post->topic_id = $request->topic_id;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $fileName = $list_post->slug . '.' . $extension;
            $image->storeAs('public/images/post', $fileName);
            $list_post->image = $fileName;
        }
        //end upload file
        $list_post->status = $request->status;
        $list_post->save();
        toastr()->success('Thêm thành công!', 'Thông báo');
        return redirect()->route('post.index');
    }

    //SHOW
    public function show(string $id)
    {
        $post = Post::where([['status', '!=', 0], ['type', '=', 'post']])->first();
        if ($post == NULL) {
            toastr()->error('Không tồn tại mẫu tin!', 'Thông báo');
            return redirect()->route('post.index');
        }
        return view('backend.post.show', compact('post'));
    }

    //EDIT
    public function edit(string $id)
    {
        $post = Post::find($id);
        if ($post == NULL) {
            toastr()->error('Không tồn tại mẫu tin!', 'Thông báo');
            return redirect()->route('post.index');
        }
        $topic = Topic::where('status', '!=', 0)
            ->select('name', 'id', 'status')
            ->orderBy('created_at')
            ->get();
        $http_topic_id = '';
        foreach ($topic as $item) {
            if ($item->id == $post->topic_id) {
                $http_topic_id .= '<option selected value="' . $item->id . '">' . $item->name . '</option>';
            } else {
                $http_topic_id .= '<option value="' . $item->id . '">' . $item->name . '</option>';
            }
        }
        return view('backend.post.edit', compact('post', 'http_topic_id'));
    }

    //UPDATE
    public function update(UpdatePostRequest $request,  $id)
    {
        $list_post = Post::where([['id', '=', $id], ['type', '=', 'post']])->first();
        if ($list_post == NULL) {
            toastr()->error('Không tồn tại mẫu tin!', 'Thông báo');
            return redirect()->route('post.index');
        }
        $list_post->title = $request->title;
        $list_post->slug = (strlen($request->slug) > 0) ? $request->slug : Str::of($request->name)->slug('-');
        $list_post->description = $request->description;
        $list_post->detail = $request->detail;
        $list_post->topic_id = $request->topic_id;
        $list_post->status = $request->status;
        //up load file
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $fileName = $list_post->slug . '.' . $extension;
            $image->storeAs('public/images/post', $fileName);
            $list_post->image = $fileName;
        }
        //endupload
        $list_post->save();
        toastr()->success('Cập nhật thành công!', 'Thông báo');
        return redirect()->route('post.index');
    }
    public function trash()
    {
        $post = Post::where('status', '=', 0)
        //, ['type', '=', 'post']
            ->orderBy('created_at','desc')
            ->select('id', 'title', 'image', 'slug', 'created_at', 'status')
            ->get();
        $count_all = Post::count();
        $count_trash = Post::where('status', '=', 0)->count();
        return view('backend.post.trash', compact('post', 'count_all', 'count_trash'));
    }
    public function delete($id)
    {
        //where(['id', '=', $id], ['type', '=', 'post'])->first()
        $post = Post::find($id);
        if ($post == NULL) {
            toastr()->error('Không tông tại mẫu tin!', 'Thông báo');
            return redirect()->route('post.index');
        }
        $post->status = 0;
        $post->updated_at = date('Y-m-d H:i:s');
        $post->updated_by = Auth::id() ?? 1;
        $post->save();
        toastr()->success('Xóa vào thùng rác thành công!', 'Thông báo');
        return redirect()->route('post.index');
    }
    //DESTROY
    public function destroy($id)
    {

        $post = Post::where([['id', '=', $id], ['type', '=', 'post'],['status','=',0]])->first();
        if ($post == NULL) {
            toastr()->error('Không tông tại mẫu tin!', 'Thông báo');
            return redirect()->route('post.index');
        }
        $post->delete();
        toastr()->success('Xóa khỏi CSDL thành công!', 'Thông báo');
        return redirect()->route('post.index');
    }
    //RESTORE
    public function restore($id)
    {
        $post = Post::find($id);//where([['id', '=', $id], ['type', '=', 'post']])->first();
        if ($post == null) {
            toastr()->error('Không tông tại mẫu tin!', 'Thông báo');
            return redirect()->route('post.trash');
        }
        $post->status = 2;
        $post->updated_at = date('Y-m-d H:i:s');
        $post->updated_by = Auth::id() ?? 1;
        $post->save();
        toastr()->success('Khôi phục thành công!', 'Thông báo');
        return redirect()->route('post.trash');
    }

    //STATUS
    public function status($id)
    {
        $post = Post::where([['id', '=', $id], ['type', '=', 'post']])->first();
        if ($post == NULL) {
            toastr()->error('Không tông tại mẫu tin!', 'Thông báo');
            return redirect()->route('post.index');
        }
        $post->status = ($post->status == 1) ? 2 : 1;
        $post->updated_at = date('Y-m-d H:i:s');
        $post->updated_by = Auth::id() ?? 1;
        $post->save();
        toastr()->success('Thay đổi trạng thái thành công!', 'Thông báo');
        return redirect()->route('post.index');
    }
}
