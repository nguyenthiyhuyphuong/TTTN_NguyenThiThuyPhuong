<?php

use App\Models\Product;
use App\Libraries\MyClass;
use App\Libraries\Upload;

if (isset($_POST['THEM'])) {
    $product = new Product();
    $product->name = $_POST['name'];
    $product->slug = (strlen($_POST['slug']) > 0) ? $_POST['slug'] :  MyClass::str_slug($_POST['name']);
    $product->detail = $_POST['detail'];
    $product->category_id = $_POST['category_id'];
    $product->brand_id = $_POST['brand_id'];
    $product->price = $_POST['price'];
    $product->pricesale = $_POST['pricesale'];
    $product->qty = $_POST['qty'];
    $product->status = $_POST['status'];
    $product->created_at = date('Y-m-d H:i:s');
    $product->created_by = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : 1;
    //XU ly upload file
    if (strlen($_FILES['image']['name']) > 0) {
        $target_dir = "../public/images/product/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $extension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
            $filename = $product->slug . '.' . $extension;
            move_uploaded_file($_FILES['image']['tmp_name'], $target_dir . $filename);
            $product->image = $filename;
        }
    }
    var_dump($product);
    $product->save();
    MyClass::set_flash('message', ['msg' => 'Thêm thành công', 'type' => 'success']);
    header("location:index.php?option=product");
}

if (isset($_POST['CAPNHAT'])) {
    $id = $_POST['id'];
    $product = Product::find($id);
    if ($product == null) {
        MyClass::set_flash('message', ['msg' => 'Lỗi trang 404', 'type' => 'danger']);
        header("location:index.php?option=product");
    }
    //Lấy từ form
    $product->name = $_POST['name'];
    $product->slug = (strlen($_POST['slug']) > 0) ? $_POST['slug'] : MyClass::str_slug(($_POST['name']));
    $product->description = $_POST['description'];
    $product->status = $_POST['status'];
    //Xử lý upload file
    if (strlen($_FILES['image']['name']) > 0) {
        //Xóa hình cũ


        //Thêm hình mới
        $target_dir = "../public/images/product/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $extension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
            $filename = $product->slug . '.' . $extension;
            move_uploaded_file($_FILES['image']['tmp_name'], $target_dir . $filename);
            $product->image = $filename;
        }
    }
    //Tự sinh ra
    $product->updated_at = date('Y-m-d H:i:s');
    $product->updated_by = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : 1;
    var_dump($product);
    //Lưu vào CSDL
    //INSERT INTO product
    $product->save();
    //Chuyển hướng về index
    MyClass::set_flash('message', ['msg' => 'Cập nhật thành công', 'type' => 'success']);
    header("location:index.php?option=product");
}
//Xóa nhiều mẫu tin vào thuhngf rác
if (isset($_POST['DELETE_ALL'])) {
    $list = $_POST['checkId'];
    foreach ($list as $id) {
        $product = Product::find($id);
        $product->status = 0;
        $product->save();
    }
    MyClass::set_flash('message', ['msg' => 'Xóa vào thùng rác thành công', 'type' => 'success']);
    header("location:index.php?option=product");
}
//Xóa nhiều mẫu tin khỏi CSDL
if (isset($_POST['DESTROY_ALL'])) {
    $list = $_POST['checkId'];
    foreach ($list as $id) {
        $product = Product::find($id);
        $product->delete();
    }
    MyClass::set_flash('message', ['msg' => 'Xóa khỏi CSDL thành công', 'type' => 'success']);
    header("location:index.php?option=product&cat=trash");
}
