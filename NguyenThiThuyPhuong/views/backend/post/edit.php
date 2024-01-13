<?php

use App\Libraries\MyClass;
use App\Models\Post;
use App\Models\Topic;

$id = $_REQUEST['id'];
//$list_post = Topic::find($id);
$list_topic = Topic::where('status', '!=', '0')->get();
$list_post = Post::where([['status', '!=', '0'], ['id', '=', $id]])->first();
if ($list_post == null) {
    MyClass::set_flash('message', ['msg' => 'Lỗi trang 404', 'type' => 'danger']);
    header("location:index.php?option=post");
}
$html_topic_id = "";
foreach ($list_topic as $topic) {
    if ($list_post['topic_id'] == $topic->id) {
        $html_topic_id .= "<option selected value=' $topic->id '> $topic->name </option>";
    }
}

?>

<?php require_once '../views/backend/header.php'; ?>
<!-- CONTENT -->
<form action="index.php?option=post&cat=process" method="post" enctype="multipart/from-data">
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
                    <a href="index.php?option=post" class="btn btn-sm btn-info">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        Về danh sách
                    </a>
                </div>
                <div class="card-body">
                    <?php require_once '../views/backend/message.php'; ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <input type="text" name="id" value="<?= $list_post->id; ?>" />
                                <label>Tiêu đề bài viết</label>
                                <input type="text" value="<?= $list_post->title; ?>" name="name" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Chi tiết</label>
                                <input type="text" value="<?= $list_post->detail; ?>" name="slug" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Từ khóa</label>
                                <textarea name="description" class="form-control"><?= $list_post->description; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label>Chủ đề</label>
                                <select name="topic_id" class="form-control">
                                    <option value="">Chọn chủ đề</option>
                                    <?= $html_topic_id; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Hình đại diện</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Trạng thái</label>
                                <select name="status" class="form-control">
                                    <option value="1" <?= ($list_post->status == 1) ? 'selected' : ''; ?>>Xuất bản</option>
                                    <option value="2" <?= ($list_post->status == 2) ? 'selected' : ''; ?>>Chưa xuất bản</option>
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