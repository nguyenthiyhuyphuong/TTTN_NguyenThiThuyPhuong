@extends('layouts.admin')
@section('title','Quan ly thuong hieu')
@section('content')
   <form action="{{route('brand.update',['brand'=>$brand->id])}}" enctype="multipart/form-data" method="POST">
      @csrf
      @method('PUT')
      <!-- CONTENT -->
      <div class="content-wrapper">
         <section class="content-header">
            <div class="container-fluid">
               <div class="row mb-2">
                  <div class="col-sm-12">
                     <h1 class="d-inline">Cập nhật thương hiệu</h1>
                  </div>
               </div>
            </div>
         </section>
         <!-- Main content -->
         <section class="content">
            <div class="card">
               <div class="card-header text-right">
                  <button class="btn btn-sm btn-success">
                     <i class="fa fa-save" aria-hidden="true"></i>
                     Lưu
                  </button>
                  <a href="{{route('brand.index')}}" class="btn btn-sm btn-info">
                     <i class="fa fa-arrow-left" aria-hidden="true"></i>
                     Về danh sách
                 </a>
               </div>
               <div class="card-body">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="mb-3">
                           <label>Tên thương hiệu (*)</label>
                           <input type="text" value="{{old('name',$brand->name)}}" name="name" class="form-control">
                           @if ($errors->has('name'))
                               <div class="text-danger">{{$errors->first("name")}}</div>
                           @endif
                        </div>
                        <div class="mb-3">
                           <label>Slug</label>
                           <input type="text"value="{{old('slug',$brand->slug)}}" name="slug" class="form-control">
                        </div>
                        <div class="mb-3">
                           <label>Mô tả</label>
                           <textarea name="description" class="from-control">{{old('description',$brand->description)}}</textarea>
                        </div>
                        <div class="mb-3">
                           <label>Hình đại diện</label>
                           <input type="file" name="image" class="form-control">
                        </div>
                        <div class="mb-3">
                           <label>Trạng thái</label>
                           <select name="status" class="form-control">
                              <option value="1"{{(old('status',$brand->status)==1)?'selected':''}}>Xuất bản</option>
                              <option value="2"{{(old('status',$brand->status)==2)?'selected':''}}>Chưa xuất bản</option>
                           </select>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
      </div>
      <!-- END CONTENT-->
   </form>
@endsection