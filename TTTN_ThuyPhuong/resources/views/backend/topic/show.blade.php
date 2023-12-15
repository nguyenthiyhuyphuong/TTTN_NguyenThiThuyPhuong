@extends('layouts.admin')
@section('title','Quản lý chủ đề')
@section('content')
      <!-- CONTENT -->
      <div class="content-wrapper">
         <section class="content-header">
            <div class="container-fluid">
               <div class="row mb-2">
                  <div class="col-sm-12">
                     <h1 class="d-inline">Chi tiết chủ đề</h1>
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
                        
                        <a class="btn btn-sm btn-info" href="{{route('topic.index')}}">Tất cả ({{$count_all??0}})</a> |
                        <a class="btn btn-sm btn-danger" href="{{route('topic.trash')}}">Thùng rác({{$count_trash??0}})</a>
                     </div>
                     <div class="col-md-6 text-right">
                        <button class="btn btn-sm btn-success" type="submit" name="THEM">
                           <i class="fas fa-save"></i> Lưu
                        </button>
                        <a href="{{route('topic.index')}}" class="btn btn-sm btn-info">
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
                                  <td>{{$topic->id}}</td>
                              </tr>
                              <tr>
                                  <th>Tên</th>
                                  <td>{{$topic->name}}</td>
                              </tr>
                              <tr>
                                  <th>Slug</th>
                                  <td>{{$topic->slug}}</td>
                              </tr>
                              <tr>
                                  <th>Từ khóa</th>
                                  <td>{{$topic->description}}</td>
                              </tr>
                              <tr>
                                  <th>Ngày tạo</th>
                                  <td>{{$topic->created_at}}</td>
                              </tr>
                              <tr>
                                  <th>Người tạo</th>
                                  <td>{{$topic->created_by}}</td>
                              </tr>
                              <tr>
                                  <th>Ngày sửa</th>
                                  <td>{{$topic->updated_at}}</td>
                              </tr>
                              <tr>
                                  <th>Người sửa</th>
                                  <td>{{$topic->updated_by}}</td>
                              </tr>
                              <tr>
                                  <th>Trạng thái</th>
                                  <td>{{$topic->status}}</td>
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