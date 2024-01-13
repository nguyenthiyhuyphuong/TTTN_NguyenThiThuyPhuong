<?php

use App\Models\Banner;

$list_banner = Banner::where('status', '!=', '0')
   ->orderBy('created_at', 'DESC')
   ->get();
?>

<?php require_once '../views/backend/header.php'; ?>
<form action="index.php?option=banner&cat=process" name="THEM" method="post">
   <!-- CONTENT -->
   <div class="content-wrapper">
      <section class="content-header">
         <div class="container-fluid">
            <div class="row mb-2">
               <div class="col-sm-12">
                  <h1 class="d-inline">Tất cả Slider</h1>
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
                     <a class="btn btn-sm btn-info" href="index.php?option=banner">
                        <i class="fas fa-bars"></i> Tất cả</a>
                     <a class="btn btn-sm btn-danger " href="index.php?option=banner&cat=trash">
                        <i class="fas fa-trash"></i> Thùng rác</a>
                  </div>
                  <div class="col-md-6 text-right">
                     <button class="btn btn-sm btn-success" type="submit" name="THEM">
                        <i class="fas fa-plus"></i> Thêm
                     </button>
                  </div>
               </div>
            </div>
            <div class="card-body">
            <?php require_once '../views/backend/message.php'; ?>
               <table class="table table-bordered" id="mytable">
                  <thead>
                     <tr>
                        <th class="text-center" style="width:30px;">
                           <input type="checkbox">
                        </th>
                        <th class="text-center" style="width:130px;">Hình ảnh</th>
                        <th>Tên banner</th>
                        <th>Liên kết</th>
                        <th>Id</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php if (count($list_banner) > 0) : ?>
                        <?php foreach ($list_banner as $item) : ?>
                           <tr class="datarow">
                              <td>
                                 <input type="checkbox">
                              </td>
                              <td>
                                 <img width="350" height="150" src="../public/images/banner/<?= $item->image; ?>" alt="<?= $list->image; ?>">
                              </td>
                              <td>
                                 <div class="name">
                                    <?= $item->name; ?>
                                 </div>
                                 <div class="function_style">
                                    <?php if ($item->status == 1) : ?>
                                       <a class="btn btn-success btn-xs" href="index.php?option=banner&cat=status&id=<?= $item->id; ?>">
                                          <i class="fas fa-toggle-on"></i> Hiện</a>
                                    <?php else : ?>
                                       <a class="btn btn-danger btn-xs" href="index.php?option=banner&cat=status&id=<?= $item->id; ?>">
                                          <i class="fas fa-toggle-off"></i> Ẩn
                                       </a>
                                    <?php endif; ?>
                                    <a class="btn btn-primary btn-xs" href="index.php?option=banner&cat=edit&id=<?= $item->id; ?>">
                                       <i class="fas fa-edit"></i> Chỉnh sửa
                                    </a>
                                    <a class="btn btn-info btn-xs" href="index.php?option=banner&cat=show&id=<?= $item->id; ?>">
                                       <i class="fas fa-eye"></i> Chi tiết</a>
                                    <a class="btn btn-danger btn-xs" href="index.php?option=banner&cat=delete&id=<?= $item->id; ?>">
                                       <i class="fas fa-trash"></i> Xóa</a>
                                 </div>
                              </td>
                              <td><?= $item->link; ?></td>
                              <td><?= $item->id; ?></td>
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
<script>
   $(document).ready(function() {
      $('#myTable').Datable();
   });
</script>

<?php require_once '../views/backend/footer.php'; ?>