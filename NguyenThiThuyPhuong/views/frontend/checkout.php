<?php require_once 'views/frontend/header.php'; ?>
   </section>
   <section class="hdl-mainmenu bg-main">
      <div class="container">
         <div class="row">
            <div class="col-12 col-md-12">
               <nav class="navbar navbar-expand-lg bg-main">
                  <div class="container-fluid">
                     <a class="navbar-brand d-block d-sm-none text-white" href="index.html">DIENLOISHOP</a>
                     <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                     </button>
                     <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                           <li class="nav-item">
                              <a class="nav-link text-white" aria-current="page" href="index.html">Trang chủ</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link text-white" href="post_page.html">Giới thiệu</a>
                           </li>
                           <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle text-white" href="#" role="button"
                                 data-bs-toggle="dropdown" aria-expanded="false">
                                 Thời trang nam
                              </a>
                              <ul class="dropdown-menu">
                                 <li><a class="dropdown-item text-main" href="product_category.html">Quần jean nam</a>
                                 </li>
                                 <li><a class="dropdown-item text-main" href="product_category.html">Áo thun nam </a>
                                 </li>
                                 <li><a class="dropdown-item text-main" href="product_category.html">Sơ mi nam</a></li>
                              </ul>
                           </li>
                           <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle text-white" href="#" role="button"
                                 data-bs-toggle="dropdown" aria-expanded="false">
                                 Thời trang nữ
                              </a>
                              <ul class="dropdown-menu">
                                 <li><a class="dropdown-item text-main" href="product_category.html">Váy</a></li>
                                 <li><a class="dropdown-item text-main" href="product_category.html">Đầm</a>
                                 </li>
                                 <li><a class="dropdown-item text-main" href="product_category.html">Sơ mi nữ</a></li>
                              </ul>
                           </li>
                           <li class="nav-item">
                              <a href="post_topic.html" class="nav-link text-white">Bài viết</a>
                           </li>
                           <li class="nav-item">
                              <a href="contact.html" class="nav-link text-white">Liên hệ</a>
                           </li>
                        </ul>
                     </div>
                  </div>
               </nav>
            </div>
         </div>
      </div>
   </section>
   <section class="bg-light">
      <div class="container">
         <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb py-2 my-0">
               <li class="breadcrumb-item">
                  <a class="text-main" href="index.html">Trang chủ</a>
               </li>
               <li class="breadcrumb-item active" aria-current="page">
                  Thanh toán
               </li>
            </ol>
         </nav>
      </div>
   </section>
   <section class="hdl-maincontent py-2">
      <div class="container">
         <div class="row">
            <div class="col-md-6">
               <h2 class="fs-5 text-main">Thông tin giao hàng</h2>
               <p>Bạn có tài khoản chưa? <a href="login.html">Đăng nhập</a></p>
               <div class="mb-3">
                  <label for="name">Họ tên</label>
                  <input type="text" name="name" id="name" class="form-control" placeholder="Nhập họ tên">
               </div>
               <div class="mb-3">
                  <label for="phone">Điện thoại</label>
                  <input type="text" name="phone" id="phone" class="form-control" placeholder="Nhập điện thoại">
               </div>
               <div class="card">
                  <div class="card-header text-main">
                     Địa chỉ nhận hàng
                  </div>
                  <div class="card-body">
                     <div class="mb-3">
                        <label for="address">Địa chỉ</label>
                        <input type="text" name="address" id="address" class="form-control" placeholder="Nhập địa chỉ">
                     </div>
                     <div class="row">
                        <div class="col-4">
                           <select name="tinhtp" id="tinhtp" class="form-control">
                              <option value="">Chọn Tỉnh/TP</option>
                           </select>
                        </div>
                        <div class="col-4">
                           <select name="quanhuyen" id="quanhuyen" class="form-control">
                              <option value="">Chọn Quận/Huyện</option>
                           </select>
                        </div>
                        <div class="col-4">
                           <select name="phuongxa" id="phuongxa" class="form-control">
                              <option value="">Chọn Phường/Xã</option>
                           </select>
                        </div>
                     </div>
                  </div>
               </div>
               <h4 class="fs-6 text-main mt-4">Phương thức thanh toán</h4>
               <div class="thanhtoan mb-4">
                  <div class="p-4 border">
                     <input name="typecheckout" onchange="showbankinfo(this.value)" type="radio" value="1"
                        id="check1" />
                     <label for="check1">Thanh toán khi giao hàng</label>
                  </div>
                  <div class="p-4 border">
                     <input name="typecheckout" onchange="showbankinfo(this.value)" type="radio" value="2"
                        id="check2" />
                     <label for="check2">Chuyển khoản qua ngân hàng</label>
                  </div>
                  <div class="p-4 border bankinfo">
                     <p>Ngân Hàng Vietcombank </p>
                     <p>STK: 99999999999999</p>
                     <p>Chủ tài khoản: Hồ Diên Lợi</p>
                  </div>
               </div>
               <div class="text-end">
                  <button type="submit" class="btn btn-main px-4">XÁC NHẬN</button>
               </div>
            </div>
            <script>
               function showbankinfo(value) {
                  var elementbank = document.querySelector(".bankinfo");
                  if (value == 1) {
                     elementbank.style.display = "none";
                  }
                  else {
                     elementbank.style.display = "block";
                  }
               }
            </script>
            <div class="col-md-6">
               <h2 class="fs-5 text-main">Thông tin đơn hàng</h2>
               <table class="table table-borderless">
                  <thead>
                     <tr class="bg-dark">
                        <th style="width:30px;" class="text-center">STT</th>
                        <th style="width:100px;">Hình</th>
                        <th>Tên sản phẩm</th>
                        <th class="text-center">Giá</th>
                        <th style="width:130px" class='text-center'>Số lượng</th>
                        <th class="text-center">Thành tiền</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td class="text-center align-middle">1</td>
                        <td>
                           <img class="img-fluid" src="../public/images/product/thoi-trang-nam-1.jpg" alt="">
                        </td>
                        <td class="align-middle">Tên sản phẩm</td>
                        <td class="text-center align-middle">1000000</td>
                        <td class="text-center align-middle">
                           1
                        </td>
                        <td class="text-center align-middle">
                           12900000
                        </td>
                     </tr>
                     <tr>
                        <td class="text-center align-middle">3</td>
                        <td>
                           <img class="img-fluid" src="../public/images/product/thoi-trang-nam-1.jpg" alt="">
                        </td>
                        <td class="align-middle">Tên sản phẩm</td>
                        <td class="text-center align-middle">1000000</td>
                        <td class="text-center align-middle">
                           1
                        </td>
                        <td class="text-center align-middle">
                           12900000
                        </td>

                     </tr>
                     <tr>
                        <td class="text-center align-middle">3</td>
                        <td>
                           <img class="img-fluid" src="../public/images/product/thoi-trang-nam-1.jpg" alt="">
                        </td>
                        <td class="align-middle">Tên sản phẩm</td>
                        <td class="text-center align-middle">1000000</td>
                        <td class="text-center align-middle">
                           11
                        </td>
                        <td class="text-center align-middle">
                           12900000
                        </td>

                     </tr>
                  </tbody>
                  <tfoot>
                     <tr>
                        <td colspan="6" class="text-end">
                           <strong>Tổng: 199900090</strong>
                        </td>
                     </tr>
                  </tfoot>
               </table>
               <div>
                  <div class="input-group mb-3">
                     <input type="text" class="form-control" placeholder="Mã giảm giá" aria-describedby="basic-addon2">
                     <span class="input-group-text" id="basic-addon2">Sử dụng</span>
                  </div>
               </div>
               <table class="table table-borderless">
                  <tr>
                     <th>Tạm tính</th>
                     <td class="text-end">199900090</td>
                  </tr>
                  <tr>
                     <th>Phí vận chuyển</th>
                     <td class="text-end">0</td>
                  </tr>
                  <tr>
                     <th>Giảm giá</th>
                     <td class="text-end">0</td>
                  </tr>
                  <tr>
                     <th>Tổng cộng</th>
                     <td class="text-end">199900090</td>
                  </tr>
               </table>
            </div>
         </div>
      </div>
   </section>
   <?php require_once 'views/frontend/footer.php'; ?>