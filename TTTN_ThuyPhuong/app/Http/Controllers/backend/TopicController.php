<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Topic;
use App\Models\Post;
use App\Models\Link;
use App\Http\Requests\StoreTopicRequest;
use App\Http\Requests\UpdateTopicRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


class TopicController extends Controller
{
    public function index()
    {
        $topic = Topic::where('status', '!=', 0)
            ->select('id', 'name', 'slug', 'status', 'description')
            ->orderBy('created_at')
            ->get();
        $count_all = Topic::count();
        $count_trash = Topic::where('status', '=', 0)->count();
        return view('backend.topic.index', compact('topic', 'count_all', 'count_trash'));
    }

    public function create()
    {
        $list_topic = Topic::where('status', '!=', 0)->get();
        $http_parent_id = '';

        foreach ($list_topic as $item) {
            $http_parent_id .= '<option value="' . $item->id . '">' . $item->name . '</option>';
        }

        return view('backend.topic.create', compact('http_parent_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTopicRequest $request)
    {
        $topic = new Topic();
        $topic->name = $request->name;
        $topic->slug = (strlen($request->slug) > 0) ? $request->slug : Str::of($request->name)->slug('-');
        $topic->sort_order = 1;
        $topic->description = $request->description;
        $topic->created_at = date('Y-m-d H:i:s');
        $topic->created_by = Auth::id() ?? 1;
        $topic->status = $request->status;
        $topic->save();
        toastr()->success('Thêm thành công!', 'Thông báo');
        return redirect()->route('topic.index');
    }
    public function show(string $id)
    {
        $topic = Topic::find($id);
        $count_all = Topic::count();
        $count_trash = Topic::where('status', '=', 0)->count();
        if ($topic == NULL) {
            return redirect()->route('topic.index')->with('message', ['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại!']);
        }
        $title = 'Chi tiết mẫu tin';
        return view('backend.topic.show', compact('topic', 'title', 'count_all', 'count_trash'));
    }
    public function edit($id)
    {
        $topic = Topic::find($id);
        if ($topic == null) {
            toastr()->error('Không tồn tại mẫu tin!', 'Thông báo');
            return redirect()->route('topic.index');
        }
        $topics = Topic::where('status', '!=', 0)
            ->select('id', 'name')
            ->orderBy('created_at')
            ->get();
        $sort_order_html = '';
        foreach ($topics as $item) {
            if ($topic->sort_order - 1 == $item->sort_order) {
                $sort_order_html .= "<option selected value='" . $item->id . "'>Sau:" . $item->name . "</option";
            } else {
                $sort_order_html .= "<option value='" . $item->id . "'>Sau:" . $item->name . "</option";
            }
        }
        return view('backend.topic.edit', compact('topic'));
    }

    public function update(UpdateTopicRequest $request,  $id)
    {
        $list_topic = Topic::find($id);
        if ($list_topic == null) {
            toastr()->error('Không tông tại mẫu tin!', 'Thông báo');
            return redirect()->route('topic.index');
        }
        $list_topic->name = $request->name;
        $list_topic->slug = (strlen($request->slug) > 0) ? $request->slug : Str::of($request->name)->slug('-');
        $list_topic->status = $request->status;
        $list_topic->sort_order = 1;
        $list_topic->description = $request->description;
        $list_topic->updated_at = date('Y-m-d H:i:s');
        $list_topic->updated_by = Auth::id() ?? 1;
        $list_topic->status = $request->status;
        $list_topic->save();
        toastr()->success('Cập nhật thành công!', 'Thông báo');
        return redirect()->route('topic.index');
    }
    public function destroy($id)
    {

        $list_topic = Topic::where([['id','=',$id],['status', '=', 0]])->first();
        if ($list_topic == NULL) {
            toastr()->error('Không tồn tại mẫu tin!!', 'Thông báo');
            return redirect()->route('topic.index');
        }
        $list_topic->delete();
        toastr()->success('Xóa khỏi CSDL thành công!', 'Thông báo');
        return redirect()->route('topic.trash');
    }
    public function trash()
    {
        $topic = Topic::where('status', '=', '0')
            ->select('id', 'name', 'slug', 'status', 'description')
            ->orderBy('created_at')
            ->get();
        $count_all = Topic::count();
        $count_trash = Topic::where('status', '=', 0)->count();
        return view('backend.topic.trash', compact('topic', 'count_all', 'count_trash'));
    }
    public function delete($id)
    {

        $topic = Topic::find($id);
        if ($topic == NULL) {
            toastr()->error('Không tồn tại mẫu tin!', 'Thông báo');
            return redirect()->route('topic.index');
        }
        $count_post = Post::where('topic_id', $id)->count();
        if ($count_post > 0) {
            toastr()->error('Chủ đề có bài viết không thể xóa', 'Thông báo');
            return redirect()->route('topic.index');
        }
        $topic->status = 0;
        $topic->save();
        toastr()->success('Xóa vào thùng rác thành công!', 'Thông báo');
        return redirect()->route('topic.index');
    }
    public function restore($id)
    {
        $topic = Topic::find($id);
        if ($topic == null) {
            toastr()->error('Không tông tại mẫu tin!', 'Thông báo');
            return redirect()->route('topic.trash');
        }
        $topic->status = 2;
        $topic->updated_at = date('Y-m-d H:i:s');
        $topic->updated_by = Auth::id() ?? 1;
        $topic->save();
        toastr()->success('Khôi phục thành công!', 'Thông báo');
        return redirect()->route('topic.trash');
    }

    public function status($id)
    {
        $list_topic = Topic::find($id);
        if ($list_topic == null) {
            toastr()->error('Không tông tại mẫu tin!', 'Thông báo');
            return redirect()->route('topic.index');
        }
        $list_topic->status = ($list_topic->status == 1) ? 2 : 1;
        $list_topic->save();
        toastr()->success('Thay đổi trạng thái thành công!', 'Thông báo');
        return redirect()->route('topic.index');
    }
}
