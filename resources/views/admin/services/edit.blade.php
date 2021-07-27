@extends('admin.layouts.admin')

@section('title', 'Thêm dịch vụ')

@section('css')
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.3/summernote.css" rel="stylesheet">

@endsection

@section('js')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script src="{{ asset('admins/rooms/add.js') }}"></script>
@endsection

@section('content')
    <div class="main-content-container container-fluid px-4">
        @include('admin.partials.title-content', ['name'=>'Thêm dịch vụ'])


        <form action="{{ route('services.update', ['id' => $service->id]) }}" enctype="multipart/form-data"
            class="add-new-post" method="POST">
            @csrf

            <div class="form-group col-md-6">
                <label for="iputName" class="text-muted d-block mb-2">Tên dịch vụ</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">@</span>
                    </div>
                    <input  type="text" name="name" value="{{ $service->name }}" class="form-control"
                        placeholder="Nhập tên dịch vụ">
                
                </div>
                @error('name')
                    <span style="color: red; font-size:17px" >{{ $message }}</span>
                @enderror
          
            </div>
            <div class="form-group col-md-6">
                <div class="input-group">
                    <span class="input-group-btn">
                    <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                        <i class="fa fa-picture-o"></i> Choose
                    </a>
                    </span>
                    <input  id="thumbnail" class="form-control" value="{{ $service->icon }}" type="text" name="icon">
                    @error('icon')
                        <span style="color: red; font-size:17px" >{{ $message }}</span>
                    @enderror
              
                </div>

                <div id="holder">
                     <img  src="{{ $service->icon }}" style="margin-top:15px;max-height:100px;">
                </div>
            </div>


            &nbsp;&nbsp;&nbsp;
            <button type="submit" class="mb-2 btn btn-success mr-2">Sửa</button>
            <a href="{{ route('services') }}" class="mb-2 btn btn-danger mr-2">Hủy</a>

        </form>
    </div>

@endsection
