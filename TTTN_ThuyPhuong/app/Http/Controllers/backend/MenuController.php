<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Post;
use App\Models\Product;
use App\Models\Topic;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;



class menuController extends Controller
{
    public function index()
    {
        $list_menu = Menu::where('status', '!=', 0)
            ->select('id', 'name', 'link', 'status')
            ->orderBy('created_at')
            ->get();
        $brands = Brand::where('status', '!=', 0)
            ->select('id', 'name', 'slug', 'status')
            ->orderBy('created_at')
            ->get();
        $categorys = Category::where('status', '!=', 0)
            ->select('id', 'name', 'slug', 'status')
            ->orderBy('created_at')
            ->get();
        $topics = Topic::where('status', '!=', 0)
            ->select('id', 'name', 'slug', 'status')
            ->orderBy('created_at')
            ->get();
        $pages = Post::where('status', '!=', 0)
            ->select('id', 'title', 'slug', 'status')
            ->orderBy('created_at')
            ->get();
        return view('backend.menu.index', compact('list_menu', 'brands', 'categorys', 'topics', 'pages'));
    }
    public function create()
    {
        $list_menu = Menu::where('status', '!=', 0)->get();

        $http_parent_id = '';
        $http_table_id = '';
        foreach ($list_menu as $item) {

            $http_parent_id .= '<option value="' . $item->parent_id . '">' . $item->name . '</option>';
            $http_table_id .= '<option value="' . $item->table_id . '">' . $item->name . '</option>';
        }

        return view('backend.menu.create', compact('http_parent_id', 'http_table_id'));
    }
    public function store(StoreMenuRequest $request)
    {
        if (isset($request->ADDCATEGORY)) {
            $list_category_id = $request->categoryid;
            foreach ($list_category_id as $id) {
                $category = Category::find($id);
                $menu = new Menu();
                $menu->name = $request->name;
                $menu->link = "danh-muc/" . $category->slug;
                $menu->position = $request->position;
                $menu->sort_order = 1;
                $menu->parent_id = 0;
                $menu->type = 'category';
                $menu->table_id = $request->table_id;
                $menu->status = 2;
                $menu->created_at = date('Y-m-d H:i:s');
                $menu->created_by = Auth::id() ?? 1;
                $menu->save();
            }
            toastr()->success('Thêm thành công!', 'Thông báo');
            return redirect()->route('menu.index');
        }
        if (isset($request->ADDBRAND)) {
            $list_brand_id = $request->brandid;
            foreach ($list_brand_id as $id) {
                $brand = Brand::find($id);
                $menu = new Menu();
                $menu->name = $request->name;
                $menu->link = "thuong-hieu/" . $brand->slug;
                $menu->position = $request->position;
                $menu->sort_order = 1;
                $menu->parent_id = 0;
                $menu->type = 'brand';
                $menu->table_id = $request->table_id;
                $menu->status = 2;
                $menu->created_at = date('Y-m-d H:i:s');
                $menu->created_by = Auth::id() ?? 1;
                $menu->save();
            }
            toastr()->success('Thêm thành công!', 'Thông báo');
            return redirect()->route('menu.index');
        }
        if (isset($request->ADDTOPIC)) {
            $list_topic_id = $request->topicid;
            foreach ($list_topic_id as $id) {
                $topic = Topic::find($id);
                $menu = new Menu();
                $menu->name = $request->name;
                $menu->link = "chu-de/" . $topic->slug;
                $menu->position = $request->position;
                $menu->sort_order = 1;
                $menu->parent_id = 0;
                $menu->type = 'topic';
                $menu->table_id = $request->table_id;
                $menu->status = 2;
                $menu->created_at = date('Y-m-d H:i:s');
                $menu->created_by = Auth::id() ?? 1;
                $menu->save();
            }
            toastr()->success('Thêm thành công!', 'Thông báo');
            return redirect()->route('menu.index');
        }
        if (isset($request->ADDPAGE)) {
            $list_page_id = $request->pageid;
            foreach ($list_page_id as $id) {
                $page = Post::find($id);
                $menu = new Menu();
                $menu->name = $request->name;
                $menu->link = "trang-don/" . $page->slug;
                $menu->position = $request->position;
                $menu->sort_order = 1;
                $menu->parent_id = 0;
                $menu->type = 'page';
                $menu->table_id = $request->table_id;
                $menu->status = 2;
                $menu->created_at = date('Y-m-d H:i:s');
                $menu->created_by = Auth::id() ?? 1;
                $menu->save();
            }
            toastr()->success('Thêm thành công!', 'Thông báo');
            return redirect()->route('menu.index');
        }
        if (isset($request->ADDCUSTOMER)) {
            $menu = new Menu();
            $menu->name = $request->name;
            $menu->link = $request->link;
            $menu->position = $request->position;
            $menu->sort_order = 1;
            $menu->parent_id = 0;
            $menu->type = 'customer';
            $menu->table_id = $request->table_id;
            $menu->status = 2;
            $menu->created_at = date('Y-m-d H:i:s');
            $menu->created_by = Auth::id() ?? 1;
            $menu->save();
            toastr()->success('Thêm thành công!', 'Thông báo');
            return redirect()->route('menu.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $menu = Menu::find($id);
        if ($menu == NULL) {
            toastr()->success('Thêm thành công!', 'Thông báo');
            return redirect()->route('menu.index');
        }
        return view('backend.menu.show', compact('menu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $menu = Menu::find($id);
        if ($menu == NULL) {
            toastr()->success('Thêm thành công!', 'Thông báo');
            return redirect()->route('menu.index');
        }
        $menu = Menu::where('status', '!=', 0)
            ->select('id', 'name', 'sort_order')
            ->orderBy('created_at')
            ->get();
        $html_parent_id = '';
        foreach ($menu as $item) {
            if ($menu->parent_id == $item->id) {
                $html_parent_id .= '<option selected value="' . $item->id . '">' . $item->name . '</option>';
            } else {

                $html_parent_id .= '<option value="' . $item->id . '">' . $item->name . '</option>';
            }
        }
        $html_sort_order = '';
        foreach ($menu as $item) {
            if ($menu->sort_order == $item->sort_order) {
                $html_sort_order .= '<option selected value="' . ($item->sort_order + 1) . '">' . $item->name . '</option>';
            } else {

                $html_sort_order .= '<option value="' . ($item->sort_order + 1) . '">' . $item->name . '</option>';
            }
        }
        return view("backend.menu.edit", compact("menu", "html_parent_id", "html_sort_order"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMenuRequest $request,  $id)
    {
        $list_menu = Menu::find($id);
        if ($list_menu == NULL) {
            toastr()->error('không tồn tại mẫu tin!', 'Thông báo');
            return redirect()->route('menu.index');
        }
        $list_menu->name = $request->name;
        $list_menu->link = $request->link;
        $list_menu->sort_order = $request->sort_order;
        $list_menu->parent_id = $request->parent_id;
        $list_menu->updated_at = date('Y-m-d H:i:s');
        $list_menu->updated_by = Auth::id() ?? 1;
        $list_menu->status = $request->status;
        $list_menu->save();
        toastr()->success('Cập nhật thành công!', 'Thông báo');
        return redirect()->route('menu.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $menu = Menu::where([['id','=',$id],['status','=']])->first();
        if ($menu == NULL) {
            toastr()->error('không tồn tại mẫu tin!', 'Thông báo');
            return redirect()->route('menu.trash');
        }
        $menu->delete();
        toastr()->success('Xóa khỏi CSDL thành công!', 'Thông báo');
        return redirect()->route('menu.trash');
    }


    public function trash()
    {
        $list_menu = Menu::where('status', '!=', '0')
            ->select('id', 'name', 'link', 'status', 'type', 'position')
            ->orderBy('created_at')
            ->get();
        return view('backend.menu.trash', compact('list_menu'));
    }



    public function delete($id)
    {

        $menu = Menu::find($id);
        if ($menu == NULL) {
            toastr()->error('không tồn tại mẫu tin!', 'Thông báo');
            return redirect()->route('menu.index');
        }
        $menu->status = 0;
        $menu->updated_at = date('Y-m-d H:i:s');
        $menu->updated_by = Auth::id() ?? 1;
        $menu->save();
        toastr()->success('Xóa vào thùng rác thành công!', 'Thông báo');
        return redirect()->route('menu.index');
    }
    public function restore($id)
    {
        $menu = Menu::find($id);
        if ($menu == NULL) {
            toastr()->error('không tồn tại mẫu tin!', 'Thông báo');
            return redirect()->route('menu.trash');
        } 
        $menu->status = 2;
        $menu->updated_at = date('Y-m-d H:i:s');
        $menu->updated_by = Auth::id() ?? 1;
        $menu->save();
        toastr()->success('Khôi phục thành công!', 'Thông báo');
        return redirect()->route('menu.trash');
    }

    public function status($id)
    {
        $list_menu = Menu::find($id);
        if ($list_menu == NULL) {
            toastr()->error('không tồn tại mẫu tin!', 'Thông báo');
            return redirect()->route('menu.index');
        }
        $list_menu->updated_at = date('Y-m-d H:i:s');
        $list_menu->updated_by = Auth::id() ?? 1;
        $list_menu->status = ($list_menu->status == 1) ? 2 : 1;
        $list_menu->save();
        toastr()->success('Thay đổi trạng thái thành công!', 'Thông báo');
        return redirect()->route('menu.index');
    }
}
