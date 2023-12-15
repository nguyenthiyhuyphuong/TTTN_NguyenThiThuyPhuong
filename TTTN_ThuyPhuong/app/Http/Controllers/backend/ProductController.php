<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Orderdetail;
use App\Models\ProductSale;
use App\Models\ProductStore;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;



class ProductController extends Controller
{
    public function index()
    {
        $product = Product::where('status', '!=', 0)
            // ->join('category', 'category.id', '=', 'product.category_id')
            // ->join('brand', 'brand.id', '=', 'product.brand_id')
            ->orderBy('created_at', 'desc')
            ->get();
        $count_all = Product::count();
        $count_trash = Product::where('status', '=', 0)->count();
        $categorys = Category::where('status', '!=', 0)
            ->orderBy('created_at', 'desc')
            ->get();
        $category_id_html = "";
        foreach ($categorys as $item) {
            $category_id_html = "<option value='" . $item->id . "'>" . $item->name . "</option>";
        }
        return view('backend.product.index', compact('product', 'count_all', 'count_trash'));
    }

    public function trash()
    {
        $product = Product::where('product.status', '=', '0')
            ->orderBy('created_at', 'desc')
            ->get();
        $count_all = Product::count();
        $count_trash = Product::where('status', '=', 0)->count();
        return view('backend.product.trash', compact('product', 'count_all', 'count_trash'));
    }

    public function create()
    {
        $product = Product::where('status', '!=', 0)->get();
        if ($product == null) {
            toastr()->error('Không tồn tại mẫu tin!', 'Thông báo');
            return redirect()->route('product.index');
        }
        $categorys = Category::where('status', '!=', 0)
            ->select('name', 'id', 'status')
            ->orderBy('created_at', 'DESc')
            ->get();
        $brands = Brand::where('status', '!=', 0)
            ->select('name', 'id', 'status')
            ->orderBy('created_at', 'DESc')
            ->get();
        $html_category_id = "";
        foreach ($categorys as $item) {

            $html_category_id .= '<option value="' . $item->id . '">' . $item->name . '</option>';
        }

        $html_brand_id = "";
        foreach ($brands as $item) {

            $html_brand_id .= '<option value="' . $item->id . '">' . $item->name . '</option>';
        }
        toastr()->success('Thêm thành công', 'Thông báo');
        return view('backend.product.create', compact('product', 'html_category_id', 'html_brand_id'));
    }

    public function store(StoreProductRequest $request)
    {
        if ($request->hasFile('image')) {
            $list_product = new Product;
            $list_product->name = $request->name;
            $list_product->slug = (strlen($request->slug) > 0) ? $request->slug : Str::of($request->name)->slug('-');
            $list_product->category_id = $request->category_id;
            $list_product->brand_id = $request->brand_id;
            $list_product->price = $request->price;
            $list_product->detail = $request->detail;
            $list_product->description = $request->description;
            $list_product->status = $request->status;
            $list_product->created_at = date('Y-m-d H:i:s');
            $list_product->created_by = Auth::id() ?? 1;
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $fileName = $list_product->slug . '.' . $extension;
            $image->storeAs('public/images/product', $fileName);
            $list_product->image = $fileName;
            //end upload
            $list_product->save();
            toastr()->success('Thêm sản phẩm thành công!', 'Thông báo');
            return redirect()->route('product.index');
        }
    }


    public function show(string $id)
    {
        $product = Product::find($id);
        if ($product == null) {
            toastr()->error('Không tông tại mẫu tin!', 'Thông báo');
            return redirect()->route('product.index');
        }
        return view('backend.product.show', compact('product'));
    }

    public function edit($id)
    {
        $list_product = Product::find($id);
        if ($list_product == null) {
            toastr()->error('Không tông tại mẫu tin!', 'Thông báo');
            return redirect()->route('product.index');
        }
        $list_category = Category::where('status', '!=', 0)
            ->select('name', 'id', 'status')
            ->orderBy('created_at', 'DESC')
            ->get();
        $list_brand = Brand::where('status', '!=', 0)
            ->select('name', 'id', 'status')
            ->orderBy('created_at', 'DESC')
            ->get();
        $html_category_id = '';
        foreach ($list_category as $item) {
            if ($item->id == $list_product->category_id) {
                $html_category_id .= '<option selected value="' . $item->id . '">' . $item->name . '</option>';
            } else {
                $html_category_id .= '<option value="' . $item->id . '">' . $item->name . '</option>';
            }
        }
        $html_brand_id = '';
        foreach ($list_brand as $item) {
            if ($item->id == $list_product->cbrand_id) {
                $html_brand_id .= '<option selected value="' . $item->id . '">' . $item->name . '</option>';
            } else {
                $html_brand_id .= '<option value="' . $item->id . '">' . $item->name . '</option>';
            }
        }
        return view("backend.product.edit", compact("product", "html_sort_order", "html_brand_id", "html_category_id"));
    }

