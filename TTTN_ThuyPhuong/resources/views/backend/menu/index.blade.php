@extends('layouts.admin')
@section('title','Quản lý menu')
@section('content')
   <form action="{{route('menu.store')}}" enctype="multipart/form-data" method="POST">
      @csrf
      @method('POST')
      <!-- CONTENT -->
      <div class="content-wrapper">
         <section class="content-header">
            <div class="container-fluid">
               <div class="row mb-2">
                  <div class="col-sm-12">
                     <h1 class="d-inline">Tất cả menu</h1>
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
                        <a class="btn btn-sm btn-info" href="{{route('menu.index')}}">Tất cả ({{$count_all??0}})</a> |
                        <a class="btn btn-sm btn-danger" href="{{route('menu.trash')}}">Thùng rác({{$count_trash??0}})</a>
                     </div>
                     <div class="col-md-6 text-right">
                        <button class="btn btn-sm btn-success" type="submit" name="THEM">
                           <i class="fas fa-save"></i> Lưu
                        </button>
                     </div>
                  </div>
               </div>
               <div class="card-body p-2">
                  <div class="row">
                     <div class="col-md-3">
                        <div class="accordion" id="accordionExample">
                           <div class="card mb-0 p-3">
                              <select name="postion" class="form-control">
                                 <option value="mainmenu">Main Menu</option>
                                 <option value="footermenu">Footer Menu</option>
                              </select>
                           </div>
                           <div class="card mb-0">
                              <div class="card-header" id="headingCategory">
                                 <strong data-toggle="collapse" data-target="#collapseCategory" aria-expanded="true"
                                    aria-controls="collapseCategory">
                                    Danh mục sản phẩm
                                 </strong>
                              </div>
                              <div id="collapseCategory" class="collapse" aria-labelledby="headingCategory"
                                 data-parent="#accordionExample">
                                 <div class="card-body p-3">
                                    <div class="form-check">
                                       <input name="categoryId[]" class="form-check-input" type="checkbox" value=""
                                          id="categoryId">
                                       <label class="form-check-label" for="categoryId">
                                          Default checkbox
                                       </label>
                                    </div>
                                    <div class="my-3">
                                       <button name="ADDCATEGORY" class="btn btn-sm btn-success form-control">Thêm</button>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="card mb-0">
                              <div class="card-header" id="headingBrand">
                                 <strong data-toggle="collapse" data-target="#collapseBrand" aria-expanded="true"
                                    aria-controls="collapseBrand">
                                    Thương hiệu
                                 </strong>
                              </div>
                              <div id="collapseBrand" class="collapse" aria-labelledby="headingBrand"
                                 data-parent="#accordionExample">
                                 <div class="card-body p-3">
                                    <div class="form-check">
                                       <input name="BrandId[]" class="form-check-input" type="checkbox" value=""
                                          id="BrandId">
                                       <label class="form-check-label" for="BrandId">
                                          Default checkbox
                                       </label>
                                    </div>
                                    <div class="my-3">
                                       <button name="ADDBRAND" class="btn btn-sm btn-success form-control">Thêm</button>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="card mb-0">
                              <div class="card-header" id="headingTopic">
                                 <strong data-toggle="collapse" data-target="#collapseTopic" aria-expanded="true"
                                    aria-controls="collapseTopic">
                                    Chủ đề bài viết
                                 </strong>
                              </div>
                              <div id="collapseTopic" class="collapse" aria-labelledby="headingTopic"
                                 data-parent="#accordionExample">
                                 <div class="card-body p-3">
                                    <div class="form-check">
                                       <input name="TopicId[]" class="form-check-input" type="checkbox" value=""
                                          id="TopicId">
                                       <label class="form-check-label" for="TopicId">
                                          Default checkbox
                                       </label>
                                    </div>
                                    <div class="my-3">
                                       <button name="ADDTOPIC" class="btn btn-sm btn-success form-control">Thêm</button>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="card mb-0">
                              <div class="card-header" id="headingPage">
                                 <strong data-toggle="collapse" data-target="#collapsePage" aria-expanded="true"
                                    aria-controls="collapsePage">
                                   Trang đơn
                                 </strong>
                              </div>
                              <div id="collapsePage" class="collapse" aria-labelledby="headingPage"
                                 data-parent="#accordionExample">
                                 <div class="card-body p-3">
                                    <div class="form-check">
                                       <input name="PageId[]" class="form-check-input" type="checkbox" value=""
                                          id="PageId">
                                       <label class="form-check-label" for="PageId">
                                          Default checkbox
                                       </label>
                                    </div>
                                    <div class="my-3">
                                       <button name="ADDPAGE" class="btn btn-sm btn-success form-control">Thêm</button>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="card mb-0">
                              <div class="card-header" id="headingCustom">
                                 <strong data-toggle="collapse" data-target="#collapseCustom" aria-expanded="true"
                                    aria-controls="collapseCustom">
                                    Tuỳ liên kết
                                 </strong>
                              </div>
                              <div id="collapseCustom" class="collapse" aria-labelledby="headingCustom"
                                 data-parent="#accordionExample">
                                 <div class="card-body p-3">
                                    <div class="mb-3">
                                       <label>Tên menu</label>
                                       <input type="text" name="name" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                       <label>Liên kết</label>
                                       <input type="text" name="link" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                       <button name="ADDCUSTOM" class="btn btn-sm btn-success form-control">Thêm</button>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-9">
                        <table class="table table-bordered">
                           <thead>
                              <tr>
                                 <th class="text-center" style="width:30px;">
                                    <input type="checkbox">
                                 </th>
                                 <th>Tên menu</th>
                                 <th>Liên kết</th>
                                 <th>Vị trí</th>
                              </tr>
                           </thead>
                           <tbody>
                              @foreach ($list_menu as $item )
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
                                       <a class="btn btn-sm btn-success" href="{{route('menu.status',['menu'=>$item->id])}}"><i class="fas fa-toggle-on"></i> Hiện</a>
                                       @else
                                       <a class="btn btn-sm btn-danger" href="{{route('menu.status',['menu'=>$item->id])}}"><i class="fas fa-toggle-off"></i> Ẩn</a>
                                       @endif
                                       <a class="btn btn-sm btn-primary" href="{{route('menu.edit',['menu'=>$item->id])}}"><i class="fas fa-edit"></i> Chỉnh sửa</a>
                                       <a class="btn btn-sm btn-success" href="{{route('menu.show',['menu'=>$item->id])}}"><i class="fas fa-eye"></i> Chi tiết</a>
                                       <a class="btn btn-sm btn-danger" href="{{route('menu.delete',['menu'=>$item->id])}}"><i class="fas fa-trash"></i> Xoá</a>
                                    </div>
                                 </td>
                                 <td>{{$item->link}}</td>
                                 <td>{{$item->position}}</td>
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