@extends('admin.layouts.index')


@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Người dùng
                    <small>Thêm</small>
                </h1>
                <form action="{{ route('customer.add') }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    <div class="form-group">
                        <label for="name">Họ tên: <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Nhập họ tên" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email: <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Nhập email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Mật khẩu: <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" placeholder="Nhập mật khẩu" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="role">Vị trí: <span class="text-danger">*</span></label>
                        <select class="form-control" name="role" id="role" required>
                            <option value="1">Quản lý</option>
                            <option value="2">Nhân viên</option>
                            <option value="3">Khách hàng</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Thêm</button>
                  </form>
            </div>
        </div>
    </div>    
</div>
@endsection