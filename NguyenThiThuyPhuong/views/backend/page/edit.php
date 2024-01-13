<?php

use App\Libraries\MyClass;
use App\Models\Post;

$id = $_REQUEST['id'];
$list_page = Post::find($id);

if ($list_page == null) {
    MyClass::set_flash('message', ['msg' => 'Lỗi trang 404', 'type' => 'danger']);
    header("location:index.php?option=page");
}
?>

<?php require_once '../views/backend/header.php'; ?>
<!-- CONTENT -->
<form action="index.php?option=page&cat=process" name="CAPNHAT" method="post" enctype="multipart/from-data">
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
                    <button class="btn btn-sm btn-success" type="submit" name="CAPNHAT">
                        <i class="fa fa-save" aria-hidden="true"></i>
                        Lưu
                    </button>
                    <a href="index.php?option=page" class="btn btn-sm btn-info">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        Về danh sách
                    </a>
                </div>
                <div class="card-body">
                    <?php require_once '../views/backend/message.php'; ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <input type="text" name="id" value="<?= $list_page->id; ?>" />
                                <label>Tiêu đề trang đơn</label>
                                <input type="text" value="<?= $list_page->title; ?>" name="name" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Chi tiết</label>
                                <input type="text" value="<?= $list_page->detail; ?>" name="slug" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Từ khóa</label>
                                <textarea name="description" class="form-control"><?= $list_page->description; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label>Hình đại diện</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Trạng thái</label>
                                <select name="status" class="form-control">
                                    <option value="1" <?= ($list_page->status == 1) ? 'selected' : ''; ?>>Xuất bản</option>
                                    <option value="2" <?= ($list_page->status == 2) ? 'selected' : ''; ?>>Chưa xuất bản</option>
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