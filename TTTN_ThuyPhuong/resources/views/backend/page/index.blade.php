@extends('layouts.admin')
@section('title','Quản lý trang đơn')
@section('content')
   <form action="{{route('page.store')}}" enctype="multipart/form-data" method="POST">
      @csrf
      @method('POST')
      <!-- CONTENT -->
      <div class="content-wrapper">
         <section class="content-header">
            <div class="container-fluid">
               <div class="row mb-2">
                  <div class="col-sm-12">
                     <h1 class="d-inline">Tất cả trang đơn</h1>
                     <a href="{{route('page.create')}}" class="btn btn-sm btn-primary">Thêm trang đơn</a>
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
                           <th>Tên trang đơn</th>
                           <th>slug</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($page as $item )
                        <tr class="datarow">
                           <td>
                              <input type="checkbox">
                           </td>
                           <td>
                              <img src="{{asset('storage/images/page/'.$item->image)}}" alt="{{$item->image}}">
                           </td>
                           <td>
                              <div class="name">
                                 {{$item->title}}
                              </div>
                              <div class="function_style">
                                 @if ($item->status==1)
                                 <a class="btn btn-sm btn-success" href="{{route('page.status',['page'=>$item->id])}}"><i class="fas fa-toggle-on"></i> Hiện</a>
                                 @else
                                 <a class="btn btn-sm btn-danger" href="{{route('page.status',['page'=>$item->id])}}"><i class="fas fa-toggle-off"></i> Ẩn</a>
                                 @endif
                                 <a class="btn btn-sm btn-primary" href="{{route('page.edit',['page'=>$item->id])}}"><i class="fas fa-edit"></i> Chỉnh sửa</a>
                                 <a class="btn btn-sm btn-success" href="{{route('page.show',['page'=>$item->id])}}"><i class="fas fa-eye"></i> Chi tiết</a>
                                 <a class="btn btn-sm btn-danger" href="{{route('page.delete',['page'=>$item->id])}}"><i class="fas fa-trash"></i> Xoá</a>
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