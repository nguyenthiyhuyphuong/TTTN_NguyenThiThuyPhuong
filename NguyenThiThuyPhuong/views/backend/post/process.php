<?php

use App\Models\Post;
use App\Libraries\MyClass;
use App\Libraries\Upload;

if (isset($_POST['THEM'])) {
    $post = new Post();
    //Lay tu from
    $post->title = $_POST['title'];
    $post->slug = (strlen($_POST['slug']) > 0) ? $_POST['slug'] : MyClass::str_slug($_POST['name']);
    $post->topic_id = $_POST['topic_id'];
    $post->detail = $_POST['detail'];
    $post->status = $_POST['status'];
    $post->type = 'post';
    $post->description = $_POST['description'];
    $post->created_at = date('Y-m-d H:i:s');
    $post->created_by = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : 1;
    //XU ly upload file
    if (strlen($_FILES['image']['name']) > 0) {
        $target_dir = "../public/images/post/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $extension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
            $filename = $post->slug . '.' . $extension;
            move_uploaded_file($_FILES['image']['tmp_name'], $target_dir . $filename);
            $post->image = $filename;
        }
    }
    //Tu sinh ra 
    var_dump($post);
    //Luu vao CSDL
    //INSERT INTO post 
    $post->save();
    //Chuyển hướng về index
    MyClass::set_flash('message', ['msg' => 'Thêm thành công', 'type' => 'success']);
    //$_SESSION['message']="";
    header("location:index.php?option=post&cat=create");
}

if (isset($_POST['CAPNHAT'])) {
    $id = $_POST['id'];
    $post = Post::find($id);
    if ($post == null) {
        MyClass::set_flash('message', ['msg' => 'Lỗi trang 404', 'type' => 'danger']);
        header("location:index.php?option=post");
    }
    //Lấy từ form
    $post->title = $_POST['title'];
    $post->slug = (strlen($_POST['slug']) > 0) ? $_POST['slug'] : MyClass::str_slug(($_POST['name']));
    $post->topic_id = $_POST['topic_id'];
    $post->detail = $_POST['detail'];
    $post->status = $_POST['status'];
    $post->type = 'post';
    $post->description = $_POST['description'];
    $post->created_at = date('Y-m-d H:i:s');
    $post->created_by = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : 1;
    //Xử lý upload file
    if (strlen($_FILES['image']['name']) > 0) {
        //Xóa hình cũ
        Upload::deleteFile(['path_dir'=>'../public/images/post/','file'=>$post->image]);
        //Thêm hình mới
        $target_dir = "../public/images/post/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $extension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
            $filename = $post->slug . '.' . $extension;
            move_uploaded_file($_FILES['image']['tmp_name'], $target_dir . $filename);
            $post->image = $filename;
        }
    }
    //Tự sinh ra
    $post->updated_at = date('Y-m-d H:i:s');
    $post->updated_by = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : 1;
    var_dump($post);
    //Lưu vào CSDL
    //INSERT INTO post
    $post->save();
    //Chuyển hướng về index
    MyClass::set_flash('message', ['msg' => 'Cập nhật thành công', 'type' => 'success']);
    header("location:index.php?option=post");
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
    header("location:index.php?option=post");
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
    header("location:index.php?option=post&cat=trash");
}
