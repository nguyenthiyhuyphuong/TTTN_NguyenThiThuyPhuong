@extends('layouts.admin')
@section('title','Quản lý sản phẩm')
@section('content')
<!-- CONTENT -->
<form action="{{route('product.store')}}" enctype="multipart/form-data" method="POST">
   @csrf
         @method('POST')
         <div class="content-wrapper">
            <section class="content-header">
               <div class="container-fluid">
                  <div class="row mb-2">
                     <div class="col-sm-12">
                        <h1 class="d-inline">Tất cả sản phẩm</h1>
                        <a href="{{route('product.create')}}" class="btn btn-sm btn-primary">Thêm sản phẩm</a>
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
                           <a class="btn btn-sm btn-info" href="{{route('product.index')}}">Tất cả ({{$count_all??0}})</a> |
                           <a class="btn btn-sm btn-danger" href="{{route('product.trash')}}">Thùng rác({{$count_trash??0}})</a>
                        </div>
                        <div class="col-md-6 text-right">
                           <select name="" id="" class="form-control d-inline" style="width:100px;">
                              <option value="">Xoá</option>
                           </select>
                           <button class="btn btn-sm btn-success">Áp dụng</button>
                        </div>
                     </div>
                     
                  </div>
                  <div class="card-body">
                     @if (session('message'))
                        @php
                        $message=session('message');
                     @endphp
                     <div class="alert alert-{{ $message['type'] }}">
                        {{ $message['mgs'] }}
                        </div>
                        @endif
                     <table class="table table-bordered" id="mytable">
                        <thead>
                           <tr>
                              <th class="text-center" style="width:30px;">
                                 <input type="checkbox">
                              </th>
                              <th class="text-center" style="width:130px;">Hình ảnh</th>
                              <th>Tên sản phẩm</th>
                              <th>Tên danh mục</th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach ($product as $item )
                           <tr class="datarow">
                              <td>
                                 <input type="checkbox">
                              </td>
                              <td>
                                 <img class="img-fluid" src="{{asset('storage/images/product/'.$item->image)}}" alt="{{$item->image}}">
                              </td>
                              <td>
                                 <div class="name">
                                    {{$item->name}}
                                 </div>
                                 <div class="function_style">
                                    @if ($item->status==1)
                                    <a class="btn btn-sm btn-success" href="{{route('product.status',['product'=>$item->id])}}"><i class="fas fa-toggle-on"></i> Hiện</a>
                                    @else
                                    <a class="btn btn-sm btn-danger" href="{{route('product.status',['product'=>$item->id])}}"><i class="fas fa-toggle-off"></i> Ẩn</a>
                                    @endif
                                    <a class="btn btn-sm btn-primary" href="{{route('product.edit',['product'=>$item->id])}}"><i class="fas fa-edit"></i> Chỉnh sửa</a>
                                    <a class="btn btn-sm btn-success" href="{{route('product.show',['product'=>$item->id])}}"><i class="fas fa-eye"></i> Chi tiết</a>
                                    <a class="btn btn-sm btn-danger" href="{{route('product.delete',['product'=>$item->id])}}"><i class="fas fa-trash"></i> Xoá</a>
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
</form>
<!-- END CONTENT-->
@endsection