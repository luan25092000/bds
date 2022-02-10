@extends('admin.layouts.index')


@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Người dùng
                    <small>Sửa</small>
                </h1>
                <form action="{{ route('customer.edit', ['id' => $user->id]) }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    <div class="form-group">
                        <label for="name">Họ tên: <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Nhập họ tên" id="name" name="name" value="{{ $user->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email: <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Nhập email" id="email" name="email" value="{{ $user->email }}" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Mật khẩu: <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" placeholder="Nhập mật khẩu" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Số điện thoại</label>
                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="Nhập số điện thoại" pattern="[0-9]{10}" value="{{ $user->phone }}" required>
                    </div>
                    <div class="form-group">
                        <label for="role">Vị trí: <span class="text-danger">*</span></label>
                        <select class="form-control" name="role" id="role" required>
                            <option value="1" {{ $user->role == 1 ? 'selected' : '' }}>Quản lý</option>
                            <option value="2" {{ $user->role == 2 ? 'selected' : '' }}>Nhân viên</option>
                            <option value="3" {{ $user->role == 3 ? 'selected' : '' }}>Khách hàng</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Sửa</button>
                  </form>
            </div>
        </div>
    </div>    
</div>
@endsection