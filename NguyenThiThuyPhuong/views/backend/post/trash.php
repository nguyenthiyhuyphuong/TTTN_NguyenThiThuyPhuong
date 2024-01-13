<?php

use App\Models\Post;

$list_post = Post::join('topic', 'topic.id', '=', 'post.topic_id')
    ->where('post.status', '!=', 0)
    ->orderBy('post.created_at', 'DESC')
    ->select("post.*", "topic.name as topic_name")
    ->get();
?>

<?php require_once '../views/backend/header.php'; ?>
<!-- CONTENT -->
<form action="index.php?option=post&cat=process" name="THEM" method="post" enctype="multipart/form-data">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1 class="d-inline">Thùng rác bài viết</h1>
                    </div>
                </div>
            </div>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="index.php?option=post">Tất cả</a> |
                            <a href="index.php?option=post&cat=trash">Thùng rác</a>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="index.php?option=post" class="btn btn-sm btn-info">
                                <i class="fa fa-arrow-left" aria-hidden="true"></i>
                                Về danh sách
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <?php require_once '../views/backend/message.php'; ?>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width:50px;">
                                            <input type="checkbox">
                                        </th>
                                        <th class="text-center" style="width:30px;">Hình ảnh</th>
                                        <th>Tiêu đề bài viết</th>
                                        <th>Chủ đề</th>
                                        <th>Ngày tạo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (count($list_post) > 0) : ?>
                                        <?php foreach ($list_post as $item) : ?>
                                            <tr clas3s="datarow">
                                                <td>
                                                    <input type="checkbox">
                                                </td>
                                                <td>
                                                    <img src="../public/images/post/<?= $item->image; ?>" alt="<?= $item->image; ?>">
                                                </td>
                                                <td>
                                                    <div class="name">
                                                        <?= $item->title; ?>
                                                    </div>
                                                    <div class="function_style">
                                                        <a class="btn btn-info btn-xs" href="index.php?option=post&cat=restore&id=<?= $item->id; ?>">
                                                            <i class="fas fa-undo"></i> Khôi phục</a>
                                                        <a class="btn btn-danger btn-xs" href="index.php?option=post&cat=destroy&id=<?= $item->id; ?>">
                                                            <i class="fas fa-trash"></i> Xóa khỏi CSDL</a>
                                                    </div>
                                                </td>
                                                <td><?= $item->topic_name; ?></td>
                                                <td><?= $item->created_at; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</form>
<!-- END CONTENT-->
<?php require_once '../views/backend/footer.php'; ?>