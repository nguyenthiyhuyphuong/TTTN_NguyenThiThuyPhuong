@extends('layouts.admin')
@section('title','Quản lý bài viết')
@section('content')
      <!-- CONTENT -->
      <div class="content-wrapper">
         <section class="content-header">
            <div class="container-fluid">
               <div class="row mb-2">
                  <div class="col-sm-12">
                     <h1 class="d-inline">Chi tiết bài viết</h1>
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
                        
                        <a class="btn btn-sm btn-info" href="{{route('post.index')}}">Tất cả ({{$count_all??0}})</a> |
                        <a class="btn btn-sm btn-danger" href="{{route('post.trash')}}">Thùng rác({{$count_trash??0}})</a>
                     </div>
                     <div class="col-md-6 text-right">
                        <button class="btn btn-sm btn-success" type="submit" name="THEM">
                           <i class="fas fa-save"></i> Lưu
                        </button>
                        <a href="{{route('post.index')}}" class="btn btn-sm btn-info">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i>
                            Về danh sách
                        </a>
                     </div>
                  </div>
               </div>
               <div class="card-body">
                  <div class="row">
                     <div class="col-md-12">
                        <table class="table table-bordered">
                           <thead>
                              <tr>
                                  <th>Tên trường</th>
                                  <th>Giá trị</th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr>
                                  <th>ID</th>
                                  <td>{{$post->id}}</td>
                              </tr>
                              <tr>
                                  <th>Tiêu đề bài viết</th>
                                  <td>{{$post->title}}</td>
                              </tr>
                              <tr>
                                  <th>Slug</th>
                                  <td>{{$post->slug}}</td>
                              </tr>
                              <tr>
                                  <th>Từ khóa</th>
                                  <td>{{$post->description}}</td>
                              </tr>
                              <tr>
                                 <th>Kiểu</th>
                                 <td>{{$post->type}}</td>
                             </tr>
                              <tr>
                                  <th>Ngày tạo</th>
                                  <td>{{$post->created_at}}</td>
                              </tr>
                              <tr>
                                  <th>Người tạo</th>
                                  <td>{{$post->created_by}}</td>
                              </tr>
                              <tr>
                                  <th>Ngày sửa</th>
                                  <td>{{$post->updated_at}}</td>
                              </tr>
                              <tr>
                                  <th>Người sửa</th>
                                  <td>{{$post->updated_by}}</td>
                              </tr>
                              <tr>
                                  <th>Trạng thái</th>
                                  <td>{{$post->status}}</td>
                              </tr>
                          </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </section>
      </div>
      <!-- END CONTENT-->
@endsection