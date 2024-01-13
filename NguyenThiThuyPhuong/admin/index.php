<?php
session_start(); //khởi động session
//defined('HOTENSV', 'nguyenthithyuphuong');
// if (!isset($_SESSION['useradmin']))
// {
//     header("location:login.php");
// }
//date_default_timezone_set('Asia/Ho_Chi_Minh');
require_once "../vendor/autoload.php";
Route::route_admin();
