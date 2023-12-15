@extends('layouts.admin')
@section('title','Quản lý danh mục')
@section('content')
   <form action="{{route('category.update',['category'=>$category->id])}}" enctype="multipart/form-data" method="POST">
      @csrf
      @method('PUT')
      <!-- CONTENT -->
      <div class="content-wrapper">
         <section class="content-header">
            <div class="container-fluid">
               <div class="row mb-2">
                  <div class="col-sm-12">
                     <h1 class="d-inline">Cập nhật danh mục</h1>
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
                  <a href="{{route('category.index')}}" class="btn btn-sm btn-info">
                     <i class="fa fa-arrow-left" aria-hidden="true"></i>
                     Về danh sách
                 </a>
               </div>
               <div class="card-body">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="mb-3">
                           <label>Tên danh mục (*)</label>
                           <input type="text" value="{{old('name',$category->name)}}" name="name" class="form-control">
                           @if ($errors->has('name'))
                               <div class="text-danger">{{$errors->first("name")}}</div>
                           @endif
                        </div>
                        <div class="mb-3">
                           <label>Slug</label>
                           <input type="text"value="{{old('slug',$category->slug)}}" name="slug" class="form-control">
                        </div>
                        <div class="mb-3">
                           <label>Danh mục cha (*)</label>
                           <select name="parent_id" class="form-control">
                              <option value="0">None</option>
                              {!!$parent_id_html!!}
                           </select>
                        </div>
                        <div class="mb-3">
                           <label>Mô tả</label>
                           <textarea name="description" class="from-control">{{old('description',$category->description)}}</textarea>
                        </div>
                        <div class="mb-3">
                           <label>Hình đại diện</label>
                           <input type="file" name="image" class="form-control">
                        </div>
                        <div class="mb-3">
                           <label>Trạng thái</label>
                           <select name="status" class="form-control">
                              <option value="1"{{(old('status',$category->status)==1)?'selected':''}}>Xuất bản</option>
                              <option value="2"{{(old('status',$category->status)==2)?'selected':''}}>Chưa xuất bản</option>
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