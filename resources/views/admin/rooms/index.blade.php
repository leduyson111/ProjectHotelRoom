@extends('admin.layouts.admin')

@section('title', 'Trang dịch vụ')

@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('admins/main.js') }}"></script>
@endsection

@section('content')
    <div class="main-content-container container-fluid px-4">
        @include('admin.partials.title-content', ['name'=>'Trang phòng'])
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="row">
            <div class="col">
                <div class="card card-small mb-4">
                    <div class="card-header border-bottom">
                        <h6 class="m-0">Thêm phòng</h6>
                        <a class="nav-link " href="{{ route('rooms.add') }}">
                            <i class="material-icons">note_add</i>
                            <span>Thêm phòng</span>
                        </a>
                    </div>
                    <div class="card-body p-0 pb-3 text-center">
                        <table class="table mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th scope="col" class="border-0">#</th>
                                    <th scope="col" class="border-0">Room No</th>
                                    <th scope="col" class="border-0">floor</th>
                                    <th scope="col" class="border-0">image</th>
                                    <th scope="col" class="border-0">giá</th>
                                    <th scope="col" class="border-0">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rooms as $room)
                                    <tr>
                                        <td>{{(($rooms->currentPage()-1)*15) + $loop->iteration}}</td>
                                        <td>{{ $room->room_no }}</td>
                                        <td>{{ $room->floor }}</td>
                                        <td><img width="200" height="200" src="{{ asset($room->image) }}" alt=""></td>
                                        <td>{{ $room->price }}</td>
                                        <td>
                                          <a href="{{ route('rooms.edit', ['id' =>$room->id]) }}" class="mb-2 btn btn-info mr-2 ">Sửa</a>
                                          <a href="" data-url="{{ route('rooms.delete', ['id' => $room->id]) }}" class="mb-2 btn btn-danger mr-2 action_delete">Xóa</a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        {{$rooms->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
