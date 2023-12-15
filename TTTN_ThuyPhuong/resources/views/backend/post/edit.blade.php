@extends('layouts.admin')
@section('title','Quản lý Bài viết')
@section('content')
   <form action="{{route('post.update',['post'=>$post->id])}}" enctype="multipart/form-data" method="POST">
      @csrf
      @method('PUT')
      <!-- CONTENT -->
      <div class="content-wrapper">
         <section class="content-header">
            <div class="container-fluid">
               <div class="row mb-2">
                  <div class="col-sm-12">
                     <h1 class="d-inline">Cập nhật bài viết</h1>
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
                  <a href="{{route('post.index')}}" class="btn btn-sm btn-info">
                     <i class="fa fa-arrow-left" aria-hidden="true"></i>
                     Về danh sách
                 </a>
               </div>
               <div class="card-body">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="mb-3">
                           <label>Tiêu  đề bài viết (*)</label>
                           <input type="text" value="{{old('title',$post->title)}}" name="title" class="form-control">
                           @if ($errors->has('name'))
                               <div class="text-danger">{{$errors->first("title")}}</div>
                           @endif
                        </div>
                        <div class="mb-3">
                           <label>Slug</label>
                           <input type="text"value="{{old('slug',$post->slug)}}" name="slug" class="form-control">
                        </div>
                        <div class="mb-3">
                           <label>Mô tả</label>
                           <textarea name="description" class="from-control">{{old('description',$post->description)}}</textarea>
                        </div>
                        <div class="mb-3">
                           <label>Hình đại diện</label>
                           <input type="file" name="image" class="form-control">
                        </div>
                        <div class="mb-3">
                           <label>Trạng thái</label>
                           <select name="status" class="form-control">
                              <option value="1"{{(old('status',$post->status)==1)?'selected':''}}>Xuất bản</option>
                              <option value="2"{{(old('status',$post->status)==2)?'selected':''}}>Chưa xuất bản</option>
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