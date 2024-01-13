<?php

use App\Libraries\MyClass;
use App\Models\Post;

$id = $_REQUEST['id'];
$page = Post::find($id);
if ($page == null) {
    MyClass::set_flash('message', ['msg' => 'Lỗi trang 404', 'type' => 'danger']);
    header("location:index.php?option=page");
}
?>

<?php require_once '../views/backend/header.php'; ?>
<!-- CONTENT -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="d-inline">Chi tiết bài viết</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-12 text-right">
                        <a href="index.php?option=page" class="btn btn-sm btn-info">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i>
                            Về danh sách
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Tên trường</th>
                                    <th>Giá trị</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>ID</td>
                                    <td><?= $page->id; ?></td>
                                </tr>
                                <tr>
                                    <td>Mã chủ đề</td>
                                    <td><?= $page->topic_id; ?></td>
                                </tr>
                                <tr>
                                    <td>Tiêu đề</td>
                                    <td><?= $page->title; ?></td>
                                </tr>
                                <tr>
                                    <td>Slug</td>
                                    <td><?= $page->slug; ?></td>
                                </tr>
                                <tr>
                                    <td>Chi tiết</td>
                                    <td><?= $page->detail; ?></td>
                                </tr>
                                <tr>
                                    <td>Hình ảnh</td>
                                    <td><img style="with=100px;" src="../public/images/page/<?= $page->image; ?>" alt="<?= $page->image; ?>"></td>
                                </tr>
                                <tr>
                                    <td>Kiếu</td>
                                    <td><?= $page->type; ?></td>
                                </tr>
                                <tr>
                                    <td>Từ khóa</td>
                                    <td><?= $page->description; ?></td>
                                </tr>
                                <tr>
                                    <td>Ngày tạo</td>
                                    <td><?= $page->created_at; ?></td>
                                </tr>
                                <tr>
                                    <td>Người tạo</td>
                                    <td><?= $page->created_by; ?></td>
                                </tr>
                                <tr>
                                    <td>Ngày sửa</td>
                                    <td><?= $page->updated_at; ?></td>
                                </tr>
                                <tr>
                                    <td>Người sửa</td>
                                    <td><?= $page->updated_by; ?></td>
                                </tr>
                                <tr>
                                    <td>Trạng thái</td>
                                    <td><?= $page->status; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- END CONTENT-->
<?php require_once '../views/backend/footer.php'; ?>