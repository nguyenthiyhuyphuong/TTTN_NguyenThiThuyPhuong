@extends('layouts.admin')
@section('title','Quản lý chủ đề')
@section('content')
<form action="{{route('topic.store')}}" enctype="multipart/form-data" method="POST">
   @csrf
   @method('POST')
      <!-- CONTENT -->
      <div class="content-wrapper">
         <section class="content-header">
            <div class="container-fluid">
               <div class="row mb-2">
                  <div class="col-sm-12">
                     <h1 class="d-inline">Tất cả chủ đề</h1>
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
                     </div>
                  </div>
               </div>
               <div class="card-body">
                  <div class="row">
                     <div class="col-md-4">
                        <div class="mb-3">
                           <label>Tên chủ đề (*)</label>
                           <input type="text" name="name" class="form-control">
                        </div>
                        <div class="mb-3">
                           <label>Slug</label>
                           <input type="text" name="slug" class="form-control">
                        </div>
                        <div class="mb-3">
                           <label>Trạng thái</label>
                           <select name="status" class="form-control">
                              <option value="1">Xuất bản</option>
                              <option value="2">Chưa xuất bản</option>
                           </select>
                        </div>
                     </div>
                     <div class="col-md-8">
                        <table class="table table-bordered">
                           <thead>
                              <tr>
                                 <th class="text-center" style="width:30px;">
                                    <input type="checkbox">
                                 </th>
                                 <th>Tên chủ đề</th>
                                 <th>Tên slug</th>
                              </tr>
                           </thead>
                           <tbody>
                              @foreach ($topic as $item )
                              <tr class="datarow">
                                 <td>
                                    <input type="checkbox">
                                 </td>
                                 <td>
                                    <div class="name">
                                       {{$item->name}}
                                    </div>
                                    <div class="function_style">
                                       @if ($item->status==1)
                                       <a class="btn btn-sm btn-success" href="{{route('topic.status',['topic'=>$item->id])}}"><i class="fas fa-toggle-on"></i> Hiện</a>
                                       @else
                                       <a class="btn btn-sm btn-danger" href="{{route('topic.status',['topic'=>$item->id])}}"><i class="fas fa-toggle-off"></i> Ẩn</a>
                                       @endif
                                       <a class="btn btn-sm btn-primary" href="{{route('topic.edit',['topic'=>$item->id])}}"><i class="fas fa-edit"></i> Chỉnh sửa</a>
                                       <a class="btn btn-sm btn-success" href="{{route('topic.show',['topic'=>$item->id])}}"><i class="fas fa-eye"></i> Chi tiết</a>
                                       <a class="btn btn-sm btn-danger" href="{{route('topic.delete',['topic'=>$item->id])}}"><i class="fas fa-trash"></i> Xoá</a>
                                    </div>
                                 </td>
                                 <td>{{$item->slug}}</td>
                              </tr>
                              @endforeach
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </section>
      </div>
</form>
      <!-- END CONTENT-->
      @endsection