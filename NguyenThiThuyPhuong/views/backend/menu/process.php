<?php

use App\Models\Menu;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Post;
use App\Models\Topic;
use App\Libraries\MyClass;

if (isset($_POST['ADDCATEGORY'])) {
    $listid = $_POST['categoryID'];
    foreach ($listid as $id) {
        $category = Category::find($id);
        $menu = new Menu();
        //Lay tu from
        $menu->name = $category->name;
        $menu->link = 'index.php?option=product&cat=' . $category->lug;
        $menu->type = 'category';
        $menu->table_id = $category->id;
        $menu->sort_order = 1;
        $menu->status = 2;
        $menu->parent_id = 0;
        $menu->created_at = date('Y-m-d H:i:s');
        $menu->created_by =1;
        $menu->save();
    }
    MyClass::set_flash('message', ['msg' => 'Thêm thành công', 'type' => 'success']);
    header("location:index.php?option=menu");
}
if (isset($_POST['ADDBRAND'])) {
    $listid = $_POST['brandID'];
    foreach ($listid as $id) {
        $brand = Brand::find($id);
        $menu = new Menu();
        //Lay tu from
        $menu->name = $brand->name;
        $menu->link = 'index.php?option=brand&=cat' . $category->lug;
        $menu->type = 'brand';
        $menu->table_id = $brand->id;
        $menu->sort_order = 1;
        $menu->status = 2;
        $menu->parent_id = 0;
        $menu->created_at = date('Y-m-d H:i:s');
        $menu->created_by =1;
        $menu->save();
    }
    MyClass::set_flash('message', ['msg' => 'Thêm thành công', 'type' => 'success']);
    header("location:index.php?option=menu");
}
if (isset($_POST['ADDTOPIC'])) {
    echo "ADDTOPIC";
}
if (isset($_POST['ADDPAGE'])) {
    echo "ADDPAGE";
}
if (isset($_POST['ADDCUSTOM'])) {

    echo "ADDCUSTOM";
}

// if (isset($_POST['CAPNHAT'])) {
//     $id = $_POST['id'];
//     $menu = Menu::find($id);
//     if ($menu == null) {
//         MyClass::set_flash('message', ['msg' => 'Lỗi trang 404', 'type' => 'danger']);
//         header("location:index.php?option=menu");
//     }
//     //Lấy từ form
//     $menu->name = $_POST['name'];
//     $menu->slug = (strlen($_POST['slug']) > 0) ? $_POST['slug'] : MyClass::str_slug(($_POST['name']));
//     $menu->description = $_POST['description'];
//     $menu->status = $_POST['status'];
//     //Xử lý upload file
//     if (strlen($_FILES['image']['name'])) {
//         //Xóa hình cũ


//         //Thêm hình mới
//         $target_dir = "public/images/menu/";
//         $target_file = $target_dir . basename($_FILES["image"]["name"]);
//         $extension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
//         if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
//             $filename = $menu->slug . '.' . $extension;
//             move_uploaded_file($_FILES['image']['tmp_name'], $target_dir . $filename);
//             $menu->image = $filename;
//         }
//     }
//     //Tự sinh ra
//     $menu->updated_at = date('Y-m-d H:i:s');
//     $menu->updated_by = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : 1;
//     var_dump($menu);
//     //Lưu vào CSDL
//     //INSERT INTO menu
//     $menu->save();
//     //Chuyển hướng về index
//     MyClass::set_flash('message', ['msg' => 'Cập nhật thành công', 'type' => 'success']);
//     header("location:index.php?option=menu");
// }
