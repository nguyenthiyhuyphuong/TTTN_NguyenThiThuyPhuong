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
                  <h1 class="d-inline">Tất cả bài viết</h1>
                  <a href="index.php?option=post&cat=create" class="btn btn-sm btn-primary">Thêm bài viết</a>
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
                     <a class="btn btn-sm btn-info" href="index.php?option=post">Tất cả</a>
                     <a class="btn btn-sm btn-danger" href="index.php?option=post&cat=trash"><i class="fas fa-trash"></i> Thùng rác</a>
                  </div>
                  <div class="col-md-6 text-right">
                     <button class="btn btn-sm btn-danger" type="submit" name="THEM">
                        <i class="fas fa-trash"></i> Xóa
                     </button>
                  </div>
               </div>
            </div>
            <div class="card-body">
               
               <table class="table table-bordered">
                  <thead>
                     <tr>
                        <th class="text-center" style="width:30px;">
                           <input type="checkbox">
                        </th>
                        <th class="text-center" style="width:130px;">Hình ảnh</th>
                        <th>Tiêu đề bài viết</th>
                        <th>Chủ đề</th>
                        <th>Ngày tạo</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php if (count($list_post) > 0) : ?>
                        <?php foreach ($list_post as $item) : ?>
                           <tr class="datarow">
                              <td>
                                 <input type="checkbox">
                              </td>
                              <td>
                                 <img src="../public/images/pots/<?= $list_post->image; ?>" alt="<?= $list_post->image; ?>">
                              </td>
                              <td>
                                 <div class="name">
                                    <?= $item->title; ?>
                                 </div>
                                 <div class="function_style">
                                    <?php if ($item->status == 1) : ?>
                                       <a class="btn btn-success btn-xs" href="index.php?option=post&cat=status&id=<?= $item->id; ?>">
                                          <i class="fas fa-toggle-on"></i> Hiện</a>
                                    <?php else : ?>
                                       <a class="btn btn-danger btn-xs" href="index.php?option=post&cat=status&id=<?= $item->id; ?>">
                                          <i class="fas fa-toggle-off"></i> Ẩn
                                       </a>
                                    <?php endif; ?>
                                    <a class="btn btn-primary btn-xs" href="index.php?option=post&cat=edit&id=<?= $item->id; ?>">
                                       <i class="fas fa-edit"></i> Chỉnh sửa
                                    </a>
                                    <a class="btn btn-info btn-xs" href="index.php?option=post&cat=show&id=<?= $item->id; ?>">
                                       <i class="fas fa-eye"></i> Chi tiết</a>
                                    <a class="btn btn-danger btn-xs" href="index.php?option=post&cat=delete&id=<?= $item->id; ?>">
                                       <i class="fas fa-trash"></i> Xóa</a>
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
      </section>
   </div>
   <!-- END CONTENT-->
</form>
<?php require_once '../views/backend/footer.php'; ?>