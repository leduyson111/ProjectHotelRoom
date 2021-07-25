@extends('admin.layouts.admin')

@section('title', 'Thêm dịch vụ')

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
                    <input required type="text" name="name" value="{{ $service->name }}" class="form-control"
                        placeholder="Nhập tên dịch vụ">
                </div>
            </div>

            <div class="form-group col-md-6">
                <label for="iputName" class="text-muted d-block mb-2">Icon</label>
                <div class="input-group mb-3">
                    <input type="file" name="icon" class="form-control">
                </div>
                <img width="200" height="200" src="{{ asset($service->icon) }}" alt="Lỗi">

            </div>


            &nbsp;&nbsp;&nbsp;
            <button type="submit" class="mb-2 btn btn-success mr-2">Sửa</button>
            <a href="{{ route('services') }}" class="mb-2 btn btn-danger mr-2">Hủy</a>

        </form>
    </div>

@endsection
