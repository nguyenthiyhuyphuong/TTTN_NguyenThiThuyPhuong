@extends('layouts.admin')
@section('title','Quản lý slider')
@section('content')
   <form action="{{route('banner.store')}}" enctype="multipart/form-data" method="POST">
      @csrf
      @method('POST')
      <!-- CONTENT -->
      <div class="content-wrapper">
         <section class="content-header">
            <div class="container-fluid">
               <div class="row mb-2">
                  <div class="col-sm-12">
                     <h1 class="d-inline">Tất cả banner</h1>
                     <a href="banner_create.html" class="btn btn-sm btn-primary">Thêm banner</a>
                  </div>
               </div>
            </div>
         </section>
         <!-- Main content -->
         <section class="content">
            <div class="card">
               <div class="card-header">
                  Noi dung
               </div>
               <div class="card-body">
                  <table class="table table-bordered" id="mytable">
                     <thead>
                        <tr>
                           <th class="text-center" style="width:30px;">
                              <input type="checkbox">
                           </th>
                           <th class="text-center" style="width:130px;">Hình ảnh</th>
                           <th>Tên banner</th>
                           <th>Liên kết</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($banner as $item )
                              <tr class="datarow">
                                 <td>
                                    <input type="checkbox">
                                 </td>
                                 <td>
                                    <img class="img-fluid" src="{{asset('storage/images/banner/'.$item->image)}}" alt="{{$item->image}}">
                                 </td>
                                 <td>
                                    <div class="name">
                                       {{$item->name}}
                                    </div>
                                    <div class="function_style">
                                       @if ($item->status==1)
                                       <a class="btn btn-sm btn-success" href="{{route('banner.status',['banner'=>$item->id])}}"><i class="fas fa-toggle-on"></i> Hiện</a>
                                       @else
                                       <a class="btn btn-sm btn-danger" href="{{route('banner.status',['banner'=>$item->id])}}"><i class="fas fa-toggle-off"></i> Ẩn</a>
                                       @endif
                                       <a class="btn btn-sm btn-primary" href="{{route('banner.edit',['banner'=>$item->id])}}"><i class="fas fa-edit"></i> Chỉnh sửa</a>
                                       <a class="btn btn-sm btn-success" href="{{route('banner.show',['banner'=>$item->id])}}"><i class="fas fa-eye"></i> Chi tiết</a>
                                       <a class="btn btn-sm btn-danger" href="{{route('banner.delete',['banner'=>$item->id])}}"><i class="fas fa-trash"></i> Xoá</a>
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