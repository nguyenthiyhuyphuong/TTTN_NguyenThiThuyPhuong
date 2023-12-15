@extends('layouts.admin')
@section('title','Quản lý bài viết')
@section('content')
<form action="{{route('post.store')}}" enctype="multipart/form-data" method="POST">
   @csrf
   @method('POST')
      <!-- CONTENT -->
      <div class="content-wrapper">
         <section class="content-header">
            <div class="container-fluid">
               <div class="row mb-2">
                  <div class="col-sm-12">
                     <h1 class="d-inline">Tất cả bài viết</h1>
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
                        <a href="{{route('post.create')}}" class="btn btn-sm btn-primary">Thêm bài viết</a>
                     </div>
                  </div>
               </div>
               <div class="card-body p-2">
                  <table class="table table-bordered">
                     <thead>
                        <tr>
                           <th class="text-center" style="width:30px;">
                              <input type="checkbox">
                           </th>
                           <th class="text-center" style="width:130px;">Hình ảnh</th>
                           <th>Tiêu đề bài viết</th>
                           <th>Slug</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($post as $item )
                        <tr class="datarow">
                           <td>
                              <input type="checkbox">
                           </td>
                           <td>
                              <img class="img-fluid" src="{{asset('storage/images/post/'.$item->image)}}" alt="{{$item->image}}">
                           </td>
                           <td>
                              <div class="name">
                                 {{$item->title}}
                              </div>
                              <div class="function_style">
                                 @if ($item->status==1)
                                 <a class="btn btn-sm btn-success" href="{{route('post.status',['post'=>$item->id])}}"><i class="fas fa-toggle-on"></i> Hiện</a>
                                 @else
                                 <a class="btn btn-sm btn-danger" href="{{route('post.status',['post'=>$item->id])}}"><i class="fas fa-toggle-off"></i> Ẩn</a>
                                 @endif
                                 <a class="btn btn-sm btn-primary" href="{{route('post.edit',['post'=>$item->id])}}"><i class="fas fa-edit"></i> Chỉnh sửa</a>
                                 <a class="btn btn-sm btn-success" href="{{route('post.show',['post'=>$item->id])}}"><i class="fas fa-eye"></i> Chi tiết</a>
                                 <a class="btn btn-sm btn-danger" href="{{route('post.delete',['post'=>$item->id])}}"><i class="fas fa-trash"></i> Xoá</a>
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
</form>
@endsection 