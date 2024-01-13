<?php

use App\Models\Post;
use App\Libraries\MyClass;
use App\Libraries\Upload;

if (isset($_POST['THEM'])) {
    $page = new Post();
    //Lay tu from
    $page->title = $_POST['title'];
    $page->slug = (strlen($_POST['slug']) > 0) ? $_POST['slug'] : MyClass::str_slug($_POST['name']);
    $page->detail = $_POST['detail'];
    $page->status = $_POST['status'];
    $page->type = 'page';
    $page->created_at = date('Y-m-d H:i:s');
    $page->created_by = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : 1;
    //XU ly upload file
    if (strlen($_FILES['image']['name']) > 0) {
        $target_dir = "../public/images/page/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $extension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
            $filename = $page->slug . '.' . $extension;
            move_uploaded_file($_FILES['image']['tmp_name'], $target_dir . $filename);
            $page->image = $filename;
        }
    }
    //Tu sinh ra 
    var_dump($page);
    //Luu vao CSDL
    //INSERT INTO page 
    $page->save();
    //Chuyển hướng về index
    MyClass::set_flash('message', ['msg' => 'Thêm thành công', 'type' => 'success']);
    //$_SESSION['message']="";
    header("location:index.php?option=page&cat=create");
}

if (isset($_POST['CAPNHAT'])) {
    $id = $_POST['id'];
    $page = Post::find($id);
    if ($page == null) {
        MyClass::set_flash('message', ['msg' => 'Lỗi trang 404', 'type' => 'danger']);
        header("location:index.php?option=page");
    }
    //Lấy từ form
    $page->title = $_POST['title'];
    $page->slug = (strlen($_POST['slug']) > 0) ? $_POST['slug'] : MyClass::str_slug(($_POST['name']));
    $page->detail = $_POST['detail'];
    $page->status = $_POST['status'];
    $page->type = 'page';
    $page->description = $_POST['description'];
    $page->created_at = date('Y-m-d H:i:s');
    $page->created_by = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : 1;
    //Xử lý upload file
    if (strlen($_FILES['image']['name']) > 0) {
        //Xóa hình cũ
        Upload::deleteFile(['path_dir'=>'../public/images/page/','file'=>$page->image]);
        //Thêm hình mới
        $target_dir = "../public/images/page/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $extension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
            $filename = $page->slug . '.' . $extension;
            move_uploaded_file($_FILES['image']['tmp_name'], $target_dir . $filename);
            $page->image = $filename;
        }
    }
    //Tự sinh ra
    $page->updated_at = date('Y-m-d H:i:s');
    $page->updated_by = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : 1;
    var_dump($page);
    //Lưu vào CSDL
    //INSERT INTO page
    $page->save();
    //Chuyển hướng về index
    MyClass::set_flash('message', ['msg' => 'Cập nhật thành công', 'type' => 'success']);
    header("location:index.php?option=page");
}
//Xóa nhiều mẫu tin vào thùng rác
if (isset($_POST['DELETE_ALL'])) {
    $list=$_POST['checkId'];
    foreach($list as $id)
    {
        $post=Post::find($id);
        $post->status=0;
        $post->save();
    }
    MyClass::set_flash('message', ['msg' => 'Xóa vào thùng rác thành công', 'type' => 'success']);
    header("location:index.php?option=page");
}
//Xóa nhiều mẫu tin khỏi CSDL
if (isset($_POST['DESTROY_ALL'])) {
    $list=$_POST['checkId'];
    foreach($list as $id)
    {
        $post=Post::find($id);
        $post->delete();
    }
    MyClass::set_flash('message', ['msg' => 'Xóa khỏi CSDL thành công', 'type' => 'success']);
    header("location:index.php?option=page&cat=trash");
}
