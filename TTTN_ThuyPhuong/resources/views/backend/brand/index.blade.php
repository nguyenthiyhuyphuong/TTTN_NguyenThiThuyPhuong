@extends('layouts.admin')
@section('title','Quản lý thương hiệu')
@section('content')
   <form action="{{route('brand.store')}}" enctype="multipart/form-data" method="POST">
      @csrf
      @method('POST')
      <!-- CONTENT -->
      <div class="content-wrapper">
         <section class="content-header">
            <div class="container-fluid">
               <div class="row mb-2">
                  <div class="col-sm-12">
                     <h1 class="d-inline">Tất cả thương hiệu</h1>
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
                        <a class="btn btn-sm btn-info" href="{{route('brand.index')}}">Tất cả ({{$count_all??0}})</a> |
                        <a class="btn btn-sm btn-danger" href="{{route('brand.trash')}}">Thùng rác({{$count_trash??0}})</a>
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
                           <label>Tên thương hiệu (*)</label>
                           <input type="text" value="{{old('name')}}" name="name" class="form-control">
                           @if ($errors->has('name'))
                               <div class="text-danger">{{$errors->first("name")}}</div>
                           @endif
                        </div>
                        <div class="mb-3">
                           <label>Slug</label>
                           <input type="text"value="{{old('slug')}}" name="slug" class="form-control">
                        </div>
                        <div class="mb-3">
                           <label>Mô tả</label>
                           <textarea name="description" class="from-control">{{old('description')}}</textarea>
                        </div>
                        <div class="mb-3">
                           <label>Hình đại diện</label>
                           <input type="file" name="image" class="form-control">
                        </div>
                        <div class="mb-3">
                           <label>Trạng thái</label>
                           <select name="status" class="form-control">
                              <option value="1"{{(old('status')==1)?'selected':''}}>Xuất bản</option>
                              <option value="2"{{(old('status')==2)?'selected':''}}>Chưa xuất bản</option>
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
                                 <th class="text-center" style="width:130px;">Hình ảnh</th>
                                 <th>Tên thương hiệu</th>
                                 <th>Tên slug</th>
                              </tr>
                           </thead>
                           <tbody>
                              @foreach ($brands as $item )
                              <tr class="datarow">
                                 <td>
                                    <input type="checkbox">
                                 </td>
                                 <td>
                                    <img class="img-fluid" src="{{asset('storage/images/brand/'.$item->image)}}" alt="{{$item->image}}">
                                 </td>
                                 <td>
                                    <div class="name">
                                       {{$item->name}}
                                    </div>
                                    <div class="function_style">
                                       @if ($item->status==1)
                                       <a class="btn btn-sm btn-success" href="{{route('brand.status',['brand'=>$item->id])}}"><i class="fas fa-toggle-on"></i> Hiện</a>
                                       @else
                                       <a class="btn btn-sm btn-danger" href="{{route('brand.status',['brand'=>$item->id])}}"><i class="fas fa-toggle-off"></i> Ẩn</a>
                                       @endif
                                       <a class="btn btn-sm btn-primary" href="{{route('brand.edit',['brand'=>$item->id])}}"><i class="fas fa-edit"></i> Chỉnh sửa</a>
                                       <a class="btn btn-sm btn-success" href="{{route('brand.show',['brand'=>$item->id])}}"><i class="fas fa-eye"></i> Chi tiết</a>
                                       <a class="btn btn-sm btn-danger" href="{{route('brand.delete',['brand'=>$item->id])}}"><i class="fas fa-trash"></i> Xoá</a>
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
   </form>
@endsection