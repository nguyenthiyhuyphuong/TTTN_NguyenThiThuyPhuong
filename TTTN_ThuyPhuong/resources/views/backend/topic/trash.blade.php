@extends('layouts.admin')
@section('title','Quản lý chủ đề')
@section('content')
      <!-- CONTENT -->
      <div class="content-wrapper">
         <section class="content-header">
            <div class="container-fluid">
               <div class="row mb-2">
                  <div class="col-sm-12">
                     <h1 class="d-inline">Thùng rác chủ đề</h1>
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
                                 <th class="text-center" style="width:30px;">
                                    <input type="checkbox">
                                 </th>
                                 <th class="text-center" style="width:130px;">Hình ảnh</th>
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
                                    <img class="img-fluid" src="{{asset('storage/images/topic/'.$item->image)}}" alt="{{$item->image}}">
                                 </td>
                                 <td>
                                    <div class="function_style">
                                       <a class="btn btn-sm btn-primary" href="{{route('topic.restore',['topic'=>$item->id])}}"><i class="fas fa-trash-restore"></i> Khôi phục</a>
                                       <form action="{{route('topic.destroy',['topic'=>$item->id])}}" method="post" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Xoá vĩnh viễn</button>
                                       </form>
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
      <!-- END CONTENT-->
@endsection