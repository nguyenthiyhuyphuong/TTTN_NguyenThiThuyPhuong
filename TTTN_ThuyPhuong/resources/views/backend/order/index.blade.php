@extends('layouts.admin')
@section('title','Quản lý đơn hàng')
@section('content')
   <form action="{{route('order.store')}}" enctype="multipart/form-data" method="POST">
      @csrf
      @method('POST')
      <!-- CONTENT -->
      <div class="content-wrapper">
         <section class="content-header">
            <div class="container-fluid">
               <div class="row mb-2">
                  <div class="col-sm-12">
                     <h1 class="d-inline">Tất cả thương hiệu</h1>
                     <a href="brand_create.html" class="btn btn-sm btn-primary">Thêm thương hiêu</a>
                  </div>
               </div>
            </div>
         </section>
         <!-- Main content -->
         <section class="content">
            <div class="card">
               <div class="card-header p-2">
                  Noi dung
               </div>
               <div class="card-body p-2">
                  <table class="table table-bordered">
                     <thead>
                        <tr>
                           <th class="text-center" style="width:30px;">
                              <input type="checkbox">
                           </th>
                           <th class="text-center" style="width:130px;">Hình ảnh</th>
                           <th>Tên thương hiệu</th>
                           <th>Tên slug</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($list_order as $item )
                        <tr class="datarow">
                           <td>
                              <input type="checkbox">
                           </td>
                           <td>
                              <img class="img-fluid" src="{{asset('storage/images/order/'.$item->image)}}" alt="{{$item->image}}">
                           </td>
                           <td>
                              <div class="name">
                                 {{$item->name}}
                              </div>
                              <div class="function_style">
                                 @if ($item->status==1)
                                 <a class="btn btn-sm btn-success" href="{{route('order.status',['order'=>$item->id])}}"><i class="fas fa-toggle-on"></i> Hiện</a>
                                 @else
                                 <a class="btn btn-sm btn-danger" href="{{route('order.status',['order'=>$item->id])}}"><i class="fas fa-toggle-off"></i> Ẩn</a>
                                 @endif
                                 <a class="btn btn-sm btn-primary" href="{{route('order.edit',['order'=>$item->id])}}"><i class="fas fa-edit"></i> Chỉnh sửa</a>
                                 <a class="btn btn-sm btn-success" href="{{route('order.show',['order'=>$item->id])}}"><i class="fas fa-eye"></i> Chi tiết</a>
                                 <a class="btn btn-sm btn-danger" href="{{route('order.delete',['order'=>$item->id])}}"><i class="fas fa-trash"></i> Xoá</a>
                              </div>
                           </td>
                           <td>{{$item->slug}}</td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
            </div>
         </section>
      </div>
      <!-- END CONTENT-->
@endsection