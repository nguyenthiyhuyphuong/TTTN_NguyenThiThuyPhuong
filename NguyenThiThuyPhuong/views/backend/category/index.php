<?php

use App\Models\Category;

$list = Category::where('status', '!=', 0)->select('status', 'id', 'image', 'name', 'slug')
   ->orderBy('created_at', 'DESC')
   ->get();
?>
<?php require_once '../views/backend/header.php'; ?>
<!-- CONTENT -->
<form action="index.php?option=category&cat=process" name="THEM" method="post" enctype="multipart/from-data">
   <div class="content-wrapper">
      <section class="content-header">
         <div class="container-fluid">
            <div class="row mb-2">
               <div class="col-sm-12">
                  <h1 class="d-inline">Tất cả danh mục</h1>
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
                     <a class="btn btn-sm btn-info" href="index.php?option=category">
                        <i class="fas fa-bars"></i> Tất cả</a>
                     <a class="btn btn-sm btn-danger" href="index.php?option=category&cat=trash">
                        <i class="fas fa-trash"></i> Thùng rác</a>
                  </div>
                  <div class="col-md-6 text-right">
                     <button class="btn btn-sm btn-success" type="submit" name="THEM">
                        <i class="fas fa-save"></i> Lưu
                     </button>
                  </div>
               </div>
            </div>
            <div class="card-body">
            <?php require_once '../views/backend/message.php'; ?>
               <div class="row">
                  <div class="col-md-4">
                     <div class="mb-3">
                        <label>Tên danh mục (*)</label>
                        <input type="text" name="name" id="name" placeholder="Nhập tên danh mục" class="form-control" onkeydown="handle_slug(this.value);">
                     </div>
                     <div class="mb-3">
                        <label>Slug</label>
                        <input type="text" name="slug" id="slug" placeholder="Nhập slug" class="form-control">
                     </div>
                     <div class="mb-3">
                        <label>Danh mục cha (*)</label>
                        <select name="parent_id" class="form-control">
                           <option value="">None</option>
                           <?=$category->name;?>
                        </select>
                     </div>
                     <div class="mb-3">
                        <label>Hình đại diện</label>
                        <input type="file" name="image" class="form-control">
                     </div>
                     <div class="mb-3">
                        <label>Trạng thái</label>
                        <select name="status" class="form-control">
                           <option value="1">Xuất bản</option>
                           <option value="2">Chưa xuất bản</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-md-8">
                     <table class="table table-bordered">
                        <thead>
                           <tr>
                              <th class="text-center" style="width:30px;">
                                 <input type="checkbox">
                              </th>
                              <th class="text-center" style="width:130px;">Hình ảnh</th>
                              <th>Tên danh mục</th>
                              <th>Tên slug</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php if (count($list) > 0) : ?>
                              <?php foreach ($list as $item) : ?>
                                 <tr class="datarow">
                                    <td>
                                       <input type="checkbox">
                                    </td>
                                    <td class="text-center">
                                       <img width="100px" src="../public/images/category/<?= $item->image; ?>" alt="<?= $item->image; ?>">
                                    </td>
                                    <td>
                                       <div class="name">
                                          <?= $item->name; ?>
                                       </div>
                                       <div class="function_style">
                                          <?php if ($item->status == 1) : ?>
                                             <a class="btn btn-success btn-xs" href="index.php?option=category&cat=status&id=<?= $item->id; ?>">
                                                <i class="fas fa-toggle-on"></i> Hiện
                                             </a>
                                          <?php else : ?>
                                             <a class="btn btn-danger btn-xs" href="index.php?option=category&cat=status&id=<?= $item->id; ?>">
                                                <i class="fas fa-toggle-off"></i> Ẩn</a>
                                          <?php endif; ?>
                                          <a class="btn btn-primary btn-xs" href="index.php?option=category&cat=edit&id=<?= $item->id; ?>">
                                          <i class="fas fa-edit"></i>Chỉnh sửa</a>
                                          <a class="btn btn-info btn-xs" href="index.php?option=category&cat=show&id=<?= $item->id; ?>">
                                          <i class="fas fa-eye"></i> Chi tiết</a>
                                          <a class="btn btn-danger btn-xs" href="index.php?option=category&cat=delete&id=<?= $item->id; ?>">
                                          <i class="fas fa-trash"></i> Xoá</a>
                                       </div>
                                    </td>
                                    <td><?= $item->slug; ?></td>
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
   <!-- END CONTENT-->
</form>
<?php require_once '../views/backend/footer.php'; ?>