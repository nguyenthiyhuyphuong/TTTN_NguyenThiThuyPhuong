<?php

use App\Libraries\MyClass;
use App\Models\Category;

$id = $_REQUEST['id'];
$list = Category::where([['status', '!=', 0], ['id', '!=', $id]])->get();
$category = Category::find($id);
if ($category == null) {
    MyClass::set_flash('message', ['msg' => 'Lỗi trang 404', 'type' => 'danger']);
    header("location:index.php?option=category");
}
$html_parent_id = "";
$html_sort_order = '';
foreach ($list as $item) {
    if ($item->id != $id) {
        $html_parent_id .= "<option selected value='$item->id'>$item->name</option>";
    }else{
        $html_parent_id .= "<option value='$item->id'>$item->name</option>";
    }
    if ($item->id != $id) {
        $html_sort_order .= "<option selected value='$item->sort_order'>$item->name</option>";
    }else{
        $html_sort_order .= "<option value='$item->sort_order'>$item->name</option>";
    }
}
?>

<?php require_once '../views/backend/header.php'; ?>
<!-- CONTENT -->
<form action="index.php?option=category&cat=process" name="CAPNHAT" method="post" enctype="multipart/from-data">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1 class="d-inline">Cập nhật thương hiệu</h1>
                    </div>
                </div>
            </div>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="card">
                <div class="card-header text-right">
                    <!-- <div class="row">
                            <div class="col-md-6">
                            <a href="index.php?option=category">Tất cả</a> |
                            <a href="index.php?option=category&cat=trash">Thùng rác</a>
                            </div>
                            <div class="col-md-6 text-right">
                            <button class="btn btn-sm btn-success" type="submit" name="THEM">
                                <i class="fas fa-save"></i> Lưu
                            </button>
                            </div>
                        </div> -->
                    <button class="btn btn-sm btn-success" type="submit" name="CAPNHAT">
                        <i class="fa fa-save" aria-hidden="true"></i>
                        Lưu
                    </button>
                    <a href="index.php?option=category" class="btn btn-sm btn-info">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        Về danh sách
                    </a>
                </div>
                <div class="card-body">
                    <?php require_once '../views/backend/message.php'; ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <input type="text" name="id" value="<?= $category->id; ?>" />
                                <label>Tên thương hiệu (*)</label>
                                <input type="text" value="<?= $category->name; ?>" name="name" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Slug</label>
                                <input type="text" value="<?= $category->slug; ?>" name="slug" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Mô tả</label>
                                <textarea name="description" class="form-control"><?= $category->description; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label>Hình đại diện</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Trạng thái</label>
                                <select name="status" class="form-control">
                                    <option value="1" <?= ($category->status == 1) ? 'selected' : ''; ?>>Xuất bản</option>
                                    <option value="2" <?= ($category->status == 2) ? 'selected' : ''; ?>>Chưa xuất bản</option>
                                </select>
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