@extends('admin.layouts.admin')

@section('title', 'Trang dịch vụ')

@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('admins/main.js') }}"></script>

@endsection

@section('content')
    <div class="main-content-container container-fluid px-4">
        @include('admin.partials.title-content', ['name'=>'Trang dịch vụ'])

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="row">
            <div class="col">
                <div class="card card-small mb-4">
                    <div class="card-header border-bottom">
                        <h6 class="m-0">Thêm dịch vụ</h6>
                        <a class="nav-link " href="{{ route('services.add') }}">
                            <i class="material-icons">note_add</i>
                            <span>Thêm dịch vụ</span>
                        </a>

                    </div>
                    <div class="card-body p-0 pb-3 text-center">
                        <table class="table mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th scope="col" class="border-0">#</th>
                                    <th scope="col" class="border-0">Tên dịch vụ</th>
                                    <th scope="col" class="border-0">Icon</th>
                                    <th scope="col" class="border-0">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($services as $service)
                                    <tr>
                                        <td>{{ ($services->currentPage() - 1) * 15 + $loop->iteration }}</td>
                                        <td>{{ $service->name }}</td>
                                        <td><img width="200" height="200" src="{{ asset($service->icon) }}" alt="Lỗi"></td>
                                        <td>
                                            <a href="{{ route('services.edit', ['id' => $service->id]) }}"
                                                class="mb-2 btn btn-info mr-2 ">Sửa</a>
                                            <a href="" data-url="{{ route('services.delete', ['id' => $service->id]) }}"
                                                class="mb-2 btn btn-danger mr-2 action_delete">Xóa</a>
                                        </td>
                                    </tr>

                                @endforeach

                            </tbody>
                        </table>
                        {{ $services->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
