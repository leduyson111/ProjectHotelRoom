@extends('admin.layouts.admin')

@section('title', 'Trang thành viên')

@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('admins/main.js') }}"></script>

@endsection

@section('content')
    <div class="main-content-container container-fluid px-4">
        @include('admin.partials.title-content', ['name'=>'Trang thành viên'])

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="row">
            <div class="col">
                <div class="card card-small mb-4">
                    <div class="card-header border-bottom">
                        <h6 class="m-0">Thông tin thành viên</h6>
                        <a class="nav-link " href="{{ route('users.add') }}">
                            <i class="material-icons">note_add</i>
                            <span>Thêm thành viên</span>
                        </a>

                    </div>
                    <div class="card-body p-0 pb-3 text-center">
                        <table class="table mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th scope="col" class="border-0">#</th>
                                    <th scope="col" class="border-0">Tên thành viên</th>
                                    <th scope="col" class="border-0">Email</th>
                                    <th scope="col" class="border-0">Ảnh</th>
                                    <th scope="col" class="border-0">Số điện thoại</th>
                                    <th scope="col" class="border-0">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ ($users->currentPage() - 1) * 15 + $loop->iteration }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td><img width="230px" height="230px" src="{{ $user->avatar }}"></td>
                                        <td>{{ $user->phone_number }}</td>
                                        <td>
                                            <a href="{{ route('users.profile', ['id' => $user->id]) }}"
                                                class="mb-2 btn btn-info mr-2 ">Sửa</a>
                                            <a href="" data-url="{{ route('users.delete', ['id' => $user->id]) }}"
                                                class="mb-2 btn btn-danger mr-2 action_delete">Xóa</a>
                                        </td>
                                    </tr>

                                @endforeach

                            </tbody>
                        </table>
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
