@extends('layouts.admin')
@section('title','Quan ly sản phẩm')
@section('content')
      <!-- CONTENT -->
      <div class="content-wrapper">
         <section class="content-header">
            <div class="container-fluid">
               <div class="row mb-2">
                  <div class="col-sm-12">
                     <h1 class="d-inline">Chi tiết sản phẩm</h1>
                  </div>
               </div>
            </div>
         </section>

         <!-- Main content -->
         <section class="content">
            <div class="card">
               <div class="card-header text-right">
                  <a href="{{route('product.index')}}" class="btn btn-sm btn-info">
                     <i class="fa fa-arrow-left" aria-hidden="true"></i>
                     Về danh sách
                  </a>
               </div>
               <div class="card-body p-2">
                  <table class="table table-bordered">
                     <thead>
                        <tr>
                           <th style="width:30%">Tên trường</th>
                           <th>Giá trị</th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{$product->id}}</td>
                        </tr>
                        <tr>
                           <th>Mã loại sản phẩm</th>
                           <td>{{$product->category_id}}</td>
                        </tr>
                        <tr>
                           <th>Mã loại thương hiệu</th>
                           <td>{{$product->brand_id}}</td>
                        </tr>
                        <tr>
                            <th>Tên</th>
                            <td>{{$product->name}}</td>
                        </tr>
                        <tr>
                            <th>Slug</th>
                            <td>{{$product->slug}}</td>
                        </tr>
                        <tr>
                            <th>Hình đại diện</th>
                            <td><img style="with=100px;"src="{{asset('storage/images/product/'.$product->image)}}" alt="{{$product->image}}"></td>
                        </tr>
                        <tr>
                            <th>Từ khóa</th>
                            <td>{{$product->description}}</td>
                        </tr>
                        <tr>
                            <th>Ngày tạo</th>
                            <td>{{$product->created_at}}</td>
                        </tr>
                        <tr>
                            <th>Người tạo</th>
                            <td>{{$product->created_by}}</td>
                        </tr>
                        <tr>
                            <th>Ngày sửa</th>
                            <td>{{$product->updated_at}}</td>
                        </tr>
                        <tr>
                            <th>Người sửa</th>
                            <td>{{$product->updated_by}}</td>
                        </tr>
                        <tr>
                            <th>Trạng thái</th>
                            <td>{{$product->status}}</td>
                        </tr>
                    </tbody>
                  </table>
               </div>
            </div>
         </section>
      </div>
      <!-- END CONTENT-->
@endsection