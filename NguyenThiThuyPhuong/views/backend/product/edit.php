<?php

use App\Libraries\MyClass;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

$id = $_REQUEST['id'];
$product = Product::where([['status', '!=', 0], ['id', '=', $id]])->first();
if ($product == null) {
    MyClass::set_flash('message', ['msg' => 'Lỗi trang 404', 'type' => 'danger']);
    header("location:index.php?option=product");
}
$list_brand = Brand::where('status', '!=', 0)->orderBy('created_at', 'DESC')->get();
$list_category = Category::where('status', '!=', 0)->orderBy('created_at', 'DESC')->get();
$brand_id_html = '';
$category_id_html = '';
foreach ($list_brand as $brand) {
    $brand_id_html .= "<option value='$brand->id'>$brand->name</option>";
}
foreach ($list_category as $category) {
    $category_id_html .= "<option value='$category->id'>$category->name</option>";
}
?>

<?php require_once '../views/backend/header.php'; ?>
<!-- CONTENT -->
<form action="index.php?option=product&cat=process" method="post" enctype="multipart/from-data">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1 class="d-inline">Cập nhật sản phẩm</h1>
                    </div>
                </div>
            </div>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="card">
                <div class="card-header text-right">
                    <button class="btn btn-sm btn-success" type="submit" name="CAPNHAT">
                        <i class="fa fa-save" aria-hidden="true"></i>
                        Lưu
                    </button>
                    <a href="index.php?option=product" class="btn btn-sm btn-info">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        Về danh sách
                    </a>
                </div>
                <div class="card-body">
                    <?php require_once '../views/backend/message.php'; ?>
                    <div class="row">
                        <div class="col-md-7">
                            <div class="mb-3">
                                <input type="text" style="width:70px;" name="id" value="<?= $product->id; ?>" />
                                <label>Tên sản phẩm (*)</label>
                                <input type="text" value="<?= $product->name; ?>" name="name" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Chi tiết</label>
                                <input type="text" value="<?= $product->detail; ?>" name="slug" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Từ khóa</label>
                                <textarea name="description" class="form-control"><?= $product->description; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label>Slug</label>
                                <textarea name="slug" class="form-control"><?= $product->slug; ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="mb-3">
                                <label>Danh mục (*)</label>
                                <select name="category_id" class="form-control">
                                    <option value="">Chọn danh mục</option>
                                    <?= $category_id_html; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Thương hiệu</label>
                                <select name="brand_id" class="form-control">
                                    <option value="">Chọn thương hiệu</option>
                                    <?= $brand_id_html; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Giá</label>
                                <input type="text" value="<?= $product->price; ?>" name="price" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Giá khuyến mãi</label>
                                <input type="text" value="<?= $product->pricesale; ?>" name="pricesale" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Số lượng</label>
                                <input type="text" value="<?= $product->qty; ?>" name="qty" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Hình ảnh</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Trạng thái</label>
                                <select name="status" class="form-control">
                                    <option value="1" <?= ($product->status == 1) ? 'selected' : ''; ?>>Xuất bản</option>
                                    <option value="2" <?= ($product->status == 2) ? 'selected' : ''; ?>>Chưa xuất bản</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </section>
    </div>
</form>
<!-- END CONTENT-->
<?php require_once '../views/backend/footer.php'; ?>


<!-- // foreach ($list_category as $item) {
//     if ($product->category_id == $item->id) {
//         $str_option_cat .= "<option selected value='" . $item->id . "'" . $item["name"] . "</option>";
//     } else {
//         $str_option_cat .= "<option value='" . $item->id . "'" . $item["name"] . "</option>";
//     }
// }

// foreach ($list_brand as $item) {
//     if ($product->brand_id == $item->id) {
//         $str_option_brand .= "<option selected value='" . $item->id . "'" . $item["name"] . "</option>";
//     } else {
//         $str_option_brand .= "<option value='" . $item->id . "'" . $item["name"] . "</option>";
//     }
// } -->