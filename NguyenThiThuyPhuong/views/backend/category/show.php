<?php

use App\Libraries\MyClass;
use App\Models\Category;

$id = $_REQUEST['id'];
$category = Category::find($id);
if ($category == null) {
    MyClass::set_flash('message', ['msg' => 'Lỗi trang 404', 'type' => 'danger']);
    header("location:index.php?option=category");
}
?>

<?php require_once '../views/backend/header.php'; ?>
<!-- CONTENT -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="d-inline">Chi tiết thương hiệu</h1>
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
                        <a href="index.php?option=category" class="btn btn-sm btn-info">
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
                                    <th>ID</th>
                                    <td><?= $category->id; ?></td>
                                </tr>
                                <tr>
                                    <th>Tên</th>
                                    <td><?= $category->name; ?></td>
                                </tr>
                                <tr>
                                    <th>Slug</th>
                                    <td><?= $category->slug; ?></td>
                                </tr>
                                <tr>
                                    <th>Hình đại diện</th>
                                    <td><img style="with=100px;" src="../public/images/category/<?= $category->image; ?>" alt="<?= $category->image; ?>"></td>
                                </tr>
                                <tr>
                                    <th>Từ khóa</th>
                                    <td><?= $category->description; ?></td>
                                </tr>
                                <tr>
                                    <th>Ngày tạo</th>
                                    <td><?= $category->created_at; ?></td>
                                </tr>
                                <tr>
                                    <th>Người tạo</th>
                                    <td><?= $category->created_by; ?></td>
                                </tr>
                                <tr>
                                    <th>Ngày sửa</th>
                                    <td><?= $category->updated_at; ?></td>
                                </tr>
                                <tr>
                                    <th>Người sửa</th>
                                    <td><?= $category->updated_by; ?></td>
                                </tr>
                                <tr>
                                    <th>Trạng thái</th>
                                    <td><?= $category->status; ?></td>
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