<?php

use App\Models\Post;

$list_page = Post::where([['status', '!=', 0], ['type', '=', 'page']])->orderBy('created_at', 'DESC')->get();
?>

<?php require_once '../views/backend/header.php'; ?>
<form action="index.php?option=page&cat=process" name="THEM" method="post" enctype="multipart/from-data">
   <!-- CONTENT -->
   <div class="content-wrapper">
      <section class="content-header">
         <div class="container-fluid">
            <div class="row mb-2">
               <div class="col-sm-12">
                  <h1 class="d-inline">Tất cả trang đơn</h1>
               </div>
            </div>
         </div>
      </section>
      <!-- Main content -->
      <section class="content">
         <div class="card">
            <div class="card-header p-2">
               <div class="row">
                  <div class="col-md-6">
                     <a href="index.php?option=page">Tất cả</a> |
                     <a href="index.php?option=page&cat=trash">Thùng rác</a>
                  </div>
                  <div class="col-md-6 text-right">
                     <a href="page_create.html" class="btn btn-sm btn-success">
                        <i class="fas fa-plus"></i> Thêm trang đơn</a>
                  </div>
               </div>

            </div>
            <div class="card-body p-2">
               <table class="table table-bordered">
                  <thead>
                     <tr>
                        <th class="text-center" style="width:30px;">
                           <input type="checkbox">
                        </th>
                        <th>ID</th>
                        <th class="text-center" style="width:130px;">Hình ảnh</th>
                        <th>Tiêu đề bài viết</th>
                        <th>Slug</th>
                        <th>Ngày tạo</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php if (count($list_page) > 0) : ?>
                        <?php foreach ($list_page as $item) : ?>
                           <tr class="datarow">
                              <td>
                                 <input type="checkbox">
                              </td>
                              <td><?= $item->id; ?></td>
                              <td>
                                 <img src="../public/images/page/<?= $item->image; ?>" alt="<?= $item->image; ?>">
                              </td>
                              <td>
                                 <div class="name">
                                    <?= $item->title; ?>
                                 </div>
                                 <div class="function_style">
                                    <?php if ($item->status == 1) : ?>
                                       <a class="btn btn-success btn-xs" href="index.php?option=page&cat=status&id=<?= $item->id; ?>">
                                          <i class="fas fa-toggle-on"></i> Hiện</a>
                                    <?php else : ?>
                                       <a class="btn btn-danger btn-xs" href="index.php?option=page&cat=status&id=<?= $item->id; ?>">
                                          <i class="fas fa-toggle-off"></i> Ẩn
                                       </a>
                                    <?php endif; ?>
                                    <a class="btn btn-primary btn-xs" href="index.php?option=page&cat=edit&id=<?= $item->id; ?>">
                                       <i class="fas fa-edit"></i> Chỉnh sửa
                                    </a>
                                    <a class="btn btn-info btn-xs" href="index.php?option=page&cat=show&id=<?= $item->id; ?>">
                                       <i class="fas fa-eye"></i> Chi tiết</a>
                                    <a class="btn btn-danger btn-xs" href="index.php?option=page&cat=delete&id=<?= $item->id; ?>">
                                       <i class="fas fa-trash"></i> Xóa</a>
                                 </div>
                              </td>
                              <td><?= $item->slug; ?></td>
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