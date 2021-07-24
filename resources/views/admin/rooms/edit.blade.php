@extends('admin.layouts.admin')

@section('title', 'Sửa phòng')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src='https://cloud.tinymce.com/stable/tinymce.min.js'></script>
    <script src="{{ asset('admins/rooms/add.js') }}"></script>

    <script>
          function addServices(e) {
            e.preventDefault();
            
            $("#log").append('<div class="row"> <div class="col-md-5"><select name="service_id[]" class="form-select form-control">  @foreach ($services as $service)<option value="{{ $service->id }}">{{ $service->name }}</option> @endforeach </select>   </div> <div class="col-md-5"> <input type="text" required  name="additional_price[]" class="form-control" placeholder="Giá dịch vụ"> </div><div class="col-md-2"> <button type="button"    class="delete_services detailbtn mb-2 btn btn-danger mr-2">Xóa</button> </div></div>');
        }
        function deleteServices(e){
            e.preventDefault();
            $(this).parent().parent().remove();
        }

        $(function() {
            $(document).on("click", '.add_services', addServices);
            $(document).on('click', '.delete_services', deleteServices);
        })
    </script>

@endsection

@section('content')
    <div class="main-content-container container-fluid px-4">
        @include('admin.partials.title-content', ['name'=>'Thêm phòng'])

        <form action="{{ route('rooms.update', ['id'=>$room->id]) }}" class="add-new-post" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="iputName" class="text-muted d-block mb-2">Tên phòng</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">@</span>
                        </div>
                        <input  type="text" value="{{ $room->room_no }}" name="room_no" class="form-control"
                            placeholder="Nhập tên phòng">
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <label for="iputName" class="text-muted d-block mb-2">Tên dịch vụ</label>
                    <div id="log">
                        @foreach ($roomservices as $roomsItem)
                            <div class="row">
                                <div class="col-md-5">
                                    <select name="service_id[]" class="form-select form-control">
                                        @foreach ($services as $service)
                                            <option @if ($roomsItem->service_id == $service->id) selected @endif value="{{ $service->id }}">
                                                {{ $service->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-5">
                                    <input type="text" required value="{{ $roomsItem->additional_price }}"
                                        name="additional_price[]" class="form-control" placeholder="Giá dịch vụ">
                                </div>
                                <div class="col-md-2"> <button type="button"
                                        class="delete_services detailbtn mb-2 btn btn-danger mr-2">Xóa</button> </div>
                            </div>
                        @endforeach
                    </div>


                    <a href="" class="mb-2 btn btn-primary mr-2 add_services">Thêm dịch vụ</a>


                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="price" class="text-muted d-block mb-2">Giá phòng</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">@</span>
                        </div>
                        <input type="text" name="price" value="{{ $room->price }}" id="price" class="form-control"
                            placeholder="Nhập tên danh mục">
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <label for="floor" class="text-muted d-block mb-2">Số tầng</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">@</span>
                        </div>
                        <input min="1" value="{{ $room->floor }}" max="30" type="number" name="floor" id="floor"
                            class="form-control" placeholder="Số tầng">
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="image" class="text-muted d-block mb-2">Ảnh phòng</label>
                    <div class="input-group mb-3">
                        <input type="file" name="image" id="image">
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="inputState" class="text-muted d-block mb-2">Mô tả phòng</label>
                    <textarea class="form-control tinymce_editor_init" name="detail" cols="30"
                        rows="10">{{ $room->detail }}</textarea>
                </div>
            </div>
            <button type="submit" class="mb-2 btn btn-success mr-2">Thêm</button>
            <a href="{{ route('services') }}" class="mb-2 btn btn-danger mr-2">Hủy</a>
        </form>
    </div>

@endsection
