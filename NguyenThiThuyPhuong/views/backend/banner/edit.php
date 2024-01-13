<?php

use App\Libraries\MyClass;
use App\Models\Banner;

$id = $_REQUEST['id'];
$banner = Banner::find($id);
if ($banner == null) {
    MyClass::set_flash('message', ['msg' => 'Lỗi trang 404', 'type' => 'danger']);
    header("location:index.php?option=banner");
}

$list_banner = Banner::where([['status', '!=', 0], ['id', '!=', $id]])->get();
$html_sort_order = "";
foreach ($list_banner as $item) {
    if ($item->sort_order - 1 == $banner->sort_order) {
        $html_sort_order .= "<option selected value='$item->sort_order'>$item->name</option>";
    } else {
        $html_sort_order .= "<option value='$item->sort_order'>$item->name</option>";
    }
}

?>

<?php require_once '../views/backend/header.php'; ?>
<!-- CONTENT -->
<form action="index.php?option=banner&cat=process" name="CAPNHAT" method="post" enctype="multipart/from-data">
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
                            <a href="index.php?option=banner">Tất cả</a> |
                            <a href="index.php?option=banner&cat=trash">Thùng rác</a>
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
                    <a href="index.php?option=banner" class="btn btn-sm btn-info">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        Về danh sách
                    </a>
                </div>
                <div class="card-body">
                    <?php require_once '../views/backend/message.php'; ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <input type="text" name="id" value="<?= $banner->id; ?>" />
                                <label>Tên thương hiệu (*)</label>
                                <input type="text" value="<?= $banner->name; ?>" name="name" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Hình đại diện</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                            <div class="mb-3">
                                <input type="text" name="id" value="<?= $banner->id; ?>" />
                                <label>Liên kết</label>
                                <input type="text" value="<?= $banner->link; ?>" name="name" class="form-control">
                            </div>
                            <div class="mb-3">
                                <input type="text" name="id" value="<?= $banner->id; ?>" />
                                <label>Vị trí</label>
                                <input type="text" value="<?= $banner->position; ?>" name="name" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Thứ tự</label>
                                <select name="html_sort_order" class="form-control">
                                    <option value="">Chọn thứ tự</option>
                                    <?= $html_sort_order; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Trạng thái</label>
                                <select name="status" class="form-control">
                                    <option value="1" <?= ($banner->status == 1) ? 'selected' : ''; ?>>Xuất bản</option>
                                    <option value="2" <?= ($banner->status == 2) ? 'selected' : ''; ?>>Chưa xuất bản</option>
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