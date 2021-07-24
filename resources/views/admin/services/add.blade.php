@extends('admin.layouts.admin')

@section('title', 'Thêm dịch vụ')

@section('content')
<div class="main-content-container container-fluid px-4">
@include('admin.partials.title-content', ['name'=>'Thêm dịch vụ'])


<form action="{{ route('services.store') }}" enctype="multipart/form-data" class="add-new-post" method="POST">
    @csrf

        <div class="form-group col-md-6">
            <label for="iputName" class="text-muted d-block mb-2">Tên dịch vụ</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                <span class="input-group-text">@</span>
                </div>
                <input type="text" name="name"  class="form-control" placeholder="Nhập tên dịch vụ" > 
            </div>
        </div>

        <div class="form-group col-md-6">
            <label for="iputName" class="text-muted d-block mb-2">Icon</label>
            <div class="input-group mb-3">
                <input  type="file" name="icon"  class="form-control"  > 
            </div>
        </div>
        &nbsp;&nbsp;&nbsp;    
        <button type="submit" class="mb-2 btn btn-success mr-2">Thêm</button>
        <a href="{{ route('services') }}" class="mb-2 btn btn-danger mr-2">Hủy</a>
   
</form>
</div>

@endsection