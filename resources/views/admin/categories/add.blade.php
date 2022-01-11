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
                    <button type="submit" class="btn btn-primary">Thêm</button>
                  </form>
            </div>
        </div>
    </div>    
</div>
@endsection