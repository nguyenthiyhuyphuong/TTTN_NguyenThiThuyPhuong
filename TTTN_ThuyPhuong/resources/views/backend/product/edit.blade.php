@extends('layouts.admin')
@section('title','Quan ly sản phẩm')
@section('content')
   <form action="{{route('product.update',['product'=>$product->id])}}" enctype="multipart/form-data" method="POST">
      @csrf
      @method('PUT')
      <!-- CONTENT -->
      <div class="content-wrapper">
         <section class="content-header">
            <div class="container-fluid">
               <div class="row mb-2">
                  <div class="col-sm-12">
                     <h1 class="d-inline">Cập nhật sản phẩm</h1>
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
                  <a href="{{route('product.index')}}" class="btn btn-sm btn-info">
                     <i class="fa fa-arrow-left" aria-hidden="true"></i>
                     Về danh sách
                 </a>
               </div>
               <div class="card-body">
                  <div class="row">
                     <div class="col-md-7">
                        <div class="mb-3">
                           <label>Tên sản phẩm (*)</label>
                           <input type="text" value="{{old('name',$product->name)}}" name="name" class="form-control">
                           @if ($errors->has('name'))
                               <div class="text-danger">{{$errors->first("name")}}</div>
                           @endif
                        </div>
                        <div class="mb-3">
                           <label>Chi tiết</label>
                           <input type="text" value="{{old('name',$product->detail)}}" name="slug" class="form-control">
                       </div>
                        <div class="mb-3">
                           <label>Slug</label>
                           <input type="text"value="{{old('slug',$product->slug)}}" name="slug" class="form-control">
                        </div>
                        <div class="mb-3">
                           <label>Mô tả</label>
                           <textarea name="description" class="from-control">{{old('description',$product->description)}}</textarea>
                        </div>
                        <div class="mb-3">
                           <label>Hình đại diện</label>
                           <input type="file" name="image" class="form-control">
                        </div>
                        
                     </div>
                     <div class="col-md-5">
                        <div class="mb-3">
                           <label>Danh mục (*)</label>
                           <select name="category_id" class="form-control">
                               <option value="">Chọn danh mục</option>
                               {!!$html_category_id!!}
                           </select>
                       </div>
                       <div class="mb-3">
                           <label>Thương hiệu</label>
                           <select name="brand_id" class="form-control">
                               <option value="">Chọn thương hiệu</option>
                               {{!!$html_brand_id!!}}
                           </select>
                       </div>
                       <div class="mb-3">
                           <label>Giá</label>
                           <input type="text" value="{{old('price',$product->price)}}" name="price" class="form-control">
                       </div>
                       <div class="mb-3">
                        <label>Trạng thái</label>
                        <select name="status" class="form-control">
                           <option value="1"{{(old('status',$product->status)==1)?'selected':''}}>Xuất bản</option>
                           <option value="2"{{(old('status',$product->status)==2)?'selected':''}}>Chưa xuất bản</option>
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