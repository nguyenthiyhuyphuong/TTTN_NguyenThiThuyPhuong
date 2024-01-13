<?Php

use App\Models\Banner;

$list_banner= Banner::where('status', '!=', 0)->get();
$html_sort_order = '';
foreach ($list_banner as $banner) {
   $html_sort_order .= "<option value='$banner->sort_order'>$banner->name</option>";
}

?>
<?php require_once '../views/backend/header.php'; ?>
<!-- CONTENT -->
<form action="index.php?option=banner&cat=process" name="THEM" method="post" enctype="multipart/form-data">
   <div class="content-wrapper">
      <section class="content-header">
         <div class="container-fluid">
            <div class="row mb-2">
               <div class="col-sm-12">
                  <h1 class="d-inline">Thêm mới sản phẩm</h1>
               </div>
            </div>
         </div>
      </section>
      <section class="content">
         <div class="card">
            <div class="card-header text-right">
               <a href="index.php?option=banner" class="btn btn-sm btn-info">
                  <i class="fa fa-arrow-left" aria-hidden="true"></i>
                  Về danh sách
               </a>
               <button type="submit" class="btn btn-sm btn-success" name="THEM">
                  <i class="fa fa-save" aria-hidden="true"></i>
                  Thêm sản phẩm
               </button>
            </div>
            <div class="card-body">
               <?php require_once '../views/backend/message.php'; ?>
               <div class="row">
                  <div class="col-md-9">
                     <div class="mb-3">
                        <label>Tên slider</label>
                        <input type="text" placeholder="Nhập tên sản phẩm" name="name" class="form-control">
                     </div>
                     <div class="mb-3">
                        <label>Liên kết</label>
                        <input type="text" placeholder="Nhập slug" name="slug" class="form-control">
                     </div>
                     <div class="row">
                        <div class="col-md-6">
                           <div class="mb-3">
                              <label>Vị trí</label>
                              <select name="category_id" class="form-control">
                                 <option value="">Slideshow</option>
                                 <?= $category_id_html; ?>
                              </select>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="mb-3">
                              <label>Sắp xếp</label>
                              <select name="category_id" class="form-control">
                                 <option value="">Chọn vị trí</option>
                                 <?= $category_id_html; ?>
                              </select>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
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
               </div>
            </div>
         </div>
      </section>
   </div>
</form>
<?php require_once '../views/backend/footer.php'; ?>