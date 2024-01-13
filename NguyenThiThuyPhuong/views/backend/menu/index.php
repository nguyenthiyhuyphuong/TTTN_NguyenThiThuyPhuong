<?php

use App\Models\Menu;
use App\Models\Post;
use App\Models\Topic;
use App\Models\Category;
use App\Models\Brand;

$list_menu = Menu::where('status', '!=', 0)
   ->orderBy('position', 'asc')
   ->orderBy('Sort_order', 'asc')
   ->get();
$list_category = Category::where('status', '!=', 0)->orderBy('created_at', 'DESC')->get();
$list_brand = Brand::where('status', '!=', 0)->orderBy('created_at', 'DESC')->get();
$list_topic = Topic::where('status', '!=', 0)->orderBy('created_at', 'DESC')->get();
$list_page = Post::where([['status', '!=', 0], ['type', '=', 'page']])
   ->orderBy('created_at', 'DESC')->get();
?>

<?php require_once '../views/backend/header.php'; ?>
<!-- CONTENT -->
<form action="index.php?option=menu&cat=process" name="" method="post">
   <div class="content-wrapper">
      <section class="content-header">
         <div class="container-fluid">
            <div class="row mb-2">
               <div class="col-sm-12">
                  <h1 class="d-inline">Tất cả Menu</h1>
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
                     <a class="btn btn-sm btn-info" href="index.php?option=menu">
                        <i class="fas fa-bars"></i> Tất cả</a>
                     <a class="btn btn-sm btn-danger" href="index.php?option=menu&cat=trash">
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
                  <div class="col-md-3">
                     <div class="accordion" id="accordionExample">
                        <div class="card mb-0 p-3">
                           <select name="position" class="form-control">
                              <option value="mainmenu">Main Menu</option>
                              <option value="footermenu">Footer Menu</option>
                           </select>
                        </div>
                        <div class="card mb-0">
                           <div class="card-header" id="headingCategory">
                              <strong data-toggle="collapse" data-target="#collapseCategory" aria-expanded="true" aria-controls="collapseCategory">
                                 Danh mục sản phẩm
                              </strong>
                           </div>
                           <div id="collapseCategory" class="collapse" aria-labelledby="headingCategory" data-parent="#accordionExample">
                              <div class="card-body p-3">
                                 <?php foreach ($list_category as $category) : ?>
                                    <div class="form-check">
                                       <input name="categoryID[]" class="form-check-input" type="checkbox" value="<?= $category->id; ?>" id="categoryID<?= $category->id; ?>">
                                       <label class="form-check-label" for="categoryID<?= $category->id; ?>">
                                          <?= $category->name; ?>
                                       </label>
                                    </div>
                                 <?php endforeach; ?>
                                 <div class="my-3">
                                    <button name="ADDCATEGORY" class="btn btn-sm btn-success form-control">Thêm</button>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="card mb-0">
                           <div class="card-header" id="headingBrand">
                              <strong data-toggle="collapse" data-target="#collapseBrand" aria-expanded="true" aria-controls="collapseBrand">
                                 Thương hiệu
                              </strong>
                           </div>
                           <div id="collapseBrand" class="collapse" aria-labelledby="headingBrand" data-parent="#accordionExample">
                              <div class="card-body p-3">
                                 <?php foreach ($list_brand as $brand) : ?>
                                    <div class="form-check">
                                       <input name="brandID[]" class="form-check-input" type="checkbox" value="<?= $brand->id; ?>" id="brandID<?= $brand->id; ?>">
                                       <label class="form-check-label" for="brandID<?= $brand->id; ?>">
                                          <?= $brand->name; ?>
                                       </label>
                                    </div>
                                 <?php endforeach; ?>
                                 <div class="my-3">
                                    <button name="ADDBRAND" class="btn btn-sm btn-success form-control">Thêm</button>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="card mb-0">
                           <div class="card-header" id="headingTopic">
                              <strong data-toggle="collapse" data-target="#collapseTopic" aria-expanded="true" aria-controls="collapseTopic">
                                 Chủ đề bài viết
                              </strong>
                           </div>
                           <div id="collapseTopic" class="collapse" aria-labelledby="headingTopic" data-parent="#accordionExample">
                              <div class="card-body p-3">
                                 <?php foreach ($list_topic as $topic) : ?>
                                    <div class="form-check">
                                       <input name="topicID[]" class="form-check-input" type="checkbox" value="<?= $topic->id; ?>" id="topicID<?= $topic->id; ?>">
                                       <label class="form-check-label" for="topicID<?= $topic->id; ?>">
                                          <?= $topic->name; ?>
                                       </label>
                                    </div>
                                 <?php endforeach; ?>
                                 <div class="my-3">
                                    <button name="ADDTOPIC" class="btn btn-sm btn-success form-control">Thêm</button>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="card mb-0">
                           <div class="card-header" id="headingPage">
                              <strong data-toggle="collapse" data-target="#collapsePage" aria-expanded="true" aria-controls="collapsePage">
                                 Trang đơn
                              </strong>
                           </div>
                           <div id="collapsePage" class="collapse" aria-labelledby="headingPage" data-parent="#accordionExample">
                              <div class="card-body p-3">
                                 <?php foreach ($list_page as $page) : ?>
                                    <div class="form-check">
                                       <input name="pageID[]" class="form-check-input" type="checkbox" value="<?= $page->id; ?>" id="pageID<?= $page->id; ?>">
                                       <label class="form-check-label" for="pageID<?= $page->id; ?>">
                                          <?= $page->title; ?>
                                       </label>
                                    </div>
                                 <?php endforeach; ?>
                                 <div class="my-3">
                                    <button name="ADDPAGE" class="btn btn-sm btn-success form-control">Thêm</button>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="card mb-0">
                           <div class="card-header" id="headingCustom">
                              <strong data-toggle="collapse" data-target="#collapseCustom" aria-expanded="true" aria-controls="collapseCustom">
                                 Tuỳ liên kết
                              </strong>
                           </div>
                           <div id="collapseCustom" class="collapse" aria-labelledby="headingCustom" data-parent="#accordionExample">
                              <div class="card-body p-3">
                                 <div class="mb-3">
                                    <label>Tên menu</label>
                                    <input type="text" name="THEMMENU" class="form-control">
                                 </div>
                                 <div class="mb-3">
                                    <label>Liên kết</label>
                                    <input type="text" name="link" class="form-control">
                                 </div>
                                 <div class="mb-3">
                                    <button name="ADDCUSTOM" class="btn btn-sm btn-success form-control">Thêm</button>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-9">
                     <table class="table table-bordered">
                        <thead>
                           <tr>
                              <th class="text-center" style="width:30px;">
                                 <input type="checkbox">
                              </th>
                              <th>Tên menu</th>
                              <th>Liên kết</th>
                              <th>Vị trí</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php if (count($list_menu) > 0) : ?>
                              <?php foreach ($list_menu as $item) : ?>
                                 <tr clas3s="datarow">
                                    <td>
                                       <input type="checkbox">
                                    </td>
                                    <td>
                                       <div class="name">
                                          <?= $item->name; ?>
                                       </div>
                                       <div class="function_style">
                                          <?php if ($item->status == 1) : ?>
                                             <a class="btn btn-success btn-xs" href="index.php?option=menu&cat=status&id=<?= $item->id; ?>">
                                                <i class="fas fa-toggle-on"></i> Hiện</a>
                                          <?php else : ?>
                                             <a class="btn btn-danger btn-xs" href="index.php?option=menu&cat=status&id=<?= $item->id; ?>">
                                                <i class="fas fa-toggle-off"></i> Ẩn
                                             </a>
                                          <?php endif; ?>
                                          <a class="btn btn-primary btn-xs" href="index.php?option=menu&cat=edit&id=<?= $item->id; ?>">
                                             <i class="fas fa-edit"></i> Chỉnh sửa
                                          </a>
                                          <a class="btn btn-info btn-xs" href="index.php?option=menu&cat=show&id=<?= $item->id; ?>">
                                             <i class="fas fa-eye"></i> Chi tiết</a>
                                          <a class="btn btn-danger btn-xs" href="index.php?option=menu&cat=delete&id=<?= $item->id; ?>">
                                             <i class="fas fa-trash"></i> Xóa</a>
                                       </div>
                                    </td>
                                    <td><?= $item->link; ?></td>
                                    <td><?= $item->position; ?></td>
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