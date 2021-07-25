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

        <form action="{{ route('services.store') }}" enctype="multipart/form-data" class="add-new-post" method="POST">
            @csrf

            <div class="form-group col-md-6">
                <label for="iputName" class="text-muted d-block mb-2">Tên dịch vụ</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">@</span>
                    </div>
                    <input type="text" required name="name" class="form-control" placeholder="Nhập tên dịch vụ">
                </div>
            </div>

        
                <div class="form-group col-md-6">
                    <div class="input-group">
                        <span class="input-group-btn">
                        <a id="lfm" data-input="icon" data-preview="holder" class="btn btn-primary">
                            <i class="fa fa-picture-o"></i> Choose
                        </a>
                        </span>
                        <input required id="icon" class="form-control" type="text" name="icon">
                    </div>

                    <div id="holder">
                        <img  src="{{ old('icon') ?: '(!empty($post) ? $post->icon : "")' }}"  style="margin-top:15px;max-height:100px;">
                    </div>


                </div>

            &nbsp;&nbsp;&nbsp;
            <button type="submit" class="mb-2 btn btn-success mr-2">Thêm</button>
            <a href="{{ route('services') }}" class="mb-2 btn btn-danger mr-2">Hủy</a>

        </form>
    </div>

@endsection
