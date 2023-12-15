@extends('layouts.admin')
@section('title','Quản lý danh mục')
@section('content')
      <!-- CONTENT -->
      <div class="content-wrapper">
         <section class="content-header">
            <div class="container-fluid">
               <div class="row mb-2">
                  <div class="col-sm-12">
                     <h1 class="d-inline">Chi tiếtthương hiệu</h1>
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
                        
                        <a class="btn btn-sm btn-info" href="{{route('category.index')}}">Tất cả ({{$count_all??0}})</a> |
                        <a class="btn btn-sm btn-danger" href="{{route('category.trash')}}">Thùng rác({{$count_trash??0}})</a>
                     </div>
                     <div class="col-md-6 text-right">
                        <button class="btn btn-sm btn-success" type="submit" name="THEM">
                           <i class="fas fa-save"></i> Lưu
                        </button>
                        <a href="{{route('category.index')}}" class="btn btn-sm btn-info">
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
                                  <td>ID</td>
                                  <td>{{$category->id}}</td>
                              </tr>
                              <tr>
                                  <td>Tên</td>
                                  <td>{{$category->name}}</td>
                              </tr>
                              <tr>
                                  <td>Slug</td>
                                  <td>{{$category->slug}}</td>
                              </tr>
                              <tr>
                                  <td>Hình đại diện</td>
                                  <td><img style="with=100px;"src="{{asset('storage/images/category/'.$category->image)}}" alt="{{$category->image}}"></td>
                              </tr>
                              <tr>
                                  <td>Từ khóa</td>
                                  <td>{{$category->description}}</td>
                              </tr>
                              <tr>
                                  <td>Ngày tạo</td>
                                  <td>{{$category->created_at}}</td>
                              </tr>
                              <tr>
                                  <td>Người tạo</td>
                                  <td>{{$category->created_by}}</td>
                              </tr>
                              <tr>
                                  <td>Ngày sửa</td>
                                  <td>{{$category->updated_at}}</td>
                              </tr>
                              <tr>
                                  <td>Người sửa</td>
                                  <td>{{$category->updated_by}}</td>
                              </tr>
                              <tr>
                                  <td>Trạng thái</td>
                                  <td>{{$category->status}}</td>
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