    public function update(UpdateProductRequest $request,  $id)
    {

        $list_product = Product::find($id);
        if ($list_product == null) {
            toastr()->error('Không tông tại mẫu tin!', 'Thông báo');
            return redirect()->route('product.index');
        }
        $list_product->name = $request->name;
        $list_product->slug = (strlen($request->slug) > 0) ? $request->slug : Str::of($request->name)->slug('-');
        $list_product->category_id = $request->category_id;
        $list_product->brand_id = $request->brand_id;
        $list_product->price = $request->price;
        $list_product->detail = $request->detail;
        $list_product->status = $request->status;
        $list_product->description = $request->description;
        //upload file
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $fileName = $list_product->slug . '.' . $extension;
            $image->storeAs('public/images/product', $fileName);
            $list_product->image = $fileName;
        }
        //end upload file
        $list_product->updated_at = date('Y-m-d H:i:s');
        $list_product->updated_by = Auth::id() ?? 1;
        $list_product->status = $request->status;
        $list_product->save();
        toastr()->success('Cập nhật thành công!', 'Thông báo');
        return redirect()->route('product.index');
    }

    public function status($id)
    {
        $list_product = Product::find($id);
        if ($list_product == null) {
            toastr()->error('Không tông tại mẫu tin!', 'Thông báo');
            return redirect()->route('product.index');
        }
        $list_product->status = ($list_product->status == 1) ? 2 : 1;
        $list_product->updated_at = date('Y-m-d H:i:s');
        $list_product->updated_by = Auth::id() ?? 1;
        $list_product->save();
        toastr()->success('Thay đổi trạng thái thành công!', 'Thông báo');
        return redirect()->route('product.index');
    }

    public function delete($id)
    {
        $product = Product::find($id);
        if ($product == NULL) {
            toastr()->error('Không tồn tại mẫu tin!', 'Thông báo');
            return redirect()->route('product.index');
        }
        $count_orderdetail = Orderdetail::where('product_id', $id)->count();
        if ($count_orderdetail > 0) {
            toastr()->error('Sản phẩm đã bán, Không thể xóa', 'Thông báo');
            return redirect()->route('product.index');
        }
        $product->status = 0;
        $product->updated_at = date('Y-m-d H:i:s');
        $product->updated_by = Auth::id() ?? 1;
        $product->save();
        toastr()->success('Xóa vào thùng rác thành công !', 'Thông báo');
        return redirect()->route('product.index');
    }

    public function restore($id)
    {
        $list_product = Product::find($id);
        if ($list_product == NULL) {
            toastr()->success('khôi phục không thành công!', 'Thông báo');
            return redirect()->route('product.index');
        }
        $list_product->status = 2;
        $list_product->updated_at = date('Y-m-d H:i:s');
        $list_product->updated_by = Auth::id() ?? 1;
        $list_product->save();
        toastr()->success('Khôi phục thành công!', 'Thông báo');
        return redirect()->route('product.trash');
    }

    //DESTROY XOA KHOI CSDL
    public function destroy($id)
    {
        $product = Product::where([['id', '=', $id], ['status', '=', 0]])->first();
        if ($product == null) {
            toastr()->error('Không tông tại mẫu tin!', 'Thông báo');
            return redirect()->route('product.trash');
        }

        if ($product->delete()) {
            //ProducSale
            $list_product_sale = ProductSale::where('product_id', $id)->get();
            foreach ($list_product_sale as $product_sale) {
                $product_sale->delete();
            }
            //ProducStore
            $list_product_store = ProductStore::where('product_id', $id)->get();
            foreach ($list_product_store as $product_sale) {
                $product_sale->delete();
            }
            toastr()->success('Xóa khỏi CSDL thành công!', 'Thông báo');
            return redirect()->route('product.trash');
        }
    }
}
