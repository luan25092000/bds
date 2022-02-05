@extends('admin.layouts.index')


@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Người dùng
                    <small>Thêm</small>
                    <br>
                    <small class="text-danger">
                        <i>Hiện email: <b>{{ $email }}</b> chưa có trong hệ thống, vui lòng tạo tài khoản cho email này</i>
                    </small>
                </h1>
                <form action="{{ route('customer.order.add', ['id' => $id]) }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    
                    <input type="hidden" name="order_id" value="{{ $id }}" />

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
                    <button type="submit" class="btn btn-primary">Thêm</button>
                  </form>
            </div>
        </div>
    </div>    
</div>
@endsection